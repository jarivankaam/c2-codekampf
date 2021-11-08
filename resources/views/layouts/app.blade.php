<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.head')
</head>
<body>
    <div id="app">
        @php
            use App\Http\Controllers\HomeController;
            echo HomeController::headerNav();
        @endphp

        <main class="py-4">
            @yield('content')
        </main>

        @include('includes.chat')
        @include('includes.footer')
    </div>

    @include('includes.footer')
</body>
</html>
