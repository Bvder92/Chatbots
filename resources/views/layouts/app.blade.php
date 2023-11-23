<!DOCTYPE html>
<html lang="EN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    @vite('resources/css/app.css')
</head>

<body>

    @include('layouts.navbar')
    <div class="py-6 px-8 container-fluid ">
        <div class="grid grid-cols-4 gap-4">
            @yield('content')
        </div>
    </div>
    </div>
</body>

</html>
