@props([
    'href'=>''
])

<a href="{{$href}}"
    {{ $attributes->merge(['class' => 'text-xs font-semibold bg-gradient-to-r from-amber-400 to-amber-500 py-2 px-3 rounded-md cursor-pointer hover:brightness-110 hover:shadow-lg transition-all duration-150']) }}>
{{ $slot }}
</a>