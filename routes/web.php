<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
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

Route::get('/', [PageController::class, 'index'])->name('index');

Route::group(
    ['prefix' => 'auth', 'as' => 'auth.', 'middleware' => 'guest'],
    function () {

        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::get('/register', [AuthController::class, 'register'])->name('register');
        Route::get('/lostpass', [AuthController::class, 'lostPassword'])->name('lostpass');
        Route::post('/resetpass', [AuthController::class, 'resetPassword'])->name('resetpass');

        Route::post('/login', [AuthController::class, 'loginPost']);
        Route::post('/register', [AuthController::class, 'registerPost']);
        Route::post('/lostpass', [AuthController::class, 'lostPasswordPost']);
        Route::post('/resetpass', [AuthController::class, 'resetPasswordPost']);
    }
);

Route::get('/auth/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
