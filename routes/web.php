<?php

use Illuminate\Support\Facades\Route;

// Welcome
Route::get('/', function () {
    return view('welcome');
});

// 新規登録・ログイン
Auth::routes();

// users
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('user_index');
Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('user_show');
Route::get('/profile', [App\Http\Controllers\UserController::class, 'edit'])->name('profile_edit');
Route::post('/profile', [App\Http\Controllers\UserController::class, 'update'])->name('profile_update');
Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user_delete');

Route::resource('challenges', App\Http\Controllers\ChallengeController::class)->middleware('auth')->only(['store', 'edit', 'update', 'destroy']);

Route::resource('diaries', App\Http\Controllers\DiaryController::class)->middleware('auth')->only(['store', 'edit', 'update']);
