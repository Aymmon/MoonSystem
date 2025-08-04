<!doctype html>
<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Order List</title>
    <meta name="description" content="" />
    @include('components.head')

    <style>
        .datatables th,
        .datatables td {
            min-width: 120px;
            white-space: nowrap;
            text-align: center !important;
        }
        .receipt-content {
            font-family: 'Courier New', Courier, monospace;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            white-space: pre-wrap; /* preserve formatting */
            color: #333;
            max-height: 400px;
            overflow-y: auto;
        }

    </style>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
            @include('components.menu')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
            @include('components.navbar')
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Analytics Card -->
              <div class="row g-4 mb-4">
                <div class="col-sm-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>Total Sales</span>
                          <div class="d-flex align-items-end mt-2">
                            <h4 class="mb-0 me-2">₱{{ number_format($todaySalesTotal, 2) }}</h4>
                            <small class="text-success">({{ $totalQuantitySold }} sold)</small>
                          </div>
                          <p class="mb-0">Today Sales</p>
                        </div>
                        <div class="avatar">
                        <span class="avatar-initial rounded bg-label-primary">
                            <i class="bx bx-money bx-sm"></i>
                        </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>Top-Selling Product</span>
                          <div class="d-flex align-items-end mt-2">
                            <h4 class="mb-0 me-2">{{ $topSelling?->product_name ?? '₱0.00' }}</h4>
                            <small class="text-success">({{ $topSelling?->total_quantity ?? 0 }} sold)</small>
                          </div>
                          <p class="mb-0">Today analytics</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-danger">
                            <i class="bx bx-coffee bx-sm"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>7 Days Sales</span>
                          <div class="d-flex align-items-end mt-2">
                            <h4 class="mb-0 me-2">{{ number_format($weeklySalesTotal, 2) }}</h4>
                            <small class="text-success">({{ $weeklyQuantitySold ?? 0 }} sold)</small>
                          </div>
                          <p class="mb-0">1 week analytics</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-success">
                            <i class="bx bx-calendar bx-sm"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                          <span>1 Month Sales</span>
                          <div class="d-flex align-items-end mt-2">
                            <h4 class="mb-0 me-2">{{ number_format($monthlySalesTotal, 2) }}</h4>
                            <small class="text-success">({{ $monthlyQuantitySold ?? 0 }} sold)</small>
                          </div>
                          <p class="mb-0">1 Month analytics</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-warning">
                            <i class="bx bx-calendar bx-sm"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Order List Table -->
              <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title m-0">Order List</h5>
                    </div>
                </div>
                <div class="card-datatable table-responsive">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('export.transactions') }}" class="btn btn-success me-3">
                            <i class="bx bx-download"></i> Export to Excel
                        </a>
                    </div>
                    <table class="datatables table border-top">
                        <thead>
                            <tr>
                                <th>Transaction #</th>
                                <th>Total Amount</th>
                                <th>Recieved Amount</th>
                                <th>Change Amount</th>
                                <th>Status</th>
                                <th>Transaction Date & Time</th>
                                <th>Items</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allTransactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->transaction_number }}</td>
                                    <td>₱{{ number_format($transaction->total_amount, 2) }}</td>
                                    <td>₱{{ number_format($transaction->received_amount, 2) }}</td>
                                    <td>₱{{ number_format($transaction->change_amount, 2) }}</td>
                                    <td>
                                        @if($transaction->status === 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @else
                                            <span class="badge bg-danger">Cancelled</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('F d, Y - h:i A') }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($transaction->items as $item)
                                                <li>{{ $item->product->name ?? 'N/A' }} x{{ $item->quantity }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info view-receipt-btn" data-id="{{ $transaction->id }}">View</button>
                                        @if($transaction->status !== 'cancelled')
                                            <form action="{{ route('transactions.cancel', $transaction->id) }}" method="POST" class="cancel-form" style="display:inline;">
                                                @csrf
                                                @method('PUT')
                                                <button type="button" class="btn btn-sm btn-danger cancel-btn" data-id="{{ $transaction->id }}">Cancel</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
            <!-- / Content -->
            <!-- Receipt Modal -->
            <div class="modal fade" id="receiptModal" tabindex="-1" aria-labelledby="receiptModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content" id="receipt-content">
                <!-- Content will be loaded via AJAX -->
                </div>
            </div>
            </div>
            <!-- Footer -->
            @include('components.footer')
            <!-- / Footer -->
            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>
      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->
    @include('components.scripts')
    <script>
        $(document).ready(function () {
            $('.datatables').DataTable({
                paging: true,
                searching: true,
                ordering: false
            });

            $(document).on('click', '.cancel-btn', function(e) {
                e.preventDefault();
                const button = $(this);
                const form = button.closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You are about to cancel this transaction.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, cancel it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            document.addEventListener('click', function (e) {
                if (e.target.classList.contains('view-receipt-btn')) {
                    const id = e.target.getAttribute('data-id');

                    fetch(`/transactions/${id}`)
                        .then(response => response.text())
                        .then(html => {
                            document.querySelector('#receipt-content').innerHTML = html;
                            new bootstrap.Modal(document.getElementById('receiptModal')).show();
                        })
                        .catch(error => console.error('Error:', error));
                }
            });

            $(document).on('click', '#print-receipt-btn', function () {
                var receiptContent = $('.modal-body.receipt-style').html();

                var printWindow = window.open('', '', 'height=600,width=400');

                printWindow.document.write(`
                <html>
                    <head>
                    <title>Print Receipt</title>
                    <style>
                        body {
                        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                        font-size: 14px;
                        padding: 20px;
                        }
                        table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-top: 1rem;
                        }
                        th, td {
                        border: 1px solid #333;
                        padding: 8px;
                        text-align: left;
                        }
                        th {
                        background-color: #f0f0f0;
                        }
                        .text-end {
                        text-align: right;
                        }
                        h4, strong {
                        margin: 0;
                        }
                        hr {
                        margin: 15px 0;
                        }
                    </style>
                    </head>
                    <body>
                    ${receiptContent}
                    </body>
                </html>
                `);

                printWindow.document.close();
                printWindow.focus();
                printWindow.print();
                printWindow.close();
            });

        });
    </script>
  </body>
</html>
