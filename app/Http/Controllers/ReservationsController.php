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

    public function borrow(Book $book) {
        //is user authenticated?
        $user = Auth::user();

        if(!$user) 
        {
            return redirect(route('login'));
        } 
        else 
        {
            if ($book->exists) {
                //Is the book already reserved by someone else?
                $reservationsByOthers = DB::Table('reservations')->
                                where('book_id', "=" ,  $book->id)->
                                where('user_id','!=',   $user->id)->
                                where('status',  '=',   'reserved')->
                                get();
                
                //Is the book already borrowed by you?
                $borrowedByYou = DB::Table('reservations')->
                                where('book_id', "=" ,  $book->id)->
                                where('user_id', '=',   $user->id)->
                                where('status',  '=',   'borrowed')->
                                get();
                
                if(count($reservationsByOthers) === 0 && count($borrowedByYou) === 0)
                {
                    $reservations = DB::Table('reservations')->
                                where('book_id', "=",   $book->id)->
                                where('user_id', '=',   $user->id)->
                                where('status',  '=',   'reserved')->
                                get();

                    $reservation = Reservation::find($reservations[0]->id);
                    $reservation->status = "borrowed";
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if($user) 
        {

            $reservations = Reservation::where('user_id', $user->id)->where('status','reserved')->get();

            foreach ($reservations as $reservation) {
                // dd($reservation->book()->get()[0]->title);
                // $reservation->book = $reservation->book()->title;
            }

            return view('reservations', ['reservations' => $reservations]);
        } 
        else 
        {
            return redirect(route('login'));
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
