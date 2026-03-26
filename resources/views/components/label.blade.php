@props(['for' => ''])

<label for="{{ $for }}" {{$attributes->merge(['class' => 'font-semibold text-sm'])}}>
    {{ $slot }}
</label>
