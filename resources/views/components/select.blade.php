@props([
    'name',
    'id'
])

<select name="{{$name}}" id="{{$id}}"
    {{$attributes->class([
    "select_$name rounded-md mt-2 w-full focus:ring-green-500 focus:border-green-500 text-sm border-gray-500/30 py-2"=>!$errors->has($name),
    "select_$name rounded-md mt-2 w-full focus:ring-green-500 focus:border-green-500 text-sm border-gray-500/30 py-2 border-red-700 ring-1 ring-red-700"=>$errors->has($name)
    ])}}>
    {{$slot}}
</select>
