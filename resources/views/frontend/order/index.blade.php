@extends('layouts.app')

@section('content')


<div class="container">
    <div class="content">
        <h3>My Order</h3>
        <div class="row">
            <div class="col-md-8">
                <div class="content">
                        <hr>
                        <br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Order ID</th>
                                <th>Status</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                              @foreach($orders as $order)
                              <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="{{ route('front.order.show',$order->id) }}">{{ $order->id }}</a></td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ format_rupiah($order->total + $order->shiping  ) }}</td>
                              </tr>
                              @endforeach
                        </tbody>
                    </table>
                    
                </div>
                
                {{ $orders->render() }}
            </div>
        </div>
    </div>
</div>


@endsection
