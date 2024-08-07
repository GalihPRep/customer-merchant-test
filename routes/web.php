<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post("/api/login", [AuthenticationController::class, "login"]);
Route::get("/api/logout", [AuthenticationController::class, "logout"])->middleware("auth:sanctum");
Route::post("/api/register", [AuthenticationController::class, "register"]);

Route::get("/api/customers", [CustomersController::class, "index"])->middleware("auth:sanctum");

Route::post("/api/product", [ProductsController::class, "store"])->middleware("auth:sanctum");
Route::delete("/api/product/{id}", [ProductsController::class, "destroy"])->middleware("auth:sanctum");
Route::get("/api/product/{id}", [ProductsController::class, "show"])->middleware("auth:sanctum");
Route::post("/api/product/{id}", [ProductsController::class, "update"])->middleware("auth:sanctum");
Route::get("/api/products", [ProductsController::class, "index"])->middleware("auth:sanctum");

Route::post("/api/transaction", [TransactionsController::class, "store"])->middleware("auth:sanctum");

Route::get('/api/token', fn () => csrf_token());

Route::post("/api/topup", [UsersController::class, "topup"])->middleware("auth:sanctum");
Route::get("/api/user", [UsersController::class, "show"])->middleware("auth:sanctum");
