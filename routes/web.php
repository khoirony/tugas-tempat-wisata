<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuestController;


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
Route::get('/', [GuestController::class, 'index']);

// Authentication
Route::get('/login', [LoginController::class, 'index'])->middleware(["noAuth"]);
Route::post('/login', [LoginController::class, 'authenticate'])->middleware(["noAuth"]);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware(["noAuth"]);
Route::post('/register', [RegisterController::class, 'store'])->middleware(["noAuth"]);

// Admin Route
Route::get('/admin', [AdminController::class, 'index'])->middleware(["withAuthAdmin"]);

Route::get('/listtempat', [AdminController::class, 'listTempat'])->middleware(["withAuthAdmin"]);
Route::get('/detailtempat/{id}', [AdminController::class, 'detailTempat'])->middleware(["withAuthAdmin"]);
Route::get('/tambahtempat', [AdminController::class, 'tambahTempat'])->middleware(["withAuthAdmin"]);
Route::post('/tambahtempat', [AdminController::class, 'storeTempat'])->middleware(["withAuthAdmin"]);
Route::get('/edittempat/{id}', [AdminController::class, 'editTempat'])->middleware(["withAuthAdmin"]);
Route::post('/edittempat/{id}', [AdminController::class, 'updateTempat'])->middleware(["withAuthAdmin"]);
Route::get('/hapustempat/{id}', [AdminController::class, 'hapusTempat'])->middleware(["withAuthAdmin"]);

Route::get('/listuser', [AdminController::class, 'listUser'])->middleware(["withAuthAdmin"]);
Route::get('/detailuser/{id}', [AdminController::class, 'detailUser'])->middleware(["withAuthAdmin"]);
Route::get('/edituser/{id}', [AdminController::class, 'editUser'])->middleware(["withAuthAdmin"]);
Route::post('/edituser/{id}', [AdminController::class, 'updateUser'])->middleware(["withAuthAdmin"]);
Route::get('/hapususer/{id}', [AdminController::class, 'hapusUser'])->middleware(["withAuthAdmin"]);

Route::get('/hapusfoto/{id}', [AdminController::class, 'hapusFoto'])->middleware(["withAuthAdmin"]);

Route::get('/caritempat', [AdminController::class, 'cariTempat'])->middleware(["withAuthAdmin"]);
Route::post('/caritempat', [AdminController::class, 'cariTempat'])->middleware(["withAuthAdmin"]);

// User Route
Route::get('/user', [UserController::class, 'index'])->middleware(["withAuthUser"]);
Route::get('/user/listtempat', [UserController::class, 'listTempat'])->middleware(["withAuthUser"]);
Route::get('/user/favorite', [UserController::class, 'listFav'])->middleware(["withAuthUser"]);
Route::get('/user/detailtempat/{id}', [UserController::class, 'detailTempat'])->middleware(["withAuthUser"]);
Route::get('/user/profile', [UserController::class, 'profile'])->middleware(["withAuthUser"]);
Route::get('/user/editprofile', [UserController::class, 'editProfile'])->middleware(["withAuthUser"]);
Route::post('/user/editprofile', [UserController::class, 'updateProfile'])->middleware(["withAuthUser"]);
Route::get('/user/caritempat', [UserController::class, 'cariTempat'])->middleware(["withAuthUser"]);
Route::post('/user/caritempat', [UserController::class, 'cariTempat'])->middleware(["withAuthUser"]);
