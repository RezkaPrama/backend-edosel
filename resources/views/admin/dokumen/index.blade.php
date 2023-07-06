@extends('layouts.master')
@section('title') Input Dokumen @endsection

@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}">
<link href="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/libs/choices.js/choices.js.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Sweet Alert-->
<link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Input @endslot
@slot('title') Input Dokumen @endslot
@endcomponent

{{-- Start Content --}}
<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-header">
                <form action="{{ route('admin.dokumen.index') }}" method="GET">

                    <div class="mb-3 row">
                        <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">NIK/NRP</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukan data NIK">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="nama" name="nama"
                                placeholder="Masukan data nama">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">No Rak</label>
                        <div class="col-sm-4">
                            <select class="form-control" data-trigger id="no_rak" name="no_rak">
                                <option value="">Pilih Rak</option>
                                @foreach ($shelf as $item)
                                <option value="{{ $item->id }}">{{ $item->no_rak }} - {{
                                    $item->nama_rak
                                    }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success mb-4 col-sm-2 me-1"><i
                                class="mdi mdi-filter me-1"></i>
                            Filter</button>
                        <a href="{{ route('admin.dokumen.export') }}" type="button" class="btn btn-success mb-4 col-sm-2 "><i
                                class="mdi mdi-microsoft-excel me-1"></i>
                            Export</a>
                    </div>

                    <div class="text-end">
                        <a href="{{ route('admin.dokumen.create') }}" type="button"
                                    class="btn btn-success mb-4"><i class="mdi mdi-plus me-1"></i> Tambah Dokumen</a>
                    </div>
                </form>
            </div>

            <!-- card-header default start// -->
            {{-- <div class="card-body">
                <div class="position-relative">
                    <div class="modal-button mt-2">
                        <div class="row align-items-start">
                            <div class="col-sm">
                                
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                </div>
            </div> --}}
            <!-- card-header default end// -->

            <!-- card-body start// -->
            <div class="card-body mt-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <form action="" method="post" class="form-produk">
                                @csrf
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Pangkat</th>
                                            <th class="text-center">NRP</th>
                                            <th class="text-center">No Rak</th>
                                            <th class="text-center">Tanggal Input</th>
                                            <th class="text-center">satuan</th>
                                            <th class="text-center">Jenis Karyawan</th>
                                            <th class="text-end">Upload</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($dokumen as $item => $row)
                                        <tr>
                                            <td class="text-center">{{ $item + 1 }}</td>
                                            <td class="text-center">{{ $row->nama }}</td>
                                            <td class="text-center">{{ $row->pangkat }}</td>
                                            <td class="text-center">{{ $row->nik }}</td>
                                            <td class="text-center">{{ $row->Shelf->no_rak }} - {{ $row->Shelf->nama_rak
                                                }}
                                            </td>
                                            <td class="text-center">{{ $row->tanggal_input }}</td>
                                            {{-- <td class="text-center"><span class="badge bg-success font-size-12"><i
                                                        class="mdi mdi-star me-1"></i>{{ $row->jabatan }}</span></td>
                                            --}}
                                            <td class="text-center">{{ $row->satuan }}</td>
                                            <td class="text-center">{{ $row->jenis_karyawan }}</td>
                                            <td class="text-end">
                                                <div class="dropdown">
                                                    <a class="btn btn-link text-body shadow-none dropdown-toggle"
                                                        href="#" role="button" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="bx bx-dots-horizontal-rounded"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('admin.dokumen.edit', $row->id) }}">Edit
                                                                User</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <div class="alert alert-danger">
                                            Data Belum Tersedia!
                                        </div>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div style="text-align: center">
                                    {{ $dokumen->links("vendor.pagination.bootstrap-4") }}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- card-body end// -->

        </div>
    </div>
</div>
{{-- End Content --}}

@endsection

@section('script')
<script src="{{ URL::asset('assets/libs/gridjs/gridjs.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

<script src="{{ URL::asset('assets/libs/choices.js/choices.js.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/ecommerce-choices.init.js') }}"></script>
<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        
        // Swal.fire("Hello, SweetAlert!");

        @if(session()->has('success'))
            
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

            @elseif(session()->has('error'))
            
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