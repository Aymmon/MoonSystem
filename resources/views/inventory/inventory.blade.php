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
                            <th>Item Name</th>
                            <th>Unit</th>
                            <th>Quantity</th>
                            <th>Low Stock Threshold</th>
                            <th>Date Create</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->uom->name ?? '-' }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->low_stock_threshold }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                            <!-- Edit Button -->
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editInventoryModal{{ $item->id }}">
                                <i class="bx bx-edit-alt"></i>
                            </button>

                            <!-- Delete Form -->
                            <form action="{{ route('inventory.destroy', $item->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bx bx-trash"></i>
                                </button>
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
            <div class="modal-dialog">
                <form class="modal-content" method="POST" action="{{ route('inventory.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addInventoryModalLabel">Add Inventory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                    <label for="name" class="form-label">Item Name</label>
                    <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                    <label for="unit" class="form-label">Unit</label>
                    <select name="uom_id" class="form-select" required>
                        <option value="" disabled selected>-- Select Unit --</option>
                        @foreach($uoms as $uom)
                            <option value="{{ $uom->id }}" {{ $item->uom_id == $uom->id ? 'selected' : '' }}>
                                {{ $uom->name }}
                            </option>
                        @endforeach
                    </select>
                    </div>

                    <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" class="form-control" required>
                    </div>
                    <div class="mb-3">
                    <label for="low_stock_threshold" class="form-label">Low Stock Alert</label>
                    <input type="number" name="low_stock_threshold" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
                </form>
            </div>
            </div>
            @foreach($items as $item)
            <!-- Edit Modal -->
            <div class="modal fade" id="editInventoryModal{{ $item->id }}" tabindex="-1" aria-labelledby="editInventoryModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content" method="POST" action="{{ route('inventory.update', $item->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editInventoryModalLabel{{ $item->id }}">Edit Inventory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                    <label class="form-label">Item Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $item->name }}" required>
                    </div>
                    <div class="mb-3">
                    <label class="form-label">Unit</label>
                    <select name="uom_id" class="form-select" required>
                        <option value="" disabled selected>-- Select Unit --</option>
                        @foreach($uoms as $uom)
                            <option value="{{ $uom->id }}" {{ $item->uom_id == $uom->id ? 'selected' : '' }}>
                                {{ $uom->name }}
                            </option>
                        @endforeach
                    </select>
                    </div>
                    <div class="mb-3">
                    <label class="form-label">Quantity</label>
                        <input type="number" name="quantity" class="form-control" value="{{ $item->quantity }}" required>
                    </div>
                    <div class="mb-3">
                    <label class="form-label">Low Stock Alert</label>
                        <input type="number" name="low_stock_threshold" class="form-control" value="{{ $item->low_stock_threshold }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
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
  </body>
</html>
