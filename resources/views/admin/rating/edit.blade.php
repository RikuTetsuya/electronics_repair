@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Admin</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ url('admin/rating/list') }}" class="btn btn-secondary">Back to List</a>
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
                            <form action="{{ url('customer/updateRatingOrder/' . $ratings->id) }}" method="POST">
                                @csrf
                                @method('POST')

                                <!-- Rating -->
                                <!-- Rating -->
                                <div class="rating d-flex justify-content-center">
                                    @for ($i = 5; $i >= 1; $i--)
                                        <input type="radio" id="star-{{ $i }}" name="ratingValue"
                                            value="{{ $i }}"
                                            {{ old('ratingValue', $ratings->rating ?? '') == $i ? 'checked' : '' }}
                                            required>
                                        <label for="star-{{ $i }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path pathLength="360"
                                                    d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z">
                                                </path>
                                            </svg>
                                        </label>
                                    @endfor
                                </div>

                                <!-- Ulasan -->
                                <div class="form-group mt-3">
                                    <textarea class="form-control" id="reviewText" name="reviewText" rows="3"
                                        placeholder="Write or update your rating and review here" required>{{ old('reviewText', $reportins->feedback ?? '') }}</textarea>
                                </div>

                                <!-- Tombol Kirim -->
                                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-stars"></i> Submit</button>
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
