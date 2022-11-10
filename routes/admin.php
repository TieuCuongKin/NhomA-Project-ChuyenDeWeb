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
    'namespace' => 'JobSeeker\Port\Primary\Controllers\Admin',
    'prefix' => '/admin',
    'as'=>'admin.'
], function () {
    Route::get('/login', 'AdminController@loginPage')->name('login');
    Route::post('/login', 'AdminController@loginRequest')->name('login');

    Route::group(['middleware' => 'admin'], function () {
        Route::get('/logout','AdminController@logout')->name('logout');
        Route::get('/dashboard','AdminController@index')->name('index');


        Route::prefix('user')->group(function () {
            Route::get('/list', 'UserController@listUsers')->name('jobseeker.index');
            Route::get('view-profile/{userId}', 'UserController@viewProfile');
            Route::post('update-status', 'UserController@updateStatus');
            Route::post('reapprove', 'UserController@reapprove');
            Route::post('fake', 'UserController@fakeUser');
            Route::post('upload-bulk-approval-csv', 'UserController@uploadBulkApprovalCsv');
            Route::delete('{userId}', 'UserController@delete');
            Route::post('copy', 'UserController@copy');
        });
    });
});