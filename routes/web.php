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

Route::get('/account/connect', 'Account\MarketplaceConnectController@index')->name('account.connect');
Route::get('/account/connect/complete', 'Account\MarketplaceConnectController@store')->name('account.complete');

Route::group(['prefix' => '/account', 'middleware' => ['auth', 'needs.marketplace'], 'namespace' => 'Account'], function () {
    Route::get('/', 'AccountController@index')->name('account');

});

//add to checkout namespace
//Route::get('/payment', 'PaymentController@index')->name('payment.index');
//Route::post('/payment', 'Checkout\CheckoutController@payment')->name('checkout.payment');

Route::group(['middleware' => ['needs.marketplace'], 'namespace' => 'Checkout'], function () {
    //Route::post('/free', 'CheckoutController@free')->name('checkout.free');
    Route::get('/payment', 'CheckoutController@index')->name('payment.index');
    Route::post('/payment', 'CheckoutController@payment')->name('checkout.payment');
});
//Route::post('/payment', 'CheckoutController@payment')->name('checkout.payment');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');






//Was thinking  of using
//Another appoarch
Route::group(['middleware'  =>  ['auth']], function ()
{
  Route::post('/makepayment', 'PaymentController@create')->name('payment.create');
});
