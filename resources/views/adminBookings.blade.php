@extends('layouts.app')

@section('content')
<div class="col-lg-8 m-auto">
    <h1>Room Bookings</h1>
    <br />
    <table class="table ">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Room</th>
                <th scope="col">User</th>
                <th scope="col">Booking Date</th>
                <th scope="col">Time Slot</th>
                <th scope="col">Approve</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $b)
                <tr>
                        <td>{{$b->room->getRoomName()}}</td> 
                        <td>{{$b->user->email}}</td> 
                        <td>{{$b->booking_date}}</td> 
                        <td>{{$b->timeslot}}</td>
                        @if(isset($b->approved_date))
                            <td>Approved on {{$b->approved_date}}</td>
                        @else
                            <td><a href="/bookings/{{$b->id}}/approve" class="btn btn-primary">Approve</a></td>
                        @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection