@extends('layout_user.app')
@section('usercontent')

@push('usercss')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<style>
    /* Mengatur Select2 agar sudutnya lebih lancip */
.select2-container .select2-selection--single {
  height: 38px; /* Sesuaikan dengan tinggi elemen form lainnya */
  padding: 6px 12px;
  font-size: 14px; /* Sesuaikan ukuran font agar konsisten dengan form lain */
  border-radius: 4px; /* Ubah border-radius menjadi lebih kecil untuk sudut lebih lancip */
  border: 1px solid #ccc; /* Gunakan warna border yang sesuai dengan tema */
}

.select2-container--bootstrap4 .select2-selection__arrow {
  top: 7px; /* Menyesuaikan posisi panah dropdown */
  border-left: 1px solid #ccc; /* Sesuaikan dengan border tema */
}

.select2-dropdown {
  border-radius: 0px; /* Ubah border-radius dropdown menjadi lebih lancip */
  font-size: 14px; /* Menyesuaikan font size dengan tema */
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); /* Menambahkan bayangan yang lembut */
}

/* Menyesuaikan dengan warna tema Vesperr */
.select2-container--bootstrap4 .select2-selection--single {
  background-color: #f8f9fa; /* Warna latar belakang yang lebih terang */
  color: #495057; /* Warna teks yang lebih gelap agar serasi */
}

.select2-container--bootstrap4 .select2-results {
  max-height: 300px;
  overflow-y: auto;
}


</style>
@endpush

<main class="main">
      <section id="contact" class="contact section">
        <!-- Section Title -->
        <div class="container section-title text-center" data-aos="fade-up">
          <h2>Order</h2>
          <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->
  
        <div class="container position-relative d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-7">
            <form method="POST" action="{{ url('customer/order/store') }}" class="php-email-form p-4 shadow-sm rounded">
                @csrf
                <div class="row gy-4">
                    <div class="col-md-6">
                    <input type="text" class="form-control" id="nama_customer" name="nama_customer" value="{{ Auth::user()->name }}" readonly>
                    </div>
                    
                    <div class="col-md-6">
                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
                    </div>
                    
                    <div class="col-md-6">
                        <input type="text" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon" placeholder="Masukkan nomor telepon" value="{{ old('telepon') }}">
                        @error('telepon')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="col-md-12">
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" placeholder="Masukkan alamat">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <!-- Adding Select2 to the form -->
                    <div class="col-md-12">
                    <select name="layanan_id" class="form-control select2 @error('layanan_id') is-invalid @enderror" required="">
                        <option value="">-- Pilih Layanan --</option>
                        @foreach ($layanans as $layanan)
                            <option value="{{ $layanan->id }}">{{ $layanan->nama_layanan }}</option>
                        @endforeach
                    </select>
                    @error('layanan_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    </div>

                    <div class="col-md-12">
                        <textarea style="height: 250px" class="form-control @error('deskripsi_masalah') is-invalid @enderror" id="deskripsi_masalah" name="deskripsi_masalah" placeholder="Deskripsikan masalahnya">{{ old('deskripsi_masalah') }}</textarea>
                        @error('deskripsi_masalah')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <div class="col-md-12 text-center">
                    {{-- <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your message has been sent. Thank you!</div> --}}
    
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
  
                </div>
            </form>
          </div><!-- End Contact Form -->
        </div>
  
      </section><!-- /Contact Section -->
</main>

@endsection

@push('userscript')
    <!-- Select2 JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <!-- Initialize Select2 -->
    <script>
        $(document).ready(function() {
          // Menginisialisasi Select2 untuk elemen dengan class .select2
          $('.select2').select2({
            theme: 'default' // Pilihan tema klasik jika tema default terlihat berbeda
          });
        });
    </script>
      
@endpush