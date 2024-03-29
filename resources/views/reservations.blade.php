@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="row">
        <div class="col-lg-6 ml-auto">
            <h1 class="text-left">Your reservations</h1>
            @if(null !== session('alert'))
            <br />
            <div class="alert alert-danger" role="alert">
                {{session('alert') ?? '' }}
            </div>
            @endif
            @foreach ($reservations as $reservation)
            <div class="card flex-column" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $reservation->book->title }}</h5>
                    <p class="card-text">Reserved on: {{ $reservation->reserve_date }}</p>
                    <p class="card-text">Borrow before: {{ $reservation->due_date }}</p>

                    <form method="POST" action={{ route('reservations.destroy', $reservation->id) }}>
                        @csrf
                        @method('delete')
                        <input type="submit" href="#" class="btn btn-danger p-2 d-inline-flex" value="Cancel Reservation" />
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-lg-6 mr-auto">
            <h1 class="text-left">Your History</h1>
            @foreach ($history as $reservation)
            <div class="card flex-column" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $reservation->book->title }}</h5>
                    <p class="card-text">Reserved on: {{ $reservation->reserve_date }}</p>
                    <a href={{ route('reserve', $reservation->book->id) }} </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endsection