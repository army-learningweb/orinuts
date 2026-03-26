@props(['error_field'])
<p {{$attributes->merge(["class" => "ajax_error_$error_field text-red-700 hidden mt-2 text-sm"])}}></p>