@extends('layouts.app')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Service Request</h1>
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
                        <form method="POST" action="{{ url('customer/order/update/'  . $order->id) }}">
                            @csrf
                            @method('POST')
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
                                    <label for="layanan_id">Layanan</label>
                                    <select name="layanan_id" id="layanan_id" class="form-control" required>
                                        <option value="">Pilih Layanan</option>
                                        @foreach($layanans as $layanan)
                                            <option value="{{ $layanan->id }}" {{ $layanan->id == $order->layanan_id ? 'selected' : '' }}>
                                                {{ $layanan->nama_layanan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                        
                                <div class="form-group">
                                    <label for="deskripsi_masalah">Deskripsi Masalah</label>
                                    <textarea style="height: 50rem" name="deskripsi_masalah" id="deskripsi_masalah" class="form-control" required>{{ $order->deskripsi_masalah }}</textarea>
                                </div>
                        
                                {{-- <div class="form-group">
                                    <label for="telepon">Telepon</label>
                                    <input type="text" name="telepon" id="telepon" class="form-control" value="{{ old('telepon', Auth::user()->telepon) }}" required>
                                </div> --}}
                        
                                {{-- <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control" required>{{ old('alamat') }}</textarea>
                                </div> --}}
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
