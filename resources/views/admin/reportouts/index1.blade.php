@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
@endpush

@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Service Out</h1>
          </div>
          <div class="col-sm-6" style="text-align: right">
            <a href="{{ url('admin/service_out/add') }}" class="btn btn-primary"><i class="fas fa-plus"></i> New Service</a>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @include('_message')

            <!-- Filter -->
            <div class="mb-3">
              <input type="text" id="vendorInput" class="form-control" placeholder="Search by Vendor Name" onkeyup="filterCards()">
              <input type="text" id="descriptionInput" class="form-control mt-2" placeholder="Search by Description" onkeyup="filterCards()">
              <select id="statusSelect" class="form-control mt-2" onchange="filterCards()">
                <option value="">All Status</option>
                <option value="0">Waiting...</option>
                <option value="1">On Process...</option>
                <option value="2">Finished</option>
              </select>
              <input type="date" id="startDateInput" class="form-control mt-2" placeholder="Start Date" onchange="filterCards()">
              <input type="date" id="endDateInput" class="form-control mt-2" placeholder="End Date" onchange="filterCards()">
            </div>

            <div class="row" id="cardContainer">
              @foreach ($reportouts as $val)
                <div class="col-md-4 mb-3 card-item" data-status="{{ $val->status }}" data-tanggal_keluar="{{ \Carbon\Carbon::parse($val->tanggal_keluar)->format('Y-m-d') }}" data-tanggal_masuk="{{ \Carbon\Carbon::parse($val->tanggal_diterima)->format('Y-m-d') }}">
                  <div class="card border-primary shadow-sm" style="border-radius: 10px;">
                    <div class="card-body">
                      <h5 class="card-title">{{ $val->nama_customer }}</h5>
                      <p class="card-text"><strong>Deskripsi Masalah:</strong> {{ $val->nama_layanan }}</p>
                      <p class="card-text"><strong>Deskripsi Masalah:</strong> {{ $val->deskripsi_masalah }}</p>
                      <p class="card-text"><strong>Tanggal Keluar:</strong> {{ \Carbon\Carbon::parse($val->tanggal_keluar)->format('d-m-Y') }}</p>
                      <p class="card-text"><strong>Tanggal Diterima:</strong> {{ $val->tanggal_diterima ? \Carbon\Carbon::parse($val->tanggal_diterima)->format('d-m-Y') : '-' }}</p>
                      <p class="card-text"><strong>Biaya:</strong> {{ is_null($val->biaya) ? '(not counted yet...)' : 'Rp. ' . number_format($val->biaya, 2, ',', '.') }}</p>
                      <p class="card-text"><strong>Catatan:</strong> {{ $val->catatan }}</p>
                      <p class="card-text"><strong>Status:</strong> 
                        @if ($val->status == 0)
                          <span class="badge badge-warning">Waiting...</span>
                        @elseif ($val->status == 1)
                          <span class="badge badge-info">On Process...</span>
                        @elseif ($val->status == 2)
                          <span class="badge badge-success">Finished</span>
                        @endif
                      </p>
                      <div class="d-flex justify-content-between">
                        <a href="#" class="btn btn-info view-btn" data-id="{{ $val->id }}" data-toggle="modal" data-target="#viewModal"><i class="fas fa-eye"></i> View</a>
                        <a href="{{ url('admin/service_out/edit/' . $val->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ url('delete_service_out/' . $val->id) }}" method="POST" style="display:inline;">
                          @csrf
                          <a class="delete-confirm btn btn-danger" title="Delete">Delete</a>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>

          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Modal View -->
  <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Detail Service Out</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="modalContent">
                    <p><strong>Vendor Name:</strong> <span id="modalVendorName"></span></p>
                    <p><strong>Deskripsi Masalah:</strong> <span id="modalDescription"></span></p>
                    <p><strong>Tanggal Keluar:</strong> <span id="modalTanggalKeluar"></span></p>
                    <p><strong>Tanggal Diterima:</strong> <span id="modalTanggalDiterima"></span></p>
                    <p><strong>Biaya:</strong> <span id="modalBiaya"></span></p>
                    <p><strong>Catatan:</strong> <span id="modalCatatan"></span></p>
                    <p><strong>Status:</strong> <span id="modalStatus"></span></p>
                </div>
            </div>
        </div>
    </div>
  </div>



@endsection  

@push('script')
<script>
  // Filter function
  function filterCards() {
    var vendorInput = document.getElementById("vendorInput").value.toLowerCase();
    var descriptionInput = document.getElementById("descriptionInput").value.toLowerCase();
    var statusSelect = document.getElementById("statusSelect").value;
    var startDateInput = document.getElementById("startDateInput").value;
    var endDateInput = document.getElementById("endDateInput").value;
    
    var cardContainer = document.getElementById("cardContainer");
    var cards = cardContainer.getElementsByClassName("card-item");

    for (var i = 0; i < cards.length; i++) {
      var vendorName = cards[i].getElementsByClassName("card-title")[0].innerText.toLowerCase();
      var description = cards[i].getElementsByClassName("card-text")[0].innerText.toLowerCase();
      var cardStatus = cards[i].getAttribute("data-status");
      var cardTanggalKeluar = cards[i].getAttribute("data-tanggal_keluar");
      var cardTanggalMasuk = cards[i].getAttribute("data-tanggal_masuk");

      var isVendorMatch = vendorName.indexOf(vendorInput) > -1;
      var isDescriptionMatch = description.indexOf(descriptionInput) > -1;
      var isStatusMatch = statusSelect === "" || cardStatus === statusSelect;
      var isStartDateMatch = startDateInput === "" || cardTanggalKeluar >= startDateInput;
      var isEndDateMatch = endDateInput === "" || cardTanggalKeluar <= endDateInput;

      if (isVendorMatch && isDescriptionMatch && isStatusMatch && isStartDateMatch && isEndDateMatch) {
        cards[i].style.display = "";
      } else {
        cards[i].style.display = "none";
      }
    }
  }

  // View modal function
  $(document).on('click', '.view-btn', function() {
      var serviceOutId = $(this).data('id');
      
      // Fetch data from server using AJAX
      $.ajax({
          url: '/admin/service_out/' + serviceOutId, // Ganti dengan URL yang sesuai
          method: 'GET',
          success: function(data) {
              // Isi konten modal
              $('#modalVendorName').text(data.vendor_name);
              $('#modalDescription').text(data.deskripsi_masalah);
              $('#modalTanggalKeluar').text(data.tanggal_keluar);
              $('#modalTanggalDiterima').text(data.tanggal_diterima || '-');
              $('#modalBiaya').text(data.biaya ? 'Rp. ' + numberWithCommas(data.biaya.toFixed(2)) : '(not counted yet...)');
              $('#modalCatatan').text(data.catatan);
              $('#modalStatus').text(data.status == 0 ? 'Waiting...' : (data.status == 1 ? 'On Process...' : 'Finished'));
          },
          error: function(xhr, status, error) {
              console.log('Error fetching data: ', error);
              alert('Error fetching data. Please try again later.');
          }
      });
  });


</script>
@endpush
