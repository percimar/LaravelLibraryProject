<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $timeSlotsInAWeek = 60; //12 one-hour slots a day, 5 times a week
        $rooms = Room::all()->each(function ($room) {
            $room->name = $room->getRoomName();
            $room->availability = round(100 - (($room->bookings->where('timeslot', '>', now()->subHour())->count() / 60) * 100), 2);
        });
        return view('studyRooms', ['rooms' => $rooms]);
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
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        $user = Auth::user();

        if ($user === null) {
            return redirect(route('login'));
        }
        
        $room->name = $room->getRoomName();
        $bookings = $room->bookings;
        $timeslots = [];

        //Loop through next 7 days
        for($i = 0; $i < 7; $i++) {
            $day = today()->add($i, 'day');
            //Skip weekends
            if($day->isFriday() || $day->isSaturday()) {
                continue;
            }

            //First time slot is 7:30 AM
            $timeslot = $day->add(7, 'hours')->add(30, 'minutes');
            //Loop through 7:30 AM through 7:30 PM and add to $timeslots
            for($j = 0; $j < 12; $j++) {
                if($timeslot > now()) {
                    $tsObj = new \stdClass();
                    $tsObj->datetime = $timeslot->toDateTimeString();
                    $tsObj->datedisplay = $timeslot->format('l, d/m h:i A');
                    $tsObj->isReserved = $bookings->where('timeslot', $tsObj->datetime)->isNotEmpty();
                    array_push($timeslots, $tsObj);
                }
                $timeslot = $timeslot->add(1, 'hour');
            }
        }

        $day1 = array_slice($timeslots, 0, 12);
        $day2 = array_slice($timeslots, 12, 12);
        $day3 = array_slice($timeslots, 24, 12);
        $day4 = array_slice($timeslots, 36, 12);
        $day5 = array_slice($timeslots, 48, 12);

        $days = [$day1, $day2, $day3, $day4, $day5];


        return view('reserveRoom', ['room' => $room, 'days' => $days]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function bookRoom(Request $request, Room $room)
    {
        $user = Auth::user();

        if ($user === null) {
            return redirect(route('login'));
        }

        request()->validate([
            'timeslot' => ['required']
        ]);

        $booking = new Booking();
        $booking->timeslot = $request->timeslot;
        $booking->booking_date = today();
        $booking->room_id = $room->id;
        $booking->user_id = $user->id;
        $booking->save();

        return redirect(route('bookings.index'))->with('success', 'Your room booking has been requested. You will be notified by email when it has been approved!');
    }

}
