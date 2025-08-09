<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Note\CreateNote;
use App\Http\Controllers\Note\DeleteNote;
use App\Http\Middleware\IsLogged;
use App\Http\Middleware\IsNotLogged;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Note\EditNote;

Route::middleware(IsNotLogged::class)->group(function () {
  Route::get("/login", [LoginController::class, 'login']);
  Route::post("/login-submit", [LoginController::class, 'loginSubmit']);
});


Route::middleware(IsLogged::class)->group(function () {
  Route::get("/", [MainController::class, "index"])->name("home");
  Route::get("/logout", [LogoutController::class, 'logout'])->name("logout");
  Route::get("/new-note", [CreateNote::class, 'newNote'])->name("newNote");
  Route::get("/edit-note/{id}", [EditNote::class, 'viewNote'])->name("editNote");
  Route::post("/edit-note/{id}", [EditNote::class, 'update'])->name("updateNote");
  Route::post("/create-note", [CreateNote::class, 'create'])->name("createNote");
  Route::post("/delete-note/{id}", DeleteNote::class)->name("deleteNote");
});
