@extends('layouts.master')
@section('title') Input Dokumen @endsection

@section('css')
<link href="{{ URL::asset('assets/libs/choices.js/choices.js.min.css') }}" rel="stylesheet" type="text/css" />
{{--
<link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" /> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" />
{{--
<link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}"> --}}
<link href="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Input @endslot
@slot('title') Input Dokumen @endslot
@endcomponent

<!-- Start Page-content -->
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Input Dokumen</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        {{-- <form action="#"> --}}
                            <form action="{{ route('admin.dokumen.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <ul class="wizard-nav mb-5">
                                    <li class="wizard-list-item">
                                        <div class="list-item">
                                            <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Input Dokumen">
                                                <i class="bx bx-user-circle"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="wizard-list-item">
                                        <div class="list-item">
                                            <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Input Dokumen Detail">
                                                <i class="bx bx-file"></i>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <!-- wizard-nav -->

                                <div class="wizard-tab">
                                    <div class="text-center mb-4">
                                        <h5>Tambah Dokumen</h5>
                                        <p class="card-title-desc">Isi semua informasi di bawah ini</p>
                                    </div>
                                    <div>
                                        <div class="mb-3">
                                            <label class="form-label" for="no_dosir">No Dosir</label>
                                            <input id="no_dosir" name="no_dosir" placeholder="Masukan No Dosir" type="text"
                                                class="form-control @error('no_dosir') is-invalid @enderror">

                                            @error('no_dosir')
                                            <div class="invalid-feedback" style="display: block">
                                                No Dosir harus terisi
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="nama">Nama</label>
                                            <input id="nama" name="nama" placeholder="Masukan Nama Lengkap" type="text"
                                                class="form-control @error('nama') is-invalid @enderror">

                                            @error('nama')
                                            <div class="invalid-feedback" style="display: block">
                                                Nama harus terisi
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="pangkat"> Pangkat</label>
                                            <select class="form-control @error('pangkat') is-invalid @enderror"
                                                data-trigger name="pangkat" id="pangkat">
                                                <option value="">Pilih Pangkat</option>
                                                <option value="Mayjen">Mayjen</option>
                                                <option value="Brigjen">Brigjen</option>
                                                <option value="Kolonel">Kolonel</option>
                                                <option value="Letkol">Letkol</option>
                                                <option value="Mayor">Mayor</option>
                                                <option value="Kapten">Kapten</option>
                                                <option value="Lettu">Lettu</option>
                                                <option value="Letda">Letda</option>
                                                <option value="Peltu">Peltu</option>
                                                <option value="Pelda">Pelda</option>
                                                <option value="Serma">Serma</option>
                                                <option value="Serka">Serka</option>
                                                <option value="Sertu">Sertu</option>
                                                <option value="Kopka">Kopka</option>
                                                <option value="Koptu">Koptu</option>
                                                <option value="Kopda">Kopda</option>
                                                <option value="Praka">Praka</option>
                                                <option value="Pratu">Pratu</option>
                                                <option value="Prada">Prada</option>
                                            </select>

                                            @error('pangkat')
                                            <div class="invalid-feedback" style="display: block">
                                                Jabatan harus terisi
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="nik">NIP/NRP</label>
                                            <input id="nik" name="nik" placeholder="Masukan NIK" type="text"
                                                class="form-control @error('nik') is-invalid @enderror">

                                            @error('nik')
                                            <div class="invalid-feedback" style="display: block">
                                                NIP/NRP harus terisi
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="choices-single-default" class="form-label">No Rak</label>
                                                <select class="form-control @error('shelf_id') is-invalid @enderror"
                                                    data-trigger id="shelf_id" name="shelf_id">
                                                    <option value="">Pilih Rak</option>
                                                    @foreach ($shelf as $item)
                                                    <option value="{{ $item->id }}">{{ $item->no_rak }} - {{
                                                        $item->nama_rak
                                                        }}
                                                    </option>
                                                    @endforeach
                                                </select>

                                                @error('shelf_id')
                                                <div class="invalid-feedback" style="display: block">
                                                    No rak harus terisi
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-12">

                                            <div class="mb-3">

                                                <label class="form-label" for="tanggal_input"> Tanggal Input</label>
                                                <input id="tanggal_input" name="tanggal_input"
                                                    placeholder="Masukan Nama Satuan" type="text"
                                                    class="form-control flatpickr-input @error('tanggal_input') is-invalid @enderror">

                                                @error('tanggal_input')
                                                <div class="invalid-feedback" style="display: block">
                                                    tanggal harus terisi
                                                </div>
                                                @enderror

                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="choices-single-specifications" class="form-label">Personel</label>
                                                <select
                                                    class="form-control @error('personel') is-invalid @enderror"
                                                    data-trigger name="personel" id="personel">
                                                    <option value="">Pilih Personel</option>
                                                    <option value="Militer">Militer</option>
                                                    <option value="PNS">PNS</option>
                                                </select>

                                                @error('personel')
                                                <div class="invalid-feedback" style="display: block">
                                                    Jenis Karyawan harus terisi
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="satuan"> Satuan</label>
                                                <select class="form-control @error('satuan') is-invalid @enderror"
                                                    data-trigger name="satuan" id="satuan">
                                                    <option value="">Pilih Satuan</option>
                                                    <option value="Mako Denma Kopassus">Mako Denma Kopassus</option>
                                                    <option value="Pusdiklatpasus Kopassus">Pusdiklatpasus Kopassus
                                                    </option>
                                                    <option value="Group 1 Kopassus">Group 1 Kopassus</option>
                                                    <option value="Group 2 Kopassus">Group 2 Kopassus</option>
                                                    <option value="Group 3 Kopassus">Group 3 Kopassus</option>
                                                    <option value="Satuan 81 Kopassus">Satuan 81 Kopassus</option>
                                                    <option value="PNS Kopassus">PNS Kopassus</option>
                                                </select>

                                                @error('satuan')
                                                <div class="invalid-feedback" style="display: block">
                                                    Satuan harus terisi
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- wizard-tab -->

                                <div class="wizard-tab">
                                    <div>
                                        <div class="text-center mb-4">
                                            <h5>Upload Dokumen</h5>
                                            <p class="card-title-desc">Tambahkan File Dokumen</p>
                                        </div>
                                        <div class="p-4 border-top">
                                            <div>
                                                <div id="create-dropzone" class="dropzone">
                                                    <div class="dz-message" data-dz-message>
                                                        Drop file disini atau klik untuk upload.
                                                    </div>
                                                </div>
                                                <div id="paramDetail">
                                                    <input id="lastId" name="lastId" placeholder="Masukan lastId" type="hidden" value="{{ $lastId + 1 }}"
                                                            class="form-control">
                                                    <input id="user_id" name="user_id" type="hidden"
                                                        value="{{ auth()->user()->id }}" class="form-control">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- wizard-tab -->

                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="button" class="btn btn-primary w-sm" id="prevBtn"
                                        onclick="nextPrev(-1)">Previous</button>
                                    <button type="button" class="btn btn-primary w-sm ms-auto" id="nextBtn"
                                        onclick="nextPrev(1)">Next</button>
                                    <button class="btn btn-success" id="btnSimpanInput" type="submit"
                                        style="display: none;"><i class="fa fa-paper-plane"></i>
                                        Simpan</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div><!-- end col -->
        </div><!-- end row -->

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/choices.js/choices.js.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/ecommerce-choices.init.js') }}"></script>
<script src="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

{{-- <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script> --}}
<script src="{{ asset('assets/libs/metismenujs/metismenujs.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>

<!-- datepicker js -->
<script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>

<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
<script>
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#create-dropzone", {
        url: "{{ route('admin.dokumenDetail.uploadCreate') }}",
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        paramName: "file",
        maxFiles: 50,
        autoProcessQueue: false, // prevent automatic uploading
        maxFilesize: 2, // Maximum file size in MB
        addRemoveLinks: false,
        acceptedFiles: ".pdf",
        // dictRemoveFile: 'Hapus',
        init: function() {
            this.on("sending", function(file, xhr, formData) {
                // Get the value of the extra parameter and add it to the formData
                var lastId = document.getElementById('lastId').value;
                formData.append('lastId', lastId);
                // Get the value of the extra parameter and add it to the formData
                var userId = document.getElementById('user_id').value;
                formData.append('user_id', userId);
            });
            this.on("success", function(file, response) {
                console.log(response);
                // Associate the uploaded file path with a hidden input field
                // $('<input>').attr({
                //     name: 'file',
                //     value: response.filename
                // }).appendTo('#paramDetail');
            });
        }
    });

    // Step 4: Add an event listener to the button
  document.querySelector("#btnSimpanInput").addEventListener("click", function () {
    myDropzone.processQueue();
  });
</script>

<script>
    $(document).ready(function() {
  
        // Swal.fire("Hello, SweetAlert!");

        flatpickr('#tanggal_input', {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });
        
                @if (session()->has('success'))
        
                    Swal.fire({
                        type: "success",
                        icon: "success",
                        title: "BERHASIL!",
                        text: "{{ session('success') }}",
                        timer: 1500,
                        showConfirmButton: false,
                        showCancelButton: false,
                        buttons: false,
                    });
                @elseif (session()->has('error'))
        
                    Swal.fire({
                        type: "error",
                        icon: "error",
                        title: "GAGAL!",
                        text: "{{ session('error') }}",
                        timer: 1500,
                        showConfirmButton: false,
                        showCancelButton: false,
                        buttons: false,
                    });
                @endif
    });
        
</script>

<script>
    var currentTab = 0;

    function showTab(e) {
    var t = document.getElementsByClassName("wizard-tab");
    (t[e].style.display = "block"),
        (document.getElementById("prevBtn").style.display = 0 == e ? "none" : "inline"),
        e == t.length - 1 ? (document.getElementById("btnSimpanInput").style.display = 'block') : (document.getElementById("btnSimpanInput").innerHTML = "Simpan"),
        fixStepIndicator(e);
    }

    function nextPrev(e) {
    var t = document.getElementsByClassName("wizard-tab");
    (t[currentTab].style.display = "none"),
        (currentTab += e) >= t.length &&
        (t[(currentTab -= e)].style.display = "block"),
        showTab(currentTab);
    }
    
    function fixStepIndicator(e) {
    var t,
        n = document.getElementsByClassName("list-item");
    for (t = 0; t < n.length; t++)
        n[t].className = n[t].className.replace(" active", "");
    n[e].className += " active";
    }
    showTab(currentTab), flatpickr("#datepicker-basic");

</script>
@endsection