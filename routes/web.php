<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('contacts',ContactsController::class);
Route::resource('books',BooksController::class);
Route::resource('users',UserController::class);
