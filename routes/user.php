<?php

use App\Http\Controllers\User\AttemptController;
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
Route::get('/quizzes/{quiz}/start', [QuizController::class, 'start'])->name('quizzes.start');

Route::post('/quizzes/{quiz}/start', [AttemptController::class, 'startQuiz'])->name('attempts.start');
Route::get('/quizzes/attempts/{attempt}/running', [AttemptController::class, 'running'])->name('attempts.running');

Route::resource('/quizzes/attempts', AttemptController::class);
Route::resource('/quizzes', QuizController::class);
Route::resource('/questions', QuestionController::class)->only(['store', 'update', 'destroy']);
