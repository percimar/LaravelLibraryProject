<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Reservation;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishlist = Wishlist::get();
        $user = Auth::user();
        $books = Book::all();
        $reservations = Reservation::all();
        
        if ($user === null)
            return redirect('/');

        else if ($user->role === "member"){

        // $wishlist = Reservation::all();
        // $returnsWithStatus = $wishlist->map(function ($r) {
        //     $bookHasReservations = Reservation::where('book_id', $r->book->id)->whereIn('status', ['reserved', 'borrowed'])->count() !== 0;
        //     $r->isReservable = !$bookHasReservations;
        //     return $r;
        // });
        
        // $wishlist->status = $book->reservations->whereIn('status',['reserved','borrowed'])->count() == 0;

            return view('wishlist', [
                'wishlist' => $wishlist,
                'books' => $books,
                'reservations' => $reservations,
                'user' => $user
            ]);
        }
    }

    public function addToWishlist(Book $book) {
        $user = Auth::user();
        if(!$user) 
        {
            return redirect(route('login'));
        } 
        else 
        {
            if ($book->exists) {
        
                $wishlist = DB::Table('wishlist')->where("book_id",$book->id)->where("user_id",$user->id)->get();
                if(count($wishlist) === 0)
                {
                    $wishlist = new Wishlist();
                    $wishlist->book_id = $book->id;
                    $wishlist->user_id = $user->id;
                    $wishlist->status = "";
                    // $wishlist->status = $book->reservations->whereIn('status',['reserved','borrowed'])->count() == 0;
                    $wishlist->save();
                    return redirect(route('wishlist.index'))->with('success', 'Success: Book is added to your wishlist!');
                }
                else
                {
                    return redirect(route('wishlist.index'))->with('error', 'Error: Book is already in your wishlist!');
                }
            }
            else
            {
                return abort(404);
            }
        }   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function show(Wishlist $wishlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wishlist $wishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wishlist $wishlist)
    {
        $user = Auth::user();
        if ($user)
        {
            if ($wishlist->exists)
            {
                $wishlist->delete();
                return redirect(route('wishlist.index'));
            }
            else
            {
                return abort(404);
            }
        }
        else
        {
            return abort(403);
        }
    }
}
