<?php

use App\Http\Controllers\AdminCustomerController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminValidationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminProductCatController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminFileController;
use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminPostCatController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminSliderController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\AdminPermissionController;
use App\Http\Controllers\AdminReviewController;
use App\Http\Controllers\AdminRoleController;

use App\Models\Role;
use Termwind\Components\Raw;
use UniSharp\LaravelFilemanager\Lfm;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;

//Validation Ajax
Route::post('admin/validation', [AdminValidationController::class, 'validation']);

// ====================================================================
// ADMIN
// ====================================================================

// MODULE DASHBOARD ---------------------------------------------------

Route::middleware(['auth','verified'])->group(function(){

    // Thống kê
    Route::get('admin/dashboard', [AdminDashboardController::class, 'show'])->name('admin.dashboard');

    // Phân trang sản phẩm sắp hết hàng
    Route::post('admin/dashboard/', [AdminDashboardController::class, 'paginate_out_of_stock']);  
    
    // Lấy đơn hàng mới
    Route::post('admin/dashboard/getNewOrder', [AdminDashboardController::class, 'getNewOrder']);

    // Lấy thông báo đơn hàng
    Route::post('admin/dashboard/getNewAlert', [AdminDashboardController::class, 'getNewAlert']);
});

Route::middleware('auth')->group(function () {

    // File upload
    Route::post('admin/uploadFile', [AdminFileController::class, 'uploadFile']);
    Route::post('admin/deleteFile', [AdminFileController::class, 'deleteFile']);

    // Cập nhật hồ sơ
    Route::get('admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {

    // ====================================================================
    // MODULE USER
    // ====================================================================
    Route::middleware('can:user.manager')->group(function () {
        // Danh sách
        Route::get('admin/users/list', [AdminUserController::class, 'list'])->name('admin.users.list');
        Route::post('admin/users/list', [AdminUserController::class, 'list_filter']);

        // Thêm
        Route::get('admin/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
        Route::post('admin/users/store', [AdminUserController::class, 'store'])->name('admin.users.store');

        // Cập nhật
        Route::get('admin/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
        Route::post('admin/users/{user}/update', [AdminUserController::class, 'update'])->name('admin.users.update');

        // Xóa + xóa vĩnh viễn
        Route::get('admin/users/{id}/destroy', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
        Route::get('admin/users/{id}/forceDelete', [AdminUserController::class, 'forceDelete'])->name('admin.users.forceDelete');

        // Thùng rác
        Route::get('admin/users/trash', [AdminUserController::class, 'trash'])->name('admin.users.trash');
        Route::post('admin/users/trash', [AdminUserController::class, 'trash_filter']);

        // Khôi phục
        Route::get('admin/users/{id}/restore', [AdminUserController::class, 'restore'])->name('admin.users.restore');

        // Cập nhật nhanh trạng thái (Ajax)
        Route::post('admin/users/updateStatus', [AdminUserController::class, 'updateStatus'])->name('admin.users.updateStatus');

        // Hành động
        Route::post('admin/users/action', [AdminUserController::class, 'action'])->name('admin.users.action');
    });

    // ====================================================================
    // MODULE PRODUCT
    // ====================================================================
    Route::middleware('can:product.manager')->group(function () {
        // DANH MỤC -----------------------------------------------------------

        // Danh sách
        Route::get('admin/product/categories/list', [AdminProductCatController::class, 'list'])->name('admin.product.categories.list');

        // Thêm
        Route::get('admin/product/categories/create', [AdminProductCatController::class, 'create'])->name('admin.product.categories.create');
        Route::post('admin/product/categories/store', [AdminProductCatController::class, 'store'])->name('admin.product.categories.store');

        // Cập nhật
        Route::get('admin/product/categories/{id}/edit', [AdminProductCatController::class, 'edit'])->name('admin.product.categories.edit');
        Route::post('admin/product/categories/{id}/update', [AdminProductCatController::class, 'update'])->name('admin.product.categories.update');

        // Bỏ vào thùng rác
        Route::get('admin/product/categories/{id}/destroy', [AdminProductCatController::class, 'destroy'])->name('admin.product.categories.destroy');

        // Xóa vĩnh viễn
        Route::get('admin/product/categories/{id}/forceDelete', [AdminProductCatController::class, 'forceDelete'])->name('admin.product.categories.forceDelete');

        // Thùng rác
        Route::get('admin/product/categories/trash', [AdminProductCatController::class, 'trash'])->name('admin.product.categories.trash');

        // Cập nhật nhanh trạng thái
        Route::post('admin/product/categories/updateStatusCategory', [AdminProductCatController::class, 'updateStatusCategory'])->name('admin.product.update_status_category');

        // Hành động
        Route::post('admin/product/categories/action', [AdminProductCatController::class, 'action'])->name('admin.product.categories.action');

        // Khôi phục
        Route::get('admin/product/categories/{id}/restore', [AdminProductCatController::class, 'restore'])->name('admin.product.categories.restore');

        // SẢN PHẨM ---------------------------------------------------

        // Danh sách
        Route::get('admin/product/list', [AdminProductController::class, 'list'])->name('admin.product.list');
        Route::post('admin/product/list', [AdminProductController::class, 'list_filter']);

        // Thùng rác
        Route::get('admin/product/trash', [AdminProductController::class, 'trash'])->name('admin.product.trash');
        Route::post('admin/product/trash', [AdminProductController::class, 'trash_filter']);

        // Thêm
        Route::get('admin/product/create', [AdminProductController::class, 'create'])->name('admin.product.create');
        Route::post('admin/product/store', [AdminProductController::class, 'store'])->name('admin.product.store');

        // Cập nhật
        Route::get('admin/product/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.product.edit');
        Route::post('admin/product/{id}/update', [AdminProductController::class, 'update'])->name('admin.product.update');

        // Bỏ vào thùng rác
        Route::get('admin/product/{id}/destroy', [AdminProductController::class, 'destroy'])->name('admin.product.destroy');

        // Xóa vĩnh viễn
        Route::get('admin/product/{id}/forceDelete', [AdminProductController::class, 'forceDelete'])->name('admin.product.forceDelete');

        // Khôi phục
        Route::get('admin/product/{id}/restore', [AdminProductController::class, 'restore'])->name('admin.product.restore');

        // Hành động
        Route::post('admin/product/action', [AdminProductController::class, 'action'])->name('admin.product.action');

        // Cập nhật nhanh trạng thái (Ajax)
        Route::post('admin/product/updateStatus', [AdminProductController::class, 'updateStatus'])->name('admin.product.updateStatus');
    });

    // ====================================================================
    // MODULE ORDER
    // ====================================================================

    // Danh sách
    Route::get('admin/orders', [AdminOrderController::class, 'list'])->name('admin.orders');
    Route::post('admin/orders', [AdminOrderController::class, 'list_filter']);

    // Chi tiết đơn
    Route::get('admin/orders/{id}/edit', [AdminOrderController::class, 'edit'])->name('admin.orders.edit');

    // Cập nhật thông tin đơn
    Route::post('admin/orders/{id}/update', [AdminOrderController::class, 'update'])->name('admin.orders.update');

    // Hành động
    Route::post('admin/orders/action', [AdminOrderController::class, 'action'])->name('admin.orders.action');

    // Cập nhật nhanh trạng thái
    Route::post('admin/orders/updateStatus', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

    // ====================================================================
    // MODULE CUSTOMER
    // ====================================================================

    // Danh sách
    Route::get('admin/customers', [AdminCustomerController::class, 'list'])->name('admin.customers');
    Route::post('admin/customers', [AdminCustomerController::class, 'list_filter'])->name('admin.customers');

    // Thùng rác
    Route::get('admin/customers/trash', [AdminCustomerController::class, 'trash'])->name('admin.customers.trash');
    Route::post('admin/customers/trash', [AdminCustomerController::class, 'trash_filter']);

    // Bỏ vào thùng rác & Xóa vĩnh viễn
    Route::get('admin/customers/{id}/destroy', [AdminCustomerController::class, 'destroy'])->name('admin.customers.destroy');
    Route::get('admin/customers/{id}/forceDelete', [AdminCustomerController::class, 'forceDelete'])->name('admin.customers.forceDelete');

    // Hành động
    Route::post('admin/customers/action', [AdminCustomerController::class, 'action'])->name('admin.customers.action');

    // Khôi phục
    Route::get('admin/customers/{id}/restore', [AdminCustomerController::class, 'restore'])->name('admin.customers.restore');

    // ====================================================================
    // MODULE REVIEW
    // ====================================================================

    // Danh sách
    Route::get('admin/reviews',[AdminReviewController::class,'list'])->name('admin.reviews');
    Route::post('admin/reviews',[AdminReviewController::class,'list_filter']);

    // Cập nhật nhanh trạng thái (Ajax)
    Route::post('admin/reviews/updateStatus',[AdminReviewController::class,'updateStatus']);

    // Xóa vĩnh viễn
    Route::get('admin/reviews/{id}/forceDelete',[AdminReviewController::class,'forceDelete'])->name('admin.reviews.forceDelete');

    // Hành động
    Route::post('admin/reviews/action', [AdminReviewController::class, 'action'])->name('admin.reviews.action');


    // ====================================================================
    // MODULE POST
    // ====================================================================
    Route::middleware('can:post.manager')->group(function () {
        // DANH MỤC -----------------------------------------------------------

        // Danh sách
        Route::get('admin/post/categories/list', [AdminPostCatController::class, 'list'])->name('admin.post.categories.list');

        // Thùng rác
        Route::get('admin/post/category/trash', [AdminPostCatController::class, 'trash'])->name('admin.post.categories.trash');

        // Thêm
        Route::get('admin/post/categories/create', [AdminPostCatController::class, 'create'])->name('admin.post.categories.create');
        Route::post('admin/post/categories/store', [AdminPostCatController::class, 'store'])->name('admin.post.categories.store');

        // Cập nhật
        Route::get('admin/post/categories/{id}/eidt', [AdminPostCatController::class, 'edit'])->name('admin.post.categories.edit');
        Route::post('admin/post/categories/{id}/update', [AdminPostCatController::class, 'update'])->name('admin.post.categories.update');

        // Bỏ vào thùng rác
        Route::get('admin/post/categories/{id}/destroy', [AdminPostCatController::class, 'destroy'])->name('admin.post.categories.destroy');

        // Hành động
        Route::post('admin/post/categories/action', [AdminPostCatController::class, 'action'])->name('admin.post.categories.action');

        // Cập nhật nhanh trạng thái
        Route::post('admin/post/categories/updateStatusCategory', [AdminPostCatController::class, 'updateStatusCategory'])->name('admin.post.update_status_category');

        // Khôi phục
        Route::get('admin/post/categories/{id}/restore', [AdminPostCatController::class, 'restore'])->name('admin.post.categories.restore');

        // Xóa vĩnh viễn
        Route::get('admin/post/categories/{id}/forceDelete', [AdminPostCatController::class, 'forceDelete'])->name('admin.post.categories.forceDelete');

        // BÀI VIẾT -----------------------------------------------------------

        // Danh sách
        Route::get('admin/post/list', [AdminPostController::class, 'list'])->name('admin.post.list');
        Route::post('admin/post/list', [AdminPostController::class, 'list_filter']);

        // Thùng rác
        Route::get('admin/post/trash', [AdminPostController::class, 'trash'])->name('admin.post.trash');
        Route::post('admin/post/trash', [AdminPostController::class, 'trash_filter']);

        // Thêm
        Route::get('admin/post/create', [AdminPostController::class, 'create'])->name('admin.post.create');
        Route::post('admin/post/store', [AdminPostController::class, 'store'])->name('admin.post.store');

        // Cập nhật
        Route::get('admin/post/{id}/edit', [AdminPostController::class, 'edit'])->name('admin.post.edit');
        Route::post('admin/post/{id}/update', [AdminPostController::class, 'update'])->name('admin.post.update');

        // Bỏ vào thùng rác
        Route::get('admin/post/{id}/destroy', [AdminPostController::class, 'destroy'])->name('admin.post.destroy');

        // Xóa vĩnh viễn
        Route::get('admin/post/{id}/forceDelete', [AdminPostController::class, 'forceDelete'])->name('admin.post.forceDelete');

        // Khôi phục
        Route::get('admin/post/{id}/restore', [AdminPostController::class, 'restore'])->name('admin.post.restore');

        // Hành động
        Route::post('admin/post/action', [AdminPostController::class, 'action'])->name('admin.post.action');

        // Cập nhật nhanh trạng thái (Ajax)
        Route::post('admin/post/updateStatus', [AdminPostController::class, 'updateStatus']);
    });


    Route::middleware('can:website.manager')->group(function () {
        // ====================================================================
        // MODULE SLIDER
        // ====================================================================

        Route::get('admin/sliders/manager', [AdminSliderController::class, 'manager'])->name('admin.sliders.manager');

        // Thêm
        Route::post('admin/sliders/store', [AdminSliderController::class, 'store'])->name('admin.sliders.store');

        // Hành động
        Route::post('admin/sliders/action', [AdminSliderController::class, 'action'])->name('admin.sliders.action');

        // Cập nhật
        Route::get('admin/sliders/{id}/edit', [AdminSliderController::class, 'edit'])->name('admin.sliders.edit');
        Route::post('admin/sliders/{id}/update', [AdminSliderController::class, 'update'])->name('admin.sliders.update');

        // Xóa
        Route::get('admin/sliders/{id}/destroy', [AdminSliderController::class, 'destroy'])->name('admin.sliders.destroy');

        // Khôi phục
        Route::get('admin/sliders/{id}/restore', [AdminSliderController::class, 'restore'])->name('admin.sliders.restore');

        // Xóa vĩnh viễn
        Route::get('admin/sliders/{id}/forceDelete', [AdminSliderController::class, 'forceDelete'])->name('admin.sliders.forceDelete');

        // Cập nhật nhanh trạng thái (Ajax)
        Route::post('admin/sliders/updateStatus', [AdminSliderController::class, 'updateStatus']);

        // ====================================================================
        // MODULE PAGE
        // ====================================================================

        // Danh sách
        Route::get('admin/pages/list', [AdminPageController::class, 'list'])->name('admin.pages.list');
        Route::post('admin/pages/list', [AdminPageController::class, 'list_filter'])->name('admin.pages.list');

        // Thêm
        Route::get('admin/pages/create', [AdminPageController::class, 'create'])->name('admin.pages.create');
        Route::post('admin/pages/store', [AdminPageController::class, 'store'])->name('admin.pages.store');

        // Cập nhật
        Route::get('admin/pages/{id}/edit', [AdminPageController::class, 'edit'])->name('admin.pages.edit');
        Route::post('admin/pages/{id}/update', [AdminPageController::class, 'update'])->name('admin.pages.update');

        // Xóa
        Route::get('admin/pages/{id}/destroy', [AdminPageController::class, 'destroy'])->name('admin.pages.destroy');
        Route::get('admin/pages/{id}/forceDelete', [AdminPageController::class, 'forceDelete'])->name('admin.pages.forceDelete');

        // Hành động
        Route::post('admin/pages/action', [AdminPageController::class, 'action'])->name('admin.pages.action');

        // Cập nhật nhanh trạng thái
        Route::post('admin/pages/updateStatus', [AdminPageController::class, 'updateStatus']);

        // Khôi phục
        Route::get('admin/pages/{id}/restore',[AdminPageController::class,'restore'])->name('admin.pages.restore');

        // Thùng rác
        Route::get('admin/pages/trash', [AdminPageController::class, 'trash'])->name('admin.pages.trash');
        Route::post('admin/pages/trash', [AdminPageController::class, 'trash_filter'])->name('admin.pages.trash_filter');

        // ====================================================================
        // MODULE MENU
        // ====================================================================

        // Khu vực quản lí
        Route::get('admin/menu/manager', [AdminMenuController::class, 'manager'])->name('admin.menu.manager');

        // Thêm
        Route::post('admin/menu/store', [AdminMenuController::class, 'store'])->name('admin.menu.store');

        // Xóa
        Route::get('admin/menu/{id}/forceDelete', [AdminMenuController::class, 'forceDelete'])->name('admin.menu.forceDelete');

        // Cập nhật nhanh trạng thái
        Route::post('admin/menu/updateStatus', [AdminMenuController::class, 'updateStatus']);

        // Thay đổi thứ tự Menu
        Route::post('admin/menu/changeOrder',[AdminMenuController::class, 'changeOrder']);
    });

    Route::middleware('can:admin.manager')->group(function () {
        // ====================================================================
        // MODULE PERMISSION
        // ====================================================================

        // Khu vực quản lí
        Route::get('admin/permission/manager', [AdminPermissionController::class, 'manager'])->name('admin.permission.manager');

        // Thêm
        Route::post('admin/permission/store', [AdminPermissionController::class, 'store'])->name('admin.permission.store');

        // Cập nhật
        Route::get('admin/permission/{id}/edit', [AdminPermissionController::class, 'edit'])->name('admin.permission.edit');
        Route::post('admin/permission/{id}/update', [AdminPermissionController::class, 'update'])->name('admin.permission.update');

        // Xóa
        Route::get('admin/permission/{id}/destroy', [AdminPermissionController::class, 'destroy'])->name('admin.permission.destroy');

        // ====================================================================
        // MODULE ROLE
        // ====================================================================

        // Danh sách
        Route::get('admin/role/manager', [AdminRoleController::class, 'manager'])->name('admin.role.manager');

        // Thêm
        Route::post('admin/role/store', [AdminRoleController::class, 'store'])->name('admin.role.store');

        // Sửa
        Route::get('admin/role/{role}/edit', [AdminRoleController::class, 'edit'])->name('admin.role.edit');
        Route::post('admin/role/{role}/update', [AdminRoleController::class, 'update'])->name('admin.role.update');

        // Xóa
        Route::get('admin/role/{role}/destroy', [AdminRoleController::class, 'destroy'])->name('admin.role.destroy');
    });
});


// ====================================================================
// CLIENT
// ====================================================================

// Tìm kiếm sản phẩm
Route::post('tim-kiem', [HomeController::class, 'search']);

// ====================================================================
// INDEX
Route::get('/', [HomeController::class, 'index'])->name('/');

// ====================================================================
// BLOG

// Tất cả bài viết
Route::get('bai-viet', [PostController::class, 'view'])->name('bai-viet');

// Chi tiết bài viết
Route::get('bai-viet/{post_slug}.html', [PostController::class, 'details']);

// Bài viết theo danh mục
Route::get('bai-viet/{post_slug}', [PostController::class, 'list']);

// ====================================================================
// PRODUCT

// Sản phẩm theo danh mục
Route::get('san-pham', [ProductController::class, 'list'])->name('san-pham');

// Sản phẩm theo bộ lọc
Route::post('san-pham', [ProductController::class, 'list_filter']);

// Chi tiết sản phẩm
Route::get('san-pham/{product_slug}.html', [ProductController::class, 'details']);

// Tạm tính tiền
Route::post('san-pham/{product_slug}.html', [ProductController::class, 'provisionalTotal']);

// Sản phẩm theo danh mục
Route::get('san-pham/{product_slug}', [ProductController::class, 'view']);

// Thêm đánh giá sản phẩm
Route::post('san-pham/{product_id}/danh-gia',[ProductController::class,'createReview'])->name('san-pham.danh-gia');

// ====================================================================
// CART

// Danh sách
Route::get('gio-hang', [CartController::class, 'view'])->name('gio-hang');

// Thêm
Route::get('gio-hang/add/{id}', [CartController::class, 'add'])->name('gio-hang.add');

// Mua ngay
Route::get('gio-hang/mua-ngay/{id}', [CartController::class, 'add'])->name('gio-hang.mua-ngay');

// Thêm (Ajax)
Route::post('gio-hang/add', [CartController::class, 'addAjax']);

// Xóa 1
Route::get('gio-hang/delete/{row_id}', [CartController::class, 'delete'])->name('gio-hang.delete');

// Xóa giỏ hàng
Route::get('gio-hang/destroy', [CartController::class, 'destroy'])->name('gio-hang.destroy');

// Thay đổi số lượng
Route::post('gio-hang/changeQuantity', [CartController::class, 'changeQuantity']);

// ====================================================================
// CHECKOUT

// Xem hóa đơn
Route::get('thanh-toan', [CheckoutController::class, 'view'])->name('thanh-toan');

// Điều chỉnh phí vận chuyển , thay đổi cách thanh toán
Route::post('thanh-toan', [CheckoutController::class, 'changePaymentMethod'])->name('thanh-toan');

// Tạo đơn & tạo khách hàng & gửi mail
Route::post('order', [CheckoutController::class, 'order'])->name('order');

// Quét QR code
Route::get('thanh-toan-online/{method}', [CheckoutController::class, 'payOnline'])->name('thanh-toan-online');

// Cảm ơn
Route::get('hoan-tat-dat-hang', [CheckoutController::class, 'checkoutComplete'])->name('hoan-tat-dat-hang');

// ====================================================================
// PAGE
Route::get('{page}', [PageController::class, 'view']);

require __DIR__ . '/auth.php';
