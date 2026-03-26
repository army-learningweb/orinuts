@props(['key'])

@if (session($key))
    <div {{$attributes->merge(['class'=>'text-sm select-none'])}}>
        {{$slot}} {{ session($key)}}
    </div>
@endif
