<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blog</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}"/>
    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<!-- Background -->

<!-- Wrapper -->

<header id="header">
</header>
@yield('sidebar')
<div class="container">
    @yield('content')
</div>
<footer>

</footer>

<!-- Scripts -->
</body>
</html>