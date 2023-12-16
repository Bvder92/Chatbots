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
                <div class="fixed top-1/2 left-1/2 w-96 h-96  transform -translate-x-2/4 -translate-y-1/3 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse"></div>
                <div class="fixed top-1/2 left-1/2 w-96 h-96 transform -translate-y-2/3 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse animation-delay-1000"></div>
                <div class="fixed top-1/2 left-1/2 w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse animation-delay-2000"></div>
                <div class="fixed top-1/2 left-1/2 w-96 h-96 transform -translate-x-3/4 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse animation-delay-3000"></div>
                <div class="fixed top-1/2 left-1/2 w-96 h-96 bg-pink-300 transform -translate-y-2/3 -translate-x-96 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse animation-delay-4000"></div>
        @include('layouts.navbar')
        @yield('content')
    </div>

    </div>

</body>

</html>
