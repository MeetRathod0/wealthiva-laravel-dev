<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('/css/app.css') }}?v=1" rel="stylesheet">
    <script src="/assets/js/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- jsdelivr cdn -->
    <script src="/assets/js/vue.global.js"></script>

</head>

<body class="flex items-center justify-center p-4">
    @yield('content')
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>