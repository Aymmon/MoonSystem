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
              <h4 class="py-3 mb-4"><span class="text-muted fw-light">Inventory/</span> Unit Of Measures List</h4>

              <!-- Unit Of Measures List Widget -->
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
                <!-- Unit Of Measures List Table -->
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title m-0">Unit Of Measures List</h5>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUomModal">
                            <i class="bx bx-plus"></i> Add Unit Of Measures
                        </button>
                        </div>
                    </div>
                    <div class="card-datatable table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Abbreviation</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($uoms as $uom)
                                <tr>
                                    <td>{{ $uom->name }}</td>
                                    <td>{{ $uom->abbreviation }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editUomModal{{ $uom->id }}">Edit</button>

                                        <form action="{{ route('oums.destroy', $uom->id) }}" method="POST" class="d-inline delete-uom-form">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Edit UOM Modal -->
                                <div class="modal fade" id="editUomModal{{ $uom->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <form method="POST" action="{{ route('oums.update', $uom->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit UOM</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="text" name="name" class="form-control mb-2" placeholder="Name" value="{{ $uom->name }}" required>
                                                    <input type="text" name="abbreviation" class="form-control" placeholder="Abbreviation" value="{{ $uom->abbreviation }}" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-success" type="submit">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <!-- / Content -->
            <!-- Add UOM Modal -->
<div class="modal fade" id="addUomModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('oums.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New UOM</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
                    <input type="text" name="abbreviation" class="form-control" placeholder="Abbreviation" required>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Add</button>
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
