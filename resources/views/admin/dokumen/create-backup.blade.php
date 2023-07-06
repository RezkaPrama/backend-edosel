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

<div class="row" style="height:100%;">

    <div class="col-lg-12">
        <div id="addproduct-accordion" class="custom-accordion">

            <div class="card">
                <a href="#addproduct-productinfo-collapse" class="text-dark" data-bs-toggle="collapse"
                    aria-expanded="true" aria-controls="addproduct-productinfo-collapse">
                    <div class="p-4">

                        <div class="d-flex align-items-center">

                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="font-size-16 mb-1">Tambah Dokumen</h5>
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
                        <form action="{{ route('admin.dokumen.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

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
                                <select class="form-control @error('pangkat') is-invalid @enderror" data-trigger
                                    name="pangkat" id="pangkat">
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
                                    <select class="form-control @error('shelf_id') is-invalid @enderror" data-trigger
                                        id="shelf_id" name="shelf_id">
                                        <option value="">Pilih Rak</option>
                                        @foreach ($shelf as $item)
                                        <option value="{{ $item->id }}">{{ $item->no_rak }} - {{ $item->nama_rak }}
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
                                    <input id="tanggal_input" name="tanggal_input" placeholder="Masukan Nama Satuan"
                                        type="text"
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
                                    <label for="choices-single-specifications" class="form-label">Jenis
                                        Karyawan</label>
                                    <select class="form-control @error('jenis_karyawan') is-invalid @enderror"
                                        data-trigger name="jenis_karyawan" id="jenis_karyawan">
                                        <option value="">Pilih jenis Karyawan</option>
                                        <option value="Militer">Militer</option>
                                        <option value="PNS">PNS</option>
                                    </select>

                                    @error('jenis_karyawan')
                                    <div class="invalid-feedback" style="display: block">
                                        Jenis Karyawan harus terisi
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="satuan"> Satuan</label>
                                    <select class="form-control @error('satuan') is-invalid @enderror" data-trigger
                                        name="satuan" id="satuan">
                                        <option value="">Pilih Satuan</option>
                                        <option value="Mako Denma Kopassus">Mako Denma Kopassus</option>
                                        <option value="Pusdiklatpasus Kopassus">Pusdiklatpasus Kopassus</option>
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

                            {{-- <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="satuan"> Upload Dokumen</label>

                                    <input id="users_id" name="users_id" type="text" value="{{ auth()->user()->id }}"
                                        class="form-control">
                                    <input type="file" name="files[]" multiple class="form-control">

                                </div>
                            </div> --}}


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

                                {{-- <input id="input_dokumens_id" name="input_dokumens_id" type="hidden"
                                    value="{{ $dokumen->id }}" class="form-control"> --}}
                                <input id="users_id" name="users_id" type="hidden" value="{{ auth()->user()->id }}"
                                    class="form-control">

                                <div class="dz-message needsclick">
                                    <div class="mb-3">
                                        <i class="display-4 text-muted mdi mdi-cloud-upload"></i>
                                    </div>

                                    <h4>Drop file disini atau klik untuk upload.</h4>
                                </div>
                            {{-- </form> --}}
                        </div>

                        {{-- <div class="text-center mt-4">
                            <button type="button" id="submit-all" class="btn btn-primary waves-effect waves-light"><i
                                    class="fa fa-paper-plane"></i> Upload File</button>
                        </div> --}}

                        <div class="row mb-4">
                            <div class="col text-end">
                                <a href="{{ route('admin.dokumen.index') }}" class="btn btn-danger"> <i
                                        class="bx bx-x me-1"></i> Batal </a>
                                <button class="btn btn-success" type="submit"><i class="fa fa-paper-plane"></i>
                                    Simpan</button>

                            </div> <!-- end col -->
                        </div>
                        {{-- </form> --}}

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/choices.js/choices.js.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/ecommerce-choices.init.js') }}"></script>
<script src="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

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
@endsection