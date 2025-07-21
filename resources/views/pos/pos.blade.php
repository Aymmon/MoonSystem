<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>POS UI - Product Cards in Center</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      height: 100vh;
      background-color: #f2f4f7;
    }
    .category-sidebar {
      background-color: #fff;
      border-right: 1px solid #ddd;
      padding: 20px;
    }
    .category-sidebar a {
      display: block;
      margin-bottom: 10px;
      text-decoration: none;
      padding: 10px;
      background: #f8f9fa;
      border-radius: 5px;
      color: #333;
      transition: 0.2s;
    }
    .category-sidebar a:hover {
      background-color: #007bff;
      color: #fff;
    }
    .product-card {
      background: #fff;
      border-radius: 10px;
      padding: 15px;
      box-shadow: 0 0 8px rgba(0,0,0,0.05);
      transition: 0.2s ease-in-out;
    }
    .product-card:hover {
      transform: scale(1.02);
      box-shadow: 0 0 12px rgba(0,0,0,0.1);
    }
    .product-img {
      height: 150px;
      object-fit: contain;
      border-radius: 5px;
    }
    .cart-sidebar {
      background-color: #fff;
      border-left: 1px solid #ddd;
      padding: 20px;
    }
    .cart-item {
      border-bottom: 1px solid #eee;
      padding-bottom: 10px;
      margin-bottom: 15px;
    }
    .btn-custom {
      background-color: #28a745;
      color: #fff;
      border: none;
      padding: 6px 12px;
      border-radius: 5px;
      transition: background 0.3s;
    }
    .btn-custom:hover {
      background-color: #218838;
    }
  </style>
</head>
<body>
  <div class="d-flex h-100">
    {{-- LEFT: Categories --}}
    <div class="category-sidebar col-2">
      <h4>Categories</h4>
        @foreach ($categories as $cat)
        <a href="{{ route('pos.list', ['category' => $cat->id]) }}">{{ $cat->name }}</a>
        @endforeach
    </div>

    {{-- CENTER: Products --}}
    <div class="col-6 p-4 overflow-auto">
      <h4 class="mb-4">Products @if($category) <small class="text-muted">({{ $category }})</small> @endif</h4>
      <div class="row g-3">
        @foreach ($products as $product)
          <div class="col-6">
            <div class="product-card">
              <img src="{{ asset('storage/' . $product->picture) }}" alt="{{ $product->name }}" class="img-fluid product-img mb-2 w-100">
              <h5>{{ $product->name }}</h5>
              <p class="text-muted small">{{ $product->description }}</p>
              <p><strong>₱{{ number_format($product->price, 2) }}</strong></p>
              <form action="{{ route('pos.addToCart') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">
                <button type="submit" class="btn btn-custom w-100">Add to Cart</button>
              </form>
            </div>
          </div>
        @endforeach
      </div>
    </div>

    {{-- RIGHT: Cart --}}
    <div class="cart-sidebar col-4 overflow-auto d-flex flex-column justify-content-between">
    <div>
        <h4>Shopping Cart</h4>
        @forelse ($cart as $id => $item)
        <div class="cart-item d-flex align-items-start">
            <img src="{{ asset('storage/' . $item['picture']) }}" class="me-2" style="width: 60px; height: 60px; object-fit: cover;">
            <div class="flex-grow-1">
            <strong>{{ $item['name'] }}</strong><br>
            <small>Price: ₱{{ number_format($item['price'], 2) }}</small><br>
            <small>Subtotal: ₱{{ number_format($item['price'] * $item['quantity'], 2) }}</small>

            {{-- Quantity Controls --}}
            <div class="input-group input-group-sm mt-2 mb-1" style="width: 120px;">
                <form action="{{ route('pos.updateCart') }}" method="POST" class="d-flex">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                <button type="submit" name="action" value="decrease" class="btn btn-outline-secondary">-</button>
                <input type="text" name="quantity" value="{{ $item['quantity'] }}" class="form-control text-center" readonly>
                <button type="submit" name="action" value="increase" class="btn btn-outline-secondary">+</button>
                </form>
            </div>

            <form action="{{ route('pos.removeFromCart') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                <button type="submit" class="btn btn-sm btn-danger">Remove</button>
            </form>
            </div>
        </div>
        @empty
        <p>No items in cart.</p>
        @endforelse
    </div>

    {{-- Cart Total --}}
    @if(count($cart))
        <div class="border-top pt-3 mt-3">
        @php
            $total = 0;
            foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
            }
        @endphp
        <h5>Total: ₱{{ number_format($total, 2) }}</h5>
            <form action="{{ route('pos.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success w-100 mt-2">Checkout</button>
            </form>
        </div>
    @endif
    </div>
  </div>
</body>
</html>
