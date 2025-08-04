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
    <title>Inventory List</title>
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
              <h4 class="py-3 mb-4"><span class="text-muted fw-light">Inventory /</span> Inventory List</h4>

              <!-- Inventory List Widget -->
              <div class="card mb-4">
                <div class="card-widget-separator-wrapper">
                  <div class="card-body card-widget-separator">
                    <div class="row gy-4 gy-sm-1">
                      <div class="col-sm-6 col-lg-3">
                        <div
                          class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                          <div>
                            <h6 class="mb-2">Sample Total</h6>
                            <h4 class="mb-2">$5,345.43</h4>
                            <p class="mb-0">
                              <span class="text-muted me-2">5k orders</span
                              ><span class="badge bg-label-success">+5.7%</span>
                            </p>
                          </div>
                          <div class="avatar me-sm-4">
                            <span class="avatar-initial rounded bg-label-secondary">
                              <i class="bx bx-store-alt bx-sm"></i>
                            </span>
                          </div>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none me-4" />
                      </div>
                      <div class="col-sm-6 col-lg-3">
                        <div
                          class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                          <div>
                            <h6 class="mb-2">Sample Total</h6>
                            <h4 class="mb-2">$674,347.12</h4>
                            <p class="mb-0">
                              <span class="text-muted me-2">21k orders</span
                              ><span class="badge bg-label-success">+12.4%</span>
                            </p>
                          </div>
                          <div class="avatar me-lg-4">
                            <span class="avatar-initial rounded bg-label-secondary">
                              <i class="bx bx-laptop bx-sm"></i>
                            </span>
                          </div>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none" />
                      </div>
                      <div class="col-sm-6 col-lg-3">
                        <div
                          class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                          <div>
                            <h6 class="mb-2">Sample Total</h6>
                            <h4 class="mb-2">$14,235.12</h4>
                            <p class="mb-0 text-muted">6k orders</p>
                          </div>
                          <div class="avatar me-sm-4">
                            <span class="avatar-initial rounded bg-label-secondary">
                              <i class="bx bx-gift bx-sm"></i>
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 col-lg-3">
                        <div class="d-flex justify-content-between align-items-start">
                          <div>
                            <h6 class="mb-2">Sample Total</h6>
                            <h4 class="mb-2">$8,345.23</h4>
                            <p class="mb-0">
                              <span class="text-muted me-2">150 orders</span
                              ><span class="badge bg-label-danger">-3.5%</span>
                            </p>
                          </div>
                          <div class="avatar">
                            <span class="avatar-initial rounded bg-label-secondary">
                              <i class="bx bx-wallet bx-sm"></i>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                <!-- Inventory List Table -->
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title m-0">Inventory List</h5>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addInventoryModal">
                            <i class="bx bx-plus"></i> Add Inventory
                        </button>
                        </div>
                    </div>
                    <div class="card-datatable table-responsive">
                        <table class="datatables table border-top">
                            <thead>
                                <tr>
                                <th>#</th>
                                <th>Item Name</th>
                                <th>Unit Of Measure</th>
                                <th>Quantity</th>
                                <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventories as $inventory)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $inventory->name }}</td>
                                    <td>{{ $inventory->uom->name ?? 'N/A' }}</td>
                                    <td>{{ $inventory->quantity }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editInventoryModal{{ $inventory->id }}">
                                        Edit
                                    </button>
                                    <form class="delete-inventory-form" data-id="{{ $inventory->id }}" action="{{ route('inventories.destroy', $inventory->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- / Content -->
            <!-- Add Inventory Modal -->
            <div class="modal fade" id="addInventoryModal" tabindex="-1" aria-labelledby="addInventoryModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <form action="{{ route('inventories.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                    <h5 class="modal-title" id="addInventoryModalLabel">Add Inventory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Item Name</label>
                        <input type="text" name="name" id="name" class="form-control" required min="0">
                    </div>

                    <!-- UOM -->
                    <div class="mb-3">
                        <label for="uom_id" class="form-label">Unit of Measure</label>
                        <select name="uom_id" id="uom_id" class="form-select">
                        <option value="" selected>None</option>
                        @foreach ($uoms as $uom)
                            <option value="{{ $uom->id }}">{{ $uom->name }}</option>
                        @endforeach
                        </select>
                    </div>

                    <!-- Quantity -->
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" required min="0">
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save Inventory</button>
                    </div>
                </form>
                </div>
            </div>
            </div>

            <!-- Edit Inventory Modal -->
            @foreach ($inventories as $inventory)
                <div class="modal fade" id="editInventoryModal{{ $inventory->id }}" tabindex="-1" aria-labelledby="editInventoryModalLabel{{ $inventory->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('inventories.update', $inventory->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="editInventoryModalLabel{{ $inventory->id }}">Edit Inventory</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <div class="mb-3">
                            <label for="product_id{{ $inventory->id }}" class="form-label">Product</label>
                            <select name="product_id" class="form-control" required>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{ $product->id == $inventory->product_id ? 'selected' : '' }}>
                                {{ $product->name }}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="uom_id{{ $inventory->id }}" class="form-label">UOM</label>
                            <select name="uom_id" class="form-control">
                            <option value="">None</option>
                            @foreach ($uoms as $uom)
                                <option value="{{ $uom->id }}" {{ $uom->id == $inventory->uom_id ? 'selected' : '' }}>
                                {{ $uom->name }}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="quantity{{ $inventory->id }}" class="form-label">Quantity</label>
                            <input type="number" name="quantity" class="form-control" value="{{ $inventory->quantity }}" required>
                        </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                    </form>
                </div>
                </div>
            @endforeach

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
            $('.delete-inventory-form button').on('click', function (e) {
                e.preventDefault();
                let form = $(this).closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
  </body>
</html>
