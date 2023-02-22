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
    $data = ['name' => $request->input('name'), 'product' => $request->input('product')];
    $client = new WebSocket\Client("ws:://echo.websocket.org/");
    $client->text(json_encode($data));
    echo $client->receive();
    $client->close();
   return response()->redirectTo('/order');

})->name('order.store');
