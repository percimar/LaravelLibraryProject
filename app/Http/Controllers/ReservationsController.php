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
                                where('status', '=', 'reserved')->
                                get();
                if(count($reservations) === 0)
                {
                    $reservation = new Reservation();
                    $reservation->book_id = $book->id;
                    $reservation->user_id = $user->id;
                    $reservation->reserve_date = now();
                    $reservation->status = "reserved";
                    $reservation->return_date = date("y-m-d", strtotime("+30 days", time()));
                    $reservation->save();

                    return redirect(route('reservations.index'));
                }
                else
                {
                    return redirect('/');
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
            $today = today();
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
                $reservation->return_date = $today->add(14, 'day');
                $reservation->save();
                return redirect(route('reservations.index'));
            }
            else
            {
                return abort(400);
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
            return view('reservations', ['reservations' => $reservations]);
        }

        $reservations = Reservation::where('status', 'reserved')->get();
        return view('adminReservations', ['reservations' => $reservations]);


        // foreach ($reservations as $reservation) {
            // dd($reservation->book()->get()[0]->title);
            // $reservation->book = $reservation->book()->title;
        // }

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
                $reservation->delete();
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
