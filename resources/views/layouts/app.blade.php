<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'peminjam - Perpustakaan Digital')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
       <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-800">


    <!-- ALERTS -->
    <div class="container mx-auto px-4 mt-4 space-y-3">

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded relative">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded relative">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded">
                <ul class="list-disc ml-4">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- MAIN CONTENT -->
    <main class="container mx-auto px-4 py-6">
        @yield('content')
    </main>


    @stack('scripts')
</body>
</html>
