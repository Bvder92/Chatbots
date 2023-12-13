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

    <div id="app" class="h-screen bg-gray-50 overflow-hidden">
        <h1>o</h1>
        <div class="h-full bg-gradient">
            <div class="">
                    <div
                        class="fixed top-1/4 left-2/3 mt-8 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob">
                    </div>
                    <div
                        class="fixed top-1/2 left-1/4 w-96 h-96 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000">
                    </div>
                    <div
                        class="fixed top-2/3 left-2/3 mr-64 mb-44 w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000">
                    </div>
            </div>
            @include('layouts.navbar')
            @yield('content')
        </div>

    </div>

</body>

</html>
