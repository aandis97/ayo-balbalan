@extends('layouts.app')

@section('content')

<div class="container">
    <div class="content">
        <div class="row">
            <div class="col-md-9">
                <h3>Shopping Cart</h3>
                @if($items)
                @php
                  $totalItems = 0;
                  $totalPrice = 0;
                @endphp
                @foreach($items as $item)
                  @php
                    $totalItems += $item['qty'];
                    $totalPrice += $item['price'];
                  @endphp
                  <div class="card mb-10">
                      <div class="card-body">
                          <div class="row">
                              <div class="col-md-2">
                                  <img src="{{ $item['image'] }}" class="mw-100" alt="">
                              </div>
                              <div class="col-md-9">
                                  <h5 class="card-title">{{ $item['name'] }}</h5>
                                  <p class="card-text ">Description : {{ $item['description'] }}</p>
                                  <h4 class="card-text text-danger">{{ $item['formatted_price'] }}</h4>
                              </div>
                          </div>
                      </div>
                  </div>
                @endforeach
                @else
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-header-title">Data Kosong</h3>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-md-3">
            <h3>Cart Detail</h3> 
                <div class="card">
                    <div class="card-body">
                      <p>Total Items : {{ $totalItems }}</p>
                      <p>Total Price : {{ format_rupiah($totalPrice) }}</p>
                      <hr>
                      <a href="{{ route('checkout.index') }}" class="btn btn-danger btn-block">Checkout</a>
                    </div>
                </div> 
            </div>
        </div>
    </div>

    @endsection
