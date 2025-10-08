<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'regiView']);
Route::post('/register', [RegisterController::class, 'add']);

Route::get('/login', [LoginController::class, 'loginView']);
Route::post('/login', [LoginController::class, 'authentication']);
// Route::post('/login', [LoginController::class, 'authentication']);

Route::middleware(['authCheck'])->group(function () {
    Route::get('/display', [RegisterController::class, 'display']);
    // Route::get('/edit/{id}', [RegisterController::class, 'edit']);
    Route::get('/edit/{id}', [RegisterController::class, 'editView']);
    Route::put('/edit/{id}', [RegisterController::class, 'edit']);

    // web.php
    Route::delete('/users/delete-multiple', [RegisterController::class, 'deleteMultiple'])->name('users.deleteMultiple');
});
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
