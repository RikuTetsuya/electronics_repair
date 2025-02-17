@extends('layouts.app')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Status</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ url('admin/service_out/list') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
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
                        <!-- general form elements -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Edit Status Layanan</h3>
                            </div>
                            <!-- form start -->
                            <form method="POST" action="{{ url('admin/service_out/update/' . $reportouts->id) }}">
                                @csrf
                                @method('POST')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nama_customer">Deskripsi</label>
                                        <textarea style="height: 250px" class="form-control" name="deskripsi_masalah" rows="3" readonly>{{ $reportouts->deskripsi_masalah }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_layanan">Nama Vendor</label>
                                        {{-- <input type="text" class="form-control" name="vendor_name" value="{{ $reportouts->vendor_name }}"> --}}
                                        <select name="mitra_id" class="form-control select2">
                                            @foreach ($mitras as $val)
                                                <option value="{{ $val->mitra_id }}"
                                                    {{ $val->mitra_id == $reportouts->mitra_id ? 'selected' : '' }}>
                                                    {{ $val->nama_mitra }} - {{ $val->alamat }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_masuk">Tanggal Keluar</label>
                                        <input type="text" class="form-control" name="tanggal_keluar"
                                            value="{{ \Carbon\Carbon::parse($reportouts->tanggal_keluar)->format('d-m-Y') }}"
                                            disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_diterima">Tanggal Kembali</label>
                                        <input type="date" name="tanggal_diterima"
                                            value="{{ $reportouts->tanggal_diterima ? \Carbon\Carbon::parse($reportouts->tanggal_diterima)->format('Y-m-d') : '' }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="biaya">Biaya : </label>
                                        <p>Rp. </p>
                                        <input type="number" name="biaya" value="{{ $reportouts->biaya }}"
                                            class="form-control" step="0.01">
                                    </div>
                                    <div class="form-group">
                                        <label for="catatan">Catatan : </label>
                                        <textarea style="height: 250px" class="form-control" name="catatan" rows="3">{{ $reportouts->catatan }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="status_souts">Status</label>
                                        <select name="status_souts" class="form-control">
                                            <option value="0" {{ $reportouts->status_souts == 0 ? 'selected' : '' }}>
                                                Waiting...</option>
                                            <option value="1" {{ $reportouts->status_souts == 1 ? 'selected' : '' }}>
                                                On Process...</option>
                                            <option value="2" {{ $reportouts->status_souts == 2 ? 'selected' : '' }}>
                                                Finished</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
