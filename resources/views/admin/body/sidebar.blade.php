<div class="vertical-menu">

<div data-simplebar class="h-100">

    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title">Menu</li>

            <li>
                <a href="{{ route('dashboard') }}" class="waves-effect">
                    <i class="fas fa-home"></i><span class="badge rounded-pill bg-success float-end">3</span>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="ri-hotel-fill"></i>
                    <span>Manage Suppliers</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('supplier.all') }}">All Supplier</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fas fa-users"></i>
                    <span>Manage Customer</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('customer.all') }}">All Customer</a></li>                 
                    <li><a href="{{ route('credit.customer') }}">Credit Customers</a></li>
                    <li><a href="{{ route('paid.customer') }}">Paid Customers</a></li>
                    <li><a href="{{ route('customer.wise.report') }}">Customer Wise Report</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="ri-apps-2-fill"></i>
                    <span>Manage Category</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('category.all') }}">All Category</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fas fa-weight"></i>
                    <span>Manage Units</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('unit.all') }}">All Unit</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fab fa-product-hunt"></i>
                    <span>Manage Product</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('product.all') }}">All Product</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fas fa-cash-register"></i>
                    <span>Manage Purchase</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('purchase.all') }}">All Purchase</a></li>
                    <li><a href="{{ route('purchase.pending') }}">Approval Purchase</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fas fa-file-invoice"></i>
                    <span>Manage Invoice</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('invoice.all') }}">All Invoice</a></li>
                    <li><a href="{{ route('daily.invoice.report') }}">Daily Invoice Report</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="fa-solid fa-warehouse"></i>
                    <span>Manage Stock</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('stock.report') }}">Stock Report</a></li>
                    <li><a href="{{ route('stock.supplier.wise') }}">Supplier / Product Wise </a></li>
                </ul>
            </li>


            <!-- <li class="menu-title">Roles and Permission</li>

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="ri-account-circle-line"></i>
                    <span>Role and Permission</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('all.permission') }}">All Permission</a></li>
                    <li><a href="{{ route('all.roles') }}">All Roles</a></li>
                    <li><a href="{{ route('add.roles.permission') }}">Roles in Permission</a></li>
                    <li><a href="{{ route('all.roles.permission') }}">All Roles in Permission</a></li>
                </ul>
            </li>

            <li class="menu-title">Admin Manage</li>

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="ri-account-circle-line"></i>
                    <span>Admin Manage</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('all.admin') }}">All Admin</a></li>
                </ul>
            </li> -->

            <!-- <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="ri-profile-line"></i>
                    <span>Utility</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="pages-starter.html">Starter Page</a></li>
                    <li><a href="pages-timeline.html">Timeline</a></li>
                    <li><a href="pages-directory.html">Directory</a></li>
                    <li><a href="pages-invoice.html">Invoice</a></li>
                    <li><a href="pages-404.html">Error 404</a></li>
                    <li><a href="pages-500.html">Error 500</a></li>
                </ul>
            </li> -->

        </ul>
    </div>
    <!-- Sidebar -->
</div>
</div>