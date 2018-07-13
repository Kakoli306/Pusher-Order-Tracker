<?php
use App\Events\OrderStatusChanged;
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

Route::get('/fire', function () {
    event(new OrderStatusChanged);
    return 'Fired';
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// User Routes
Route::middleware('auth')->group(function () {
    Route::get('/orders', 'UserOrdersController@index')->name('user.orders');
    Route::get('/orders/create', 'UserOrdersController@create')->name('user.orders.create');
    Route::post('/orders', 'UserOrdersController@store')->name('user.orders.store');
    Route::get('/orders/{order}', 'UserOrdersController@show')->name('user.orders.show');
});

// Admin Routes - Make sure you implement an auth layer here
Route::prefix('admin')->group(function () {
    Route::get('/orders', 'AdminOrdersController@index')->name('admin.orders');
    Route::get('/orders/edit/{order}', 'AdminOrdersController@edit')->name('admin.orders.edit');
    Route::patch('/orders/{order}', 'AdminOrdersController@update')->name('admin.orders.update');
});
