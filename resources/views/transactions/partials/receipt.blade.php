<style>
/* Thermal Receipt Style - 58mm optimized */
.receipt-style {
  font-family: 'Courier New', Courier, monospace !important;
  font-size: 9px !important;
  color: #000 !important;
  width: 58mm !important;
  padding: 0 !important;
  margin: 0 !important;
  line-height: 1.1 !important;
}

.receipt-style h2 {
  font-size: 11px !important;
  font-weight: bold;
  text-align: center;
  margin: 0 0 2px 0;
}

.receipt-style p {
  text-align: center;
  margin: 0;
  font-size: 9px !important;
}

.receipt-style hr.dotted {
  border: none;
  border-top: 1px dotted #000;
  margin: 3px 0;
}

.receipt-style .info {
  font-size: 8px !important;
  margin-bottom: 2px;
}

.receipt-style table {
  width: 100%;
  border-collapse: collapse;
  table-layout: fixed; /* keeps columns stable */
}

.receipt-style th,
.receipt-style td {
  font-size: 8px !important;
  padding: 0 !important;
  line-height: 1.1 !important;
  word-wrap: break-word; /* allow wrapping */
  white-space: normal !important; /* force wrap if needed */
}

.receipt-style th.name,
.receipt-style td.name {
  text-align: left;
  width: 60%; /* bigger space for product name */
}

.receipt-style th.qty,
.receipt-style td.qty {
  text-align: center;
  width: 15%;
}

.receipt-style th.price,
.receipt-style td.price {
  text-align: right;
  width: 25%;
}

.receipt-style .totals,
.receipt-style .small-totals {
  display: flex;
  justify-content: space-between;
  font-size: 9px !important;
  margin: 2px 0;
}

.receipt-style .thank-you {
  text-align: center;
  font-weight: bold;
  margin-top: 4px;
  font-size: 9px !important;
}

@media print {
  body * { visibility: hidden; }
  #receipt-content, #receipt-content * { visibility: visible; }
  #receipt-content {
    position: absolute;
    left: 0;
    top: 0;
    width: 58mm !important;
    font-family: 'Courier New', Courier, monospace !important;
    font-size: 9px !important;
    padding: 0 !important;
    margin: 0 !important;
    line-height: 1.1 !important;
  }
}

</style>

<!-- Modal -->
      <div class="modal-header">
        <h5 class="modal-title" id="receiptModalLabel">Receipt</h5>
        <button type="button" class="btn btn-primary btn-sm ms-3" id="print-receipt-btn">Print</button>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body receipt-style" id="receipt-content">
        <h2>Astra Cafe</h2>
        <p>Imus, Cavite</p>

        <hr class="dotted" />

        <div class="info">
          <span><strong>Transaction ID:</strong> {{ $transaction->id }}</span>
          <span>{{ \Carbon\Carbon::parse($transaction->created_at)->format('F d, Y h:i A') }}</span><br />
        </div>

        <hr class="dotted" />

        <table>
          <thead>
            <tr>
              <th>Name</th>
              <th class="qty">Qty</th>
              <th class="price">Price</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($transaction->items as $item)
            <tr>
              <td>{{ $item->product->name }}</td>
              <td class="qty">{{ $item->quantity }}</td>
              <td class="price">₱{{ number_format($item->price * $item->quantity, 2) }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <hr class="dotted" />

        <div class="totals">
          <div class="label">Total</div>
          <div>₱{{ number_format($transaction->total_amount, 2) }}</div>
        </div>

        <div class="small-totals">
          <div>Received Payment</div>
          <div>₱{{ number_format($transaction->received_amount, 2) }}</div>
        </div>

        <div class="small-totals">
          <div>Change</div>
          <div>₱{{ number_format($transaction->change_amount, 2) }}</div>
        </div>

        <hr class="dotted" />

        <div class="thank-you">THANK YOU!</div>
      </div>
