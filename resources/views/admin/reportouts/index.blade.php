@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.5/css/buttons.bootstrap4.min.css">
@endpush

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Service Out</h1>
                </div>
                <div class="col-sm-6" style="text-align: right">
                    <a href="{{ url('admin/service_out/add') }}" class="btn btn-primary"><i class="fas fa-plus"></i> New Service</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('_message')
                    
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Filter</h3>
                        </div>
                        <div class="card-body">
                            <form id="filterForm">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nama Customer</label>
                                            <input type="text" class="form-control" name="customer_name" placeholder="Nama Customer">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Layanan</label>
                                            <select class="form-control" name="service_name">
                                                <option value="">Semua</option>
                                                @foreach($reportouts as $val)
                                                    <option value="{{ $val->nama_layanan }}">{{ $val->nama_layanan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="status">
                                                <option value="">Semua</option>
                                                <option value="0">Waiting...</option>
                                                <option value="1">Rejected</option>
                                                <option value="2">Accepted</option>
                                                <option value="3">On Process...</option>
                                                <option value="4">Finished</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Order List</h3>
                        </div>
                        <div class="card-body">
                            <div id="cardContainer">
                                @foreach ($reportouts as $val)
                                    <div class="card mb-3 customer-card" data-customer-name="{{ strtolower($val->nama_customer) }}" data-service-name="{{ strtolower($val->nama_layanan) }}" data-status="{{ $val->status }}">
                                        <div class="card-body">
                                            <h5 class="card-title mb-2">
                                                <i class="fas fa-tag"></i> {{ $val->nama_customer }}'s order 
                                                <i class="fas fa-user-circle" style="margin-left: 10px;"></i> {{ $val->email }}
                                            </h5>
                                            
                                            <p class="card-text"><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($val->tanggal_masuk)->translatedFormat('d-F-Y') }}</p>
                                            <hr>
                                            <strong class="card-text">
                                                <strong>Layanan</strong> {{ $val->nama_layanan }}
                                                @if ($val->status_service_out == 0)
                                                    <span class="badge badge-warning" style="margin-left: 10px;">Waiting...</span>
                                                @elseif ($val->status_service_out == 1)
                                                    <span class="badge badge-info" style="margin-left: 10px;">On Process...</span>
                                                @elseif ($val->status_service_out == 2)
                                                    <span class="badge badge-success" style="margin-left: 10px;">Finished</span>
                                                @endif
                                            </strong>
                                            <hr>
                                            <p class="card-text"><i class="fas fa-phone-alt"></i> {{ $val->telepon }}</p>
                                            
                                            {{-- <p class="card-text"><i class="fas fa-wrench"></i> <strong>Perbaikan 3rd Party </strong>
                                                @if ($val->perbaikan_pihak_ketiga == 0)
                                                    <span class="badge badge-warning">Waiting...</span>
                                                @elseif ($val->perbaikan_pihak_ketiga == 1)
                                                    <span class="badge badge-success">Needed</span>
                                                @elseif ($val->perbaikan_pihak_ketiga == 2)
                                                    <span class="badge badge-danger">No need</span>
                                                @endif
                                            </p> --}}
                                            <p class="card-text"><i class="fas fa-calendar-minus"></i> <strong>Tanggal Keluar:</strong> {{ $val->tanggal_keluar ? \Carbon\Carbon::parse($val->tanggal_keluar)->translatedFormat('d-F-Y') : '- (belum diperkirakan)' }}</p>
                                            <p class="card-text"><i class="fas fa-calendar-check"></i> <strong>Tanggal Kembali:</strong> {{ $val->tanggal_diterima ? \Carbon\Carbon::parse($val->tanggal_diterima)->translatedFormat('d-F-Y') : '- (barang belum kembali)' }}</p>
                                            @if ($val->tanggal_diterima)
                                              <?php
                                                  $tanggalKeluar = \Carbon\Carbon::parse($val->tanggal_keluar);
                                                  $tanggalDiterima = \Carbon\Carbon::parse($val->tanggal_diterima);
                                                  $sisaHari = $tanggalDiterima->diffInDays($tanggalKeluar);
                                              ?>
                                              @if ($sisaHari > 0)
                                                  <p>Barang dikembalikan dalam {{ $sisaHari }} hari</p>
                                              @endif
                                            @endif
                                            
                                            <button class="btn btn-xs btn-info view-detail" data-toggle="modal" data-target="#viewModal" 
                                            data-nama-customer-title="{{ $val->nama_customer }}"
                                            data-nama-customer="{{ $val->nama_customer }}" 
                                            data-nama-layanan="{{ $val->nama_layanan }}" 
                                            data-status="{{ $val->status_service_out }}" 
                                            data-telepon="{{ $val->telepon }}"
                                            data-email="{{ $val->email }}"
                                            data-alamat="{{ $val->alamat }}"

                                            data-keluhan="{{ $val->deskripsi_masalah }}"
                                            {{-- data-serviceins-note="{{ $val->catatan }}" --}}

                                            data-perbaikan="{{ $val->perbaikan_pihak_ketiga }}"
                                            data-serviceouts-vendor="{{ $val->vendor_name }}"
                                            data-serviceouts-note="{{ $val->catatan_service_out }}"

                                            data-serviceins-harga="{{ $val->harga }}"
                                            data-serviceouts-biaya="{{ $val->biaya }}"
                                            data-total="{{ $val->total_biaya }}"
                                            data-tanggal-estimasi="{{ $val->tanggal_estimasi }}"><i class="fa fa-eye"></i> View</button>

                                            <a href="{{ url('admin/service_out/edit/' . $val->id) }}" class="btn btn-xs btn-primary">
                                              <i class="fa fa-pencil-alt"></i> Edit
                                            </a>

                                            <form action="{{ url('delete_service_out/' . $val->id) }}" method="POST" style="display:inline;">
                                              @csrf
                                              <a class="delete-confirm btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash"></i> Delete</a>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal for Viewing Detail -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel"><i class="fas fa-tag"></i> <span id="modal-customer-name-title"></span>'s Order Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><i class="fas fa-user-circle"></i> <strong>Nama Customer:</strong> <span id="modal-customer-name"></span></p>
                <p><i class="fas fa-phone-alt"></i> <strong>Telepon:</strong> <span id="modal-telepon"></span></p>
                <p><i class="far fa-envelope"></i> <strong>Email:</strong> <span id="modal-email"></span></p>
                <p><i class="fas fa-map-marker-alt"></i> <strong>Alamat:</strong> <span id="modal-alamat"></span></p>
                <hr>
                <p><i class="fas fa-atom"></i> <strong>Layanan:</strong> <span id="modal-layanan"></span></p>
                <p><i class="fas fa-lightbulb"></i> <strong>Status:</strong> <span id="modal-status"></span></p>
                <hr>
                <p><i class="far fa-comment"></i> <strong>Keluhan:</strong> <br> <span id="modal-keluhan"></span></p>
                
                {{-- <p><i class="fas fa-wrench"></i> <strong>Perbaikan:</strong> <br> <span id="modal-serviceins-note"></span></p> --}}
                <hr>
                <p><i class="fas fa-file-export"></i> <strong>Perbaikan 3rd Party</strong> <i class="fas fa-wrench"></i> <span id="modal-perbaikan"></span></p>
                <p><strong>Vendor:</strong> <span id="modal-vendor-name"></span></p>
                <p><strong>Catatan Perbaikan 3rd Party:</strong> <span id="modal-serviceouts-note"></span></p>
                <hr>
                <p><strong><i class="fas fa-money-bill-wave"></i> Biaya </strong> <i class="fas fa-coins"></i></p>
                <p><strong>Biaya Service In:</strong> <span id="modal-harga-servicein"></span></p>
                <p><strong>Biaya Service 3rd Party:</strong> <span id="modal-biaya-serviceout"></span></p>
                <br>
                <p><strong><i class="fas fa-file-invoice-dollar"></i> Total Biaya:</strong> <span id="modal-total-biaya"></span></p>
                <hr>
                <p><strong><i class="fas fa-calendar-check"></i> Estimasi Selesai:</strong> <span id="modal-tanggal-estimasi"></span></p>
            </div>            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection  

@push('script')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Sweet alert for delete confirmation
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
            var matchService = serviceName ? $(this).data('service-name').indexOf(serviceName) !== -1 : true; // Update filter untuk service
            var matchStatus = status ? $(this).data('status') == status : true;

            return !(matchCustomer && matchService && matchStatus);
        }).hide();
    });


    // Modal for view details
    $('.view-detail').click(function() {
        var namaCustomerTitle = $(this).data('nama-customer-title');
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
        $('#modal-customer-name').text(namaCustomer);
        $('#modal-layanan').text(namaLayanan);
        $('#modal-status').text(
            status == 0 ? "Waiting..." :
            status == 1 ? "On Process..." :
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
            $('#modal-biaya-serviceout').text(biayaServiceOut ? 'Rp. ' + Number(biayaServiceOut).toLocaleString('id-ID') : '(waiting...)');
        }

        // Ubah di sini untuk harga service in dan total biaya
        $('#modal-harga-servicein').text(hargaServiceIn ? 'Rp. ' + Number(hargaServiceIn).toLocaleString('id-ID') : '-');
        $('#modal-total-biaya').text(totalBiaya ? 'Rp. ' + Number(totalBiaya).toLocaleString('id-ID') : '-');
        $('#modal-tanggal-estimasi').text(
            tanggalEstimasi ? new Date(tanggalEstimasi).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) : '- (belum diperkirakan)'
        );
    });



</script>

@endpush
