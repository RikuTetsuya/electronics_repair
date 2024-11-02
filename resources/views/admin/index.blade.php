@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Sub-Department List</h3>
                            <div class="card-tools">
                                <a href="{{ url('/tambah_sub_department') }}" class="btn btn-info"><i
                                        class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="col-12">
                                
                            </div>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>test</th>
                                        <th>test</th>
                                        <th>test</th>
                                        <th>test</th>
                                        <th>test</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        <tr>
                                            <th>test</th>
                                            <th>test</th>
                                            <th>test</th>
                                            <th>test</th>
                                            <th>test</th>
                                        </tr>
                                  
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
    <script src="adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="adminlte/plugins/jszip/jszip.min.js"></script>
    <script src="adminlte/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="adminlte/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
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
