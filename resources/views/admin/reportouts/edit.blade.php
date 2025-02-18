@extends('layouts.app')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Service Out</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ url('admin/service_out/list') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('_message')
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Edit Service Out</h3>
                            </div>

                            <form method="POST" action="{{ url('admin/service_out/update', $reportout->id) }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="service_in_id">Deskripsi Masalah</label>
                                        <input type="text" class="form-control"
                                            value="{{ $reportout->deskripsi_masalah }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_layanan">Layanan</label>
                                        <input type="text" class="form-control" value="{{ $reportout->nama_layanan }}"
                                            disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="mitra_id">Nama Vendor</label>
                                        <select name="mitra_id" class="form-control select2">
                                            @foreach ($mitras as $val)
                                                <option value="{{ $val->mitra_id }}"
                                                    {{ $reportout->mitra_id == $val->mitra_id ? 'selected' : '' }}>
                                                    {{ $val->nama_mitra }} - {{ $val->alamat }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_diterima">Tanggal Diterima</label>
                                        {{-- <input type="date" class="form-control" name="tanggal_diterima"
                                            value="{{ old('tanggal_diterima', $reportout->tanggal_diterima) }}"> --}}
                                        <input type="date" name="tanggal_diterima"
                                            value="{{ $reportout->tanggal_diterima ? \Carbon\Carbon::parse($reportout->tanggal_diterima)->format('Y-m-d') : '' }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="biaya">Biaya</label>
                                        <input type="number" class="form-control" name="biaya"
                                            value="{{ old('biaya', $reportout->biaya) }}" step="0.01">
                                    </div>
                                    <div class="form-group">
                                        <label for="catatan">Catatan</label>
                                        <textarea style="height: 250px" class="form-control" name="catatan">{{ old('catatan', $reportout->catatan) }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="0" {{ $reportout->status == 0 ? 'selected' : '' }}>
                                                Waiting...</option>
                                            <option value="1" {{ $reportout->status == 1 ? 'selected' : '' }}>On
                                                Process...</option>
                                            <option value="2" {{ $reportout->status == 2 ? 'selected' : '' }}>Finished
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
