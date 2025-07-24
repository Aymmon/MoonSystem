<style>
    .receipt-style {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 0.95rem;
    color: #3a3a3a;
    padding: 1rem;
    }

    .receipt-style h4 {
    font-weight: 700;
    margin-bottom: 0.25rem;
    }

    .receipt-style p {
    margin-bottom: 0.5rem;
    }

    .receipt-style table {
    width: 100%;
    margin-top: 1rem;
    }

    .receipt-style th,
    .receipt-style td {
    padding: 0.25rem 0.5rem;
    vertical-align: middle;
    }

    .receipt-style th {
    border-bottom: 1px solid #ddd;
    }

    .receipt-style td {
    border-bottom: 1px solid #eee;
    }

    .receipt-style .d-flex.justify-content-between {
    margin-top: 0.75rem;
    font-size: 1rem;
    }

    @media (max-width: 576px) {
        .receipt-style {
            font-size: 0.85rem;
            padding: 0.5rem;
        }
        .receipt-style .d-flex.justify-content-between {
            flex-direction: column;
            gap: 0.25rem;
        }
    }

</style>
<div class="modal-header">
  <h5 class="modal-title">Receipt</h5>
  <button type="button" class="btn btn-primary btn-sm ms-3" id="print-receipt-btn">Print</button>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body receipt-style">
    <div class="text-center">
        <h4>Astral Coffee</h4>
        <p>Imus, Cavite</p>
        <hr>
        <p><strong>Transaction ID:</strong> {{ $transaction->id }}</p>
        {{ \Carbon\Carbon::parse($transaction->created_at)->format('F d, Y h:i A') }}
    </div>

    <table class="table table-borderless">
        <thead>
            <tr>
                <th>Item</th>
                <th class="text-end">Qty</th>
                <th class="text-end">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaction->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td class="text-end">{{ $item->quantity }}</td>
                    <td class="text-end">₱{{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr>
  <div class="d-flex justify-content-between mt-2">
      <strong>Total:</strong>
      <strong>₱{{ number_format($transaction->total_amount, 2) }}</strong>
  </div>
  <div class="d-flex justify-content-between mt-1">
      <strong>Received Payment:</strong>
      <strong>₱{{ number_format($transaction->received_amount, 2) }}</strong>
  </div>
  <div class="d-flex justify-content-between mt-1">
      <strong>Change:</strong>
      <strong>₱{{ number_format($transaction->change_amount, 2) }}</strong>
  </div>
</div>
