<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class BookingsController extends Controller
{
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

        if($user->role == "admin") {
            $bookings = Booking::where('timeslot', '>', now()->subHour())->orderBy('timeslot')->get();
            return view('adminBookings', ['bookings' => $bookings]);
        }

        $bookings = Booking::where('user_id', $user->id)->where('timeslot', '>', now()->subHour())->orderBy('timeslot')->get();
        return view('userBookings', ['bookings' => $bookings]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        if ($user === null) {
            return redirect(route('login'));
        }

        return view("bookingForm");
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
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }

    public function approve(Booking $booking)
    {
        $user = Auth::user();

        if ($user === null) {
            return redirect(route('login'));
        }

        if ($user->role !== "admin") {
            return abort(403);
        }

        $booking->approved_date = now();
        $booking->save();

        return redirect(route("bookings.index"));
    }
}
