<x-client-app-layout>
    @if (!$page_info)
        <div class="mt-2">
            @include('client.layouts.404')
        </div>
    @else
        <div class="bg-white shadow-sm mt-2 rounded-md animation_content_slide_up p-5 text-left">
            <div class="content mt-10 select-none px-5 w-full md:w-[990px] mx-auto">{!! $page_info->content !!}</div>
        </div>
    @endif
    
</x-client-app-layout>
