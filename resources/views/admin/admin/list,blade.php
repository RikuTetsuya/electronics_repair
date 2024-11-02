@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.bootstrap4.css"> 
@endpush
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Admin List [ Total : {{ $getRecord->total() }} Admin(s) ]</h3>
                            <div class="card-tools">
                                <a href="{{ url('/tambah_sub_department') }}" class="btn btn-info"><i
                                        class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table id="example1" class="table table-striped">
                                <thead>
                                    <tr>
                                        {{-- <th>#</th> --}}
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Created (Logged) Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($getRecord as $val)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $val->email }}</td>
                                            <td>
                                                @if ($val->is_delete == 0)
                                                    <span class="badge badge-success">Active/Enabled</span>
                                                @else
                                                    <span class="badge badge-danger">Nonactive/Disabled</span>
                                                @endif
                                            </td>
                                            <td>{{ $val->created_at }}</td>
                                            <td>
                                                <a href="{{ url('admin/admin/edit/' . $val->id) }}" class="btn btn-xs btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                                                <a href="{{ url('admin/admin/activate/' . $val->id) }}" class="btn btn-xs btn-info" title="Activate"><i class="fa fa-power-off"></i></a>
                                                <a href="{{ url('admin/admin/deactivate/' . $val->id) }}" class="btn btn-xs btn-warning" title="Diactivate"><i class="fa fa-power-off"></i></a>
                                            </td>
                                            <td>
                                                <form action="{{ url('delete_admin/' . $val->id) }}" method="POST">
                                                  @csrf
                                                  <a class="delete-confirm btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    
    {{-- modal view --}}
    <div class="modal fade" id="modal-department">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Default Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="load_detail">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@push('script')
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="backend/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="backend/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="backend/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="backend/plugins/jszip/jszip.min.js"></script>
    <script src="backend/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="backend/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="backend/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="backend/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="backend/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.bootstrap4.js"></script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush
