<?php

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


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('show');

Route::get('/profile', [App\Http\Controllers\UserController::class, 'edit'])->name('profile_edit');
Route::post('/profile', [App\Http\Controllers\UserController::class, 'update'])->name('profile_update');
Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user_delete');

Route::post('/challenges', [App\Http\Controllers\ChallengeController::class, 'store'])->name('challenge_store');
Route::get('/challenges/{challenge_id}', [App\Http\Controllers\ChallengeController::class, 'edit'])->name('challenge_edit');
Route::post('/challenges/{challenge_id}', [App\Http\Controllers\ChallengeController::class, 'update'])->name('challenge_update');
Route::delete('/challenges/{challenge_id}', [App\Http\Controllers\ChallengeController::class, 'destroy'])->name('challenge_delete');


Route::post('/diaries', [App\Http\Controllers\DiaryController::class, 'store'])->name('diary_store');
Route::get('/diaries/{diary_id}', [App\Http\Controllers\DiaryController::class, 'edit'])->name('diary_edit');
Route::post('/diaries/{diary_id}', [App\Http\Controllers\DiaryController::class, 'update'])->name('diary_update');
