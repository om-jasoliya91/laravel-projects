<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

use App\Http\Controllers\UserController;

// Route to create a user and see accessor in action
Route::get('/create-user', [UserController::class, 'index']);

Route::get('/get-data', [UserController::class, 'hello']);
Route::get('/get-view', [UserController::class, 'show']);
Route::get('/users/index', [UserController::class, 'redis'])->name('users.redis');

// sudo apt update
// sudo apt install redis-server
// sudo systemctl enable redis-server
// sudo systemctl start redis-server
Route::get('/test-redis', [UserController::class, 'testRedis']);
// Route::get('/users/index', [UserController::class, 'redis'])->name('users.redis'); --- IGNORE ---


use App\Http\Resources\UserCollection;
use App\Models\User;
 
Route::get('/user/{id}', function (string $id) {
    return new UserCollection(User::findOrFail($id));
});