@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.5/css/buttons.bootstrap4.min.css">
@endpush

@push('script')
<!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
<script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script>
<!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
@endpush

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Checkout</h1>
                </div>
                <div class="col-sm-6" style="text-align: right">
                    <a href="{{ url('customer/') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('_message')
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <p>
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </p>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="fas fa-tag"></i> {{ $firstReportin->nama_customer }}'s Order Detail
                                {{-- <i class="fas fa-ticket-alt ml-3"> {{ $firstReportin->order_id }}</i> --}}
                                <span class="badge badge-success" style="margin-left: 10px;">Finished</span>
                            </h5>
                            <button type="button" class="close" data-dismiss="card" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="" method="post">
                            @csrf
                            @method('GET')
                            <div class="card-body">
                            <div class="form-group">
                                <label for="nama_layanan"><i class="fas fa-atom"></i> Jenis Layanan</label>
                                <p>{{ $firstReportin->nama_layanan }}</p>
                                <p class="card-text"><i class="fas fa-wrench"></i> <strong>Perbaikan 3rd Party </strong>
                                    @if ($firstReportin->perbaikan_pihak_ketiga == 0)
                                        <span class="badge badge-warning">Waiting...</span>
                                    @elseif ($firstReportin->perbaikan_pihak_ketiga == 1)
                                        <span class="badge badge-success">Needed</span>
                                    @elseif ($firstReportin->perbaikan_pihak_ketiga == 2)
                                        <span class="badge badge-danger">No need</span>
                                    @endif
                                </p>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_masuk"><i class="far fa-calendar"></i> Tanggal Masuk</label>
                                <p>{{ \Carbon\Carbon::parse($firstReportin->tanggal_masuk)->translatedFormat('d-F-Y') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_estimasi"> <i class="fas fa-calendar-check"></i> Tanggal Estimasi : </label>
                                <p>{{ \Carbon\Carbon::parse($firstReportin->tanggal_estimasi)->translatedFormat('d-F-Y') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_masalah">Deskripsi Masalah</label>
                                <textarea style="height: 250px" class="form-control" name="deskripsi_masalah" rows="3" readonly>{{ $firstReportin->deskripsi_masalah }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="catatan">Catatan Perbaikan : </label>
                                <textarea style="height: 250px" class="form-control" name="catatan" rows="3" disabled>{{ $firstReportin->catatan }}</textarea>
                            </div>
                            {{-- <strong class="card-text">
                                <strong>Layanan</strong> {{ $firstReportin->nama_layanan }}
                                @if ($firstReportin->status == 0)
                                    <span class="badge badge-warning" style="margin-left: 10px;">Waiting...</span>
                                @elseif ($firstReportin->status == 1)
                                    <span class="badge badge-danger" style="margin-left: 10px;">Rejected</span>
                                @elseif ($firstReportin->status == 2)
                                    <span class="badge badge-primary" style="margin-left: 10px;">Accepted</span>
                                @elseif ($firstReportin->status == 3)
                                    <span class="badge badge-info" style="margin-left: 10px;">On Process...</span>
                                @elseif ($firstReportin->status == 4)
                                    <span class="badge badge-success" style="margin-left: 10px;">Finished</span>
                                @endif
                            </strong> --}}
                            <br>
                            <div class="form-group">   
                                <label><i class="fas fa-money-bill-wave"></i> Detail Biaya <i class="fas fa-coins"></i></label>
                                
                                <p for="harga">Biaya Service In : Rp. {{ number_format($firstReportin->harga, 2, ',', '.') }}</p>
                                <p for="harga">Biaya Service 3rd Party : Rp. {{ number_format($firstReportin->biaya, 2, ',', '.') }}</p>
                                <hr>
                                <label for="harga">Total Biaya : Rp. {{ number_format($firstReportin->total_harga, 2, ',', '.') }}</label>
                            </div>
                            
                            
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <div><button class="btn btn-success" id="pay-button">Pay!</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection  

@push('script')
{{-- midtrans --}}
<script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function (e) {
        e.preventDefault(); // Cegah form dari pengiriman otomatis

        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function (result) {
                /* You may add your own implementation here */
                alert("payment success!");
                console.log(result);
            },
            onPending: function (result) {
                /* You may add your own implementation here */
                alert("waiting your payment!");
                console.log(result);
            },
            onError: function (result) {
                /* You may add your own implementation here */
                alert("payment failed!");
                console.log(result);
            },
            onClose: function () {
                /* You may add your own implementation here */
                alert('you closed the popup without finishing the payment');
            }
        });
    });
</script>
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
            var matchService = serviceName ? $(this).data('service-name').indexOf(serviceName) !== -1 : true; // Update filter untuk service
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
