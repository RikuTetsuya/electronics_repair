@extends('layouts.app')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Service Out</h1>
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
                <h3 class="card-title">Add Service Out</h3>
              </div>
              <!-- form start -->
              <form method="POST" action="{{ url('admin/service_out/store') }}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="service_in_id">Pilih Data Service In</label>
                    <select name="service_in_id" class="form-control select2">
                      @foreach($reportouts as $val)
                          <option disabled>-- Pilih Data --</option>
                          <option value="{{ $val->id }}">{{ $val->deskripsi_masalah }} - {{ $val->nama_layanan }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="mitra_id">Nama Vendor</label>
                    {{-- <input type="text" class="form-control" name="mitra_id" value="{{ old('mitra_id') }}"> --}}
                    <select name="mitra_id" class="form-control select2">
                      @foreach($mitras as $val)
                          <option value="{{ $val->mitra_id }}">
                            {{ $val->nama_mitra }} - {{ $val->alamat }}
                          </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="tanggal_keluar">Tanggal Keluar</label>
                    <input type="date" class="form-control" name="tanggal_keluar" value="{{ old('tanggal_keluar') }}" required>
                  </div>
                  <div class="form-group">
                    <label for="tanggal_diterima">Tanggal Diterima</label>
                    <input type="date" class="form-control" name="tanggal_diterima" value="{{ old('tanggal_diterima') }}">
                  </div>
                  <div class="form-group">
                    <label for="biaya">Biaya</label>
                    <input type="number" class="form-control" name="biaya" value="{{ old('biaya') }}" step="0.01">
                  </div>
                  <div class="form-group">
                    <label for="catatan">Catatan</label>
                    <textarea style="height: 250px" class="form-control" name="catatan">{{ old('catatan') }}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control">
                      <option value="0">Waiting...</option>
                      <option value="1">On Process...</option>
                      <option value="2">Finished</option>
                    </select>
                  </div>
                </div>

                <!-- card-footer -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection