<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>POS UI - Product Cards in Center</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body, html {
      height: 100vh;
    }
    .sidebar {
      height: 100vh;
      overflow-y: auto;
      border-right: 1px solid #ddd;
    }
    .product-center {
      height: 100vh;
      overflow-y: auto;
      padding: 20px;
      border-right: 1px solid #ddd;
    }
    .cart-sidebar {
      height: 100vh;
      overflow-y: auto;
      padding: 20px;
      background: #f8f9fa;
    }
    .category-list button {
      width: 100%;
      margin-bottom: 10px;
    }
    .card-img-top {
      height: 150px;
      object-fit: contain;
    }
  </style>
</head>
<body>
 <div style="display: flex;">
    {{-- LEFT: Categories --}}
    <div style="width: 20%; padding: 10px; border-right: 1px solid #ccc;">
        <h4>Categories</h4>
        <ul>
            @foreach ($categories as $cat)
                <li>
                    <a href="{{ route('pos.list', ['category' => $cat]) }}">{{ $cat }}</a>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- CENTER: Products --}}
    <div style="width: 50%; padding: 10px;">
        <h4>Products @if($category) ({{ $category }}) @endif</h4>
        <div style="display: flex; flex-wrap: wrap; gap: 15px;">
            @foreach ($products as $product)
                <div style="border: 1px solid #ccc; padding: 10px; width: 45%;">
                    <img src="{{ asset('storage/' . $product->picture) }}" alt="{{ $product->name }}" width="100%">
                    <h5>{{ $product->name }}</h5>
                    <p>{{ $product->description }}</p>
                    <strong>${{ number_format($product->price, 2) }}</strong>
                    <form action="{{ route('pos.addToCart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <button type="submit">Add to Cart</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

    {{-- RIGHT: Cart --}}
    <div style="width: 30%; padding: 10px; border-left: 1px solid #ccc;">
        <h4>Shopping Cart</h4>
        @forelse ($cart as $id => $item)
            <div style="margin-bottom: 10px; border-bottom: 1px solid #eee;">
                <img src="{{ asset('storage/' . $item['picture']) }}" width="50">
                <strong>{{ $item['name'] }}</strong><br>
                Quantity: {{ $item['quantity'] }}<br>
                Price: ${{ number_format($item['price'], 2) }}<br>
                <form action="{{ route('pos.removeFromCart') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}">
                    <button type="submit">Remove</button>
                </form>
            </div>
        @empty
            <p>No items in cart.</p>
        @endforelse
    </div>
</div>
</body>
</html>
