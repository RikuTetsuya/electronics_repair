@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
@endpush

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>

    <script>
        $(document).ready(function() {
            let table = $('#example1').DataTable({
                responsive: true,
                autoWidth: false,
                scrollX: true,
                scrollCollapse: true,
                lengthChange: true,
                pageLength: 10,
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i> Copy',
                        className: 'btn btn-primary'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i> CSV',
                        className: 'btn btn-success'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        className: 'btn btn-info'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        className: 'btn btn-danger'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i> Print',
                        className: 'btn btn-warning'
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fas fa-eye"></i> Column Visibility',
                        className: 'btn btn-secondary'
                    }
                ]
            });

            // Tambahkan tombol ke dalam DataTable
            table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush

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
                            {{-- <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $jumlahMitra }}</h3>
                                <p>Total Company Partner</p>
                            </div>
                            <div class="icon">
                                {{-- <i class="ion ion-person"></i> --}}
                                <i class="fas fa-atom"></i>
                            </div>
                            {{-- <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a> --}}
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
                            {{-- <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a> --}}
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
                            {{-- <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $jumlahWaiting }}</h3>
                                <p>Waiting</p>
                            </div>
                            <div class="icon">
                                {{-- <i class="ion ion-log-out"></i> --}}
                            </div>
                            {{-- <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $jumlahRejected }}</h3>
                                <p>Rejected</p>
                            </div>
                            <div class="icon">
                                {{-- <i class="ion ion-log-out"></i> --}}
                            </div>
                            {{-- <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{ $jumlahAccepted }}</h3>
                                <p>Accepted</p>
                            </div>
                            <div class="icon">
                                {{-- <i class="ion ion-log-out"></i> --}}
                            </div>
                            {{-- <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $jumlahOnProcess }}</h3>
                                <p>Ongoing</p>
                            </div>
                            <div class="icon">
                                {{-- <i class="ion ion-log-out"></i> --}}
                            </div>
                            {{-- <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $jumlahFinished }}</h3>
                                <p>Finished</p>
                            </div>
                            <div class="icon">
                                {{-- <i class="ion ion-log-out"></i> --}}
                            </div>
                            {{-- <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
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
                                                <table id="example1" class="table table-striped" style="text-align: left; width: 100%">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Customer</th>
                                                            <th>Selected Service</th>
                                                            
                                                            <th>Data</th>
                                                            {{-- <th>3rd Party </th> --}}
                                                            <th>Total Amount</th>
                                                            <th>Payday</th>
                                                            <th>Method</th>
                                                            {{-- <th>Invoice</th> --}}
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
                                                                    <p>{{ $val->order_id }}</p>
                                                                </td>
                                                                <td>
                                                                    <p>{{ $val->nama_layanan }}</p>
                                                                    <p>{{ \Carbon\Carbon::parse($val->tanggal_masuk)->translatedFormat('d F Y') }}
                                                                    </p>
                                                                </td>
                                                                
                                                                <td>
                                                                    <p>Service In : IDR. {{ number_format($val->harga, 2, ',', '.') }}</p>
                                                                    <p>Service Out : IDR. {{ number_format($val->biaya, 2, ',', '.') }}</p>
                                                                    
                                                                </td>
                                                                <td>
                                                                    IDR.
                                                                    {{ number_format($val->total_harga, 2, ',', '.') }}
                                                                </td>
                                                                <td>
                                                                  {{ \Carbon\Carbon::parse($val->updated_at)->translatedFormat('d F Y') }}
                                                                </td>

                                                                <td>
                                                                  @if ($val->status_payment === 'Unpaid')
                                                                      <span style="color: red;">Unpaid</span>
                                                                  @elseif ($val->status_payment === 'Paid')
                                                                      <span style="color: green;">e-Payment</span>
                                                                  @elseif ($val->status_payment === 'Paid in Cash')
                                                                      <span style="color: green;">Cash</span>
                                                                  @endif
                                                              </td>
                                                                {{-- <td>
                                                                    @if ($val->status == 4)
                                                                        <a href="#" class="btn btn-warning"
                                                                            title="Make Invoice"><i
                                                                                class="fas fa-file-invoice-dollar"></i></a>
                                                                    @else
                                                                        <span class="badge badge-danger">Unfinished
                                                                            Order</span>
                                                                    @endif
                                                                </td> --}}
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
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.2.2/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.5/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.5/js/buttons.colVis.min.js"></script> --}}

    
@endpush
