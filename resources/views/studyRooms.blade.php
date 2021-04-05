@extends('layouts.app')

@section('content')
<div class="container w-50">
    <div class="row">
        <div class="col">
            <h1>Rooms</h1>
            @foreach ($rooms as $room)
            <div class="card float-left mr-5 mb-5" style="width: 18rem;">
                <img src="{{asset($room->image_url)}}" class="card-img-top" alt="A Medium Study Room">
                <div class="card-body">
                    <h5 class="card-title">{{ $room->name }}</h5>
                    <p class="card-text">
                        Location: {{ $room->location }}
                        <br />
                        Availability: {{ $room->availability }}%
                        <br />
                        {{ $room->description }}
                    </p>
                    <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-primary p-2 d-inline-flex"> Reserve Room</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection