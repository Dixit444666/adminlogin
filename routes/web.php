<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login',[AdminController::class,'login'])->name('login');
Route::post('/logindata',[AdminController::class,'logindata'])->name('logindata');
Route::get('/logout',[AdminController::class,'gotologin'])->name('logout');
Route::get('/gotoloin',[AdminController::class,'logout'])->name('gotologin');
Route::get('/fpassword',[AdminController::class,'fpassword'])->name('fpassword');
Route::post('/fpassworddata',[AdminController::class,'fpassworddata'])->name('fpassworddata');
// Route::get('/checkotpform',[AdminController::class,'checkotpform'])->name('checkotpform');
Route::post('/checkotp',[AdminController::class,'checkotp'])->name('checkotp');
Route::post('/changepass',[AdminController::class,'changepass'])->name('changepass');
// Route::get('/gotologin',[AdminController::class,'gotologin'])->name('gotologin');
Route::get('list',[AdminController::class,'list'])->name('list');









