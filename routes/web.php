<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\LoginController;
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


Route::get('/weblogin', [LoginController::class, "webLogin"])->middleware('auth');
// /weblogin
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/exttoken', [App\Http\Controllers\HomeController::class, 'extToken'])->middleware(['auth']);
