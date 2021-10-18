<?php

use App\Http\Controllers\User\PageController;
use App\Http\Controllers\User\QuestionController;
use App\Http\Controllers\User\QuizController;
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

Route::get('/my-quizzes', [QuizController::class, 'myQuizzes'])->name('my_quizzes');
Route::get('/quizzes/my-attempts', [QuizController::class, 'myAttempts'])->name('quizzes.my_attempts');

Route::resource('/quizzes', QuizController::class);
Route::resource('/questions', QuestionController::class)->only(['store', 'update', 'destroy']);
