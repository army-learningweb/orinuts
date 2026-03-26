@foreach ($products_info as $slug => $name)
    <div class="mt-1">
        <a href="{{ url($slug) . '.html' }}"
            class="w-full inline-block hover:bg-gray-100 p-2 rounded-md">{{ $name }}</a>
    </div>
@endforeach
