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
<body>
<div class="container">
    <div>
        @if($id == 1)
            <h1>Комната 1</h1>
        @elseif($id==2)
            <h1>Комната 2</h1>
        @else
            <h1>Комната 3</h1>
    </div>
    <div class="row">
        <div class="col-3">
            Пользователи онлайн
            <ul id="users">

            </ul>
        </div>
        <div class="col-3">
            Сообщения
            <div id="messages">

            </div>
        </div>
        <div class="col-3">
            <label for="text"></label><input type="text" id="text">
            <button id="send" onclick="send()">Отправить</button>
        </div>
    </div>
</div>
</body>
<script>
    var socket = new WebSocket("ws://192.168.31.202:8080");
    socket.onopen = function() {
        socket.send('{"message": "now root, "value": "{{$room_name}}", "user": {{$name}}');
        console.log("Соединение установлено.");
    };

    socket.onclose = function(event) {
        if (event.wasClean) {
            console.log('Соединение закрыто чисто');
        } else {
            console.log('Обрыв соединения'); // например, "убит" процесс сервера
        }
        console.log('Код: ' + event.code + ' причина: ' + event.reason);
    };

    socket.onmessage = function(event) {
        var json = JSON.parse(event.data)
        var orders = document.getElementById('message');
        var order = '' +
            '<div class="order">'+
            '<p>'+json.name+'</p>' +
            '<p>'+json.product+'</p>' +
            '</div>' +
            '';
        orders.insertAdjacentHTML('beforeend', order);
    };

    socket.onerror = function(error) {
        console.log("Ошибка " + error.message);
    };

</script>
</html>
