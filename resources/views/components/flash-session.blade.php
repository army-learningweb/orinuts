@props([
    'key'
])

@if (session($key))
    <div
        class="fixed z-50 bg-emerald-600 text-white p-4 rounded-md shadow-lg bottom-0 right-5 animation_slide_up opacity-0 pointer-events-none">
        {{$slot}} {{ session($key)}}
    </div>
@endif
