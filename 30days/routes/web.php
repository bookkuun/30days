<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// users
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('user_index');
Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('user_show');
Route::get('/profile', [App\Http\Controllers\UserController::class, 'edit'])->name('profile_edit');
Route::post('/profile', [App\Http\Controllers\UserController::class, 'update'])->name('profile_update');
Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user_delete');

// challenges
Route::post('/challenges', [App\Http\Controllers\ChallengeController::class, 'store'])->name('challenge_store');
Route::get('/challenges/{challenge_id}', [App\Http\Controllers\ChallengeController::class, 'edit'])->name('challenge_edit');
Route::post('/challenges/{challenge_id}', [App\Http\Controllers\ChallengeController::class, 'update'])->name('challenge_update');
Route::delete('/challenges/{challenge_id}', [App\Http\Controllers\ChallengeController::class, 'destroy'])->name('challenge_delete');

// diaries
Route::post('/diaries', [App\Http\Controllers\DiaryController::class, 'store'])->name('diary_store');
Route::get('/diaries/{diary_id}', [App\Http\Controllers\DiaryController::class, 'edit'])->name('diary_edit');
Route::post('/diaries/{diary_id}', [App\Http\Controllers\DiaryController::class, 'update'])->name('diary_update');
