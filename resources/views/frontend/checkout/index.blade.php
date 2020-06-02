@extends('layouts.app')

@section('content')

<div class="container">
    <div class="content">
        <h3>Checkout</h3>
        <div class="row">
            <div class="col-md-8">

                <div class="content">
                    <h5>Shipping Address</h5>

                    <form method="POST" action="{{ route('checkout.store') }}">
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control " name="name"
                                value="{{ auth()->user()->name ?? old('name') }}" required autocomplete="name"
                                autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="email">{{ __('E-Mail Address') }}</label>


                            <input id="email" type="email" class="form-control " name="email"
                                value="{{ auth()->user()->email ?? old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>


                        <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="phone">{{ __('Phone') }}</label>
                            <input id="phone" type="text" class="form-control " name="phone"
                                value="{{  auth()->user()->phone ?? old('phone') }}" required autocomplete="phone">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="form-group  {{ $errors->has('province') ? 'has-error' : '' }}">
                            <label for="phone">Province</label>
                            <select class="select form-control" name="province" id="province">
                                <option value="">Pilih Provinsi</option>
                            </select>
                        </div>

                        <div class="form-group  {{ $errors->has('city') ? 'has-error' : '' }}">
                            <label for="phone">City</label>
                            <select class="select form-control" name="city" id="city">
                            </select>
                        </div>

                        <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="address">{{ __('Address') }}</label>
                            <textarea name="address" class="form-control " cols="30"
                                rows="3">{{  auth()->user()->address ?? old('address') }}</textarea>
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="form-group  {{ $errors->has('courier') ? 'has-error' : '' }}">
                            <label for="phone">courier</label>
                            <select class="select form-control" name="courier" id="courier">
                                <option value="">Pilih Courier</option>
                                @foreach($couriers as $key => $courier)
                                <option value="{{ $key }}">{{ $courier }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group  {{ $errors->has('service') ? 'has-error' : '' }}">
                            <label for="phone">service</label>
                            <select class="select form-control" name="service" id="service">
                            </select>
                        </div>
                        <hr>
                        <input type="text" name="shipping" id="shipping">
                        <button type="submit" class="btn btn-danger btn-block">Save</button>
                    </form>
                </div> 
            </div>
            <div class="col-md-4">
                <h5>Cart Detail</h5>
                <div class="card">
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
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ $item['image'] }}" class="mw-100" alt="">
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title">{{ $item['name'] }}</h5> 
                                    <p class="card-text text-danger">{{ $item['formatted_price'] }}</p>
                                </div>
                            </div>
                        </div> 
                    @endforeach
                    @else
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title">Data Kosong</h4>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="card">
                    <div class="card-body">
                        <p>Total Items : {{ $totalItems }}</p> 
                        <p>ETD : <span id="etd"></span></p>
                        <p>Shipping Cost : <span id="shipping_cost"></span></p>
                        <p>Total Price : <span id="total_price">{{ format_rupiah($totalPrice) }}</span></p>
                        <hr>
                        <p>Grand Total : <span id="grand_total">{{ format_rupiah($totalPrice) }}</span></p>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection

    @push('scripts')
    <script>

        function convertToRupiah(angka)
        {
            var rupiah = '';		
            var angkarev = angka.toString().split('').reverse().join('');
            for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
            return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
        }
        
        function convertToAngka(rupiah)
        {
            return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
        }   

        $.ajax({
            type: 'GET',
            url: "{{ route('rajaongkir.province') }}",
            success: function (data) {
                // console.log(data);

                var provinces = data;

                provinces.forEach(function (province) {
                    // var provinsi = new Option(province.province_id, provice.province)
                    // $(provinsi).html(province.province)
                    // $("#province").append(provinsi)

                    $("#province").append('<option value="' + province.province_id + '">' + province
                        .province + '</option>')
                })
            }
        })

        $(document).ready(function ($) {
            $('#province').change(function () {
                var provinceId = $('#province').val()

                $.ajax({
                    type: 'GET',
                    url: "{{ route('rajaongkir.city') }}",
                    data: 'province_id=' + provinceId,
                    success: function (data) {
                        console.log(data);

                        var cities = data;

                        $("#city").empty().append(
                        '<option value=""> Select City </option>');
                        cities.forEach(function (city) {
                            // var provinsi = new Option(province.province_id, provice.province)
                            // $(provinsi).html(province.province)
                            // $("#province").append(provinsi)
                            $("#city").append('<option value="' + city.city_id +
                                '">' + city.city_name + '</option>')
                        })
                    }
                })

            })


            $('#courier').change(function () {
                var cityId = $('#city').val()
                var courier = $('#courier').val()
                $.ajax({
                    type: 'POST',
                    url: "{{ route('rajaongkir.cost') }}",
                    data: 'city=' + cityId + '&courier=' + courier,
                    success: function (data) {
                        console.log(data);

                        var services = data.costs;

                        console.log(services)

                        $("#service").empty().append(
                            '<option value=""> Select Service </option>');
                        services.forEach(function (courier) {
                            // var provinsi = new Option(province.province_id, provice.province)
                            // $(provinsi).html(province.province)
                            // $("#province").append(provinsi)
                            $("#service").append('<option value="' + courier
                                .service + '">' + courier.description + ' - ' +
                                courier.cost[0].value + '</option>')
                        })
                    }
                })

            })

            
            $('#service').change(function () {
                var cityId = $('#city').val()
                var courier = $('#courier').val()
                var service = $('#service').val()

                $.ajax({
                    type: 'POST',
                    url: "{{ route('rajaongkir.cost') }}",
                    data: 'city=' + cityId + '&courier=' + courier,
                    success: function (data) {

                        var couriers = data.costs;
                        var shipCost = couriers.find(function(cost){
                            return cost.service == service
                        })
                        var totalPrice = convertToAngka($('#total_price').text())
                        var shippingCost = shipCost.cost[0].value
                        var grandTotal = totalPrice+shippingCost

                        $('#shipping_cost').text(shipCost.cost[0].value);
                        $('#shipping').val(shipCost.cost[0].value)
                        $('#etd').text(shipCost.cost[0].etd+" Days");
                        $('#total_price').text(convertToRupiah(totalPrice));
                        $('#grand_total').text(convertToRupiah(grandTotal));

                    }
                })

            })

        });

    </script>
    @endpush
