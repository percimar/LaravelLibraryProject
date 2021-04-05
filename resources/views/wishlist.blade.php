@extends('layouts.app')

@section('content')
<div class="col-lg-8 m-auto">
    <h1>Your Wishlist</h1>
    <br />
    <table class="w-100 center">
        <thead class="thead-dark">
            <tr>
                <th scope="col"></th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <!-- <th scope="col">Available?</th> -->
                <th scope="col">Remove from Wishlist</th>
            </tr>
        </thead>
        <tbody>
            @foreach($wishlist as $item)
            @if($user->role == 'member')
            <tr>
                @if($user->id === $item->user_id)
                @foreach($books as $book)
                @if($book->id == $item->book_id)
                <td><img src='{{$book->image}}' id="bookCover"></td>
                <td><a href="/books/{{$item->book_id}}">{{$book->title}}</a></td>
                <td>{{$book->category}}</td>
                @endif
                @endforeach
                <form method="POST" action={{ route('wishlist.destroy', $item->id) }}>
                    @csrf
                    @method('delete')
                    <td><input type="submit" href="#" class="btn btn-danger p-2 d-inline-flex" value="X" /></td>
                </form>
                @endif
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection