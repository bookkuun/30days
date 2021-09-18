<?php

use Illuminate\Support\Facades\Route;

// Welcome to 30days!!
Route::get('/', function () {
    return view('welcome');
});

// 新規登録・ログイン
Auth::routes();

// users
Route::resource('users', App\Http\Controllers\UserController::class)
    ->middleware('auth')->only(['index', 'show']);

// profile
Route::get('/profile', [App\Http\Controllers\UserController::class, 'edit'])
    ->middleware('auth')->name('profile.edit');
Route::post('/profile', [App\Http\Controllers\UserController::class, 'update'])
    ->middleware('auth')->name('profile.update');

// challenges
Route::resource('challenges', App\Http\Controllers\ChallengeController::class)
    ->middleware('auth')->only(['store', 'edit', 'update', 'destroy']);

// diaries
Route::resource('diaries', App\Http\Controllers\DiaryController::class)
    ->middleware('auth')->only(['store', 'edit', 'update']);
