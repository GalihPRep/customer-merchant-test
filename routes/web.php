<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post("/api/login", [AuthenticationController::class, "login"]);
Route::post("/api/logout", [AuthenticationController::class, "logout"]);
Route::post("/api/register", [AuthenticationController::class, "register"]);

Route::get('/api/token', fn () => csrf_token());