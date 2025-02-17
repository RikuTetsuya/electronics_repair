@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ $jumlahLayanan }}</h3>
                    <p>Total Services</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tools"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $jumlahCustomer }}</h3>
                    <p>Total Customers</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $jumlahServiceIn }}</h3>
                    <p>Total Service In</p>
                </div>
                <div class="icon">
                    <i class="ion ion-wrench"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $jumlahServiceOut }}</h3>
                    <p>Total Service Out</p>
                </div>
                <div class="icon">
                    <i class="ion ion-log-out"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    
        {{-- <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $jumlahAkunCustomer }}</h3>
                    <p>Total Customer Accounts</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div> --}}
    
        {{-- <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $jumlahAkunAdmin }}</h3>
                    <p>Total Admin Accounts</p>
                </div>
                <div class="icon">
                    <i class="ion ion-locked"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div> --}}
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          
          {{-- ISI TABEL --}}
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
                              {{-- <th>Estimasi Selesai</th> --}}
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
                                  <p>{{ $val->name }}</p>
                                  {{-- <p>{{ $val->email }}</p>
                                  <p>{{ $val->telepon }}</p>
                                  <p>{{ $val->alamat }}</p> --}}
                                </td>
                                <td>
                                  <p>{{ $val->nama_layanan }}</p>
                                  <p>{{ \Carbon\Carbon::parse($val->tanggal_masuk)->translatedFormat('d-F-Y') }}</p>
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
                                {{-- <td>
                                  @if ($val->tanggal_estimasi)
                                  {{ \Carbon\Carbon::parse($val->tanggal_estimasi)->translatedFormat('d-F-Y') }}
                                  @else
                                    -
                                  @endif
                                </td> --}}
                                {{-- <td>{{ $val->catatan }}</td> --}}
                                <td>
                                  @if (is_null($val->harga) || $val->harga === '')
                                    <p>(ain't counted yet...)</p>
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
                                    {{-- @elseif ($val->perbaikan_pihak_ketiga == 2)
                                        <p> (Tidak memerlukan perbaikan pihak ketiga...)</p> --}}
                                    @endif
                                </td>
                                <td>
                                    Rp. {{ number_format($val->total_biaya, 2, ',', '.') }}
                                </td>
                                <td>
                                    @if ($val->status == 4)
                                        <a href="#" class="btn btn-xs btn-success" title="Make Invoice">Buat Invoice <br><i class="fas fa-file-invoice-dollar"></i></a>
                                    @else
                                      <span class="badge badge-danger">Unfinished Order</span>
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
          
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          {{-- <section class="col-lg-5 connectedSortable">

            <!-- Map card -->
            <div class="card bg-gradient-primary">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-map-marker-alt mr-1"></i>
                  Visitors
                </h3>
                <!-- card tools -->
                <div class="card-tools">
                  <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                    <i class="far fa-calendar-alt"></i>
                  </button>
                  <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                <div id="world-map" style="height: 250px; width: 100%;"></div>
              </div>
              <!-- /.card-body-->
              <div class="card-footer bg-transparent">
                <div class="row">
                  <div class="col-4 text-center">
                    <div id="sparkline-1"></div>
                    <div class="text-white">Visitors</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <div id="sparkline-2"></div>
                    <div class="text-white">Online</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <div id="sparkline-3"></div>
                    <div class="text-white">Sales</div>
                  </div>
                  <!-- ./col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.card -->

            <!-- Calendar -->
            <div class="card bg-gradient-success">
              <div class="card-header border-0">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendar
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <!-- button with a dropdown -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                      <i class="fas fa-bars"></i>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a href="#" class="dropdown-item">Add new event</a>
                      <a href="#" class="dropdown-item">Clear events</a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item">View calendar</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section> --}}
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
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