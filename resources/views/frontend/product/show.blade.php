@extends('layouts.app')

@section('content')

  <div class="content">
    <div class="row">
      <div class="col-md-2">
        @include('frontend.components._sidebar')
      </div>
      <div class="col-md-10">
        <div class="row">
          <div class="col-md-4">

              <img class="card-img-top"  src="{{ asset($product->getImage()) }}" alt="Card image cap">
          </div>
          <div class="col-md-7">
            <div class="card" >
              <div class="card-body">
                <h5 class="card-title"> <a href="{{ route('front.product.show', $product) }}"> {{ $product->name }}</a></h5>
                <label for="label">{{ $product->getPrice() }}</label>
                <p class="card-text">{{ $product->description }} </p>
                <a href="" class="btn btn-info">Add to Cart</a>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>

@endsection
