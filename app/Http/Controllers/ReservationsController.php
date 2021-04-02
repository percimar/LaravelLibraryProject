<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationsController extends Controller
{

    public function reserve(Book $book) {
        //is user authenticated?
        $user = Auth::user();

        if(!$user) 
        {
            return redirect(route('login'));
        } 
        else 
        {
            if ($book->exists) {
                //Is the book already reserved?
                $reservations = DB::Table('reservations')->
                                where('book_id',"=",$book->id)->
                                whereIn('status', ['reserved','borrowed'])->
                                get();
                if(count($reservations) === 0)
                {
                    $reservation = new Reservation();
                    $reservation->book_id = $book->id;
                    $reservation->user_id = $user->id;
                    $reservation->reserve_date = now();
                    $reservation->status = "reserved";
                    $reservation->due_date = date("y-m-d", strtotime("+1 days", time()));
                    $reservation->save();

                    return redirect(route('reservations.index'));
                }
                else
                {
                    return redirect(route('reservations.index'))->with('error', 'Error: Book is currently reserved or borrowed!');
                }
            }
            else
            {
                return abort(404);
            }
        }   
    }

    public function borrow(Reservation $reservation) {
        //is user authenticated?
        $authUser = Auth::user();

        if($authUser === null) {
            return redirect(route('login'));
        }

        if($authUser->role !== "admin") {
            return abort(403);
        }

        if ($reservation->exists) {
            $book = $reservation->book;
            $user = $reservation->user;

            //Is the book already borrowed?
            $isBorrowed = DB::Table('reservations')->
                            where('book_id', "=" ,  $book->id)->
                            where('status',  '=',   'borrowed')->
                            get();
            
            if(count($isBorrowed) === 0)
            {
                $reservation->status = "borrowed";
                $reservation->borrow_date = today();
                $reservation->due_date = today()->add(14, 'day');
                $reservation->save();
                return redirect(route('reservations.index'));
            }
            else
            {
                return abort(400, "Illegal reservation, already reserved/borrowed");
            }
        }
        else
        {
            return abort(404);
        }
    }

    public function return(Reservation $reservation) {
        //is user authenticated?
        $authUser = Auth::user();

        if($authUser === null) {
            return redirect(route('login'));
        }

        if($authUser->role !== "admin") {
            return abort(403);
        }

        if ($reservation->exists) {
            $book = $reservation->book;
            $user = $reservation->user;
            
            if($reservation->status === "borrowed")
            {
                $reservation->status = "returned";
                $reservation->due_date = today();
                $reservation->save();
                return redirect(route('reservations.index'));
            }
            else
            {
                return redirect(route('reservations.index'))->with('error', 'Error: Book is not currently borrowed?');
            }
        }
        else
        {
            return abort(404);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $user = Auth::user();

        if($user === null) {
            return redirect(route('login'));
        }

        if($user->role !== "admin") {
            $reservations = Reservation::where('user_id', $user->id)->where('status','reserved')->get();
            $history = Reservation::where('user_id', $user->id)->whereIn('status',['cancelled','expired'])->get();
            return view('reservations', ['reservations' => $reservations, 'history' => $history]);
        }

        $reservations = Reservation::whereIn('status', ['reserved','borrowed'])->get();
        return view('adminReservations', ['reservations' => $reservations]);


        // foreach ($reservations as $reservation) {
            // dd($reservation->book()->get()[0]->title);
            // $reservation->book = $reservation->book()->title;
        // }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function borrowedIndex()
    {
        
        $user = Auth::user();

        if($user === null) {
            return redirect(route('login'));
        }

        $reservations = Reservation::where('status', 'borrowed')->where('user_id', $user->id)->get();
        return view('userBorrowed', ['reservations' => $reservations]);
    }

    /**
     * Display a history of the returned books.
     *
     * @return \Illuminate\Http\Response
     */
    public function returnedBooks()
    {
        
        $user = Auth::user();

        if($user === null) {
            return redirect(route('login'));
        }

        if($user->role == "admin") {
            $returns = Reservation::whereIn('status',['returned','expired','cancelled'])->get();
            return view('adminReservedBooks', ['returns' => $returns]);
        }

        $returns = Reservation::where('status', 'returned')->where('user_id', $user->id)->get();
        $returnsWithStatus = $returns->map(function ($r) {
            $bookHasReservations = Reservation::where('book_id', $r->book->id)->whereIn('status', ['reserved', 'borrowed'])->count() !== 0;
            $r->isReservable = !$bookHasReservations;
            return $r;
        });

        return view('returnedBooks', ['returns' => $returnsWithStatus]);
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
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $user = Auth::user();
        if ($user)
        {
            if ($reservation->exists && $reservation->status === "reserved")
            {
                $reservation->status = "cancelled";
                $reservation->save();
                return redirect(route('reservations.index'));
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
