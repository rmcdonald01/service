<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware'  =>  ['auth']], function ()
{
  Route::get('/payment', 'PaymentController@index')->name('payment.index');
  Route::post('/makepayment', 'PaymentController@create')->name('payment.create');
});
