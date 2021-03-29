@extends('layouts.app')

@section('content')
<img class="center" src="{{ asset('img/labiblio-banner.png') }}"  width="200px" />

<div class="grid-container">
  <!-- <div class="item1">Header</div> -->
  <div class="item2">
    Categories
    <div>
      <a href="#">
        Cat 1
      </a><br />
      <a href="#">
        Cat 2
      </a>
    </div>

  </div>
  <div class="item3">
    <input class="searchInput" id="searchBooks" placeholder="Type to Search..." />

    <div id="loadBooks" class="grid-container-books">
    </div>

    <!-- <div class="item4">Right</div> -->
    <!-- <div class="item5">Footer</div> -->
  </div>
  @endsection