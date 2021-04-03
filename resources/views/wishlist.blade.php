@extends('layouts.app')

@section('content')
<div class="col-lg-8 m-auto">
    <h1>Your Wishlist</h1>
    <br />
    <table class="table ">
        <thead class="thead-dark">
            <tr>
                <th scope="col"></th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Available?</th>
                <th scope="col">Remove from Wishlist</th>
            </tr>
        </thead>
        <tbody>
            @foreach($returnsWithStatus as $item)
                @if($user->role == 'member') 
                    <tr>
                        @foreach($books as $book)
                            @if($book->id == $item->book_id)
                            <td><img src='{{$book->image}}' id="bookCover"></td> 
                            <td style="vertical-align:center">{{$book->title}}</td>
                            <td>{{$book->category}}</td>
                            @endif
                        @endforeach
                        @if($item->isReservable !== 1){
                            <td>Not Available</td>
                        }
                        @else{
                            <td><a href={{route('reserve', $item->book_id)}} class="btn btn-primary">Reserve</a></td>
                        }
                        @endif
                        <form method="POST" action={{ route('wishlist.destroy', $item->id) }}>
                        @csrf
                        @method('delete')
                        <td><input type="submit" href="#" class="btn btn-danger p-2 d-inline-flex" value="X" /></td>
                        </form>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection