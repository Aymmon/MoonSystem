<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ route('dashboard') }}" class="app-brand-link">
      <span class="app-brand-logo demo"></span>
      <span class="app-brand-text demo menu-text fw-bold ms-2">Moon System</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboards -->
    <li class="menu-item {{ request()->routeIs('dashboard') ? 'active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div class="text-truncate" data-i18n="Dashboards">Dashboards</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
          <a href="{{ route('dashboard') }}" class="menu-link">
            <div class="text-truncate" data-i18n="Analytics">Analytics</div>
          </a>
        </li>
      </ul>
    </li>

    <!-- Apps & Pages -->
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text" data-i18n="Apps & Pages">Apps &amp; Pages</span>
    </li>

    <!-- Inventory Menu -->
    <li class="menu-item {{ request()->routeIs('product.list', 'categories.list', 'order.list') ? 'open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-cart-alt"></i>
        <div class="text-truncate" data-i18n="Inventory">Inventory</div>
      </a>
      <ul class="menu-sub">
        <!-- Products -->
        <li class="menu-item {{ request()->routeIs('product.list', 'categories.list') ? 'open' : '' }}">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <div class="text-truncate" data-i18n="Products">Products</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('product.list') ? 'active' : '' }}">
              <a href="{{ route('product.list') }}" class="menu-link">
                <div class="text-truncate" data-i18n="Product List">Product List</div>
              </a>
            </li>
            <li class="menu-item {{ request()->routeIs('categories.list') ? 'active' : '' }}">
              <a href="{{ route('categories.list') }}" class="menu-link">
                <div class="text-truncate" data-i18n="Category List">Category List</div>
              </a>
            </li>
          </ul>
        </li>

        <!-- Orders -->
        <li class="menu-item {{ request()->routeIs('order.list') ? 'open' : '' }}">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <div class="text-truncate" data-i18n="Order">Order</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('order.list') ? 'active' : '' }}">
              <a href="{{ route('order.list') }}" class="menu-link">
                <div class="text-truncate" data-i18n="Order List">Order List</div>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </li>

    <!-- Users -->
    <li class="menu-item {{ request()->routeIs('user-list') ? 'open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-user"></i>
        <div class="text-truncate" data-i18n="Users">Users</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('user-list') ? 'active' : '' }}">
          <a href="{{ route('user-list') }}" class="menu-link">
            <div class="text-truncate" data-i18n="List">List</div>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</aside>
<!-- / Menu -->
