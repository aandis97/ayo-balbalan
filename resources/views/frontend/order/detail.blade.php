@extends('layouts.app')

@section('content')


<div class="container">
    <div class="content">
        <h3>Order Detail</h3>
        <div class="row">
            <div class="col-md-8">
                <div class="content">
                  <table class="table pull-right" style="width:300px">
                  @if($order->status=="Unpaid")

                        <tr>
                              <td class="text-right">Bank</td>
                              <td >: {{ config('olshop.bank.name') }}</td>
                        </tr>
                        <tr>
                              <td class="text-right">Account Name</td>
                              <td >: {{ config('olshop.bank.account_name') }}</td>
                        </tr>
                        <tr>
                              <td class="text-right">Account Number</td>
                              <td >: {{ config('olshop.bank.account_number') }}</td>
                        </tr>
                        <tr>
                              <td class="text-right">Amount</td>
                              <td >: {{ $order->total + $order->shiping_cost }}</td>
                        </tr>
                  
                        @else
                        
                              <tr>
                                    <td class="text-right">Status</td>
                                    <td >: PAID</td>
                              </tr>
                              <tr>
                                    <td class="text-right">Amount</td>
                                    <td >: {{ $order->total + $order->shiping_cost }}</td>
                              </tr>

                        @endif
                  </table>
                        <hr>
                        <br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Item Name</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                              @foreach($order->orderDetails as $item)
                              <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ format_rupiah($item->product->price) }}</td>
                              </tr>
                              @endforeach
                              <tr>
                                    <td colspan="2" class="text-right">Shipping</td>
                                    <td>{{ $order->shiping_cost }}</td>
                              </tr>
                              <tr>
                                    <td colspan="2" class="text-right">Total</td>
                                    <td>{{ $order->total + $order->shiping_cost }}</td>                                    
                              </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
