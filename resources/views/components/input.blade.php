@props([
    'type',
    'name',
    'value' => old($name),
    'id' => '',
    'placeholder' => ''
])

<input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" id="{{ $id }}" placeholder="{{$placeholder}}"
{{ $attributes->class([
    "input_$name text-sm mt-1 border-gray-300/70 bg-white w-full rounded-md shadow-sm focus:border-green-500 focus:ring-green-500 focus:ring-1" => !$errors->has($name),
    "input_$name text-sm mt-1 border-gray-300/70 bg-white border-red-700 ring-1 ring-red-700 w-full rounded-md shadow-sm focus:border-green-500 focus:ring-green-500 focus:ring-1" => $errors->has($name)
]) }}>