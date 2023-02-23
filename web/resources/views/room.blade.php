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
        @endif

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
        if (json.message == 'connection')
        {
            const deleteElement = document.querySelector('#users');
            deleteElement.innerHTML = '';
            json.users.map(function (item){
                var users = document.getElementById('users')
                let liFirst = document.createElement('li')
                liFirst.innerHTML = "<li><span>"+item+"</span></li>"
                users.prepend(liFirst);
            })
        }
        else if(json.message == 'message')
        {
            var messages = document.getElementById('messages')
            let pFirst = document.createElement('li')
            pFirst.innerHTML = "<b>"+json.user+"</b>:"+json.value;
            messages.prepend(pFirst);
        }
    };

    socket.onerror = function(error) {
        console.log("Ошибка " + error.message);
    };
    function send()
    {
        var text = document.querySelector('text').value;
        fetch('https://websocket.dmitry-povyshav.ru/send_message', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json:charset-utf-8'
            },
            body: JSON.stringify({text:text})
        });
        socket.send('{"message": "new message", "value": "'+text+'"}');
    }
</script>
</html>
