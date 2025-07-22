<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>POS UI - Product Cards in Center</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <style>
    body {
    height: 100vh;
    background: linear-gradient(135deg, #3e2f23 0%, #a9745b 100%);
    background-attachment: fixed;
    font-family: 'Segoe UI', sans-serif;
    color: #fff;
    }

    .category-sidebar {
    background: rgba(62, 47, 35, 0.25); /* semi-transparent brown */
    border-right: 1px solid rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    padding: 20px;
    border-radius: 16px 0 0 16px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
    color: #f5e8dc;
    }

    .category-sidebar a {
    display: block;
    margin-bottom: 10px;
    text-decoration: none;
    padding: 10px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 8px;
    color: #f5e8dc;
    transition: background-color 0.3s ease, color 0.3s ease;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    backdrop-filter: blur(4px);
    }

    .category-sidebar a:hover,
    .category-sidebar a.active {
    background-color: rgba(255, 255, 255, 0.35);
    color: #3e2f23;
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    }
    /* Product */
        .product-card {
        background: rgba(255, 255, 255, 0.08);
        border-radius: 16px;
        padding: 15px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: 0.3s ease-in-out;
        overflow: hidden;
        color: #f5f5f5;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.4);
        }
        .product-card:hover {
        transform: scale(1.02);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
        }
        /* Style for product name and price */
        .product-card h5,
        .product-card p,
        .product-card small,
        .product-card .price {
        margin: 0;
        color: #fff !important;
        font-weight: 500;
        }
        .product-card .btn {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.4);
        color: #ffffff;
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
        transition: all 0.3s ease-in-out;
        }
        .product-card .btn:hover {
        background: rgba(255, 255, 255, 0.35);
        color: #2e1c14;
        font-weight: 600;
        }
        .product-img {
        height: 300px;
        width: 100%;
        object-fit: cover;
        border-radius: 10px;
        display: block;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
    /* Product */
        /* Cart Sidebar Glassmorphism Coffee Theme */
        .cart-sidebar {
        background: rgba(62, 47, 35, 0.25); /* semi-transparent mocha brown */
        border-left: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        padding: 20px;
        border-radius: 0 16px 16px 0;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
        color: #f5e8dc;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        }
        /* Cart Item */
        .cart-item {
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        padding-bottom: 10px;
        margin-bottom: 15px;
        color: #f5e8dc;
        transition: background-color 0.3s ease;
        border-radius: 8px;
        padding: 12px;
        background: rgba(255, 255, 255, 0.1);
        box-shadow: inset 0 0 5px rgba(255, 255, 255, 0.1);
        }
        .cart-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        }
        .cart-item:hover {
        background: rgba(255, 255, 255, 0.25);
        box-shadow: inset 0 0 10px rgba(255, 255, 255, 0.2);
        color: #3e2f23;
        }
        /* Quantity Control Buttons (- / +) */
        .cart-sidebar .btn-outline-secondary {
        background: rgba(111, 78, 55, 0.15); /* mocha translucent */
        border-color: rgba(255, 255, 255, 0.5);
        color: #ffffff; /* mocha brown */
        font-weight: bold;
        padding: 0 10px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(111, 78, 55, 0.3);
        border-radius: 6px;
        }
        .cart-sidebar .btn-outline-secondary:hover,
        .cart-sidebar .btn-outline-secondary:focus {
        background: #a9745b; /* caramel */
        border-color: #a9745b;
        color: #fff;
        box-shadow: 0 4px 10px rgba(169, 116, 91, 0.7);
        outline: none;
        }
        /* Quantity Input */
        .cart-sidebar .input-group-sm .form-control {
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(111, 78, 55, 0.4);
        color: #f5e8dc;
        font-weight: 600;
        text-align: center;
        border-radius: 6px;
        pointer-events: none; /* readonly */
        box-shadow: inset 0 0 5px rgba(255, 255, 255, 0.1);
        }
        /* Remove Button */
        .cart-sidebar .btn-danger {
        background: #6f4e37;
        border: none;
        color: #fff;
        font-weight: 600;
        padding: 3px 8px;
        border-radius: 6px;
        box-shadow: 0 3px 10px rgba(111, 78, 55, 0.6);
        transition: background-color 0.3s ease;
        }
        .cart-sidebar .btn-danger:hover {
        background: #a9745b;
        color: #2e1c14;
        box-shadow: 0 5px 15px rgba(169, 116, 91, 0.9);
        }
        /* Checkout Button */
        #checkout-btn {
        background-color: #6f4e37; /* mocha */
        border: none;
        color: #fff !important;
        font-weight: 700;
        padding: 10px 0;
        border-radius: 8px;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 12px rgba(111, 78, 55, 0.6);
        }
        #checkout-btn:hover {
        background-color: #a9745b; /* caramel */
        color: #2e1c14 !important;
        box-shadow: 0 6px 18px rgba(169, 116, 91, 0.9);
        cursor: pointer;
        }
    /* Custom Add to Cart Button */
    .btn-custom {
    background: rgba(255, 255, 255, 0.2);
    color: #fff;
    border: 1px solid rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(5px);
    transition: all 0.3s ease;
    }
    .btn-custom:hover {
    background: rgba(255, 255, 255, 0.35);
    color: #000;
    font-weight: 600;
    }

    /* Responsive */
    /* Responsive for tablets and smaller screens */
    @media (max-width: 991.98px) {
        body {
            font-size: 10px;
        }
        .category-sidebar {
            padding: 15px;
            border-radius: 12px 0 0 12px;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.12);
        }
        .cart-sidebar {
            padding: 15px;
            border-radius: 0 12px 12px 0;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.12);
            height: auto; /* Let cart height adjust */
            overflow-y: auto;
        }

        .product-card {
            padding: 12px;
            height: 210px;
        }
      .product-card p {
            display: none;
        }
        .product-card .price {
            display: block;
            font-size: 15px !important;

        }
       .fa-mug-hot:before {
            display: none;
        }
        .product-card h5 {
            font-size: 15px;
        }
        .product-img {
            height: 100px;
        }
        .product-card .btn {
           font-size: 10px;
        }
    }

    /* Responsive for phones */
    @media (max-width: 575.98px) {
    body {
        font-size: 13px;
    }

    /* Stack sidebars and content vertically */
    .category-sidebar,
    .cart-sidebar {
        width: 100% !important;
        border: none !important;
        border-radius: 12px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        padding: 12px;
        margin-bottom: 20px;
        backdrop-filter: blur(15px);
    }

    /* Adjust layout container to vertical */
    .row {
        flex-direction: column !important;
    }

    /* Product card full width */
    .product-card {
        width: 100%;
        margin-bottom: 20px;
    }

    .product-img {
        height: 180px;
    }

    /* Input group width for quantity controls */
    .input-group.input-group-sm {
        width: 100% !important;
    }

    /* Cart sidebar scroll adjustments */
    .cart-sidebar {
        max-height: none;
        overflow-y: visible;
    }

    /* Button full width on small devices */
    #checkout-btn,
    .btn-custom,
    .btn-danger,
    .btn-outline-secondary {
        width: 100%;
    }
    }

  </style>
</head>
<body>
  <div class="d-flex h-100">
    {{-- LEFT: Categories --}}
    <div class="category-sidebar col-2">
      <h4>Categories</h4>
      <a href="{{ route('pos.list') }}" class="{{ empty($categoryId) ? 'active' : '' }}">All Categories</a>
      @foreach ($categories as $cat)
        <a href="{{ route('pos.list', ['category' => $cat->id]) }}"
           class="{{ (int)($categoryId ?? 0) === $cat->id ? 'active' : '' }}">
           {{ $cat->name }}
        </a>
      @endforeach
    </div>

    {{-- CENTER: Products --}}
    <div class="col-7 p-4 overflow-auto">
      <h5 class="mb-4">
        Products
        @if($categoryId)
          <small class="text-muted">({{ $categories->firstWhere('id', $categoryId)?->name ?? 'Category' }})</small>
        @endif
      </h5>
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
              <h5><i class="fas fa-mug-hot me-1"></i>{{ $product->name }}</h5>
              <p class="text-muted small">{{ $product->description }}</p>
              <p class="price" style="color: #ffffff; font-size: 20px;">
                <strong>₱{{ number_format($product->price, 2) }}</strong>
            </p>
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
    <div class="cart-sidebar col-3 overflow-auto d-flex flex-column justify-content-between">
      <div>
        <h4>Shopping Cart</h4>
        @forelse ($cart as $id => $item)
          <div class="cart-item d-flex align-items-start">
            @if($item['picture'])
              <img src="{{ asset('storage/' . $item['picture']) }}" class="me-2" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
            @else
              <div class="bg-light me-2" style="width: 60px; height: 60px; display: flex; align-items:center; justify-content:center; border-radius:4px;">
                No Image
              </div>
            @endif
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
                <button type="button" id="checkout-btn" class="btn btn-success w-100 mt-2">Checkout</button>
            </form>
        </div>
      @endif
    </div>
  </div>

</body>
    <!-- jQuery (add this if not already included) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    $(document).ready(function () {
        $('#checkout-btn').on('click', function () {
        let $btn = $(this); // reference to the button
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to proceed with checkout?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, checkout',
            cancelButtonText: 'No, cancel'
        }).then((result) => {
            if (result.isConfirmed) {
            // Disable the button and show spinner text
            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Processing...');
            // Submit the form
            $btn.closest('form').submit();
            }
        });
        });
    });
    </script>

</html>
