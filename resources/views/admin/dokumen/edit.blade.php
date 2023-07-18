@extends('layouts.master')
@section('title') Edit Dokumen @endsection

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
@slot('li_1') Edit @endslot
@slot('title') Edit Dokumen @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div id="addproduct-accordion" class="custom-accordion">

            <div class="card">
                <a href="#addproduct-productinfo-collapse" class="text-dark" data-bs-toggle="collapse"
                    aria-expanded="true" aria-controls="addproduct-productinfo-collapse">
                    <div class="p-4">

                        <div class="d-flex align-items-center">

                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="font-size-16 mb-1">Edit Dokumen</h5>
                                <p class="text-muted text-truncate mb-0">Isi semua informasi di bawah ini</p>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                            </div>
                        </div>
                    </div>
                </a>

                <div id="addproduct-productinfo-collapse" class="collapse show" data-bs-parent="#addproduct-accordion">
                    <div class="p-4 border-top">
                        <form action="{{ route('admin.dokumen.update', $dokumen->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label" for="no_dosir">No Dosir</label>
                                <input id="no_dosir" name="no_dosir" placeholder="Masukan no dosir" type="text"
                                    value="{{ old('dokumen', $dokumen->no_dosir) }}"
                                    class="form-control @error('no_dosir') is-invalid @enderror">

                                @error('no_dosir')
                                <div class="invalid-feedback" style="display: block">
                                    no_dosir harus terisi
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="nama">Nama</label>
                                <input id="nama" name="nama" placeholder="Masukan Nama Lengkap" type="text"
                                    value="{{ old('dokumen', $dokumen->nama) }}"
                                    class="form-control @error('nama') is-invalid @enderror">

                                @error('nama')
                                <div class="invalid-feedback" style="display: block">
                                    Nama harus terisi
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="pangkat"> Pangkat</label>
                                <select class="form-control @error('pangkat') is-invalid @enderror" data-trigger
                                    name="pangkat" id="pangkat">
                                    <option value="">Pilih Pangkat</option>
                                    <option value="Mayjen" {{ $dokumen->pangkat == 'Mayjen' ? 'selected' : '' }}>Mayjen</option>
                                    <option value="Brigjen" {{ $dokumen->pangkat == 'Brigjen' ? 'selected' : '' }}>Brigjen</option>
                                    <option value="Kolonel" {{ $dokumen->pangkat == 'Kolonel' ? 'selected' : '' }}>Kolonel</option>
                                    <option value="Letkol" {{ $dokumen->pangkat == 'Letkol' ? 'selected' : '' }}>Letkol</option>
                                    <option value="Mayor" {{ $dokumen->pangkat == 'Mayor' ? 'selected' : '' }}>Mayor</option>
                                    <option value="Kapten" {{ $dokumen->pangkat == 'Kapten' ? 'selected' : '' }}>Kapten</option>
                                    <option value="Lettu" {{ $dokumen->pangkat == 'Lettu' ? 'selected' : '' }}>Lettu</option>
                                    <option value="Letda" {{ $dokumen->pangkat == 'Letda' ? 'selected' : '' }}>Letda</option>
                                    <option value="Peltu" {{ $dokumen->pangkat == 'Peltu' ? 'selected' : '' }}>Peltu</option>
                                    <option value="Pelda" {{ $dokumen->pangkat == 'Pelda' ? 'selected' : '' }}>Pelda</option>
                                    <option value="Serma" {{ $dokumen->pangkat == 'Serma' ? 'selected' : '' }}>Serma</option>
                                    <option value="Serka" {{ $dokumen->pangkat == 'Serka' ? 'selected' : '' }}>Serka</option>
                                    <option value="Sertu" {{ $dokumen->pangkat == 'Sertu' ? 'selected' : '' }}>Sertu</option>
                                    <option value="Kopka" {{ $dokumen->pangkat == 'Kopka' ? 'selected' : '' }}>Kopka</option>
                                    <option value="Koptu" {{ $dokumen->pangkat == 'Koptu' ? 'selected' : '' }}>Koptu</option>
                                    <option value="Kopda" {{ $dokumen->pangkat == 'Kopda' ? 'selected' : '' }}>Kopda</option>
                                    <option value="Praka" {{ $dokumen->pangkat == 'Praka' ? 'selected' : '' }}>Praka</option>
                                    <option value="Pratu" {{ $dokumen->pangkat == 'Pratu' ? 'selected' : '' }}>Pratu</option>
                                    <option value="Prada" {{ $dokumen->pangkat == 'Prada' ? 'selected' : '' }}>Prada</option>
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
                                    value="{{ old('dokumen', $dokumen->nik) }}"
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
                                    <select class="form-control @error('shelf_id') is-invalid @enderror" data-trigger
                                        id="shelf_id" name="shelf_id">
                                        <option value="">Pilih Rak</option>
                                        @foreach ($shelf as $item)
                                        @if($dokumen->shelf_id == $item->id)
                                        <option value="{{ $item->id  }}" selected>{{ $item->no_rak }} - {{
                                            $item->nama_rak }}</option>
                                        @else
                                        <option value="{{ $item->id  }}">{{ $item->no_rak }} - {{ $item->nama_rak }}
                                        </option>
                                        @endif
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
                                    <input id="tanggal_input" name="tanggal_input" placeholder="Masukan Nama Satuan"
                                        type="text" value="{{ old('dokumen', $dokumen->tanggal_input) }}"
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
                                    <select class="form-control @error('personel') is-invalid @enderror"
                                        data-trigger name="personel" id="personel">
                                        <option value="">Pilih jenis Karyawan</option>
                                        <option value="Militer" {{ $dokumen->personel == 'Militer' ? 'selected' : '' }}>Militer</option>
                                        <option value="PNS" {{ $dokumen->personel == 'PNS' ? 'selected' : '' }}>PNS</option>
                                    </select>

                                    @error('personel')
                                    <div class="invalid-feedback" style="display: block">
                                        Personel harus terisi
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="satuan"> Satuan</label>
                                <select class="form-control @error('satuan') is-invalid @enderror" data-trigger
                                    name="satuan" id="satuan">
                                    <option value="">Pilih Satuan</option>
                                    <option value="Mako Denma Kopassus" {{ $dokumen->satuan == 'Mako Denma Kopassus' ? 'selected' : '' }}>Mako Denma Kopassus</option>
                                    <option value="Pusdiklatpasus Kopassus" {{ $dokumen->satuan == 'Pusdiklatpasus Kopassus' ? 'selected' : '' }}>Pusdiklatpasus Kopassus</option>
                                    <option value="Group 1 Kopassus" {{ $dokumen->satuan == 'Group 1 Kopassus' ? 'selected' : '' }}>Group 1 Kopassus</option>
                                    <option value="Group 2 Kopassus" {{ $dokumen->satuan == 'Group 2 Kopassus' ? 'selected' : '' }}>Group 2 Kopassus</option>
                                    <option value="Group 3 Kopassus" {{ $dokumen->satuan == 'Group 3 Kopassus' ? 'selected' : '' }}>Group 3 Kopassus</option>
                                    <option value="Satuan 81 Kopassus" {{ $dokumen->satuan == 'Satuan 81 Kopassus' ? 'selected' : '' }}>Satuan 81 Kopassus</option>
                                    <option value="PNS Kopassus" {{ $dokumen->satuan == 'PNS Kopassus' ? 'selected' : '' }}>PNS Kopassus</option>
                                </select>

                                @error('satuan')
                                <div class="invalid-feedback" style="display: block">
                                    Jenis Karyawan harus terisi
                                </div>
                                @enderror
                            </div>

                            <div class="row mb-4">
                                <div class="col text-end me-4">
                                    <a href="{{ route('admin.dokumen.index') }}" class="btn btn-danger"> <i
                                            class="bx bx-x me-1"></i> Batal </a>
                                    <button class="btn btn-success" type="submit"><i class="fa fa-paper-plane"></i>
                                        Update</button>
                                </div> <!-- end col -->
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="fileDokumen-accordion" class="custom-accordion">

            <div class="card">
                <a href="#fileDokumen-dokumeninfo-collapse" class="text-dark" data-bs-toggle="collapse"
                    aria-expanded="true" aria-controls="fileDokumen-dokumeninfo-collapse">
                    <div class="p-4">

                        <div class="d-flex align-items-center">

                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="font-size-16 mb-1">File Dokumen</h5>
                                {{-- <p class="text-muted text-truncate mb-0">Isi semua informasi di bawah ini</p> --}}
                            </div>
                            <div class="flex-shrink-0">
                                <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                            </div>
                        </div>
                    </div>
                </a>

                <div id="fileDokumen-dokumeninfo-collapse" class="collapse show"
                    data-bs-parent="#fileDokumen-accordion">
                    <div class="p-4 border-top">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th class="fw-bold text-center" style="width: 70px;">No.</th>
                                        <th class="fw-bold text-center">Nama File</th>
                                        <th class="fw-bold text-center">Action</th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>

                                    @forelse ($dokumenDetail as $item => $row)
                                    <tr>
                                        <td class="text-center">{{$item + 1}}</td>
                                        <td class="text-center">{{$row->nama_file}}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.dokumenDetail.download', ['userid' => $row->users_id, 'filename' => $row->nama_file ]) }}"
                                                class="btn btn-primary w-sm"><i
                                                    class="bx bx-download me-2"></i>Download</a>
                                            <a href="{{ route('admin.dokumenDetail.previewPdf', ['userid' => $row->users_id, 'filename' => $row->nama_file ]) }}"
                                                class="btn btn-dark w-sm"><i
                                                    class="bx bxs-file-pdf me-2"></i>Preview</a>
                                            <a href="{{ route('admin.dokumenDetail.destroy', ['id' => $row->id, 'userid' => $row->users_id ]) }}"
                                                class="btn btn-danger w-sm"><i
                                                    class="bx bxs-eraser-pdf me-2"></i>Hapus</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <div class="alert alert-danger">
                                        File Dokumen Belum Tersedia!
                                    </div>
                                    @endforelse
                                    <!-- end tr -->

                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div id="uploadDokumen-accordion" class="custom-accordion">

            <div class="card">
                <a href="#uploadDokumen-dokumeninfo-collapse" class="text-dark" data-bs-toggle="collapse"
                    aria-expanded="true" aria-controls="uploadDokumen-dokumeninfo-collapse">
                    <div class="p-4">

                        <div class="d-flex align-items-center">

                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="font-size-16 mb-1">Upload Dokumen</h5>
                                {{-- <p class="text-muted text-truncate mb-0">Isi semua informasi di bawah ini</p> --}}
                            </div>
                            <div class="flex-shrink-0">
                                <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                            </div>
                        </div>
                    </div>
                </a>

                <div id="uploadDokumen-dokumeninfo-collapse" class="collapse show"
                    data-bs-parent="#uploadDokumen-accordion">
                    <div class="p-4 border-top">
                        <div>
                            <form action="#" class="dropzone" method="POST" id="my-dropzone"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="fallback">
                                    <input name="file" type="file" multiple="multiple">
                                </div>

                                <input id="input_dokumens_id" name="input_dokumens_id" type="hidden"
                                    value="{{ $dokumen->id }}" class="form-control">
                                <input id="users_id" name="users_id" type="hidden" value="{{ auth()->user()->id }}"
                                    class="form-control">

                                <div class="dz-message needsclick">
                                    <div class="mb-3">
                                        <i class="display-4 text-muted mdi mdi-cloud-upload"></i>
                                    </div>

                                    <h4>Drop file disini atau klik untuk upload.</h4>
                                </div>
                            </form>
                        </div>

                        <div class="text-center mt-4">
                            <button type="button" id="submit-all" class="btn btn-primary waves-effect waves-light"><i
                                    class="fa fa-paper-plane"></i> Upload File</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>


@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/choices.js/choices.js.min.js') }}"></script>
{{-- <script src="{{ URL::asset('assets/libs/dropzone/dropzone.min.js') }}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
<script src="{{ URL::asset('assets/js/pages/ecommerce-choices.init.js') }}"></script>
<script src="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css"
    rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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
    // Step 1: Initialize Dropzone.js
  Dropzone.autoDiscover = false;
  var myDropzone = new Dropzone("#my-dropzone", {
    url: "{{ route('admin.dokumenDetail.upload') }}",
    autoProcessQueue: false, // prevent automatic uploading
    paramName: "file",
    maxFilesize: 2, // MB
    acceptedFiles: ".pdf",
    addRemoveLinks: true,
    dictDefaultMessage: 'Drop file disini atau klik untuk upload',
    dictRemoveFile: 'Hapus',
  });

  // Step 4: Add an event listener to the button
  document.querySelector("#submit-all").addEventListener("click", function () {
    myDropzone.processQueue();
  });

  // Step 5: Handle the file upload
  myDropzone.on("success", function (file, response) {
    console.log(response.result);
    if (response.result == "success") {
        Swal.fire({
        type: "success",
            icon: "success",
            title: "BERHASIL!",
            text: "File Berhasil di Upload",
            timer: 1500,
            showConfirmButton: false,
            showCancelButton: false,
            buttons: false,
        }); 

        location.reload();
    } else {
        Swal.fire({
            type: "error",
            icon: "error",
            title: "GAGAL!",
            text: "File Gagal Di upload!",
            timer: 1500,
            showConfirmButton: false,
            showCancelButton: false,
            buttons: false,
        });

        location.reload();
    }
  });
</script>
@endsection