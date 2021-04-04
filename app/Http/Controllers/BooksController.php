<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class BooksController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return $books;
    }

    public function create()
    {
        $user = Auth::user();

        if ($user === null) {
            return redirect(route('login'));
        }

        if ($user->role !== "admin") {
            return abort(403);
        }

        $categories = [
            'Fantasy',
            'Historical Fiction',
            'Autobiography',
            'Horror',
            'Detective Mystery',
            'Romance',
            'Thrillers'
        ];
        return view("bookForm", ['categories' => $categories]);
    }
    public function createBookFromRequest($title, $author)
    {
        $user = Auth::user();

        if ($user === null) {
            return redirect(route('login'));
        }

        if ($user->role !== "admin") {
            return abort(403);
        }

        $categories = [
            'Fantasy',
            'Historical Fiction',
            'Autobiography',
            'Horror',
            'Detective Mystery',
            'Romance',
            'Thrillers'
        ];
        return view("AdminReqBookForm", ['categories' => $categories, 'title' => $title, 'author' => $author]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user === null) {
            return redirect(route('login'));
        }

        if ($user->role !== "admin") {
            return abort(403);
        }

        request()->validate([
            'title' => 'required',
            'isbn' => 'required',
            'author' => 'required',
            'category' => 'required',
            'pages' => 'required',
            'publication' => 'required',
        ]);

        $bookExistsinReq = DB::Table('request_books')->where('title', $request->title)->count();
        if ($bookExistsinReq > 0) {
            $res = DB::Table('request_books')->where('title', $request->title)->delete();
        }
        $bookTitleExists = DB::Table('book')->where('title', $request->title)->count();
        $bookISBNExists = DB::Table('book')->where('isbn', $request->isbn)->count();
        if ($bookTitleExists > 0 || $bookISBNExists > 0) {
            return redirect('/')->with('error', 'We have this book already, search and you will find it ;) !');
        }

        $book = Book::create($request->all());
        $book->save();

        return redirect('/');
    }


    public function show(Book $book)
    {
        $user = Auth::user();

        // Find if the book is borrowed or returned by the authenticated user
        // To check if the user is allowed to leave a review or not
        $reviewable = false;
        if ($user) {
            $borrowed = Reservation::where("book_id", $book->id)
            ->where("user_id", $user->id)
            ->where("status", "borrowed")
            ->get();
            $returned = Reservation::where("book_id", $book->id)
            ->where("user_id", $user->id)
            ->where("status", "returned")
            ->get();
            if (count($borrowed) > 0 || count($returned) > 0) {
                $reviewable = true;
            }
        }

        $reviews = Review::where("book_id", $book->id)->get();

        // Add the user name to each review
        foreach ($reviews as $review) {
            $from = User::find($review->user_id);
            $review->from = $from->name;
        }

        return view('bookDetails', [
        'book' => $book,
        'user' => $user->id,
        'reviews' => $reviews,
        'isreviewallowed' => $reviewable,
        ]);
    }

    public function edit(Book $book)
    {
        //
    }


    public function update(Request $request, Book $book)
    {
        //
    }

    public function destroy(Book $book)
    {
        //
    }
}
