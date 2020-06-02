@extends('admin.templates.default')

@section('content')
@include('admin.templates.partials._alerts')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Order</h3>
        </div>

        <div class="box-body">
          <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Order ID</th>
                                <th>Status</th>
                                <th>Courier</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                              @foreach($orders as $order)
                              <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td> <a href="{{ route('order.show',$order->id  ) }}"> {{ $order->id }} </a></td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->courier }}</td>
                                    <td>{{ format_rupiah($order->total + $order->shiping  ) }}</td>
                              </tr>
                              @endforeach
                        </tbody>
                    </table>
        </div>
        <div class="box-footer clearfix">
          <!-- perbedaan links dan render?? -->
          {{ $orders->render('vendor.pagination.admin-lte') }}
        </div>
      </div>
    </div>
  </div>

@endsection