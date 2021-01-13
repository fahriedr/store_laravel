<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{route("admin.dashboard")}}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Product
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route("admin.product")}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Product List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route("admin.category")}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Product Category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route("admin.brand")}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Product Brand</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>