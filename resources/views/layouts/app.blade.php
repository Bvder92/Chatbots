<!DOCTYPE html>
<html lang="EN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>🤖 {{ config('app.name') }}</title>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="">

    <div id="app">
        @include('layouts.navbar')
        @yield('content')
    </div>

</body>

</html>
