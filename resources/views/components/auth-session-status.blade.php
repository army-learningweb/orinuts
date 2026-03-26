@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600 animation_slide_left']) }}>
        {{ $status }}
    </div>
@endif
