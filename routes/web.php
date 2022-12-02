<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;

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
//contact mail
Route::get('contact',[MyController::class,'contact'])->name('contact');
Route::post('contact',[MyController::class,'post_contact'])->name('contact');
Route::post('contact',[MyController::class,'mail'])->name('contact');
//tim kiem
Route::get('search', [MyController::class, 'getsearch'])->name('search'); 
// Dẫn tới trang đăng ký custommer
Route::get('home-register',[MyController::class,'register'])->name('register');
Route::post('home-register',[MyController::class,'post_register'])->name('register');
Route::get('customer-active/{customer}/{token}',[MyController::class,'actived'])->name('customer.active');

//Dẫn tới trang thông tin khách hàng
Route::get('thongtinkh/{id?}',[MyController::class,'update_Profile'])->name('thongtinkh');
// Dẫn tới trang đăng nhập custommer
Route::get('login',[MyController::class,'login'])->name('login');
Route::post('login',[MyController::class,'post_login'])->name('login');
// Thoát custommer
Route::get('logout',[MyController::class,'logout'])->name('logout');
Route::get('company', [MyController::class, 'company'])->name('company');
Route::get('testimonial', [MyController::class, 'testimonial'])->name('testimonial');
Route::get('joblist', [MyController::class, 'joblist'])->name('joblist');
Route::get('jobdetail/{id?}',[MyController::class,'chitietsp'])->name('jobdetail');
Route::get('/{name?}', [MyController::class, 'index'])->name('index');





