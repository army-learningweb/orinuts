<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- FontsFamily -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- FontAwsome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Tiny cloud --}}
    <script src="https://cdn.tiny.cloud/1/99c8uy6qg2tkb92zk1z57p4evrix6u0q9mpgxced7w3w12ve/tinymce/7/tinymce.min.js"
    referrerpolicy="origin" crossorigin="anonymous"></script>

    {{-- Tinycloud Config Product Details --}}
    <x-head.tinymce-config selector="textarea#product_details"/>

    {{-- Tinycloud Config Pages Details --}}
    <x-head.tinymce-config selector="textarea#pages_details"/>

    <!-- Scripts + CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-sm overflow-y-scroll text-gray-800">

    <div class="min-h-screen bg-[#F4F7FA] relative md:flex md:w-[1500px] mx-auto">
        
        {{-- modal-delete-account --}}
        <x-modal-delete-account/>

        <!-- sidebar -->
        <aside class="bg-white md:w-[210px] shadow-sm">
            <x-sidebar/>
        </aside>

        {{-- content --}}
        <main class="md:flex-1">
            {{ $slot }}
        </main>

    </div>
</body>

</html>
