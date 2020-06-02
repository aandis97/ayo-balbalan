@extends('admin.templates.default')

@section('content')
@include('admin.templates.partials._alerts')
  <div class="row">
    <div class="col-md-10">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Order</h3>
        </div>

        <div class="box-body">
            <center><h3>Order Detail</h3></center>
            <h4>Order ID : {{ $order->id }}</h4>
            <h4>Order Status : {{ $order->status }}</h4>
            <h4>Total : {{ format_rupiah($order->total + $order->shiping  ) }}</h4>
          <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Item Name</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Sub Total</th> 
                            </tr>
                        </thead>
                        <tbody>
                              @foreach($order->orderDetails as $item)
                              <tr>
                                    <td>{{ $loop->iteration }}</td> 
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ format_rupiah($item->price) }}</td>
                                    <td>{{ format_rupiah($item->subtotal) }}</td>
                              </tr>
                              @endforeach
                              <tr>
                                    <td colspan="4" class="text-right">Shiping Cost</td>
                                    <td>: {{ format_rupiah( $order->shiping  ) }}</td>
                                    
                              </tr>
                              <tr>
                                    <td colspan="4" class="text-right">Grand Total</td>
                                    <td>: {{ format_rupiah($order->total + $order->shiping  ) }}</td>
                                    
                              </tr>
                        </tbody>
                    </table>
        </div>
      </div>
    </div>
  </div>

@endsection