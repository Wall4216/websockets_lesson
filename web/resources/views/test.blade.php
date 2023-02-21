<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
    </style>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased">
<div class="relative items-top flex justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    @if(\Illuminate\Support\Facades\Route::has('login'))
        <div class="hidden fixed top-0 right-0 py-4 sm:block">
            @auth
                <a href="{{url('/home')}}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
            @else
                <a href="{{route('login')}}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                @if(\Illuminate\Support\Facades\Route::has('register'))
                    <a href="{{route('register')}}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            <p id="message"></p>
        </div>
    </div>
</div>

</body>
<script>
    var socket = new WebSocket("ws://192.168.31.202:8080");
    socket.onopen = function() {
        alert("Соединение установлено.");
    };

    socket.onclose = function(event) {
        if (event.wasClean) {
            alert('Соединение закрыто чисто');
        } else {
            alert('Обрыв соединения'); // например, "убит" процесс сервера
        }
        alert('Код: ' + event.code + ' причина: ' + event.reason);
    };

    socket.onmessage = function(event) {
        console.log(event.data)
    };

    socket.onerror = function(error) {
        alert("Ошибка " + error.message);
    };
</script>
</html>
