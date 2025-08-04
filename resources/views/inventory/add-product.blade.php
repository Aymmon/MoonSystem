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
    <title>Add Product</title>
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
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="py-3 mb-4"><span class="text-muted fw-light">Inventory /</span><span> Add Product</span></h4>
              <div class="app-ecommerce">
                <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Add Product -->
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1 mt-3">Add a new Product</h4>
                        <p class="text-muted">Orders placed across your store</p>
                    </div>
                        <div class="d-flex align-content-center flex-wrap gap-3 mb-3">
                            <button type="reset" class="btn btn-label-secondary">Discard</button>
                            <button type="submit" name="draft" value="1" class="btn btn-label-primary">Save draft</button>
                            <button type="submit" class="btn btn-primary">Publish product</button>
                        </div>
                    </div>
                    <div class="row">
                    <!-- First column-->
                    <div class="col-12 col-lg-8">
                        <!-- Product Information -->
                        <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-tile mb-0">Product information</h5>
                        </div>
                            <div class="card-body">
                                <div class="mb-3">
                                <label class="form-label" for="ecommerce-product-name">Product Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="ecommerce-product-name"
                                    placeholder="Product title"
                                    name="name"
                                    aria-label="Product title"
                                    required />
                                </div>
                                <div class="row mb-3">
                                <div class="col">
                                    <label for="category" class="form-label">Category</label>
                                    <select name="category_id" class="form-select" required>
                                        <option value="" disabled selected>Select a category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label" for="ecommerce-product-barcode">Price</label>
                                    <input
                                    type="number"
                                    class="form-control"
                                    id="ecommerce-product-barcode"
                                    placeholder="₱0.00"
                                    name="price"
                                    aria-label="Product barcode" />
                                </div>
                                </div>
                                <!-- Description -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description <span class="text-muted">(Optional)</span></label>
                                    <textarea name="description" id="description" rows="4" class="form-control" placeholder="Write product description...">{{ old('description') }}</textarea>
                                </div>

                            </div>
                        </div>
                        <!-- /Product Information -->
                    <!-- Media -->
                    <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Media</h5>
                    </div>
                    <div class="card-body">
                        <input type="file" name="picture" class="form-control" />
                    </div>
                    </div>
                        <!-- /Media -->
                    </div>
                    <div class="col-12 col-lg-4">
                        <!-- Size Card -->
                        <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Sizes</h5>
                            <button type="button" id="add-size-btn" class="btn btn-sm btn-primary">+ Add Size</button>
                        </div>
                        <div class="card-body" id="size-wrapper">
                            <!-- Initial size row (can be removed) -->
                            <div class="size-row border rounded p-2 mb-3">
                            <div class="mb-2">
                                <label class="form-label">Size</label>
                                <input type="text" name="sizes[0][size]" class="form-control" placeholder="e.g., Small" />
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Price</label>
                                <input type="number" name="sizes[0][price]" class="form-control" placeholder="e.g., 49.00" />
                            </div>
                            <button type="button" class="btn btn-sm btn-danger remove-size-btn">Remove</button>
                            </div>
                        </div>
                        </div>
                        <!-- Ingredient Card -->
                        <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Ingredient</h5>
                        </div>
                        <div class="card-body">
                        </div>
                        </div>
                        <!-- /Ingredient Card -->
                    </div>
                    <!-- /Second column -->
                    </div>
                </form>
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
        let sizeIndex = 1;
    $('#add-size-btn').on('click', function () {
        console.log('Add Size button clicked');
        const sizeRow = `
            <div class="size-row border rounded p-2 mb-3">
            <div class="mb-2">
                <label class="form-label">Size</label>
                <input type="text" name="sizes[${sizeIndex}][size]" class="form-control" placeholder="e.g., Medium" />
            </div>
            <div class="mb-2">
                <label class="form-label">Price</label>
                <input type="number" name="sizes[${sizeIndex}][price]" class="form-control" placeholder="e.g., 59.00" />
            </div>
            <button type="button" class="btn btn-sm btn-danger remove-size-btn">Remove</button>
            </div>
        `;
        $('#size-wrapper').append(sizeRow);
        sizeIndex++;
    });
    // REMOVE or COMMENT OUT the next line:
    // asss
    $(document).on('click', '.remove-size-btn', function () {
        $(this).closest('.size-row').remove();
    });
    });
    </script>

  </body>
</html>
