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
                            @include('_message')
                            <h5 class="mb-3">Account Details</h5>
                                    <form action="{{ url('admin/profile/update') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Full Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                {{-- value="{{ old('name', Auth::user()->name) }}" required> --}}
                                                value="{{ Auth::user()->name }}" required>
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                {{-- value="{{ old('email', Auth::user()->email) }}" required> --}}
                                                value="{{ Auth::user()->email }}" required>
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="telepon">Phone Number</label>
                                            <input type="telepon" class="form-control" id="telepon" name="telepon"
                                                {{-- value="{{ old('telepon', Auth::user()->telepon) }}" required> --}}
                                                value="{{ Auth::user()->telepon }}" required>
                                            @error('telepon')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="alamat">Address</label>
                                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat', Auth::user()->alamat) }}</textarea>
                                            @error('alamat')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group text-right">
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                                Confirm Update</button>
                                        </div>
                                    </form>
                                    <h5 class="mb-3">Change Password</h5>
                                    <form action="{{ url('customer/profile/change-password') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="current_password">Current Password</label>
                                            <input type="password" class="form-control" id="current_password"
                                                name="current_password" required>
                                            @error('current_password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="new_password">New Password</label>
                                            <input type="password" class="form-control" id="new_password"
                                                name="new_password" required>
                                            @error('new_password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="new_password_confirmation">Confirm New Password</label>
                                            <input type="password" class="form-control" id="new_password_confirmation"
                                                name="new_password_confirmation" required>
                                        </div>

                                        <div class="form-group text-right">
                                            <button type="submit" class="btn btn-success"><i class="fas fa-lock"></i>
                                                Update Password</button>
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
