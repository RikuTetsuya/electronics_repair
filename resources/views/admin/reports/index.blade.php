@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.5/css/buttons.bootstrap4.min.css">
@endpush

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Report</h1>
          </div>
          <div class="col-sm-6" style="text-align: right">
            {{-- <a href="{{ url('admin/service/add') }}" class="btn btn-primary"><i class="fas fa-plus"></i> New Service</a> --}}
          </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      
      <div class="container-fluid">
        <div class="row">
          
          <!-- /.col -->
          <div class="col-md-12">
            
            @include('_message')
            
            <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Laporan Service Keseluruhan</h3>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-striped" style="text-align: left">
                    <thead> 
                      <tr>
                        <th></th>
                        <th>Identitas Customer</th>
                        <th>Layanan/Tanggal Laporan</th>
                        {{-- <th>Keluhan Customer</th> --}}
                        <th>Status</th>
                        <th>Estimasi Selesai</th>
                        {{-- <th>Catatan Perbaikan</th> --}}
                        <th>Harga</th>
                        <th>Perbaikan 3rd Party</th>
                        {{-- <th>Catatan Perbaikan 3rd Party</th> --}}
                        <th>Total Biaya</th>
                        <th>Buat Invoice</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $no = 1;
                      @endphp
                      @foreach ($report as $val)
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>
                            <p>{{ $val->nama_customer }}</p>
                            <p>{{ $val->email }}</p>
                            <p>{{ $val->telepon }}</p>
                            <p>{{ $val->alamat }}</p>
                          </td>
                          <td>
                            <p>{{ $val->nama_layanan }}</p>
                            <p>{{ \Carbon\Carbon::parse($val->tanggal_masuk)->format('d-m-Y') }}</p>
                          </td>
                          {{-- <td class="truncate-text">{{ $val->deskripsi_masalah }}</td> --}}
                          <td>
                            @if ($val->status == 0)
                                <span class="badge badge-warning">Waiting...</span>
                            @elseif ($val->status == 1)
                                <span class="badge badge-danger">Rejected</span>
                            @elseif ($val->status == 2)
                                <span class="badge badge-primary">Accepted</span>
                            @elseif ($val->status == 3)
                                <span class="badge badge-info">On Process...</span>
                            @elseif ($val->status == 4)
                                <span class="badge badge-success">Finished</span>
                            @endif
                          </td>
                          <td>
                            @if ($val->tanggal_estimasi)
                              {{ \Carbon\Carbon::parse($val->tanggal_estimasi)->format('d-m-Y') }}
                              
                            @else
                              -
                            @endif
                          </td>
                          {{-- <td>{{ $val->catatan }}</td> --}}
                          <td>
                            @if (is_null($val->harga) || $val->harga === '')
                              <p>(not counted yet...)</p>
                            @else
                              Rp. {{ number_format($val->harga, 2, ',', '.') }}
                            @endif
                          </td>
                          <td>
                              @if ($val->perbaikan_pihak_ketiga == 0)
                                  <span class="badge badge-warning">Waiting...</span>
                              @elseif ($val->perbaikan_pihak_ketiga == 1)
                                  <span class="badge badge-success">Needed</span>                        
                              @elseif ($val->perbaikan_pihak_ketiga == 2)
                                  <span class="badge badge-danger">No need</span>
                              @endif

                              @if ($val->perbaikan_pihak_ketiga == 0)
                                  <p>waiting...</p>
                              @elseif ($val->perbaikan_pihak_ketiga == 1)
                                  <p><strong>Nama Vendor:</strong> <br> {{ $val->vendor_name ?? 'N/A' }}</p>
                                  <p><strong>Biaya:</strong> <br> {{ $val->biaya ? 'Rp. '.number_format($val->biaya, 2, ',', '.') : 'N/A' }}</p>
                                  {{-- <p><strong>Catatan:</strong> <br> {{ $val->catatan_service_out ?? 'N/A' }}</p> --}}
                              @elseif ($val->perbaikan_pihak_ketiga == 2)
                                  <p> (Tidak memerlukan perbaikan pihak ketiga...)</p>
                              @endif
                          </td>
                          <td>
                              Rp. {{ number_format($val->total_biaya, 2, ',', '.') }}
                          </td>
                          <td>
                              @if ($val->status == 4)
                                  <a href="#" class="btn btn-xs btn-success" title="Make Invoice">Buat Invoice <i class="fas fa-file-invoice-dollar"></i></a>
                              @else
                                  <p>Pesanan belum selesai, belum bisa membuat invoice...</p>
                              @endif
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection  

@push('script')
{{-- truncate text deskripsi --}}
<script>
  $(document).ready(function() {
    var maxLength = 200; // Panjang maksimum deskripsi yang ditampilkan
    
    $('.truncate-text').each(function() {
      var text = $(this).text();
      if (text.length > maxLength) {
        var shortText = text.substr(0, maxLength) + '...';
        $(this).text(shortText);
      }
    });
  });
</script>

{{-- sweet alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  //sweet alert
  $('.delete-confirm').click(function(e) {
      var form = $(this).closest('form');
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
              form.submit();
              Swal.fire({
                  title: "Deleted!",
                  text: "Your file has been deleted.",
                  icon: "success"
              });
          }
      });
  });

  // send data to JS n AJAX 
  $('.show_detail').click(function() {
      var id = $(this).attr('id_dept');
      $.ajax({
          type: 'POST',
          url: '/department_detail',
          cache: false,
          data: {
              _token: "{{ csrf_token() }}",
              id_dept: id
          },
          success: function(respond) {
              $('#load_detail').html(respond);
          }
      });
      $('#modal-department').modal('show');
  });
</script>

{{-- datatables --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.2.2/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.5/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.5/js/buttons.colVis.min.js"></script>

<script>
  $(document).ready(function() {
    $('#example1').DataTable({
      responsive: true,
      autoWidth: false,
      scrollX: true,
      scrollCollapse: true,
      lengthChange: true, // Mengaktifkan opsi "entries per page"
      pageLength: 10, // Jumlah baris per halaman
      buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>

@endpush
