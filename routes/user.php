<?php

use App\Http\Controllers\User\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authenticated user's Routes
|--------------------------------------------------------------------------
|
| Middleware: auth
|
*/

Route::get('/', [PageController::class, 'index'])->name('index');
