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
            <a href="{{ url('admin/service_in/list') }}" class="btn btn-secondary">Back to List</a>
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
                <h3 class="card-title"><i class="fas fa-ticket-alt"> {{ $reportins->order_id }}</i></h3>
              </div>
              <!-- form start -->
              <form method="POST" action="{{ url('admin/service_in/update/' . $reportins->id) }}">
                @csrf
                @method('POST')
                <div class="card-body">
                  <div class="form-group">
                    <h5>{{ $reportins->nama_customer }}'s Order</h5>
                    
                  </div>
                  <div class="form-group">
                    <label for="nama_layanan">Jenis Layanan</label>
                    <p>{{ $reportins->nama_layanan }}</p>
                  </div>
                  <div class="form-group">
                    <label for="tanggal_masuk">Tanggal Masuk</label>
                    <p>{{ \Carbon\Carbon::parse($reportins->tanggal_masuk)->translatedFormat('d-F-Y') }}</p>
                  </div>
                  <div class="form-group">
                    <label for="deskripsi_masalah">Deskripsi Masalah</label>
                    <textarea style="height: 250px" class="form-control" name="deskripsi_masalah" rows="3" readonly>{{ $reportins->deskripsi_masalah }}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control" value="{{ $reportins->status }}">
                      <option value="0" {{ $reportins->status == 0 ? 'selected' : '' }}>Waiting...</option>
                      <option value="1" {{ $reportins->status == 1 ? 'selected' : '' }}>Rejected</option>
                      <option value="2" {{ $reportins->status == 2 ? 'selected' : '' }}>Accepted</option>
                      <option value="3" {{ $reportins->status == 3 ? 'selected' : '' }}>On Process...</option>
                      <option value="4" {{ $reportins->status == 4 ? 'selected' : '' }}>Finished</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="tanggal_estimasi">Tanggal Estimasi : </label>
                    <input type="date" name="tanggal_estimasi" 
                      value="{{ $reportins->tanggal_estimasi ? \Carbon\Carbon::parse($reportins->tanggal_estimasi)->format('Y-m-d') : '' }}" 
                      class="form-control">
                  </div>
                  <br>
                  <div class="form-group">
                    <label for="harga">Harga : </label>
                    <p>Rp. </p>
                    <input type="number" name="harga" value="{{ $reportins->harga }}" class="form-control" step="0.01">
                  </div>
                  <div class="form-group">
                    <label for="catatan">Catatan Perbaikan : </label>
                    <textarea style="height: 250px" class="form-control" name="catatan" rows="3">{{ $reportins->catatan }}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="perbaikan_pihak_ketiga">3rd Party : </label>
                    <select name="perbaikan_pihak_ketiga" class="form-control" value="{{ $reportins->perbaikan_pihak_ketiga }}">
                      <option value="0" {{ $reportins->perbaikan_pihak_ketiga == 0 ? 'selected' : '' }} disabled>Waiting...</option>
                      <option value="1" {{ $reportins->perbaikan_pihak_ketiga == 1 ? 'selected' : '' }}>Ya</option>
                      <option value="2" {{ $reportins->perbaikan_pihak_ketiga == 2 ? 'selected' : '' }}>Tidak</option>
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