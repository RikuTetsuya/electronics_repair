<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="index.html" class="logo d-flex align-items-center me-auto">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            {{-- <img src="userpage/assets/img/logo.png" alt=""> --}}
            <h1 class="sitename">VolTech, Inc.</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="/customer/main/#hero">Home<br></a></li>
                <li><a href="{{ url('customer/order/#order') }}">Order</a></li>
                <li><a href="/customer/main/#services">Services</a></li>
                <li><a href="/customer/main/#testimonials">Testimonials</a></li>
                {{-- <li><a href="/customer/main/#donation">Donate!us</a></li> --}}
                <li><a href="/customer/main/#contact">Contact</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg' }}"
                            width="40" height="40" class="rounded-circle">
                        <i class="bi bi-chevron-down toggle-dropdown ms-1"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right p-3" aria-labelledby="navbarDropdownMenuLink"
                        style="min-width: 300px;">
                        <div class="text-center">
                            <!-- Profile Picture -->
                            <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg' }}"
                                width="100" height="100" class="rounded-circle mb-2">
                            <!-- User Name -->
                            <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                            <!-- User Email -->
                            <small class="text-muted">{{ Auth::user()->email }}</small>
                        </div>
                        <hr>
                        <!-- Additional Options -->
                        <div>
                            <a class="btn btn-primary btn-sm w-100 mb-2 text-white"
                                href="{{ url('customer/profile/') }}">Profile</a>
                            <a href="#" class="btn btn-danger btn-sm w-100 text-light" id="logout-button">Log
                                Out</a>
                            <form id="logout-form" action="{{ url('logout') }}" method="GET" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        {{-- <a class="btn-getstarted" href="index.html#about">Get Started</a> --}}

    </div>
</header>

@push('userscript')
    <script>
        document.getElementById('logout-button').addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default link behavior
            Swal.fire({
                title: 'Are you sure?',
                text: "You will be logged out!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, log me out!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the logout form
                    document.getElementById('logout-form').submit();
                }
            });
        });
    </script>
@endpush
