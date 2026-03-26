<div
    {{ $attributes->merge(['class' => 'flex justify-between items-center min-w-full bg-white shadow-sm py-3 px-4 mt-2 md:mt-0  border-l border-gray-100']) }}>
    {{ $slot }}

    <div class="flex items-center gap-5">
        {{-- short-cut   --}}
        <div class="shortcut">

        </div>

        {{-- bell --}}
        <div class="bell relative cursor-pointer group">
            <i class="fa-solid fa-bell text-xl"></i>
            
            <div class="absolute -top-1 -right-2 translate-y-[-2px] translate-x-[-1px]">
                <span class="relative flex size-5">
                    <span
                        class="absolute inline-flex h-full w-full animate-ping rounded-full bg-red-600 opacity-75"></span>
                    <span
                        class="relative inline-flex size-5 rounded-full bg-red-600 justify-center items-center text-white text-xs alert_count">{{ $total_pending_order }}</span>
                </span>
            </div>

            <div class="new_orders_alert absolute hidden group-hover:inline-block bg-white p-5 pt-2 md:left-[-335px] left-[-245px] top-[30px] md:w-[370px] w-[340px] z-40 shadow-md rounded-md border border-gray-100 overflow-y-auto max-h-[200px]">
                @include('admin.partials.new_orders_alert')
            </div>
        </div>

        {{-- admin --}}
        <div class="admin-info flex items-center md:gap-3 cursor-pointer relative">
            <div class="flex flex-col text-xs md:block">
                <div class="name font-semibold text-right hidden md:block">{{ Auth::user()->name }}</div>
                <div class="role hidden md:block text-right">{{ Auth::user()->roles[0]->name }}</div>
            </div>
            <div class="avatar"><img src="{{ asset('images/OIP.webp') }}" alt="avatar" width="40px"
                    class="rounded-full shadow-md outline outline-2 outline-green-600"></div>
            {{-- admin-options --}}
            <div
                class="admin-options absolute bottom-0 right-0 opacity-0 translate-y-[70px] pointer-events-none translate-x-[-10px] flex flex-col items-center bg-slate-50 rounded-md overflow-hidden w-[150px] text-xs py-2 px-4 shadow-md transition-all duration-100">
                <a href="{{ route('admin.profile.edit') }}"
                    class="py-1 w-full text-center text-green-600 font-semibold hover:underline underline-offset-4">Thông
                    tin tài khoản</a>
                <form action="{{ route('logout') }}" method="post" class="w-full">
                    @csrf
                    <input type="submit" value="Đăng xuất"
                        class="py-1 w-full text-center cursor-pointer hover:underline underline-offset-4"></input>
                </form>
            </div>
        </div>

    </div>
</div>
