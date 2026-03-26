@props([
    'placeholder' => '',
    'id' => '',
    'name' => ''
])

<div>
    <textarea id="{{$id}}" placeholder="Thông tin chi tiết sản phẩm" name="{{$name}}">{{$slot}}</textarea>
</div>