<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <title>Villain</title>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,200..1000&family=Roboto+Condensed:wght@100..900&display=swap"
        rel="stylesheet">


    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Using Vite -->
    @vite(['resources/js/app.js'])
    @vite(['resources/js/cv_modal.js'])
</head>

<body class="bg-dark">
    <div id="app" class="d-flex flex-column vh-100 app-admin">
        <aside class="flex-shrink-0">
            @include('admin.partials.top_bar')
        </aside>

        <div class="flex-grow-1 d-flex page-center">
            <aside class="flex-shrink-0">
                @auth
                    @include('admin.partials.side_bar')
                @endauth
            </aside>

            <main class="flex-grow-1 overflow-auto bg-white">
                @yield('content')
            </main>
        </div>

    </div>

</body>

</html>
