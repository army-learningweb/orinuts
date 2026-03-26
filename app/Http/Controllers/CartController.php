<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Intervention\Image\Colors\Rgb\Channels\Red;

class CartController extends Controller
{
    // Danh sách
    function view()
    {
        $carts = Cart::content();
        // return 
        $cart_count = Cart::count();
        $cart_provisional = Cart::total();
        $cart_total = $cart_provisional + 30000;
        $more_cash_to_free_ship = 490000 - $cart_total;
        $products_disscount = Product::with('media')->where('status', 'active')->where('disscount', '>', 0)->orderBy('updated_at')->get();

        return view('client.cart.view', compact('products_disscount', 'carts', 'cart_count', 'cart_provisional', 'cart_total', 'more_cash_to_free_ship'));
    }

    // Thêm
    function add(Request $request, $id)
    {
        
        $product_info = Product::with('media')->find($id);
        
        if ($product_info->disscount > 0) {
            $price = $product_info->price - ($product_info->price * ($product_info->disscount / 100));
        } else {
            $price = $product_info->price;
        }

        $quantity = $request->product_quantity ? $request->product_quantity : 1;

        Cart::add([
            'id' => $product_info->id,
            'name' => $product_info->name,
            'qty' => $quantity,
            'price' => $price,
            'options' => [
                'url' => $product_info->media->url,
                'desc' => $product_info->desc,
                'disscount' => $product_info->disscount,
                'quantity' => $product_info->quantity
            ]
        ]);

        if($request->segment(2) == 'mua-ngay' || $request->buyNow == 'yes'){
            return redirect()->route('thanh-toan')->with('status_complete','Đã thêm sản phẩm vào giỏ hàng');
        }

        return redirect()->route('gio-hang')->with('status_complete','Thêm vào giỏ thành công');
    }

    // Thêm (Ajax)
    function addAjax(Request $request)
    {

        $id = $request->id;

        $product_info = Product::find($id);

        if ($product_info->disscount > 0) {
            $price = $product_info->price - ($product_info->price * ($product_info->disscount / 100));
        } else {
            $price = $product_info->price;
        }

        if ($product_info) {
            Cart::add([
                'id' => $product_info->id,
                'name' => $product_info->name,
                'qty' => 1,
                'price' => $price,
                'options' => [
                    'url' => $product_info->media->url,
                    'desc' => $product_info->desc,
                    'disscount' => $product_info->disscount,
                    'quantity' => $product_info->quantity
                ]
            ]);
            $status = view('client.cart.partials.flash-session')->render();
            $cart_count = Cart::count();
            $view_cart_count = view('client.cart.partials.cart-count', compact('cart_count'))->render();
        } else {
            $status = view('client.cart.partials.flash-session-failed')->render();
        }

        $data = [
            'status' => $status,
            'view_cart_count' => $view_cart_count
        ];

        return response()->json($data);
    }

    // Xóa 1
    function delete($row_id)
    {
        Cart::remove($row_id);
        return back()->with('status_complete', 'Đã xóa sản phẩm khỏi giỏ hàng');
    }

    // Xóa giỏ hàng
    function destroy()
    {
        Cart::destroy();
        return back()->with('status_complete', 'Đã xóa toàn bộ sản phẩm khỏi giỏ hàng');
    }

    // Thay đổi số lượng trong giỏ hàng (Ajax)
    function changeQuantity(Request $request)
    {
        $qty = $request->qty;
        $rowId = $request->row_id;
        $price = $request->price;

        Cart::update($rowId, $qty);

        $subtotal = number_format(Cart::get($rowId)->subtotal, 0, ',', '.') . 'đ';
        $cart_provisional = number_format(Cart::total(), 0, ',', '.') . 'đ';
        $cart_count = Cart::count();
        $view_cart_count = view('client.cart.partials.cart-count', compact('cart_count'))->render();;
        $view_ship = Cart::total() > 490000 ? 'Miễn phí' : number_format(30000, 0, ',', '.') . 'đ';
        $cart_total = Cart::total() > 490000 ? number_format(Cart::total() , 0, ',', '.') . 'đ' : number_format(Cart::total() + 30000, 0, ',', '.') . 'đ';

        $free_ship = 490000 - Cart::total();

        if ($free_ship < 0) {
            $cash_to_free_ship = "Miễn phí Ship cho đơn hàng của bạn";
        } else {
            $cash_to_free_ship = 'Thêm ' . number_format(490000 - Cart::total(), 0, ',', '.') . 'đ được miễn phí Ship';
        }

        $data = [
            'subtotal' => $subtotal,
            'rowId' => $rowId,
            'cart_provisional' => $cart_provisional,
            'view_cart_count' => $view_cart_count,
            'view_ship' => $view_ship,
            'cart_total' => $cart_total,
            'cash_to_free_ship' => $cash_to_free_ship,
            'cart_count' => $cart_count
        ];

        return response()->json($data);
    }
}
