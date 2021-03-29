<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('contacts',ContactsController::class);
Route::resource('books',BooksController::class);
Route::resource('reservations',ReservationsController::class);
Route::resource('users',UserController::class);

Route::get('/books/{book}/reserve', [ReservationsController::class, 'reserve'])->name('reserve');
Route::get('/books/{book}/borrow', [ReservationsController::class, 'borrow'])->name('borrow');