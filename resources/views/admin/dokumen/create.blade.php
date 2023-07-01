@extends('layouts.master')
@section('title') Input Dokumen @endsection

@section('css')
<link href="{{ URL::asset('assets/libs/choices.js/choices.js.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
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

<div class="row">
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
                                <label class="form-label" for="nik">NIK/NRP</label>
                                <input id="nik" name="nik" placeholder="Masukan NIK" type="text"
                                    class="form-control @error('nik') is-invalid @enderror">

                                @error('nik')
                                <div class="invalid-feedback" style="display: block">
                                    NIK/NRP harus terisi
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="nama">Nama Lengkap</label>
                                <input id="nama" name="nama" placeholder="Masukan Nama Lengkap" type="text"
                                    class="form-control @error('nama') is-invalid @enderror">

                                @error('nama')
                                <div class="invalid-feedback" style="display: block">
                                    Nama harus terisi
                                </div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-lg-6">

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

                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="jabatan"> jabatan</label>
                                        <input id="jabatan" name="jabatan" placeholder="Masukan jabatan" type="text"
                                            class="form-control @error('jabatan') is-invalid @enderror">

                                        @error('jabatan')
                                        <div class="invalid-feedback" style="display: block">
                                            Jabatan harus terisi
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="choices-single-default" class="form-label">No Rak</label>
                                        <select class="form-control @error('shelf_id') is-invalid @enderror"
                                            data-trigger id="shelf_id" name="shelf_id">
                                            <option value="">Pilih Rak</option>
                                            @foreach ($shelf as $item)
                                            <option value="{{ $item->id }}">{{ $item->no_rak }} - {{ $item->nama_rak }}</option>
                                            @endforeach
                                        </select>

                                        @error('shelf_id')
                                        <div class="invalid-feedback" style="display: block">
                                            No rak harus terisi
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="choices-single-specifications" class="form-label">Jenis Karyawan</label>
                                        <select class="form-control @error('jenis_karyawan') is-invalid @enderror"
                                            data-trigger name="jenis_karyawan" id="jenis_karyawan">
                                            <option value="">Pilih jenis Karyawan</option>
                                            <option value="tetap">Tetap</option>
                                            <option value="kontrak">Kontrak</option>
                                        </select>

                                        @error('jenis_karyawan')
                                        <div class="invalid-feedback" style="display: block">
                                            Jenis Karyawan harus terisi
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col text-end">
        <a href="{{ route('admin.dokumen.index') }}" class="btn btn-danger"> <i class="bx bx-x me-1"></i> Batal </a>
        {{-- <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#success-btn"> <i
                class=" bx bx-file me-1"></i> Simpan </a> --}}
        <button class="btn btn-success" type="submit"><i class="fa fa-paper-plane"></i> Simpan</button>

    </div> <!-- end col -->
</div>
</form>

@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/choices.js/choices.js.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/dropzone/dropzone.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/ecommerce-choices.init.js') }}"></script>
<script src="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>


<script>

$("#datepicker").datepicker({
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years"
});
  
    flatpickr('#tanggal_input', {
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
    });

    flatpickr('#tahun', {
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
    });
</script>
@endsection