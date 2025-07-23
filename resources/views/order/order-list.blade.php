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
                            <h4 class="mb-0 me-2">{{ $topSelling->product_name }}</h4>
                            <small class="text-success">({{ $topSelling->total_quantity }} sold)</small>
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
                          <span>Active Users</span>
                          <div class="d-flex align-items-end mt-2">
                            <h4 class="mb-0 me-2">19,860</h4>
                            <small class="text-danger">(-14%)</small>
                          </div>
                          <p class="mb-0">Last week analytics</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-success">
                            <i class="bx bx-group bx-sm"></i>
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
                          <span>Pending Users</span>
                          <div class="d-flex align-items-end mt-2">
                            <h4 class="mb-0 me-2">237</h4>
                            <small class="text-success">(+42%)</small>
                          </div>
                          <p class="mb-0">Last week analytics</p>
                        </div>
                        <div class="avatar">
                          <span class="avatar-initial rounded bg-label-warning">
                            <i class="bx bx-user-voice bx-sm"></i>
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
                                <th>Status</th>
                                <th>Transaction Date</th>
                                <th>Transaction Time</th>
                                <th>Items</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->transaction_number }}</td>
                                    <td>{{ number_format($transaction->total_amount, 2) }}</td>
                                    <td>{{ $transaction->status }}</td>
                                    <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('m-d-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('h:i A') }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($transaction->items as $item)
                                                <li>{{ $item->product->name ?? 'N/A' }} x{{ $item->quantity }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
            <!-- / Content -->
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
                "paging": true,
                "searching": true,
                "ordering": false
            });
        });
    </script>
  </body>
</html>
