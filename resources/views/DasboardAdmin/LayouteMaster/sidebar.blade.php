<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href=""><h3 class="auth-title">Mini E-commerce</h3></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item  ">
                    <a href="{{ route('dasboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <a href="{{ route('data_kategori') }}" class='sidebar-link'>
                        <i class="bi bi-clipboard"></i>
                        <span>Kategori</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <a href="{{ route('product.index') }}" class='sidebar-link'>
                        <i class="bi bi-box-seam"></i>
                        <span>Product</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <a href="{{ route('data-order') }}" class='sidebar-link'>
                       <i class="bi bi-cart2"></i>
                        <span>Orders</span>
                    </a>
                </li>




            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
