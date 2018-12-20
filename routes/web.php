<?php

use App\Events\ChatMessage;
use App\Events\ItemAdded;

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

Route::post('/post', function () {
    event(new ChatMessage(request('message')));

    return [
        'data' => request('message')
    ];
});

Route::post('/add-item', function () {
    $item = App\Item::find(1); // example data.
    event(new ItemAdded($item));

    return [
        'data' => $item,
    ];
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
