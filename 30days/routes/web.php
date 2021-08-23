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
Route::get('/profile/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('profile_edit');
Route::post('/profile/update', [App\Http\Controllers\UserController::class, 'update'])->name('profile_update');
