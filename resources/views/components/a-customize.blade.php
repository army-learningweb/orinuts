@props(['href'=>''])

<a href="{{$href}}" {{$attributes->merge(['class'=>'text-xs font-semibold bg-gradient-to-r from-emerald-500 to-green-700 text-white py-2 px-3 rounded-md cursor-pointer hover:brightness-110 hover:shadow-md transition-all duration-150'])}}>
    {{$slot}}
</a>