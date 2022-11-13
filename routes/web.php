<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;

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

require __DIR__ . '/auth.php';


//tim kiem

Route::get('search', [MyController::class, 'getsearch'])->name('search'); 
// Dẫn tới trang đăng ký custommer
Route::get('register',[MyController::class,'register'])->name('register');
Route::post('register',[MyController::class,'post_register'])->name('register');
//thong tin khach hang

Route::get('thongtinkh/{id?}',[MyController::class,'update_Profile'])->name('thongtinkh');
// Dẫn tới trang đăng nhập custommer
Route::get('login',[MyController::class,'login'])->name('login');
Route::post('login',[MyController::class,'post_login'])->name('login');

// Thoát custommer
Route::get('logout',[MyController::class,'logout'])->name('logout');

Route::get('company', [MyController::class, 'company'])->name('company');
Route::get('testimonial', [MyController::class, 'testimonial'])->name('testimonial');
Route::get('joblist', [MyController::class, 'joblist'])->name('joblist');
Route::get('jobdetail', [MyController::class, 'jobdetail'])->name('jobdetail');
Route::get('/{name?}', [MyController::class, 'index'])->name('index');


