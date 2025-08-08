<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\IsLogged;
use App\Http\Middleware\IsNotLogged;
use Illuminate\Support\Facades\Route;

Route::middleware(IsNotLogged::class)->group(function () {
  Route::get("/login", [LoginController::class, 'login']);
  Route::post("/login-submit", [LoginController::class, 'loginSubmit']);
});


Route::middleware(IsLogged::class)->group(function () {
  Route::get("/", [MainController::class, "index"]);
  Route::get("/logout", [LogoutController::class, 'logout']);
});
