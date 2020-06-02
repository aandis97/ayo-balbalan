<div class="col-md-2">
    <div class="card">
        <img class="card-img-top" src="{{ asset($product->getImage()) }}" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title"> <a href="{{ route('front.product.show', $product) }}"> {{ $product->name }}</a></h5>
            <label for="label">Rp. {{ number_format($product->price, 0,",",".") }}</label>
            <p class="card-text">{{ $product->description }} </p>
            <a href="{{ route('cart.add.item',$product) }}" class="btn btn-info">Add to Cart</a>
        </div>
    </div>
</div>
