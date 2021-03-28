@extends('layouts.app')

@section('content')
<img class="center" src="{{ asset('img/labiblio-banner.png') }}" />

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
    Popular Books
    <input id="searchBooks" placeholder="Search our books" id="searchInput" />
    <div id="loadBooks">
      <div>
      </div>
      <div class="grid-container-books">
<div id="loadBooks"></div>

        <!-- <div class="grid-item">1</div> -->
        <!-- <div class="grid-item">2</div>
        <div class="grid-item">3</div>
        <div class="grid-item">4</div>
        <div class="grid-item">5</div>
        <div class="grid-item">6</div>
        <div class="grid-item">7</div>
        <div class="grid-item">8</div>
        <div class="grid-item">9</div> -->


      </div>

      <!-- <div class="item4">Right</div> -->
      <!-- <div class="item5">Footer</div> -->
    </div>
    @endsection