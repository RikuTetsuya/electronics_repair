@extends('layouts.app')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Service Request</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ url('customer/') }}" class="btn btn-secondary">Back to List</a>
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
                        <form method="POST" action="{{ url('customer/order/store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama_customer">Nama Customer</label>
                                    <input type="text" class="form-control" id="nama_customer" name="nama_customer" value="{{ Auth::user()->name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="telepon">Nomor Telepon</label>
                                    <input type="text" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon" placeholder="Masukkan nomor telepon" value="{{ old('telepon') }}">
                                    @error('telepon')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" placeholder="Masukkan alamat">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="layanan_id">Pilih Layanan</label>
                                    <select name="layanan_id" class="form-control @error('layanan_id') is-invalid @enderror">
                                        <option value="">-- Pilih Layanan --</option>
                                        @foreach ($layanans as $layanan)
                                            <option value="{{ $layanan->id }}">{{ $layanan->nama_layanan }}</option>
                                        @endforeach
                                    </select>
                                    @error('layanan_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi_masalah">Deskripsi Masalah</label>
                                    <textarea style="height: 250px" class="form-control @error('deskripsi_masalah') is-invalid @enderror" id="deskripsi_masalah" name="deskripsi_masalah" placeholder="Deskripsikan masalahnya">{{ old('deskripsi_masalah') }}</textarea>
                                    @error('deskripsi_masalah')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection
