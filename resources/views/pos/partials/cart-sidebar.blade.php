<div>
  <h4>Shopping Cart</h4>
  @forelse ($cart as $id => $item)
    <div class="cart-item d-flex align-items-start">
      <div class="flex-grow-1">
        @if($item['picture'])
            <img src="{{ asset('storage/' . $item['picture']) }}" class="me-2" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
        @else
            <div class="bg-light me-2" style="width: 60px; height: 60px; display: flex; align-items:center; justify-content:center; border-radius:4px;">
            No Image
            </div>
        @endif
        <strong>{{ $item['name'] }}</strong><br>
        <small>Price: ₱{{ number_format($item['price'], 2) }}</small><br>
        <small>Subtotal: ₱{{ number_format($item['price'] * $item['quantity'], 2) }}</small>

        {{-- Quantity Controls --}}
        <div class="input-group input-group-sm mt-2 mb-1" style="width: 120px;">
          <form class="update-cart-form d-flex" data-id="{{ $id }}">
            @csrf
            <input type="hidden" name="id" value="{{ $id }}">
            <button type="button" class="btn btn-outline-secondary btn-decrease" data-action="decrease">-</button>
            <input type="text" name="quantity" value="{{ $item['quantity'] }}" class="form-control text-center" readonly>
            <button type="button" class="btn btn-outline-secondary btn-increase" data-action="increase">+</button>
          </form>
        </div>

        <form class="remove-from-cart-form" data-id="{{ $id }}">
          @csrf
          <input type="hidden" name="id" value="{{ $id }}">
          <button type="button" class="btn btn-sm btn-danger btn-remove">Remove</button>
        </form>
      </div>
    </div>
  @empty
    <p>No items in cart.</p>
  @endforelse
</div>

@if(count($cart))
  <div class="border-top pt-3 mt-3">
    @php
      $total = 0;
      foreach ($cart as $item) {
          $total += $item['price'] * $item['quantity'];
      }
    @endphp
    <h5>Total: ₱{{ number_format($total, 2) }}</h5>
        <form id="checkout-form" action="{{ route('pos.checkout') }}" method="POST">
        @csrf
            <button type="button" id="checkout-btn" class="btn btn-success w-100 mt-2">Checkout</button>
        </form>
  </div>
@endif
