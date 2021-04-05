<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $bookTitleExists = DB::Table('books')->where('title', $request->title)->count();
        $bookISBNExists = DB::Table('books')->where('isbn', $request->isbn)->count();
        if ($bookTitleExists > 0 || $bookISBNExists > 0) {
            return redirect('/')->with('error', 'We have this book already, search and you will find it ;) !');
        }
        $book = Book::create($request->all());
        $book->save();
        return redirect('/');
    }


    public function show(Book $book)
    {
        return view('bookDetails', ['book' => $book]);
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
