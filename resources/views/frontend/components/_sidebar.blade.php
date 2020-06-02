<ul class="list-group">
  @foreach($categories as $category)
  <a href="{{ route('front.product.byCategory',$category) }}">
    <li class="list-group-item d-flex justify-content-between align-items-center">
      {{ $category->name }}
      <span class="badge badge-danger badge-pill">{{ $category->products->count() }}</span>
    </li>
  </a>
  @endforeach
</ul>
