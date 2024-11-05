@extends('user.home')
@section('body')
<div class="latest-products">
    <div class="container">
      <div class="row">
      <div class="product">
          <img src="{{ asset("Storage/$product->image") }}" alt="">
          <h2>{{ $product->name }}</h2>
          <p>{{ $product->description }}</p>
          <span>{{ $product->price }}</span>
      </div>
      </div>
    </div>
  </div>
@endsection
