<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::group([
    'namespace' => 'App\Http\Controllers\Admin',
    'prefix' => '/admin',
    'as'=>'admin.'
], function () {
    Route::get('/login', 'AdminController@loginPage')->name('login');
    Route::post('/login', 'AdminController@loginRequest')->name('login');

    Route::group(['middleware' => 'admin'], function () {
        Route::get('/logout','AdminController@logout')->name('logout');
        Route::get('/dashboard','AdminController@index')->name('index');

        Route::prefix('user')->group(function () {
            Route::get('/list', 'UserController@listUsers')->name('jobseeker.list');
            Route::get('/add', 'UserController@create')->name('jobseeker.add');
            Route::post('/add', 'UserController@store')->name('jobseeker.add');
            Route::get('/show/{id}', 'UserController@show')->name('jobseeker.show');
            Route::get('/edit/{id}', 'UserController@edit')->name('jobseeker.edit');
            Route::put('/edit/{id}', 'UserController@update')->name('company.edit');
            Route::delete('/delete/{id}', 'UserController@delete')->name('jobseeker.delete');
        });

        Route::prefix('location')->group(function (){
            Route::get('/list', 'LocationController@index')->name('location.list');

        });

        Route::prefix('company')->group(function () {
            Route::get('/list', 'CompanyController@index')->name('company.list');
            Route::get('/add', 'CompanyController@create')->name('company.add');
            Route::post('/add', 'CompanyController@store')->name('company.add');
            Route::get('/show/{id}', 'CompanyController@show')->name('company.show');
            Route::get('/edit/{id}', 'CompanyController@edit')->name('company.edit');
            Route::put('/edit/{id}', 'CompanyController@update')->name('company.edit');
            Route::delete('/delete/{id}', 'CompanyController@destroy')->name('company.delete');
        });

        Route::prefix('upload')->group(function () {
            Route::post('/services', 'UploadController@store')->name('upload.add');
        });
    });
});