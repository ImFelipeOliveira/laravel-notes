<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;


Route::get("/login", [LoginController::class, 'login']);
Route::post("/login-submit", [LoginController::class, 'loginSubmit']);
Route::get("/logout", [LogoutController::class, 'logout']);
