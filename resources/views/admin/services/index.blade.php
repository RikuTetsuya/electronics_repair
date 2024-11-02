@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.5/css/buttons.bootstrap4.min.css">
    
@endpush

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Service List</h1>
          </div>
          <div class="col-sm-6" style="text-align: right">
            <a href="{{ url('admin/service/add') }}" class="btn btn-primary"><i class="fas fa-plus"></i> New Service</a>
          </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      
      <div class="container-fluid">
        <div class="row">
          
          <!-- /.col -->
          <div class="col-md-12">
            
                <!-- general form elements -->
                {{-- <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Admin List</h3> <br>
                  </div>
                  <form method="GET" action="">
                    <div class="card-body">
                      <div class="row">
                        <div class="form-group col-md-3">
                          <label>Name</label>
                          <input type="text" class="form-control" value="" name="name" required placeholder="Name">
                        </div>  
                        <div class="form-group col-md-3 ">
                          <label>Email address</label>
                          <input type="email" class="form-control" value="" name="email" required placeholder="Email">
                        </div>
                      </div>
                    </div>
                  </form>
                </div> --}}
            @include('_message')
            
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Layanan</h3></h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-striped" style="text-align: left">
                  <thead> 
                    <tr>
                      <th></th>
                      <th>Layanan</th>
                      <th>Deskripsi</th>
                      {{-- <th>Prediksi Harga</th> --}}
                      <th>Status</th>
                      {{-- <th>Created Date</th> --}}
                      <th>Action</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $no = 1;
                    @endphp
                    @foreach ($services as $val)
                      <tr>
                        {{-- <td>{{ $val->id }}</td> --}}
                        <td>{{ $no++ }}</td>
                        <td>{{ $val->nama_layanan }}</td>
                        <td>{{ $val->deskripsi }}</td>
                        {{-- <td>Rp. {{ $val->harga }}</td> --}}
                        <td>
                          @if ($val->status == 1)
                              <span class="badge badge-success">Active/Enabled</span>
                          @else
                              <span class="badge badge-danger">Inactive/Disabled</span>
                          @endif
                        </td>
                        {{-- <td>{{ date('d-m-Y H:i A', strtotime($val->created_at)) }}</td> --}}
                        <td>
                          <a href="{{ url('admin/service/edit/' . $val->id) }}" class="btn btn-xs btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                          {{-- <a href="{{ url('admin/service/activate/' . $val->id) }}" class="btn btn-xs btn-info" title="Activate"><i class="fa fa-power-off"></i></a>
                          <a href="{{ url('admin/service/deactivate/' . $val->id) }}" class="btn btn-xs btn-warning" title="Diactivate"><i class="fa fa-power-off"></i></a> --}}
                        </td>
                        <td>
                          <form action="{{ url('delete_service/' . $val->id) }}" method="POST">
                            @csrf
                            <a class="delete-confirm btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                  
                </table>
              </div>
            </div>
              <!-- /.card-header -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection  

@push('script')
{{-- sweet alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  //sweet alert
  $('.delete-confirm').click(function(e) {
      var form = $(this).closest('form');
      console.log(form);
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
      console.log(id); //untuk cek apakah data id terkirim atau tidak
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
  })
</script>

{{-- datatables --}}
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.5/js/dataTables.bootstrap4.js"></script>

<script src="https://cdn.datatables.net/buttons/2.1.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.5/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.5/js/buttons.print.min.js"></script>

<script>
  new DataTable('#example1');
  // $(document).ready(function() {
  //   $('#example1').DataTable({
  //       "responsive": true,
  //       "lengthChange": false,
  //       "autoWidth": false,
  //       "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"] // Aktifkan tombol yang diinginkan
  //   }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  // });

  // $(function () {
  //   $("#example1").DataTable({
  //     "responsive": true, "lengthChange": false, "autoWidth": false,
  //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
  //   }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  //   $('#example2').DataTable({
  //     "paging": true,
  //     "lengthChange": false,
  //     "searching": false,
  //     "ordering": true,
  //     "info": true,
  //     "autoWidth": false,
  //     "responsive": true,
  //   });
  // });
  
  // $(document).ready(function () {
  //   // Setup - add a text input to each footer cell
  //   $('#example1 tfoot th').each(function (i) {
  //       var title = $('#example1 thead th').eq($(this).index()).text();
  //       $(this).html('<input type="text" style="border-radius: 5px; color: gray" placeholder="Search..." />');
  //   });

  //   // DataTable initialization
  //   var table = $('#example1').DataTable({
  //       scrollY: '300px',
  //       scrollX: true,
  //       scrollCollapse: true,
  //       paging: false,
  //       fixedColumns: true
  //   });

  //   // Filter event handler
  //   $(table.table().container()).on('keyup', 'tfoot input', function () {
  //       table
  //           .column($(this).data('index'))
  //           .search(this.value)
  //           .draw();
  //   });
  // });
</script>
@endpush