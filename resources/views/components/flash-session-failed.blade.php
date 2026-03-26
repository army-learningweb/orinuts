@props([
    'key'
])

@if (session($key))
    <div
        class="absolute z-44 bg-red-700 text-white p-4 rounded-md shadow-lg bottom-0 right-5 animation_slide_up opacity-0">
        {{$slot}} {{ session($key)}}
    </div>
@endif
