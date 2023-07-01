@extends('layouts.master')
@section('title') Input Rak @endsection

@section('css')
<link href="{{ URL::asset('assets/libs/choices.js/choices.js.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/choices.js/choices.js.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Manajemen Rak @endslot
@slot('title') Input Rak @endslot
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
                                <h5 class="font-size-16 mb-1">Tambah Rak</h5>
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
                        <form action="{{ route('admin.shelf.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label" for="nama_rak">Nama Rak</label>
                                <input id="nama_rak" name="nama_rak" placeholder="Masukan Nama Rak" type="text"
                                    class="form-control @error('nama_rak') is-invalid @enderror">

                                @error('nama_rak')
                                <div class="invalid-feedback" style="display: block">
                                    Kolom Nama Rak harus terisi!
                                </div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-lg-6">

                                    <div class="mb-3">
                                        <label class="form-label" for="no_rak"> No Rak</label>
                                        <input id="no_rak" name="no_rak" placeholder="Masukan no_rak" type="number"
                                            class="form-control @error('no_rak') is-invalid @enderror">

                                        @error('no_rak')
                                        <div class="invalid-feedback" style="display: block">
                                            no_rak harus terisi
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">

                                    <div class="mb-3">
                                        <label class="form-label" for="jumlah_ambalan"> Jumlah Ambalan</label>
                                        <input id="jumlah_ambalan" name="jumlah_ambalan"
                                            placeholder="Masukan jumlah_ambalan" type="number"
                                            class="form-control @error('jumlah_ambalan') is-invalid @enderror">

                                        @error('jumlah_ambalan')
                                        <div class="invalid-feedback" style="display: block">
                                            jumlah_ambalan harus terisi
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-0">
                                <label class="form-label" for="ket">Keterangan</label>
                                <textarea class="form-control @error('ket') is-invalid @enderror" name="ket" id="ket"
                                    placeholder="Enter Keterangan" rows="4"></textarea>

                                @error('ket')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col text-end">
        <a href="{{ route('admin.shelf.index') }}" class="btn btn-danger"> <i class="bx bx-x me-1"></i> Batal </a>
        <button class="btn btn-success" type="submit"><i class="fa fa-paper-plane"></i> Simpan</button>

    </div> <!-- end col -->
</div>
</form>

@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/choices.js/choices.js.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/ecommerce-choices.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection