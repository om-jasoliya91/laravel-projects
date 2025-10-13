<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
    // Logout
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});



Route::get('/set-cookie', function () {
    $minutes = 60;
    $response = new Response('Cookie set successfully');
    $response->withCookie(cookie('user_preference', 'dark_mode', $minutes));
    return $response;
});

Route::get('/get-cookie', function (Request $request) {
    $value = $request->cookie('user_preference');
    return $value ? 'Cookie Value: ' . $value : 'Cookie not found';
});

Route::get('/delete-cookie', function () {
    return response('Cookie deleted successfully')->cookie('user_preference', '', -1);
});
