<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Permission;

use Illuminate\Support\Facades\View;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Product;
use App\Models\Slider;
use App\Models\ProductCategory;
use Gloudemans\Shoppingcart\Facades\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $permissions = Permission::all();
        foreach($permissions as $permission){
            Gate::define($permission->slug,function(User $user) use ($permission){
                return $user->hasPermission($permission->slug);
            });
        }

        // Lấy menu
        View::composer('components.navbar',function($view){
            $menus = Menu::where('status','active')->orderBy('order','asc')->get();
             $cart_count = Cart::count();
            $view->with(compact('menus','cart_count'));
        });

        // Lấy danh mục sản phẩm
        View::composer('components.categories-product',function($view){
            $product_categories = ProductCategory::where('parent_id',0)->where('status','active')->get();
            $view->with('product_categories',$product_categories);
        });

        // Đếm số hơn hàng mới
        View::composer('components.topbar-content',function($view){
            $total_pending_order = Order::where('status','pending')->count();
            $view->with('total_pending_order',$total_pending_order);
        });

        // Danh sách đơn hàng mới
        View::composer('components.topbar-content',function($view){
            $new_orders = Order::where('status','pending')->orderBy('created_at','desc')->get();
            $view->with('new_orders',$new_orders);
        });

        // Danh sách tên sản phẩm + slug
        View::composer('components.search',function($view){
            $products_info = Product::where('status','active')->limit(7)->get()->pluck('name','slug');
            $view->with('products_info',$products_info);
        });
    }
}
