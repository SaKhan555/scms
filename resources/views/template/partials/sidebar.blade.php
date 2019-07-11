        <ul class="sidebar navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
        <a class="nav-link" href="{{ route('admin.vendor.index') }}">
          <i class="fas fa-user-cog"></i>Vendor
        </a>
                <a class="nav-link" href="{{ route('admin.customer.index') }}">
          <i class="fas fa-user-cog"></i>Customer
        </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Settings</span>
        </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <h6 class="dropdown-header">Setup:</h6>
                    <a class="dropdown-item" href="{{ route('admin.country.index') }}">
                    <i class="fas fa-globe"></i>
                    Countries</a>
                    <a class="dropdown-item" href="{{ route('admin.city.index') }}">
                    <i class="fas fa-flag"></i>
                    Cities</a>
                    <a class="dropdown-item" href="{{ route('admin.item_category.index') }}">
                    <i class="fas fa-sitemap"></i>
                    Item Categories</a> 
                      <a class="dropdown-item" href="{{ route('admin.item.index') }}">
                    <i class="fas fa-store"></i>
                    Items</a>
                    <a class="dropdown-item" href="{{ route('admin.warehouse.index') }}">
                    <i class="fas fa-warehouse"></i>
                    Warehouses</a>
                </div>
            </li>


{{--             <li class="nav-item">
                <a class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span></a>
            </li> --}}
        </ul>