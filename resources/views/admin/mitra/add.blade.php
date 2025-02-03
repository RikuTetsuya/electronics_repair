@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>New Mitra</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ url('admin/mitra/list') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <form method="POST" action="{{ url('admin/mitra/insert') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama Perusahaan Mitra</label>
                                        <input type="text" class="form-control" name="nama_mitra" required
                                            placeholder="Nama">
                                        
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea type="text" class="form-control" style="height: 250px" name="alamat" required placeholder="Alamat"></textarea>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
