<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\DatabaseController;
use \App\Http\Controllers\UsersController;

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

Route::get('/register',[UsersController::class,'register'], function () {
   return view('register');
})->name('register');

Route::post('/register',[UsersController::class,'store'], function () {
 })->name('register');

Route::get('/login',[UsersController::class, 'login'], function () {
    return view('login');
})->name('login');

Route::get('/', [DatabaseController::class, 'getData'])->name('index');

Route::get('/collection', function () {
    return view('collection/index');
})->name('collection');

Route::get('/assets', function () {
    return view('assets/index');
})->name('assets');

