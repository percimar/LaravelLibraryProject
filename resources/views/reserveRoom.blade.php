@extends('layouts.app')

@section('content')
<div class="col-lg-8 m-auto">
    <h1>Reserve {{$room->name}}</h1>
    <p>This room can be reserved for a one hour time slot, up to 5 days in advance. 
    The operating hours of the library are 7:30 - 19:30. Please do not bring food or drinks into the study rooms. 
    Due to Covid, it is kindly requested that you leave the room 5 minutes before 
    the next time slot so that it can be sanitized.</p>
    <form class="col-lg-4" method="POST" action="/rooms/{{$room->id}}/book">
        @csrf
        <div class="form-group">
            <label for="timeslot">Time Slot:</label>
            <select class="form-control @error('timeslot') border-danger @enderror" id="timeslot" name="timeslot">
                <option value="">Select Start Time</option>
                @foreach ($days as $timeslotday)
                    @foreach($timeslotday as $timeslot)
                        @if ($timeslot == old('timeslot'))
                            <option class="dropdown-item" value="{{$timeslot->datetime}}" selected>
                        @else
                            @if ($timeslot->isReserved)
                            <option class="dropdown-item" value="{{$timeslot->datetime}}" disabled>
                            @else
                            <option class="dropdown-item" value="{{$timeslot->datetime}}">
                            @endif
                        @endif
                        {{$timeslot->datedisplay}}
                        </option>
                    @endforeach
                @endforeach
            </select>
            @error('timeslot')
                <p class="alert text-danger">You must choose a timeset</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Book</button>
    </form>
</div>
@endsection