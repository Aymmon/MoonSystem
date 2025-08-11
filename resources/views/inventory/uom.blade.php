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
    <title>Unit Of Measures List</title>
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
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Inventory /</span> Unit Of Measures List</h4>

            <div class="card">
                <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title m-0">Unit Of Measures List</h5>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUomModal">
                    <i class="bx bx-plus"></i> Add UOM
                    </button>
                </div>
                </div>

                <div class="card-datatable table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Symbol</th>
                        <th>Base Unit</th>
                        <th>Base Conversion</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($uoms as $uom)
                    <tr>
                        <td>{{ $uom->name }}</td>
                        <td>{{ $uom->symbol }}</td>
                        <td>{{ $uom->base_unit }}</td>
                        <td>{{ $uom->base_conversion }}</td>
                        <td>
                        <!-- Edit Button -->
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editUomModal{{ $uom->id }}">
                            <i class="bx bx-edit-alt"></i>
                        </button>

                        <!-- Delete -->
                        <form action="{{ route('uoms.destroy', $uom->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
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
            <!-- Add UOM Modal -->
            <div class="modal fade" id="addUomModal" tabindex="-1" aria-labelledby="addUomModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content" method="POST" action="{{ route('uoms.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addUomModalLabel">Add UOM</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                    <label for="symbol" class="form-label">Symbol</label>
                    <input type="text" name="symbol" class="form-control" placeholder="e.g. kg, g, ml" required>
                    </div>

                    <div class="mb-3">
                    <label for="base_unit" class="form-label">Base Unit</label>
                    <input type="text" name="base_unit" class="form-control" required>
                    </div>

                    <div class="mb-3">
                    <label for="base_conversion" class="form-label">Base Conversion</label>
                    <input type="number" step="0.01" name="base_conversion" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
                </form>
            </div>
            </div>
            @foreach($uoms as $uom)
                <!-- Edit Modal -->
                <div class="modal fade" id="editUomModal{{ $uom->id }}" tabindex="-1" aria-labelledby="editUomModalLabel{{ $uom->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                    <form class="modal-content" method="POST" action="{{ route('uoms.update', $uom->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                        <h5 class="modal-title" id="editUomModalLabel{{ $uom->id }}">Edit UOM</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $uom->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Symbol</label>
                            <input type="text" name="symbol" class="form-control" value="{{ $uom->symbol }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Base Unit</label>
                            <input type="text" name="base_unit" class="form-control" value="{{ $uom->base_unit }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Base Conversion</label>
                            <input type="number" name="base_conversion" class="form-control" step="0.01" value="{{ $uom->base_conversion }}" required>
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
            <!-- / Content -->
            <!-- UOM Modal -->
            <div class="modal fade" id="uomModal" tabindex="-1" aria-labelledby="uomModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="uomForm" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="uomModalLabel">Add UOM</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <input type="hidden" name="uom_id" id="uom_id">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" id="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="symbol" class="form-label">Symbol <span class="text-danger">*</span></label>
                        <input type="text" name="symbol" class="form-control" id="symbol" required>
                    </div>

                    <div class="mb-3">
                        <label for="base_unit" class="form-label">Base Unit <span class="text-danger">*</span></label>
                        <input type="text" name="base_unit" class="form-control" id="base_unit" required>
                    </div>

                    <div class="mb-3">
                        <label for="base_conversion" class="form-label">Base Conversion <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="base_conversion" class="form-control" id="base_conversion" required>
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
                </form>
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
  </body>
</html>
