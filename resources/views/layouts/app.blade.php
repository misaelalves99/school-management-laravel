<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Sistema Escolar')</title>

    <!-- CSS/JS principais do Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- CSS adicionais de páginas -->
    @stack('styles')
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Container principal -->
    <div id="app" class="flex-1 flex flex-col">

        {{-- Navbar --}}
        @include('components.navbar')

        {{-- Conteúdo principal --}}
        <main class="mainContainer flex-1 p-4">
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('components.footer')

    </div>

    <!-- Scripts adicionais -->
    @stack('scripts')

</body>
</html>
