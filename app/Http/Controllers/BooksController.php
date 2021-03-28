<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        // $disbooks = Book::get();
        return $books;
        // return view('welcome', [
        //     'books' => $books,
        //     'disbooks' => $disbooks
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        if($user === null) {
            return redirect(route('login'));
        }

        if($user->role !== "admin") {
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if($user === null) {
            return redirect(route('login'));
        }

        if($user->role !== "admin") {
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

        $book = Book::create($request->all());
        $book->save();
        return $book;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
