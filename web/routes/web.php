<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {
    return view('test');
});
Route::get('/order', function () {
    return view('order');
});
Route::get('/orders', function () {
    return view('orders');
});
Route::post('/order', function (\Illuminate\Http\Request $request){
    $data = [
        'message' => 'new order',

        'value'=> [
            'name' => $request->input('name'), 'product' => $request->input('product')
        ]
    ];
    $client = new WebSocket\Client("ws:://echo.websocket.org/");
    $client->text(\GuzzleHttp\json_encode(['message' => 'new room', 'value' => 'two']));
    $client->text(json_encode($data));
    echo $client->receive();
    $client->close();
   return response()->redirectTo('/order');

})->name('order.store');

Route::get('/rooms', function (){
    return view('rooms');
});
Route::get('/rooms', function (\Illuminate\Http\Request $request){
    if($request->input('id')==1)
    {
        $room_name = 'one';
    }
    if($request->input('id')==2)
    {
        $room_name = 'two';
    }
    else{
        $room_name = 'tree';
    }
    return view('room', ['id' => $request->input('id'), 'room_name' => $room_name, 'name' => $request->input('name')]);
});
