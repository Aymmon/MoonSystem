<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
    <a href="index.html" class="app-brand-link">
        <span class="app-brand-logo demo">
        </span>
        <span class="app-brand-text demo menu-text fw-bold ms-2">Sneat</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
    <!-- Dashboards -->
    <li class="menu-item active open">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div class="text-truncate" data-i18n="Dashboards">Dashboards</div>
        <span class="badge badge-center rounded-pill bg-danger ms-auto">5</span>
        </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Route::is('dashboard') ? 'active' : '' }}">
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
    <!-- e-commerce-app menu start -->
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-cart-alt"></i>
        <div class="text-truncate" data-i18n="eCommerce">eCommerce</div>
        </a>
        <ul class="menu-sub">
        <li class="menu-item">
            <a href="app-ecommerce-dashboard.html" class="menu-link">
            <div class="text-truncate" data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
            <div class="text-truncate" data-i18n="Products">Products</div>
            </a>
            <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('product.list') ? 'active' : '' }}">
                <a href="{{ route('product.list') }}" class="menu-link">
                    <div class="text-truncate" data-i18n="Product List">Product List</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="app-ecommerce-product-add.html" class="menu-link">
                <div class="text-truncate" data-i18n="Add Product">Add Product</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('categories.list') ? 'active' : '' }}">
                <a href="{{ route('categories.list') }}" class="menu-link">
                    <div class="text-truncate" data-i18n="Category List">Category List</div>
                </a>
            </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
            <div class="text-truncate" data-i18n="Order">Order</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('order.list') ? 'active' : '' }}">
                    <a href="{{ route('order.list') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Order List">Order List</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-ecommerce-order-details.html" class="menu-link">
                    <div class="text-truncate" data-i18n="Order Details">Order Details</div>
                    </a>
                </li>
            </ul>
        </li>
        </ul>
    </li>
    <li class="menu-item">
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
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div class="text-truncate" data-i18n="View">View</div>
                </a>
                <ul class="menu-sub">
                <li class="menu-item">
                    <a href="app-user-view-account.html" class="menu-link">
                    <div class="text-truncate" data-i18n="Account">Account</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-user-view-security.html" class="menu-link">
                    <div class="text-truncate" data-i18n="Security">Security</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-user-view-billing.html" class="menu-link">
                    <div class="text-truncate" data-i18n="Billing & Plans">Billing & Plans</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-user-view-notifications.html" class="menu-link">
                    <div class="text-truncate" data-i18n="Notifications">Notifications</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-user-view-connections.html" class="menu-link">
                    <div class="text-truncate" data-i18n="Connections">Connections</div>
                    </a>
                </li>
                </ul>
            </li>
        </ul>
    </li>
    </ul>
</aside>
<!-- / Menu -->
