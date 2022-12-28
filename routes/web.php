<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;


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
// Homepage
Route::view('/', 'welcome')->name('home');

// Authentication
Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);

// Admin Route
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/tambahtempat', [AdminController::class, 'tambahTempat']);
Route::post('/tambahtempat', [AdminController::class, 'storeTempat']);
Route::get('/listtempat', [AdminController::class, 'listTempat']);
Route::get('/detailtempat/{id}', [AdminController::class, 'detailTempat']);
Route::get('/edittempat/{id}', [AdminController::class, 'editTempat']);
Route::post('/edittempat/{id}', [AdminController::class, 'updateTempat']);
Route::get('/hapustempat/{id}', [AdminController::class, 'hapusTempat']);

// User Route
Route::get('/user', [UserController::class, 'index']);