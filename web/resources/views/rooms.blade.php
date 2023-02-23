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
<form action="/room">
    <div>
        <input type="text" placeholder="Имя" name="name">
    </div>
    <div class="col-3">
        <label>Комната 1</label>
        <input type="radio" value="1" name="id">
    </div>
    <div class="col-3">
        <label>Комната 2</label>
        <input type="radio" value="2" name="id">
    </div>
    <div class="col-3">
        <label>Комната 3</label>
        <input type="radio" value="3" name="id">
    </div>
    <div class="col-3">
        <button type="submit">Da</button>
    </div>
</form>
</body>
<script>

</script>
</html>
