@extends('layout_user.app')
@section('usercontent')
    <!-- Start Info Account Section -->
    <section id="account-info" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Profile Card -->
                <div class="col-lg-8 col-md-10 col-sm-12">
                    <div class="card shadow-sm rounded">
                        {{-- <div class="card-header text-center bg-primary text-white">
                            <h4>Profile</h4>
                        </div> --}}
                        <div class="card-body">
                            <div class="row">
                                <!-- Profile Picture Section (Optional) -->
                                <div class="col-md-4 text-center">
                                    <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg' }}"
                                        width="100" height="100" class="rounded-circle mb-2">
                                    <div class="mt-3">
                                        <!-- Tombol Ubah Gambar -->
                                        <button class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                            data-target="#changePictureModal">Change Picture</button>

                                        <!-- Tombol Hapus Gambar -->
                                        @if (Auth::user()->image)
                                            <form action="{{ url('customer/profile/delete-picture') }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-sm mt-2">Delete
                                                    Picture</button>
                                            </form>
                                        @endif

                                        <form action="{{ url('logout') }}" method="GET" class="mt-3">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-sm"><i
                                                    class="fas fa-sign-out-alt"></i>
                                                Sign Out</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- Profile Details -->
                                <div class="col-md-8">

                                    @include('_message')

                                    <h5 class="mb-3">Account Details</h5>
                                    <form action="{{ url('customer/profile/update') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Full Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ old('name', Auth::user()->name) }}" required>
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ old('email', Auth::user()->email) }}" required>
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="telepon">Phone Number</label>
                                            <input type="telepon" class="form-control" id="telepon" name="telepon"
                                                value="{{ old('telepon', Auth::user()->telepon) }}" required>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Info Account Section -->

    <!-- Modal Upload Gambar -->
    {{-- <div class="modal fade" id="changePictureModal" tabindex="-1" aria-labelledby="changePictureModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('customer/profile/upload-picture') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePictureModalLabel">Change Profile Picture</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="profile_picture">Upload New Picture</label>
                            <p>1x1 size image is recommended</p>
                            <input type="file" class="form-control-file" id="profile_picture" name="profile_picture"
                                accept="image/*" required>
                            @error('profile_picture')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

    <!-- Modal untuk Crop Gambar -->
    <div class="modal fade" id="changePictureModal" tabindex="-1" role="dialog" aria-labelledby="changePictureModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePictureModalLabel">Crop Profile Picture</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <input type="file" id="uploadImage" class="form-control mb-3">
                    <div class="img-container">
                        <img id="previewImage" src="" class="w-100">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="cropImage">Crop & Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('userscript')
    <!-- Cropper.js CSS -->
    <link href="https://cdn.jsdelivr.net/npm/cropperjs@1.5.13/dist/cropper.min.css" rel="stylesheet">
    <!-- Cropper.js JS -->
    <script src="https://cdn.jsdelivr.net/npm/cropperjs@1.5.13/dist/cropper.min.js"></script>

    <script>
        let cropper;
        const uploadImage = document.getElementById("uploadImage");
        const previewImage = document.getElementById("previewImage");

        // Tampilkan pratinjau gambar yang diunggah
        uploadImage.addEventListener("change", (event) => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = () => {
                    previewImage.src = reader.result;
                    if (cropper) cropper.destroy(); // Hancurkan instans sebelumnya
                    cropper = new Cropper(previewImage, {
                        aspectRatio: 1,
                        viewMode: 1,
                        preview: ".preview",
                    });
                };
                reader.readAsDataURL(file);
            }
        });

        // Simpan gambar setelah dipotong
        document.getElementById("cropImage").addEventListener("click", () => {
            cropper.getCroppedCanvas({
                width: 300,
                height: 300
            }).toBlob((blob) => {
                const formData = new FormData();
                formData.append("image", blob);
                formData.append("_token", "{{ csrf_token() }}");

                fetch("{{ url('customer/profile/upload-picture') }}", {
                        method: "POST",
                        body: formData,
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        location.reload(); // Refresh halaman
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                    });
            });
        });
    </script>

    <script>
        document.getElementById('logout-button').addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default link behavior
            Swal.fire({
                title: 'Are you sure?',
                text: "You will be logged out!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, log me out!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the logout form
                    document.getElementById('logout-form').submit();
                }
            });
        });
    </script>
@endpush
