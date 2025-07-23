<div class="row g-3">
  @foreach ($products as $product)
    <div class="col-4">
      <div class="product-card">
        @if($product->picture)
          <img src="{{ asset('storage/' . $product->picture) }}" alt="{{ $product->name }}" class="img-fluid product-img mb-2">
        @else
          <div class="bg-light d-flex align-items-center justify-content-center mb-2" style="height: 150px; border-radius: 5px;">
            No Image
          </div>
        @endif
        <h5>{{ $product->name }}</h5>
        <p class="text-muted small">{{ $product->description }}</p>
        <p class="price" style="color: #ffffff; font-size: 20px;">
          <strong>₱{{ number_format($product->price, 2) }}</strong>
        </p>
        <button type="button" class="btn btn-custom w-100 add-to-cart" data-id="{{ $product->id }}">Add to Cart</button>
      </div>
    </div>
  @endforeach
</div>
