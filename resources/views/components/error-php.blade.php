@props(['error_field'])

@error($error_field)
    <div class="php_error_{{$error_field}} text-red-700 text-sm mt-2">
       <i class="fa-solid fa-circle-exclamation"></i> {{$message}}
    </div>
@enderror
