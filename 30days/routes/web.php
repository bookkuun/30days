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

Route::post('/challenges', [App\Http\Controllers\ChallengeController::class, 'store'])->name('challenge_store');
Route::get('/challenges/{challenge_id}', [App\Http\Controllers\ChallengeController::class, 'edit'])->name('challenge_edit');
Route::post('/challenges/{challenge_id}', [App\Http\Controllers\ChallengeController::class, 'update'])->name('challenge_update');
