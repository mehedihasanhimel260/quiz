<?php

use App\Http\Controllers\ExamMaintainController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\TimeCounDownController;
use App\Http\Controllers\UserResponseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::prefix('quiz')
    ->controller(QuizController::class)
    ->group(function () {
        Route::get('/', 'index')->name('quiz.index');
        Route::post('/store', 'store')->name('quiz.store');
        Route::get('/edit/{id}', 'edit')->name('quiz.edit');
        Route::get('/destroy/{id}', 'destroy')->name('quiz.destroy');
        Route::get('quiz/exam/{id}', 'quiz_exam')->name('quiz.exam');
    });

Route::prefix('question')
    ->controller(QuestionController::class)
    ->group(function () {
        Route::get('/', 'index')->name('question.index');
        Route::post('/store', 'store')->name('question.store');
        Route::get('/edit/{id}', 'edit')->name('question.edit');
        Route::get('/destroy/{id}', 'destroy')->name('question.destroy');
    });

Route::prefix('option')
    ->controller(OptionController::class)
    ->group(function () {
        Route::post('/store', 'store')->name('option.store');
        Route::get('/edit/{id}', 'edit')->name('option.edit');
        Route::get('/destroy/{id}', 'destroy')->name('option.destroy');
    });

// use for user

Route::prefix('user/quiz')
    ->controller(ExamMaintainController::class)
    ->group(function () {
        Route::get('/exam/{id}', 'quiz_exam')->name('userQuiz.exam');
        Route::get('/start-Exam/{id}', 'startexam')->name('start.exam');
    }); // use for user

Route::post('user/response/', [UserResponseController::class, 'store'])->name('userResponse.store');
