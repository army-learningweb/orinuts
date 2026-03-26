@props([
    'type' => '',
])
<button type="{{$type}}" {{$attributes->merge(['class'=>'flex items-center justify-center bg-gradient-to-r from-red-500 to-red-800 py-2 px-3 text-sm font-semibold rounded-md text-white hover:shadow-lg hover:brightness-110'])}}>
    {{$slot}}
</button>

