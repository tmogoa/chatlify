<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/users', [UserController::class, 'list'])->name('listusers');
Route::get('/users/search', [UserController::class, 'findUser']);
Route::get('/chats', [UserController::class, 'getMostRecentChats'])->name('chats');
Route::get('/finduser', [UserController::class, 'findUser'])->name('finduser');

