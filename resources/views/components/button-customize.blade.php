@props([
    'type'=>''
])

<button type="{{$type}}"
    {{ $attributes->merge(['class' => 'text-xs font-semibold bg-gradient-to-r from-emerald-500 to-green-700 text-white py-2 px-3 rounded-md cursor-pointer hover:brightness-110 hover:shadow-lg transition-all duration-150 flex justify-center items-center']) }}>
{{ $slot }}
</button>