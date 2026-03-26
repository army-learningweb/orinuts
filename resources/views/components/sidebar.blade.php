<div class="sidebar relative">
    <div class="brand text-center py-3">
        <a href="{{ route('admin.dashboard') }}"><x-app-logo class="text-[45px] px-3 text-left" /></a>
    </div>
    <div class="toggle-sidebar absolute top-4 right-4 md:hidden border px-2 py-1 rounded-md shadow-sm">
        <i class="fa-solid fa-bars text-xl"></i>
    </div>
    <ul class="main-menu s-sm font-semibold hidden md:block">
        @canany(['admin.manager'])
            <p class="select-none font-semibold text-gray-500 mb-2 mt-3 ml-4 tracking-wider uppercase text-xs">Tổng quan</p>
            {{-- dashboard --}}
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="inline-block py-3 w-full hover:text-green-700 {{ session('module_active') == 'dashboard' ? 'active' : '' }}">
                    <div class="ml-4 flex gap-2">
                        <span><i class="fa-solid fa-grip"></i></span>
                        <span>Dashboard</span>
                    </div>
                </a>
            </li>
        @endcanany

        @canany(['product.manager', 'sale.manager', 'admin.manager'])
            <p class="select-none font-semibold text-gray-500 my-2 ml-4 tracking-wider uppercase text-xs">Kinh doanh</p>
            {{-- sản phẩm --}}
            <li>
                <a href="#"
                    class="inline-block py-3 w-full hover:text-green-600 {{ session('module_active') == 'product' ? 'active' : '' }}">
                    <div class="ml-4 flex justify-between items-center">
                        <div class="flex gap-2">
                            <span><i class="fa-brands fa-product-hunt"></i></span>
                            <span>Sản phẩm</span>
                        </div>
                        <i class="fa-solid fa-caret-down arrow-down transition-all duration-150 mr-4"></i>
                    </div>
                </a>
                <ul
                    class="sub-menu font-semibold text-gray-700 {{ session('module_active') == 'product' ? '' : 'hidden' }}">
                    <li>
                        <a href="{{ route('admin.product.list') }}"
                            class="inline-block w-full py-2 mt-1 hover:text-green-600 {{ session('module_active') == 'product' && session('sub_module_active') == 'list' ? 'active' : '' }}">
                            <div class="ml-4">&nbsp; └─ Danh sách sản phẩm</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.product.create') }}"
                            class="hover:text-green-600 inline-block w-full py-2 mt-1 {{ session('module_active') == 'product' && session('sub_module_active') == 'create' ? 'active' : '' }}">
                            <div class="ml-4">&nbsp; └─ Thêm sản phẩm</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.product.categories.list') }}"
                            class="hover:text-green-600 inline-block w-full py-2 mt-1 {{ session('module_active') == 'product' && session('sub_module_active') == 'categories' && session('segment_4') == 'list' ? 'active' : '' }}">
                            <div class="ml-4">&nbsp; └─ Danh sách danh mục</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.product.categories.create') }}"
                            class="hover:text-green-600 inline-block w-full py-2 mt-1 {{ session('module_active') == 'product' && session('segment_4') == 'create' ? 'active' : '' }}">
                            <div class="ml-4">&nbsp; └─ Thêm danh mục</div>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Đơn hàng --}}
            <li>
                <a href="{{ route('admin.orders') }}"
                    class="inline-block py-3 w-full hover:text-green-600 {{ session('module_active') == 'orders' ? 'active' : '' }}">
                    <div class="ml-4 flex justify-between items-center">
                        <div class="flex gap-2">
                            <span><i class="fa-solid fa-receipt"></i></span>
                            <span>Đơn hàng</span>
                        </div>
                    </div>
                </a>
            </li>
        @endcanany

        {{-- Khách hàng --}}
        <p class="select-none font-semibold text-gray-500 my-2 ml-4 tracking-wider uppercase text-xs">Khách hàng</p>
        <li>
            <a href="{{ route('admin.customers') }}"
                class="inline-block py-3 w-full hover:text-green-600 {{ session('module_active') == 'customers' ? 'active' : '' }}">
                <div class="ml-4 flex justify-between items-center">
                    <div class="flex gap-2">
                        <span><i class="fa-solid fa-person"></i></span>
                        <span>Khách hàng</span>
                    </div>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.reviews') }}"
                class="inline-block py-3 w-full hover:text-green-600 {{ session('module_active') == 'reviews' ? 'active' : '' }}">
                <div class="ml-4 flex justify-between items-center">
                    <div class="flex gap-2">
                        <span><i class="fa-solid fa-comment"></i></span>
                        <span>Đánh giá</span>
                    </div>
                </div>
            </a>
        </li>

        @canany(['post.manager', 'admin.manager'])
            <p class="select-none font-semibold text-gray-500 my-2 ml-4 tracking-wider uppercase text-xs">Nội dung</p>
            {{-- bài viết --}}
            <li>
                <a href="#"
                    class="inline-block py-3 w-full hover:text-green-600 {{ session('module_active') == 'post' ? 'active' : '' }}">
                    <div class="ml-4 flex justify-between items-center">
                        <div class="flex gap-2">
                            <span><i class="fa-solid fa-pen-to-square"></i></span>
                            <span>Bài viết</span>
                        </div>
                        <i class="fa-solid fa-caret-down arrow-down transition-all duration-150 mr-4"></i>
                    </div>
                </a>
                <ul class="sub-menu font-semibold text-gray-700 {{ session('module_active') == 'post' ? '' : 'hidden' }}">
                    <li>
                        <a href="{{ route('admin.post.list') }}"
                            class="inline-block w-full py-2 mt-1 hover:text-green-600 {{ session('module_active') == 'post' && session('sub_module_active') == 'list' ? 'active' : '' }}">
                            <div class="ml-4">&nbsp; └─ Danh sách bài viết</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.post.create') }}"
                            class="hover:text-green-600 inline-block w-full py-2 mt-1 {{ session('module_active') == 'post' && session('sub_module_active') == 'create' ? 'active' : '' }}">
                            <div class="ml-4">&nbsp; └─ Thêm bài viết</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.post.categories.list') }}"
                            class="hover:text-green-600 inline-block w-full py-2 mt-1 {{ session('module_active') == 'post' && session('sub_module_active') == 'categories' && session('segment_4') == 'list' ? 'active' : '' }}">
                            <div class="ml-4">&nbsp; └─ Danh sách danh mục</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.post.categories.create') }}"
                            class="hover:text-green-600 inline-block w-full py-2 mt-1 {{ session('module_active') == 'post' && session('segment_4') == 'create' ? 'active' : '' }}">
                            <div class="ml-4">&nbsp; └─ Thêm danh mục</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endcanany

        @canany(['website.manager', 'admin.manager'])
            {{-- Trang --}}
            <li>
                <a href="#"
                    class="inline-block py-3 w-full hover:text-green-600 {{ session('module_active') == 'pages' ? 'active' : '' }}">
                    <div class="ml-4 flex justify-between items-center">
                        <div class="flex gap-2">
                            <span><i class="fa-solid fa-newspaper"></i></span>
                            <span>Trang</span>
                        </div>
                        <i class="fa-solid fa-caret-down arrow-down transition-all duration-150 mr-4"></i>
                    </div>
                </a>
                <ul class="sub-menu font-semibold text-gray-700 {{ session('module_active') == 'pages' ? '' : 'hidden' }}">
                    <li>
                        <a href="{{ route('admin.pages.list') }}"
                            class="inline-block w-full py-2 mt-1 hover:text-green-600 {{ session('module_active') == 'pages' && session('sub_module_active') == 'list' ? 'active' : '' }}">
                            <div class="ml-4">&nbsp; └─ Danh sách trang</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pages.create') }}"
                            class="hover:text-green-600 inline-block w-full py-2 mt-1 {{ session('module_active') == 'pages' && session('sub_module_active') == 'create' ? 'active' : '' }}">
                            <div class="ml-4">&nbsp; └─ Thêm trang</div>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- Slider (Ads) --}}
            <li>
                <a href="{{ route('admin.sliders.manager') }}"
                    class="inline-block py-3 w-full hover:text-green-600 {{ session('module_active') == 'sliders' ? 'active' : '' }}">
                    <div class="ml-4 flex justify-between items-center">
                        <div class="flex gap-2">
                            <span><i class="fa-solid fa-sliders"></i></span>
                            <span>Slider (Ads)</span>
                        </div>
                    </div>
                </a>
            </li>
            {{-- Menu --}}
            <li>
                <a href="{{ route('admin.menu.manager') }}"
                    class="inline-block py-3 w-full hover:text-green-600 {{ session('module_active') == 'menu' ? 'active' : '' }}">
                    <div class="ml-4 flex justify-between items-center">
                        <div class="flex gap-2">
                            <span><i class="fa-brands fa-elementor"></i></span>
                            <span>Menu</span>
                        </div>
                    </div>
                </a>
            </li>
        @endcanany

        @canany(['user.manager', 'admin.manager'])
            <p class="select-none font-semibold text-gray-500 my-2 ml-4 tracking-wider uppercase text-xs">Thành viên</p>
            {{-- User --}}
            <li>
                <a href="#"
                    class="inline-block py-3 w-full hover:text-green-600 {{ session('module_active') == 'users' ? 'active' : '' }}">
                    <div class="ml-4 flex justify-between items-center">
                        <div class="flex gap-2">
                            <span><i class="fa-solid fa-users"></i></span>
                            <span>Thành viên</span>
                        </div>
                        <i class="fa-solid fa-caret-down arrow-down transition-all duration-150 mr-4"></i>
                    </div>
                </a>
                <ul class="sub-menu font-seminold text-gray-700 {{ session('module_active') == 'users' ? '' : 'hidden' }}">
                    <li>
                        <a href="{{ route('admin.users.list') }}"
                            class="inline-block w-full py-2  hover:text-green-600 {{ session('module_active') == 'users' && session('sub_module_active') == 'list' ? 'active' : '' }}">
                            <div class="ml-4">&nbsp; └─ Danh sách thành viên</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.create') }}"
                            class="inline-block w-full py-2 hover:text-green-600 {{ session('module_active') == 'users' && session('sub_module_active') == 'create' ? 'active' : '' }}">
                            <div class="ml-4">&nbsp; └─ Thêm thành viên</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endcanany

        {{-- Role --}}

        @canany(['role.manager', 'admin.manager'])
            <li>
                <a href="#"
                    class="inline-block py-3 w-full hover:text-green-600 {{ session('module_active') == 'permission' || session('module_active') == 'role' ? 'active' : '' }}">
                    <div class="ml-4 flex justify-between items-center">
                        <div class="flex gap-2">
                            <span><i class="fa-solid fa-user-gear"></i></span>
                            <span>Phân quyền</span>
                        </div>
                        <i class="fa-solid fa-caret-down arrow-down transition-all duration-150 mr-4"></i>
                    </div>
                </a>
                <ul
                    class="sub-menu font-seminold text-gray-700 {{ session('module_active') == 'permission' || session('module_active') == 'role' ? '' : 'hidden' }}">
                    <li>
                        <a href="{{ route('admin.permission.manager') }}"
                            class="inline-block w-full py-2  hover:text-green-600 {{ session('module_active') == 'permission' && session('sub_module_active') == 'manager' ? 'active' : '' }}">
                            <div class="ml-4">&nbsp; └─ Quyền</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.role.manager') }}"
                            class="inline-block w-full py-2 hover:text-green-600 {{ session('module_active') == 'role' && session('sub_module_active') == 'manager' ? 'active' : '' }}">
                            <div class="ml-4">&nbsp; └─ Vai trò</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endcanany
    </ul>
</div>
