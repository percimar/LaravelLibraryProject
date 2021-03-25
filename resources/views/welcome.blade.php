@extends('layouts.app')

@section('content')
<img class="center" src="{{ asset('img/labiblio-banner.png') }}" />

<div class="grid-container">
  <!-- <div class="item1">Header</div> -->
  <div class="item2">
    Categories
    <div>
      Cat 1
    </div>
    <div>
      Cat 2
    </div>
  </div>
  <div class="item3">
  Popular Books
  
  </div>
  <div class="item2">Categories</div>
  <div class="item3">
  <input id="searchBooks" placeholder="Search our books" />
  <div id="loadBooks"><div>
  </div>  
  <!-- <div class="item4">Right</div> -->
  <!-- <div class="item5">Footer</div> -->
</div>
@endsection