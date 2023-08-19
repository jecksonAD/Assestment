<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GoogleController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('target.login');
Route::get('/dashboard', function () {
    return view('main');
})->name('target.main');

Route::get('auth/google',[GoogleController::class, 'googleSignInPage']);
Route::get('getData',[GoogleController::class, 'getData']);
Route::get('auth/google/callback',[GoogleController::class, 'googleCallBack']);