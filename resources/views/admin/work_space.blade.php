<x-app-layout>

    <x-flash-session key="welcome"><i class="fa-solid fa-hand-peace"></i></x-flash-session>

    {{-- topbar --}}
    <x-topbar-content>
        <x-breadcrum page_name="WorkSpace" />
    </x-topbar-content>

    {{-- datacontent --}}
    <div class="data-content animation_content_slide_up text-sm px-3 pb-3 pt-1 md:pt-3 box-border">
        <div class="bg-white shadow-sm rounded-md p-5">
            <h1 class="text-2xl font-semibold tracking-tight mb-2">
                Chào mừng trở lại, {{ Auth::user()->name }}!
            </h1>
            <p class="text-gray-400 leading-relaxed ">
                Hôm nay là một ngày tuyệt vời để hoàn thành các bản thảo còn dang dở
            </p>
        </div>
    </div>

</x-app-layout>
