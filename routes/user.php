<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authenticated user's Routes
|--------------------------------------------------------------------------
|
| Middleware: auth
|
*/

Route::get('/', [\App\Http\Controllers\PageController::class, 'index'])->name('index');
