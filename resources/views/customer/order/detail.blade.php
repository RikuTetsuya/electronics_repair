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
        </style>

        <style>
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

        <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('midtrans.client_key') }}"></script>
        <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    @endpush

    <main class="main">

        <section id="order" class="dashboard section">
            <div class="container">
                <div class="row">
                    {{-- <div class="col-12 text-center mb-3">
                        <!-- Button Add Order -->
                        <a href="{{ url('customer/order/add') }}" class="btn btn-primary">
                          <i class="fas fa-cart-plus"></i> Add Order
                        </a>
                    </div> --}}
                    <div class="col-12 text-center mb-3">
                        <form action="" method="post">
                            @csrf
                            @method('GET')

                            @if ($reportins->status_payment === 'Paid')
                                <div><span class="text-success">Already Paid 😁</span></div>
                                <br>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ url('customer/order/') }}" class="btn btn-xs btn-danger">
                                        <i class="far fa-times-circle"></i> Back
                                    </a>
                                    <a href="{{ url('customer/invoice/' . $reportins->id) }}" target="_blank"
                                        class="btn btn-success" id="invoice-button">
                                        <i class="fas fa-file-invoice-dollar"></i> e-Invoice
                                    </a>

                                </div>
                            @elseif($reportins->status_payment === 'Paid in Cash')
                                <div><span class="text-success">Already Paid 😁</span></div>
                                <br>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ url('customer/order/') }}" class="btn btn-xs btn-danger">
                                        <i class="far fa-times-circle"></i> Back
                                    </a>
                                    <a href="{{ url('customer/invoice/' . $reportins->id) }}" target="_blank"
                                        class="btn btn-success" id="invoice-button">
                                        <i class="fas fa-file-invoice-dollar"></i> e-Invoice
                                    </a>

                                </div>
                            @elseif($reportins->status_payment === 'Unpaid')
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ url('customer/order/') }}" class="btn btn-xs btn-danger">
                                        <i class="far fa-times-circle"></i> Back
                                    </a>
                                    <button class="btn btn-success" id="pay-button">
                                        <i class="fas fa-hand-holding-usd"></i> Pay!
                                    </button>
                                    <a href="{{ url('customer/invoice/' . $reportins->id) }}" target="_blank"
                                        class="btn btn-warning" id="invoice-button">
                                        <i class="fas fa-file-invoice-dollar"></i> e-Invoice
                                    </a>
                                </div>
                                <br>
                            @endif
                        </form>
                    </div>
                    <div class="col-12">
                        <div class="burger-menu text-center" onclick="toggleDashboardCards()">
                            ☰ Show Stats
                        </div>
                    </div>
                    @include('_message')
                    <!-- Column for Order Statistics Cards (Narrower) -->
                    <div class="col-md-4" id="dashboardCards">
                        <div class="dashboard-section">
                            <!-- Card Order ID -->
                            <div class="dashboard-card card-primary text-center">
                                <i class="fas fa-ticket-alt"></i>
                                <h3 class="text-white">Order ID</h3>
                                <p>{{ $reportins->order_id }}</p>

                            </div>
                            <div class="dashboard-section mt-4">
                                <div class="card p-3">
                                    <h4 class="text-center">Reviews</h4>
                                    <p class="text-center">What people said about us</p>

                                    <form action="{{ url('customer/storeRatingOrder/' . $reportins->id) }}" method="POST">
                                        @csrf
                                        @method('POST')

                                        <!-- Rating -->
                                        <!-- Rating -->
                                        <div class="rating d-flex justify-content-center">
                                            @for ($i = 5; $i >= 1; $i--)
                                                <input type="radio" id="star-{{ $i }}" name="ratingValue"
                                                    value="{{ $i }}"
                                                    {{ old('ratingValue', $reportins->rating ?? '') == $i ? 'checked' : '' }}
                                                    required>
                                                <label for="star-{{ $i }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path pathLength="360"
                                                            d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z">
                                                        </path>
                                                    </svg>
                                                </label>
                                            @endfor
                                        </div>

                                        <!-- Ulasan -->
                                        <div class="form-group mt-3">
                                            <textarea class="form-control" id="reviewText" name="reviewText" rows="3"
                                                placeholder="Write or update your rating and review here" required>{{ old('reviewText', $reportins->feedback ?? '') }}</textarea>
                                        </div>

                                        <!-- Tombol Kirim -->
                                        <button type="submit" class="btn btn-primary w-100"><i class="bi bi-stars"></i> Submit</button>
                                    </form>
                                </div>
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

                                    <div class="card mb-3 customer-card"
                                        data-customer-name="{{ strtolower($reportins->name) }}"
                                        data-service-name="{{ strtolower($reportins->nama_layanan) }}"
                                        data-status="{{ $reportins->status }}">
                                        <div class="card-body">
                                            <h5 class="card-title mb-2">
                                                <i class="fas fa-ticket-alt"> {{ $reportins->order_id }}</i>
                                                <i class="fas fa-calendar" style="margin-left: 10px;"></i>
                                                {{ \Carbon\Carbon::parse($reportins->tanggal_masuk)->translatedFormat('d-F-Y') }}
                                                {{-- <i class="fas fa-tag" style="margin-left: 10px;"></i> {{ $reportins->name }}'s order 
                                            <i class="fas fa-user-circle" style="margin-left: 10px;"></i> {{ $reportins->email }} --}}
                                            </h5>

                                            {{-- <p class="card-text"><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($reportins->tanggal_masuk)->translatedFormat('d-F-Y') }}</p> --}}
                                            <hr>
                                            <strong class="card-text">
                                                <strong>Layanan</strong> {{ $reportins->nama_layanan }}
                                                @if ($reportins->status == 0)
                                                    <span class="badge badge-warning"
                                                        style="margin-left: 10px;">Waiting...</span>
                                                @elseif ($reportins->status == 1)
                                                    <span class="badge badge-danger"
                                                        style="margin-left: 10px;">Rejected</span>
                                                @elseif ($reportins->status == 2)
                                                    <span class="badge badge-primary"
                                                        style="margin-left: 10px;">Accepted</span>
                                                @elseif ($reportins->status == 3)
                                                    <span class="badge badge-info" style="margin-left: 10px;">On
                                                        Process...</span>
                                                @elseif ($reportins->status == 4)
                                                    <span class="badge badge-success"
                                                        style="margin-left: 10px;">Finished</span>
                                                @endif

                                                @if ($reportins->status_payment === 'Unpaid')
                                                    <span style="color: red;">Unpaid</span>
                                                @else
                                                    <span style="color: green;">Paid</span>
                                                @endif
                                            </strong>
                                            <hr>
                                            <p class="card-text"><i class="fas fa-phone-alt"></i>
                                                {{ $reportins->telepon }}
                                            </p>

                                            <p class="card-text"><i class="fas fa-wrench"></i> <strong>Perbaikan 3rd
                                                    Party </strong>
                                                @if ($reportins->perbaikan_pihak_ketiga == 0)
                                                    <span class="badge badge-warning">Waiting...</span>
                                                @elseif ($reportins->perbaikan_pihak_ketiga == 1)
                                                    <span class="badge badge-success">Needed</span>
                                                @elseif ($reportins->perbaikan_pihak_ketiga == 2)
                                                    <span class="badge badge-danger">No need</span>
                                                @endif
                                            </p>
                                            <p class="card-text"><i class="fas fa-calendar-check"></i> <strong>Estimasi
                                                    Selesai:</strong>
                                                {{ $reportins->tanggal_estimasi ? \Carbon\Carbon::parse($reportins->tanggal_estimasi)->translatedFormat('d-F-Y') : '- (belum diperkirakan)' }}
                                            </p>
                                            @if ($reportins->tanggal_estimasi)
                                                <?php
                                                $tanggalMasuk = \Carbon\Carbon::parse($reportins->tanggal_masuk);
                                                $tanggalEstimasi = \Carbon\Carbon::parse($reportins->tanggal_estimasi);
                                                $sisaHari = $tanggalEstimasi->diffInDays($tanggalMasuk);
                                                ?>
                                                @if ($sisaHari > 0)
                                                    <p>Selesai dalam {{ $sisaHari }} hari</p>
                                                @endif
                                            @endif

                                            {{-- @if ($reportins->status == 4)
                                                <a href="{{ url('customer/checkout/' . $reportins->order_id) }}"
                                                    class="btn btn-success">
                                                    <i class="fas fa-hand-holding-usd"></i> Pay
                                                </a>
                                            @elseif ($reportins->status == 0 || $reportins->status == 1 || $reportins->status == 2)
                                                <button type="button" class="btn btn-xs btn-success" disabled
                                                    title="BELUM BISA MELAKUKAN PEMBAYARAN">
                                                    <i class="fas fa-hand-holding-usd"></i> Pay
                                                </button>
                                            @endif --}}

                                            <button style="color: white" class="btn btn-xs btn-info view-detail"
                                                data-toggle="modal" data-target="#viewModal"
                                                data-nama-customer-title="{{ $reportins->name }}"
                                                data-order-id-customer="{{ $reportins->order_id }}"
                                                data-nama-customer="{{ $reportins->name }}"
                                                data-nama-layanan="{{ $reportins->nama_layanan }}"
                                                data-status="{{ $reportins->status }}"
                                                data-telepon="{{ $reportins->telepon }}"
                                                data-email="{{ $reportins->email }}"
                                                data-alamat="{{ $reportins->alamat }}"
                                                data-keluhan="{{ $reportins->deskripsi_masalah }}"
                                                data-serviceins-note="{{ $reportins->catatan }}"
                                                data-perbaikan="{{ $reportins->perbaikan_pihak_ketiga }}"
                                                data-serviceouts-vendor="{{ $reportins->nama_mitra }}"
                                                data-serviceouts-note="{{ $reportins->catatan_service_out }}"
                                                data-serviceins-harga="{{ $reportins->harga }}"
                                                data-serviceouts-biaya="{{ $reportins->biaya }}"
                                                data-total="{{ $reportins->total_biaya }}"
                                                data-tanggal-estimasi="{{ $reportins->tanggal_estimasi }}"><i
                                                    class="fa fa-eye"></i> View</button>
                                            {{-- <p style="color: red">Pastikan lakukan pembayaran di tempat kami. Jika berhalangan untuk datang, hubungi admin sebelum melakukan pembayaran untuk konfirmasi</p> --}}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section id="testimonials" class="testimonials section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Reviews</h2>
                <p>What people said about us</p>
                <div class="container mt-5">
                    {{-- <h2 class="mb-4">Tambah Ulasan</h2> --}}
                    <form action="{{ url('customer/main/rating/store') }}" method="POST">
                        @csrf
                        @method('POST')
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
                            <input type="radio" id="star-1" name="ratingValue" value="1x">
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
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </section><!-- /Testimonials Section -->
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
    </script>
@endpush
