<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\RequestBookController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\RoomsController;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('contacts',ContactsController::class);
Route::resource('books',BooksController::class);
Route::resource('reservations',ReservationsController::class);
Route::resource('users', UserController::class);
Route::resource('request', RequestBookController::class);
Route::resource('bookings', BookingsController::class);
Route::resource('rooms', RoomsController::class);
Route::resource('wishlist', WishlistController::class);

Route::get('/books/{book}/reserve', [ReservationsController::class, 'reserve'])->name('reserve');
Route::get('/books/{book}/addToWishlist', [WishlistController::class, 'addToWishlist'])->name('addToWishlist');
Route::get('/reservations/{reservation}/borrow', [ReservationsController::class, 'borrow'])->name('borrow');
Route::get('/reservations/{reservation}/return', [ReservationsController::class, 'return'])->name('return');
Route::get('/borrowed', [ReservationsController::class, 'borrowedIndex'])->name('userBorrowed');
Route::get('/returned', [ReservationsController::class, 'returnedBooks'])->name('returnedBooks');
Route::get('/request/create/{title}/{author}', [BooksController::class, 'createBookFromRequest'])->name('books.createBookFromRequest');
// Route::get('/request/create/{title}/{author}', ['as' => 'books.createBookFromRequest', 'uses' => 'BooksController@createBookFromRequest']);
