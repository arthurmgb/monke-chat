<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>MonkeChat</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="icon" type="image/png" href="https://cdn3d.iconscout.com/3d/premium/thumb/monkey-face-5662771-4771369.png" />

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="bg-gray-100">
        <div class="font-sans text-gray-900 antialiased mx-3">
            {{ $slot }}
        </div>
    </body>
</html>
