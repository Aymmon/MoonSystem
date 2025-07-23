<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>POS UI - Product Cards in Center</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}">

<style>
body {
height: 100vh;
background: linear-gradient(135deg, #3e2f23 0%, #a9745b 100%);
background-attachment: fixed;
font-family: 'Segoe UI', sans-serif;
color: #fff !important;
}
body h5{
color: #f5e8dc !important;
}
body h4{
color: #f5e8dc !important;
}
.category-sidebar {
background: rgba(62, 47, 35, 0.25); /* semi-transparent brown */
border-right: 1px solid rgba(255, 255, 255, 0.2);
backdrop-filter: blur(10px);
-webkit-backdrop-filter: blur(10px);
padding: 20px;
border-radius: 16px 0 0 16px;
box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
color: #f5e8dc !important;
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
.swal2-popup {
    background: rgba(255, 255, 255, 0.1) !important;
    backdrop-filter: blur(15px) saturate(180%) !important;
    -webkit-backdrop-filter: blur(15px) saturate(180%) !important;
    border: 1px solid rgba(255, 255, 255, 0.25) !important;
    border-radius: 16px !important;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2) !important;
    color: #fff !important;
}
.swal2-confirm {
    background-color: #a9745b !important;
    color: #fff !important;
    border: none !important;
    border-radius: 6px !important;
    padding: 8px 20px !important;
}
.swal2-cancel {
    background-color: transparent !important;
    color: #fff !important;
    border: 1px solid #fff !important;
    border-radius: 6px !important;
    padding: 8px 20px !important;
}
/* Responsive */
/* Responsive for tablets and smaller screens */
@media (min-width: 1024px) and (max-width: 1439px) {
    .product-card {
        padding: 12px;
        height: 260px;
    }
    .product-img {
        height: 120px;
    }
}

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

@media (max-width: 767px) {
  body {
    padding: 0;
    margin: 0;
  }
  .category-sidebar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    width: 100vw;
    height: auto;
    z-index: 1000;
    background: rgba(62, 47, 35, 0.95);
    border-radius: 0 0 16px 16px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.2);
    display: flex;
    flex-direction: row;
    align-items: center;
    padding: 8px 8px 8px 8px;
    overflow-x: auto;
    border-right: none;
    border-bottom: 1px solid rgba(255,255,255,0.15);
  }
  .category-sidebar h4 {
    display: none;
  }
  .category-sidebar a {
    margin: 0 6px 0 0;
    padding: 8px 14px;
    font-size: 13px;
    border-radius: 8px;
    white-space: nowrap;
    background: rgba(255,255,255,0.12);
  }
  .category-sidebar a:last-child {
    margin-right: 0;
  }
  .col-2 {
    display: none !important;
  }
  .col-7, .col-3, .cart-sidebar {
    width: 100vw !important;
    max-width: 100vw !important;
    flex: none !important;
    border-radius: 0 !important;
    margin: 0 !important;
    padding-left: 0 !important;
    padding-right: 0 !important;
  }
  .col-7 {
    margin-top: 60px !important; /* space for navbar */
    padding-top: 12px !important;
    padding-bottom: 0 !important;
  }
  .cart-sidebar {
    margin-top: 0 !important;
    padding-top: 12px !important;
    border-left: none !important;
    border-top: 1px solid rgba(255,255,255,0.15);
    border-radius: 0 0 16px 16px;
    box-shadow: none;
  }
  /* Stack products and cart */
  #product-list, .cart-sidebar {
    width: 100vw !important;
    max-width: 100vw !important;
  }
}
/* Responsive for phones */
</style>
</head>
<body>
        {{-- Toggle Button for Mobile --}}
<button id="toggle-category" class="btn btn-sm btn-outline-light d-md-none" style="position: fixed; top: 8px; left: 8px; z-index: 1100;">
  ☰ Categories
</button>
  <div class="d-flex h-100">
    {{-- LEFT: Categories --}}
    <div class="category-sidebar col-2">
        <h4>Categories</h4>
        <a href="#" class="category-link {{ empty($categoryId) ? 'active' : '' }}" data-id="">All Categories</a>
        @foreach ($categories as $cat)
            <a href="#" class="category-link {{ (int)($categoryId ?? 0) === $cat->id ? 'active' : '' }}"
            data-id="{{ $cat->id }}">
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
        <div id="product-list">
            @include('pos.partials.product-list', ['products' => $products])
        </div>
    </div>

    {{-- RIGHT: Cart --}}
    <div class="cart-sidebar col-3 overflow-auto d-flex flex-column justify-content-between" id="cart-sidebar">
        @include('pos.partials.cart-sidebar', ['cart' => $cart])
    </div>

  </div>
</body>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<!-- jQuery (add this if not already included) -->
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<!-- ✅ Load SweetAlert2 from local path -->
<script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>

<!-- Your custom script using Swal -->
<script>
  $(document).ready(function () {
    //sweet alert Jquery
    $(document).on('click', '#checkout-btn', function () {
        const $btn = $(this);
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
            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Processing...');
            // AJAX checkout
            $.ajax({
            url: $btn.closest('form').attr('action'),
            method: 'POST',
            data: $btn.closest('form').serialize(),
            success: function (res) {
                // If your controller returns JSON, handle it here
                Swal.fire('Success!', 'Checkout successful!', 'success');
                updateCartSidebar(); // Refresh cart
            },
            error: function (xhr) {
                let msg = 'Checkout failed.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                msg = xhr.responseJSON.message;
                }
                Swal.fire('Error', msg, 'error');
            },
            complete: function () {
                $btn.prop('disabled', false).html('Checkout');
            }
            });
        }
        });
    });

    $(document).on('click', '.category-link', function (e) {
      e.preventDefault();
      const categoryId = $(this).data('id');
      $.ajax({
        url: "{{ route('pos.list') }}",
        type: 'GET',
        data: {
          category: categoryId
        },
        success: function (response) {
          $('#product-list').html($(response).find('#product-list').html());
          // Optional: highlight selected category
          $('.category-link').removeClass('active');
          $(`.category-link[data-id="${categoryId}"]`).addClass('active');
        },
        error: function () {
          alert('Failed to load products.');
        }
      });
    });

    // Add to Cart (adjust selector based on your add button class)
  $(document).on('click', '.add-to-cart', function (e) {
    e.preventDefault();

    const productId = $(this).data('id');
    $.ajax({
      url: "{{ route('pos.addToCart') }}",
      method: 'POST',
      data: {
        _token: '{{ csrf_token() }}',
        id: productId
      },
      success: function (res) {
        updateCartSidebar(res);
      },
      error: function () {
        alert('Failed to add to cart.');
      }
    });
  });

  // Update Cart Quantity
  $(document).on('click', '.btn-increase, .btn-decrease', function (e) {
    e.preventDefault();

    const form = $(this).closest('.update-cart-form');
    const productId = form.data('id');
    const action = $(this).data('action');

    $.ajax({
      url: "{{ route('pos.updateCart') }}",
      method: 'POST',
      data: {
        _token: '{{ csrf_token() }}',
        id: productId,
        action: action
      },
      success: function (res) {
        updateCartSidebar(res);
      },
      error: function () {
        alert('Failed to update cart.');
      }
    });
  });

  // Remove from Cart
  $(document).on('click', '.btn-remove', function (e) {
    e.preventDefault();

    const form = $(this).closest('.remove-from-cart-form');
    const productId = form.data('id');

    $.ajax({
      url: "{{ route('pos.removeFromCart') }}",
      method: 'POST',
      data: {
        _token: '{{ csrf_token() }}',
        id: productId
      },
      success: function (res) {
        updateCartSidebar(res);
      },
      error: function () {
        alert('Failed to remove item.');
      }
    });
  });

  // Update cart sidebar HTML
  function updateCartSidebar(data) {
    // Build cart HTML dynamically or make an AJAX request to get the partial view HTML
    // Easiest: make a small endpoint to return the cart partial view and replace #cart-sidebar

    $.ajax({
      url: "{{ route('pos.cartPartial') }}", // You need to create this route & controller method
      method: 'GET',
      success: function (html) {
        $('#cart-sidebar').html(html);
      }
    });
  }
  });
</script>

</html>
