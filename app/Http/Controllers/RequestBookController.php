<?php

namespace App\Http\Controllers;

use App\Models\RequestBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequestBookController extends Controller
{

    public function index()
    {
        $reqbooks = RequestBook::all();

        $user = Auth::user();
        if ($user === null) {
            return redirect('/');
        } else if ($user->role === "admin") {
            return view('RequestedBooks', [
                'requests' => $reqbooks
            ]);
        }
        return abort(401);
    }

    public function create()
    {
        $user = Auth::user();

        if ($user === null) {
            return redirect(route('login'));
        }

        return view("RequestBookForm");
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user === null) {
            return redirect(route('login'));
        }
        request()->validate([
            'title' => 'required',
            'author' => 'required',
        ]);
        $bookRequested = DB::Table('request_books')->where('title', $request->title)->count();
        if ($bookRequested > 0) {
            return redirect('/')->with('error', 'A book with same title been requested already, we working on bringing it on our online shelves :D !');
        }
        $bookExists = DB::Table('books')->where('title', $request->title)->count();
        if ($bookExists > 0) {
            return redirect('/')->with('error', 'We have this book, search and you will find it ;) !');
        }
        $reqbooks = RequestBook::create($request->all());
        $reqbooks->save();
        return redirect('/')->with('success', 'Your request has been sent!');
    }

    public function show(RequestBook $requestBook)
    {
        //
    }

    public function edit(RequestBook $requestBook)
    {
        //
    }

    public function update(Request $request, RequestBook $requestBook)
    {
        //
    }

    public function destroy($requestBook)
    {
        $user = Auth::user();
        $res = DB::Table('request_books')->where('id', $requestBook)->delete();
        return redirect('request');
    }
}
