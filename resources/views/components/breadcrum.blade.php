@props(['href' => '', 'page_name'])

<div {{ $attributes->merge(['class' => 'md:text-lg text-sm flex items-center md:mt-3']) }}>
  
    @if (session('module_active') != 'dashboard')
        <a href="{{ $href }}" class="text-gray-300 hover:text-gray-600 hidden md:block"><i class="fa-solid fa-arrow-left"></i> Quay lại</a>
        <span class="text-gray-300 mx-2 select-none hidden md:block">/</span>
    @endif

    <span class="select-none font-semibold ">{{ $page_name }}</span>
</div>
