<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li> --}}
        {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        {{-- <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li> --}}

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{ asset('adminlte/dist/img/user1-128x128.jpg') }}" alt="User Avatar"
                            class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Brad Diesel
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Call me whenever you can...</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{ asset('adminlte/dist/img/user8-128x128.jpg') }}" alt="User Avatar"
                            class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                John Pierce
                                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">I got your message bro</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{ asset('adminlte/dist/img/user3-128x128.jpg') }}" alt="User Avatar"
                            class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Nora Silvester
                                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">The subject goes here</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        {{-- <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li> --}}
        {{-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> --}}
    </ul>
</nav>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javasript:;" class="brand-link" style="text-align: center">
        {{-- <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light" style="font-weight: bold !important; font-size: 20px;">VolTech, Inc.</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="{{ url('admin/profile') }}" class="d-block">{{ Auth::user()->name }}</a>
                <a href="{{ url('admin/profile') }}" class="d-block">
                    Logged as
                    {{ Auth::user()->user_type == 1 ? 'Admin' : (Auth::user()->user_type == 3 ? 'SuperAdmin' : 'Admin') }}
                </a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                @if (Auth::user()->user_type == 1 || Auth::user()->user_type == 3 || Auth::user()->user_type == 4)
                    <li class="nav-item">
                        <a href="{{ url('admin/dashboard') }}"
                            class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                                {{-- <span class="badge badge-info right">2</span> --}}
                            </p>
                        </a>
                    </li>
                    @if (Auth::user()->user_type == 3 || Auth::user()->user_type == 4)
                        <li class="nav-header">Super Admin Menu</li>
                        <li class="nav-item menu-close @if (in_array(Request::segment(2), ['admin', 'rating', 'faqs', 'mitra', 'service', 'customer'])) menu-open @endif">
                            <a href="#" class="nav-link @if (in_array(Request::segment(2), ['admin', 'rating', 'faqs', 'mitra', 'service', 'customer'])) active @endif">
                                <i class="nav-icon fas fa-crown"></i>
                                <p>
                                    Super Admin Menu
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/admin/service/list') }}"
                                        class="nav-link @if (Request::segment(2) == 'service') active @endif">
                                        <i class="fas fa-tools"></i>
                                        <p> Services</p>
                                    </a>
                                </li>
                                
                                <li class="nav-item">
                                    <a href="{{ url('/admin/mitra/list') }}"
                                        class="nav-link @if (Request::segment(2) == 'mitra') active @endif">
                                        <i class="fas fa-atom"></i>
                                        <p> Company Partner</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ url('/admin/admin/list') }}"
                                        class="nav-link @if (Request::segment(2) == 'admin') active @endif">
                                        <i class="fas fa-users-cog"></i>
                                        <p> Employee</p>
                                    </a>
                                </li>   

                                <li class="nav-item">
                                    <a href="{{ url('/admin/customer/list') }}"
                                        class="nav-link @if (Request::segment(2) == 'customer') active @endif">
                                        <i class="fas fa-user"></i>
                                        <p> Customer</p>
                                    </a>
                                </li>   
                                
                                <li class="nav-item">
                                    <a href="{{ url('/admin/rating/list') }}"
                                        class="nav-link @if (Request::segment(2) == 'rating') active @endif">
                                        <i class="far fa-star"></i>
                                        <p> Ratings</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    <li class="nav-header">Admin Menu</li>
                    <li class="nav-item menu-close @if (in_array(Request::segment(2), ['service', 'mitra', 'service_in', 'service_out'])) menu-open @endif">
                        {{-- <a href="#" class="nav-link @if (in_array(Request::segment(2), ['service', 'mitra', 'service_in', 'service_out'])) active @endif">
                            <i class="nav-icon nav-icon fas fa-user-cog"></i>
                            <p>
                                Admin Menu
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a> --}}
                        @if (auth()->user()->user_type == 1)
                        <li class="nav-item">
                            <a href="{{ url('/admin/service/list') }}"
                                class="nav-link @if (Request::segment(2) == 'service') active @endif">
                                <i class="fas fa-tools"></i>
                                <p> Service</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ url('/admin/mitra/list') }}"
                                class="nav-link @if (Request::segment(2) == 'mitra') active @endif">
                                <i class="fas fa-atom"></i>
                                <p> Mitra</p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('/admin/service_in/list') }}"
                                class="nav-link @if (Request::segment(2) == 'service_in') active @endif">
                                <i class="fas fa-file-import"></i>
                                <p> Service In</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/admin/service_out/list') }}"
                                class="nav-link @if (Request::segment(2) == 'service_out') active @endif">
                                <i class="fas fa-file-export"></i>
                                <p> Service Out</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/admin/faqs/list') }}"
                                class="nav-link @if (Request::segment(2) == 'faqs') active @endif">
                                <i class="fas fa-question"></i>
                                <p> FaQ</p>
                            </a>
                        </li>
                    </li>

                    {{-- <li class="nav-item menu-close @if (Request::segment(2) == 'admin') menu-open @endif">
                        <a href="#" class="nav-link @if (Request::segment(2) == 'admin') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Customer Menu
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ '/admin/customer/' }}" class="nav-link @if (Request::segment(2) == 'admin') active @endif">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>Order</p>
                                </a>
                            </li>
                        </ul>
                    </li> --}}
                @elseif(Auth::user()->user_type == 2)
                    <li class="nav-item">
                        <a href="{{ url('customer/dashboard') }}"
                            class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                                {{-- <span class="badge badge-info right">2</span> --}}
                            </p>
                        </a>
                    </li>

                    <li class="nav-item menu-close">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Customer Menu
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ '/customer/' }}"
                                    class="nav-link @if (Request::segment(2) == 'admin') active @endif">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        Order
                                    </p>
                                </a>
                            </li>

                        </ul>
                    </li>
                @elseif(Auth::user()->user_type == 3)
                    <li class="nav-item">
                        <a href="{{ url('administrator/dashboard') }}"
                            class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                                {{-- <span class="badge badge-info right">2</span> --}}
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ '/administrator/service_in/list' }}"
                            class="nav-link @if (Request::segment(2) == 'servicein') active @endif">
                            <i class="fas fa-file-import"></i>
                            <p>
                                Order Inbox
                            </p>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="{{ url('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>
                            Sign Out
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/profile') }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
