@extends('layouts.app')

@section('content')

  <div class="content">
    <div class="row">
      <div class="col-md-2">
        @include('frontend.components._sidebar')
      </div>
      <div class="col-md-10">
        <div class="row">
          @foreach($products as $product)
          <!-- Include product here -->
            @include('frontend.components._card-product', $product)
          @endforeach
          </div>
          <br>
          {{ $products->links() }}
      </div>
    </div>
  </div>

@endsection
