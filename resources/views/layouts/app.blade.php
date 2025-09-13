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
<body">
    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Container principal --}}
    <div class="container flex-1">
        <main class="mainContainer">
            @yield('content')
        </main>
    </div>

    {{-- Footer --}}
    @include('components.footer')

    @stack('scripts')
</body>
</html>
