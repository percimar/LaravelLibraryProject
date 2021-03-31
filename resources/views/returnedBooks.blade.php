@extends('layouts.app')

@section('content')
<div class="col-lg-8 m-auto">
    <h1>Returned Books</h1>
    @if(null !== session('alert'))
    <br />
    <div class="alert alert-primary " role="alert">
        {{session('alert') ?? '' }}
    </div>
    @endif
    <br />
    <table class="table ">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Book ISBN</th>
                <th scope="col">Book Title</th>
                <th scope="col">Book Author</th>
                <th scope="col">Returned Date</th>
                <th scope="col">Reservable?</th>
            </tr>
        </thead>
        <tbody>
            @foreach($returns as $r)
                <tr>
                        <td>{{$r->book->isbn}}</td> 
                        <td>{{$r->book->title}}</td>
                        <td>{{$r->book->author}}</td>
                        <td>{{$r->return_date}}</td>
                        @if($r->isReservable)
                            <td><a href={{route('reserve', $r->book->id)}} class="btn btn-primary">Reserve</a></td>
                        @else
                            <td>Not available</td>
                        @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection