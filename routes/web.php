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

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    #Admin
    Route::group(
        [
            'namespace' => 'Admin',
            'as' => 'admin.'
        ], function () {
        Route::get('/login', 'AdminController@loginPage')->name('login');
        Route::post('/login', 'AdminController@loginRequest')->name('login');

        #Product
        Route::resource('product', 'ProductController');

        #Customer
        Route::resource('customer', 'CustomerController');

        #Checkout
        Route::group([
            'prefix' => 'cart',
            'as' => 'cart.',
        ], function () {
            Route::get('add/{id}/{quantity?}', 'CheckoutController@create')
                ->name('add');
            Route::get('remove/{id}', 'CheckoutController@remove')
                ->name('remove');
            Route::get('update/{id}/{quantity?}', 'CheckoutController@update')
                ->name('update');
        });

        #Order
        Route::group([
            'prefix' => 'order',
            'as' => 'order.',
        ], function () {
            Route::post('/search', 'OrderListController@searchOrder')->name('search');
        });
        #Order
        Route::resource('order', 'OrderListController');

    });
});

