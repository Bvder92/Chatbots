<!DOCTYPE html>
<html lang="EN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>🤖 {{ config('app.name') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.7.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="">

    <div id="app" class="h-screen bg-gray-100 overflow-hidden">
        @include('include.bubbles')
        @include('layouts.navbar')
        @yield('content')
    </div>

    </div>

</body>

</html>
