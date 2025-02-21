@extends('layout_user.app')
@section('usercontent')
    @push('usercss')
        <!-- Select2 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
        <style>
            /* Custom Card Styles for Vesperr Theme */
            .dashboard-card {
                border-radius: 10px;
                color: #fff;
                padding: 15px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                margin-bottom: 15px;
            }

            .card-primary {
                background-color: #007bff;
            }

            .card-success {
                background-color: #28a745;
            }

            .card-info {
                background-color: #17a2b8;
            }

            .card-warning {
                background-color: #ffc107;
                color: #212529;
            }

            .card-danger {
                background-color: #dc3545;
            }

            /* Styling for Titles and Icons */
            .dashboard-card h3 {
                font-size: 18px;
                margin-bottom: 5px;
            }

            .dashboard-card p {
                font-size: 14px;
                margin: 0;
            }

            .dashboard-card i {
                font-size: 28px;
                opacity: 0.8;
            }

            /* Sticky positioning for left column */
            .dashboard-section {
                height: 100vh;
                /* Full viewport height */
                overflow-y: auto;
                /* Scrollable */
                position: sticky;
                top: 0;
            }

            /* Burger menu styles */
            .burger-menu {
                display: none;
                cursor: pointer;
                font-size: 24px;
                margin-bottom: 15px;
            }

            /* Responsive styles for mobile view */
            @media (max-width: 768px) {
                .burger-menu {
                    display: block;
                }

                .dashboard-cards {
                    display: none;
                    /* Hidden by default on mobile */
                    padding-top: 10px;
                }
            }

            /* Order Detail Card Styling */
            .order-detail-card {
                border: 1px solid #ddd;
                border-radius: 10px;
                padding: 20px;
                background-color: #f8f9fa;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                height: 250px;
                /* Match height */
                overflow-y: auto;
                /* Scrollable */
            }

            .order-detail-card h4 {
                font-size: 20px;
                margin-bottom: 15px;
                color: #333;
            }

            .order-detail-card p {
                margin: 0;
                font-size: 16px;
                color: #555;
            }

            /* menyelaraskan data pada view modal */
            .label-width {
                width: 250px;
                /* Sesuaikan sesuai kebutuhan Anda */
            }

            .text-content {
                white-space: pre-wrap;
                /* Membuat teks sesuai baris baru */
                word-wrap: break-word;
                /* Teks panjang akan dibungkus */
                max-width: 100%;
                /* Maksimalkan area isi modal */
            }

            .modal-content {
                border-radius: 10px;
            }

            .modal-header {
                background-color: #f8f9fa;
                border-bottom: 1px solid #dee2e6;
            }

            .modal-title {
                font-size: 1.25rem;
                font-weight: bold;
            }

            .modal-body {
                padding: 20px;
            }

            .modal-footer {
                border-top: 1px solid #dee2e6;
            }

            .rating {
                display: flex;
                flex-direction: row-reverse;
                gap: 0.3rem;
                --stroke: #666;
                --fill: #ffc73a;
            }

            .rating input {
                appearance: unset;
            }

            .rating label {
                cursor: pointer;
            }

            .rating svg {
                width: 2rem;
                height: 2rem;
                overflow: visible;
                fill: transparent;
                stroke: var(--stroke);
                stroke-linejoin: bevel;
                stroke-dasharray: 12;
                animation: idle 4s linear infinite;
                transition: stroke 0.2s, fill 0.5s;
            }

            @keyframes idle {
                from {
                    stroke-dashoffset: 24;
                }
            }

            .rating label:hover svg {
                stroke: var(--fill);
            }

            .rating input:checked~label svg {
                transition: 0s;
                animation: idle 4s linear infinite, yippee 0.75s backwards;
                fill: var(--fill);
                stroke: var(--fill);
                stroke-opacity: 0;
                stroke-dasharray: 0;
                stroke-linejoin: miter;
                stroke-width: 8px;
            }

            @keyframes yippee {
                0% {
                    transform: scale(1);
                    fill: var(--fill);
                    fill-opacity: 0;
                    stroke-opacity: 1;
                    stroke: var(--stroke);
                    stroke-dasharray: 10;
                    stroke-width: 1px;
                    stroke-linejoin: bevel;
                }

                30% {
                    transform: scale(0);
                    fill: var(--fill);
                    fill-opacity: 0;
                    stroke-opacity: 1;
                    stroke: var(--stroke);
                    stroke-dasharray: 10;
                    stroke-width: 1px;
                    stroke-linejoin: bevel;
                }

                30.1% {
                    stroke: var(--fill);
                    stroke-dasharray: 0;
                    stroke-linejoin: miter;
                    stroke-width: 8px;
                }

                60% {
                    transform: scale(1.2);
                    fill: var(--fill);
                }


                .testimonial-wrap {
                    background: #fff;
                    border-radius: 10px;
                    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
                    padding: 20px;
                    text-align: center;
                    margin: 10px;
                }

                .testimonial-item {
                    padding: 15px;
                }

                .testimonial-img {
                    width: 80px;
                    height: 80px;
                    border-radius: 50%;
                    object-fit: cover;
                    margin-bottom: 15px;
                }

                .stars i {
                    color: #ffc107;
                }

            }
        </style>
    @endpush

    @push('userscript')
        <script>
            // Toggle display of dashboard cards on mobile when burger menu is clicked
            function toggleDashboardCards() {
                var dashboardCards = document.getElementById("dashboardCards");
                if (dashboardCards.style.display === "none" || dashboardCards.style.display === "") {
                    dashboardCards.style.display = "block";
                } else {
                    dashboardCards.style.display = "none";
                }
            }

            // Ensure dashboard cards are hidden on mobile load
            document.addEventListener("DOMContentLoaded", function() {
                if (window.innerWidth <= 768) {
                    document.getElementById("dashboardCards").style.display = "none";
                }
            });
        </script>
    @endpush

    <main class="main">

        <section id="order" class="dashboard section">
            <div class="container">
                <div class="row">
                    {{-- <div class="col-12 text-center mb-3">
                        <!-- Button -->
                        <a href="{{ url('customer/order/add') }}" class="btn btn-primary">
                          <i class="fas fa-cart-plus"></i> Add Order
                        </a>
                    </div> --}}
                    <div class="col-12 text-center mb-3">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addOrderModal">
                            <i class="fas fa-cart-plus"></i> Add Order
                        </button>
                    </div>
                    <div class="col-12">
                        <div class="burger-menu text-center" onclick="toggleDashboardCards()">
                            ☰ Show Stats
                        </div>
                    </div>
                    <form method="GET" action="{{ url('customer/order') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="date" name="tanggal_masuk" class="form-control" placeholder="Tanggal Masuk"
                                    value="{{ request('tanggal_masuk') }}">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="order_id" class="form-control" placeholder="Order ID"
                                    value="{{ request('order_id') }}">
                            </div>
                            <div class="col-md-3">
                                <select name="layanan" class="form-control">
                                    <option value="">Select Service</option>
                                    @foreach ($layanans as $layanan)
                                        <option value="{{ $layanan->id }}"
                                            {{ request('layanan') == $layanan->id ? 'selected' : '' }}>
                                            {{ $layanan->nama_layanan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Waiting</option>
                                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Rejected
                                    </option>
                                    <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Accepted
                                    </option>
                                    <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>On Process
                                    </option>
                                    <option value="4" {{ request('status') == '4' ? 'selected' : '' }}>Finished
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-3 mt-2">
                                <select name="status_payment" class="form-control">
                                    <option value="">Payment Status</option>
                                    <option value="Unpaid" {{ request('status_payment') == 'Unpaid' ? 'selected' : '' }}>
                                        Unpaid</option>
                                    <option value="Paid" {{ request('status_payment') == 'Paid' ? 'selected' : '' }}>Paid
                                        (e-payment)</option>
                                    <option value="Paid in Cash"
                                        {{ request('status_payment') == 'Paid in Cash' ? 'selected' : '' }}>Paid in Cash
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-3 mt-2">
                                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-filter"></i>
                                    Filter</button>
                            </div>
                            <div class="col-md-3 mt-2">
                                <a href="{{ url('customer/order') }}" class="btn btn-secondary btn-block"><i
                                        class="fas fa-sync"></i> Reset</a>
                            </div>
                        </div>
                    </form>
                    @include('_message')
                    <!-- Column for Order Statistics Cards (Narrower) -->
                    <div class="col-md-4" id="dashboardCards">
                        <div class="dashboard-section">
                            <!-- Card Secondary -->
                            <div class="dashboard-card bg-secondary text-center">
                                {{-- <i class="fas fa-shopping-cart"></i> --}}
                                <i class="bi bi-cart3"></i>
                                <h3>Total Orders</h3>
                                <p>{{ $totalOrders }}</p>
                            </div>

                            <!-- Card Warning -->
                            <div class="dashboard-card card-warning text-center">
                                <i class="bi bi-exclamation-triangle"></i>
                                <h3>Waiting</h3>
                                <p>{{ $totalWaiting }}</p>
                            </div>

                            <!-- Card Primary -->
                            <div class="dashboard-card card-primary text-center">
                                <i class="bi bi-people"></i>
                                <h3>Accepted</h3>
                                <p>{{ $totalAccepted }}</p>
                            </div>

                            <!-- Card Info -->
                            <div class="dashboard-card card-info text-center">
                                <i class="bi bi-info-circle"></i>
                                <h3>On-going Orders</h3>
                                <p>{{ $totalOnProcess }}</p>
                            </div>

                            <!-- Card Success -->
                            <div class="dashboard-card card-success text-center">
                                <i class="bi bi-check-circle"></i>
                                <h3>Completed Orders</h3>
                                <p>{{ $totalFinished }}</p>
                            </div>

                            <!-- Card Danger -->
                            <div class="dashboard-card card-danger text-center">
                                {{-- <i class="bi bi-cross-circle"></i> --}}
                                <i class="bi bi-x-circle"></i>
                                <h3>Rejected</h3>
                                <p>{{ $totalRejected }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Column for Order Details Card (Wider) -->
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Order List</h3>
                            </div>
                            <div class="card-body">
                                <div id="cardContainer">
                                    @foreach ($customer as $val)
                                        <div class="card mb-3 customer-card"
                                            data-customer-name="{{ strtolower($val->name) }}"
                                            data-service-name="{{ strtolower($val->nama_layanan) }}"
                                            data-status="{{ $val->status }}">
                                            <div class="card-body">
                                                <h5 class="card-title mb-2">
                                                    <i class="fas fa-ticket-alt"> {{ $val->order_id }}</i>
                                                    <i class="fas fa-calendar" style="margin-left: 10px;"></i>
                                                    {{ \Carbon\Carbon::parse($val->tanggal_masuk)->translatedFormat('d-F-Y') }}
                                                    {{-- <i class="fas fa-tag" style="margin-left: 10px;"></i> {{ $val->name }}'s order 
                                            <i class="fas fa-user-circle" style="margin-left: 10px;"></i> {{ $val->email }} --}}
                                                </h5>

                                                {{-- <p class="card-text"><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($val->tanggal_masuk)->translatedFormat('d-F-Y') }}</p> --}}
                                                <hr>
                                                <strong class="card-text">
                                                    <strong>Selected Service : </strong> {{ $val->nama_layanan }}
                                                    @if ($val->status == 0)
                                                        <span class="badge badge-warning"
                                                            style="margin-left: 10px;">Waiting...</span>
                                                    @elseif ($val->status == 1)
                                                        <span class="badge badge-danger"
                                                            style="margin-left: 10px;">Rejected</span>
                                                    @elseif ($val->status == 2)
                                                        <span class="badge badge-primary"
                                                            style="margin-left: 10px;">Accepted</span>
                                                    @elseif ($val->status == 3)
                                                        <span class="badge badge-info" style="margin-left: 10px;">On
                                                            Process...</span>
                                                    @elseif ($val->status == 4)
                                                        <span class="badge badge-success"
                                                            style="margin-left: 10px;">Finished</span>
                                                    @endif

                                                    @if ($val->status_payment === 'Unpaid')
                                                        <span style="color: red;">Unpaid</span>
                                                    @elseif ($val->status_payment === 'Paid')
                                                        <span style="color: green;">Paid (e-payment)</span>
                                                    @elseif ($val->status_payment === 'Paid in Cash')
                                                        <span style="color: green;">Paid in Cash</span>
                                                    @endif
                                                </strong>
                                                <hr>
                                                <p class="card-text"><i class="fas fa-phone-alt"></i> {{ $val->telepon }}
                                                </p>

                                                <p class="card-text"><i class="fas fa-wrench"></i> <strong>Perbaikan 3rd
                                                        Party </strong>
                                                    @if ($val->perbaikan_pihak_ketiga == 0)
                                                        <span class="badge badge-warning">Waiting...</span>
                                                    @elseif ($val->perbaikan_pihak_ketiga == 1)
                                                        <span class="badge badge-success">Needed</span>
                                                    @elseif ($val->perbaikan_pihak_ketiga == 2)
                                                        <span class="badge badge-danger">No need</span>
                                                    @endif
                                                </p>
                                                <p class="card-text"><i class="fas fa-calendar-check"></i>
                                                    <strong>Estimasi
                                                        Selesai:</strong>
                                                    {{ $val->tanggal_estimasi ? \Carbon\Carbon::parse($val->tanggal_estimasi)->translatedFormat('d-F-Y') : '- (belum diperkirakan)' }}
                                                </p>

                                                @if ($val->status == 4 && $val->status_payment == 'Unpaid')
                                                    <a href="{{ url('customer/checkout/' . $val->order_id) }}"
                                                        class="btn btn-success">
                                                        <i class="fas fa-hand-holding-usd"></i> Pay
                                                    </a>
                                                @endif

                                                @if ($val->status == 0 || $val->status == 1 || $val->status == 2)
                                                    <button type="button" class="btn btn-xs btn-success" disabled
                                                        title="BELUM BISA MELAKUKAN PEMBAYARAN">
                                                        <i class="fas fa-hand-holding-usd"></i> Pay
                                                    </button>
                                                @endif

                                                @if ($val->status_payment == 'Paid' || $val->status_payment == 'Paid in Cash')
                                                    <!-- Tombol untuk membuka modal -->
                                                    {{-- <button type="button" class="btn view-rating"
                                                        style="background-color: purple; color: white;"
                                                        data-bs-toggle="modal" data-bs-target="#ratingModal"
                                                        data-order-id-customer="{{ $val->order_id }}">
                                                        <i class="bi bi-stars"></i> Review
                                                    </button> --}}
                                                    <a href="{{ url('customer/detail/' . $val->order_id) }}"
                                                        class="btn btn-primary">
                                                        <i class="fas fa-file-invoice"></i> Details <i class="bi bi-stars"></i>
                                                    </a>
                                                @endif

                                                <button style="color: white" class="btn btn-xs btn-info view-detail"
                                                    data-toggle="modal" data-target="#viewModal"
                                                    data-nama-customer-title="{{ $val->name }}"
                                                    data-order-id-customer="{{ $val->order_id }}"
                                                    data-nama-customer="{{ $val->name }}"
                                                    data-nama-layanan="{{ $val->nama_layanan }}"
                                                    data-status="{{ $val->status }}" data-telepon="{{ $val->telepon }}"
                                                    data-email="{{ $val->email }}" data-alamat="{{ $val->alamat }}"
                                                    data-keluhan="{{ $val->deskripsi_masalah }}"
                                                    data-serviceins-note="{{ $val->catatan }}"
                                                    data-perbaikan="{{ $val->perbaikan_pihak_ketiga }}"
                                                    data-serviceouts-vendor="{{ $val->nama_mitra }}"
                                                    data-serviceouts-note="{{ $val->catatan_service_out }}"
                                                    data-serviceins-harga="{{ $val->harga }}"
                                                    data-serviceouts-biaya="{{ $val->biaya }}"
                                                    data-total="{{ $val->total_biaya }}"
                                                    data-tanggal-estimasi="{{ $val->tanggal_estimasi }}"><i
                                                        class="fa fa-eye"></i> View</button>

                                                @if ($val->status == 0 || $val->status == 2)
                                                    {{-- <a href="{{ url('customer/order/edit/' . $val->id) }}"
                                                        class="btn btn-xs btn-primary">
                                                        <i class="fa fa-pencil-alt"></i> Edit
                                                    </a> --}}
                                                    <button type="button" class="btn btn-xs btn-primary edit-button"
                                                        data-order-id="{{ $val->id }}">
                                                        <i class="fa fa-pencil-alt"></i> Edit
                                                    </button>
                                                    {{-- @else
                                                    <button type="button" class="btn btn-xs btn-primary" disabled
                                                        title="TIDAK DAPAT MENGEDIT PESANAN JIKA SUDAH DIPROSES ATAU DISELESAIKAN">
                                                        <i class="fas fa-ban"></i> Edit
                                                    </button> --}}
                                                @endif

                                                <form action="{{ url('delete_order/' . $val->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @if ($val->status == 0)
                                                        <button action="{{ url('delete_order/' . $val->id) }}"
                                                            method="POST" class="delete-confirm btn btn-xs btn-danger">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </button>
                                                        {{-- @else
                                                        <button type="button" class="btn btn-xs btn-danger" disabled
                                                            title="TIDAK DAPAT MEMBATALKAN PESANAN JIKA SUDAH DIPROSES ATAU DISELESAIKAN">
                                                            <i class="fas fa-ban"></i> Delete
                                                        </button> --}}
                                                    @endif
                                                </form>
                                                {{-- <p style="color: red">Pastikan lakukan pembayaran di tempat kami. Jika berhalangan untuk datang, hubungi admin sebelum melakukan pembayaran untuk konfirmasi</p> --}}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Pagination Links -->
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $customer->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Modal for Viewing Detail -->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">
                        {{-- <i class="fas fa-tag"></i> <span id="modal-customer-name-title"></span>'s Order Detail --}}
                        <i class="fas fa-ticket-alt ml-3"></i> <span id="modal-order-id-customer"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="d-flex"><span class="label-width"><i class="fas fa-user-circle"></i> <strong>Nama
                                Customer :</strong></span> <span id="modal-customer-name"></span></p>
                    <p class="d-flex"><span class="label-width"><i class="fas fa-phone-alt"></i>
                            <strong>Telepon :</strong></span> <span id="modal-telepon"></span></p>
                    <p class="d-flex"><span class="label-width"><i class="far fa-envelope"></i>
                            <strong>Email :</strong></span> <span id="modal-email"></span></p>
                    <p class="d-flex"><span class="label-width"><i class="fas fa-map-marker-alt"></i>
                            <strong>Alamat :</strong></span> <span id="modal-alamat"></span></p>
                    <hr>
                    <p class="d-flex"><span class="label-width"><i class="fas fa-atom"></i>
                            <strong>Layanan :</strong></span> <span id="modal-layanan"></span></p>
                    <p class="d-flex"><span class="label-width"><i class="fas fa-lightbulb"></i>
                            <strong>Status :</strong></span> <span id="modal-status"></span></p>
                    <hr>

                    <!-- Area teks menggunakan pre untuk melestarikan format baris baru -->
                    <div class="d-flex">
                        <span class="label-width"><i class="far fa-comment"></i> <strong>Keluhan :</strong></span>
                        <pre id="modal-keluhan" class="text-content"></pre>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <span class="label-width"><i class="fas fa-wrench"></i> <strong>Perbaikan :</strong></span>
                        <pre id="modal-serviceins-note" class="text-content"></pre>
                    </div>
                    <hr>
                    <div class="d-flex">
                        <span class="label-width"><i class="fas fa-file-export"></i> <strong>Perbaikan 3rd
                                Party :</strong></span>
                        <pre id="modal-perbaikan" class="text-content"></pre>
                    </div>
                    <br>
                    <p class="d-flex"><span class="label-width"><strong>Vendor :</strong></span> <span
                            id="modal-vendor-name"></span></p>
                    <div class="d-flex">
                        <span class="label-width"><strong>Catatan Perbaikan 3rd Party :</strong></span>
                        <pre id="modal-serviceouts-note" class="text-content"></pre>
                    </div>
                    <hr>

                    <p><strong><i class="fas fa-money-bill-wave"></i> Biaya </strong> <i class="fas fa-coins"></i></p>
                    <p class="d-flex"><span class="label-width"><strong>Biaya Service In :</strong></span> <span
                            id="modal-harga-servicein"></span></p>
                    <p class="d-flex"><span class="label-width"><strong>Biaya Service 3rd Party :</strong></span> <span
                            id="modal-biaya-serviceout"></span></p>
                    <br>
                    <p class="d-flex"><span class="label-width"><strong><i class="fas fa-file-invoice-dollar"></i> Total
                                Biaya :</strong></span> <span id="modal-total-biaya"></span></p>
                    <hr>
                    <p class="d-flex"><span class="label-width"><strong><i class="fas fa-calendar-check"></i> Estimasi
                                Selesai :</strong></span> <span id="modal-tanggal-estimasi"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal untuk Menambahkan Order Baru -->
    <div class="modal fade" id="addOrderModal" tabindex="-1" role="dialog" aria-labelledby="addOrderModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addOrderModalLabel">Add New Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('customer/order/store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <!-- Nama Customer -->
                        <div class="form-group">
                            <label for="customer_name">Customer Name</label>
                            {{-- <input type="text" class="form-control" id="customer_name" name="customer_name"
                                value="{{ Auth::user()->name }}" readonly> --}}
                            <p id="customer_name" name="customer_name">{{ Auth::user()->name }}</p>
                        </div>

                        <!-- Email Customer -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            {{-- <input type="email" class="form-control" id="email" name="email"
                                value="{{ Auth::user()->email }}" readonly> --}}
                            <p id="email" name="email">{{ Auth::user()->email }}</p>
                        </div>

                        <!-- Telepon -->
                        <div class="form-group">
                            <label for="telepon">Phone Number</label>
                            <p id="telepon" name="telepon">{{ Auth::user()->telepon }}</p>
                        </div>

                        <!-- Alamat -->
                        <div class="form-group">
                            <label for="alamat">Address</label>
                            <p id="alamat" name="alamat">{{ Auth::user()->alamat }}</p>
                        </div>

                        <!-- Layanan (Dropdown dengan Select2) -->
                        <div class="form-group">
                            <label for="layanan_id">Service</label>
                            <select class="form-control select2" id="layanan_id" name="layanan_id" required>
                                <option value="" disabled selected>Select Service</option>
                                @foreach ($layanans as $layanan)
                                    <option value="{{ $layanan->id }}">{{ $layanan->nama_layanan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Deskripsi Masalah -->
                        <div class="form-group">
                            <label for="deskripsi_masalah">Issue Description</label>
                            <textarea class="form-control" id="deskripsi_masalah" name="deskripsi_masalah" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal untuk Edit Order -->
    <div class="modal fade" id="editOrderModal" tabindex="-1" role="dialog" aria-labelledby="editOrderModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editOrderModalLabel">Edit Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('customer/order/update') }}" method="POST" id="editOrderForm">
                    @csrf
                    @method('PUT') <!-- Gunakan PUT untuk update -->
                    <div class="modal-body">
                        <!-- Nama Customer (readonly) -->
                        <div class="form-group">
                            <label for="edit_customer_name">Customer Name</label>
                            <input type="text" class="form-control" id="edit_customer_name" name="customer_name"
                                readonly>
                        </div>

                        <!-- Email Customer (readonly) -->
                        <div class="form-group">
                            <label for="edit_email">Email</label>
                            <input type="email" class="form-control" id="edit_email" name="email" readonly>
                        </div>

                        <!-- Telepon -->
                        <div class="form-group">
                            <label for="edit_telepon">Phone Number</label>
                            <input type="text" class="form-control" id="edit_telepon" name="telepon" required>
                        </div>

                        <!-- Alamat -->
                        <div class="form-group">
                            <label for="edit_alamat">Address</label>
                            <input type="text" class="form-control" id="edit_alamat" name="alamat" required>
                        </div>

                        <!-- Layanan (Dropdown dengan Select2) -->
                        <div class="form-group">
                            <label for="edit_layanan_id">Service</label>
                            <select class="form-control select2" id="edit_layanan_id" name="layanan_id" required>
                                <option value="" disabled>Select Service</option>
                                @foreach ($layanans as $layanan)
                                    <option value="{{ $layanan->id }}">{{ $layanan->nama_layanan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Deskripsi Masalah -->
                        <div class="form-group">
                            <label for="edit_deskripsi_masalah">Issue Description</label>
                            <textarea class="form-control" id="edit_deskripsi_masalah" name="deskripsi_masalah" rows="3" required></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Rating -->
    <div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="ratingModalLabel">Add Your Review</h5>
                    <h5 class="modal-title" id="viewModalLabel">
                        {{-- <i class="fas fa-tag"></i> <span id="modal-customer-name-title"></span>'s Order Detail --}}
                        <i class="fas fa-ticket-alt ml-3"></i> <span id="modal-order-id-customer"></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form action="{{ url('customer/orderRatingStore/') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Rating -->
                        <div class="rating">
                            <input type="radio" id="star-5" name="ratingValue" value="5" required>
                            <label for="star-5">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path pathLength="360"
                                        d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z">
                                    </path>
                                </svg>
                            </label>
                            <input type="radio" id="star-4" name="ratingValue" value="4">
                            <label for="star-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path pathLength="360"
                                        d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z">
                                    </path>
                                </svg>
                            </label>
                            <input type="radio" id="star-3" name="ratingValue" value="3">
                            <label for="star-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path pathLength="360"
                                        d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z">
                                    </path>
                                </svg>
                            </label>
                            <input type="radio" id="star-2" name="ratingValue" value="2">
                            <label for="star-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path pathLength="360"
                                        d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z">
                                    </path>
                                </svg>
                            </label>
                            <input type="radio" id="star-1" name="ratingValue" value="1">
                            <label for="star-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path pathLength="360"
                                        d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z">
                                    </path>
                                </svg>
                            </label>
                        </div>

                        <!-- Ulasan -->
                        <div class="form-group mb-3">
                            <textarea class="form-control" id="reviewText" name="reviewText" rows="4"
                                placeholder="Write or update your rating and review here" required></textarea>
                        </div>

                        <!-- Tombol Kirim -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('userscript')
    <!-- Select2 JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <!-- Initialize Select2 -->
    <script>
        // Inisialisasi Select2 ketika modal ditampilkan
        $('#addOrderModal').on('shown.bs.modal', function() {
            $('#layanan_id').select2({
                theme: 'default', // Pilihan tema default
                dropdownParent: $('#addOrderModal') // Agar dropdown tampil di dalam modal
            });
        });

        // Menampilkan data order di modal edit
        $(document).ready(function() {
            // Menampilkan data order di modal edit
            $('.edit-button').on('click', function() {
                var orderId = $(this).data('order-id');
                $.ajax({
                    url: '/customer/order/edit/' + orderId, // Ganti dengan URL yang sesuai
                    type: 'GET',
                    success: function(response) {
                        // Isi data di dalam form modal dengan data order
                        $('#edit_customer_name').val(response.order.name);
                        $('#edit_email').val(response.order.email);
                        $('#edit_telepon').val(response.order.telepon);
                        $('#edit_alamat').val(response.order.alamat);
                        $('#edit_layanan_id').val(response.order.layanan_id).trigger('change');
                        $('#edit_deskripsi_masalah').val(response.order.deskripsi_masalah);

                        // Update form action untuk submit
                        $('#editOrderForm').attr('action', '/customer/order/update/' + orderId);

                        // Tampilkan modal
                        $('#editOrderModal').modal('show');
                    }
                });
            });
        });
    </script>


    {{-- sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Sweet alert for delete confirmation
        $('.delete-confirm').click(function(e) {
            e.preventDefault(); // Mencegah form terkirim otomatis
            var form = $(this).closest('form'); // Mendapatkan form yang terkait dengan tombol delete
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Mengirim form setelah konfirmasi
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                }
            });
        });

        // Filter functionality
        $('#filterForm').submit(function(e) {
            e.preventDefault();

            var customerName = $('input[name="customer_name"]').val().toLowerCase();
            var serviceName = $('select[name="service_name"]').val().toLowerCase(); // Dapatkan nilai dari select
            var status = $('select[name="status"]').val();

            $('.customer-card').show(); // Tampilkan semua secara default
            $('.customer-card').filter(function() {
                var matchCustomer = $(this).data('customer-name').indexOf(customerName) !== -1;
                var matchService = serviceName ? $(this).data('service-name').indexOf(serviceName) !== -1 :
                    true; // Update filter untuk service
                var matchStatus = status ? $(this).data('status') == status : true;

                return !(matchCustomer && matchService && matchStatus);
            }).hide();
        });


        // Modal for view details
        $('.view-detail').click(function() {
            var namaCustomerTitle = $(this).data('nama-customer-title');
            var OrderIdCustomer = $(this).data('order-id-customer');
            var namaCustomer = $(this).data('nama-customer');
            var namaLayanan = $(this).data('nama-layanan');
            var status = $(this).data('status');
            var telepon = $(this).data('telepon');
            var email = $(this).data('email');
            var alamat = $(this).data('alamat');
            var keluhan = $(this).data('keluhan');
            var serviceInsNote = $(this).data('serviceins-note');
            var perbaikan = $(this).data('perbaikan');
            var vendorName = $(this).data('serviceouts-vendor');
            var serviceOutsNote = $(this).data('serviceouts-note');
            var biayaServiceOut = $(this).data('serviceouts-biaya');
            var totalBiaya = $(this).data('total');
            var tanggalEstimasi = $(this).data('tanggal-estimasi');
            var hargaServiceIn = $(this).data('serviceins-harga'); // Tambahkan ini

            // Set data ke elemen di modal
            $('#modal-customer-name-title').text(namaCustomerTitle);
            $('#modal-order-id-customer').text(OrderIdCustomer);
            $('#modal-customer-name').text(namaCustomer);
            $('#modal-layanan').text(namaLayanan);
            $('#modal-status').text(
                status == 0 ? "Waiting..." :
                status == 1 ? "Rejected" :
                status == 2 ? "Accepted" :
                status == 3 ? "On Process..." :
                "Finished"
            );
            $('#modal-telepon').text(telepon);
            $('#modal-email').text(email);
            $('#modal-alamat').text(alamat);
            $('#modal-keluhan').text(keluhan);
            $('#modal-serviceins-note').text(serviceInsNote);

            // Kondisi untuk kolom perbaikan_pihak_ketiga
            if (perbaikan == 2) {
                $('#modal-vendor-name').text('-');
                $('#modal-serviceouts-note').text('-');
                $('#modal-biaya-serviceout').text('-');
            } else if (perbaikan == 0 || perbaikan == 1) {
                $('#modal-vendor-name').text(vendorName ? vendorName : '(waiting...)');
                $('#modal-serviceouts-note').text(serviceOutsNote ? serviceOutsNote : '(waiting...)');
                $('#modal-biaya-serviceout').text(biayaServiceOut ? 'Rp. ' + Number(biayaServiceOut).toLocaleString(
                    'id-ID') : '(waiting...)');
            }

            // Ubah di sini untuk harga service in dan total biaya
            $('#modal-harga-servicein').text(hargaServiceIn ? 'Rp. ' + Number(hargaServiceIn).toLocaleString(
                'id-ID') : '-');
            $('#modal-total-biaya').text(totalBiaya ? 'Rp. ' + Number(totalBiaya).toLocaleString('id-ID') : '-');
            $('#modal-tanggal-estimasi').text(
                tanggalEstimasi ? new Date(tanggalEstimasi).toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                }) : '- (belum diperkirakan)'
            );
        });

        

        // Modal for rating details
        // $('.view-rating').click(function() {
            
        //     var OrderIdCustomer = $(this).data('order-id-customer');
            
        //     $('#modal-order-id-customer').text(OrderIdCustomer);

        // });
    </script>
@endpush
