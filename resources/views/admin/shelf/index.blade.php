@extends('layouts.master')
@section('title') Manajemen Rak @endsection

@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}">
<link href="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css">
<!-- Sweet Alert-->
<link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Rak @endslot
@slot('title') Manajemen Rak @endslot
@endcomponent

{{-- Start Content --}}
<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <!-- card-header default start// -->
            <div class="card-body">
                <div class="position-relative">
                    <div class="modal-button mt-2">
                        <div class="row align-items-start">
                            <div class="col-sm">
                                <a href="{{ route('admin.shelf.create') }}" type="button"
                                    class="btn btn-success mb-4"><i class="mdi mdi-plus me-1"></i> Tambah Rak</a>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                </div>
            </div>
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
                                            <th class="text-center">Nama Rak</th>
                                            <th class="text-center">Nomor Rak</th>
                                            <th class="text-center">Jumlah Ambalan</th>
                                            <th class="text-center">Keterangan</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($shelf as $item => $row)
                                        <tr>
                                            <td class="text-center">{{ $item + 1 }}</td>
                                            <td class="text-center">{{ $row->nama_rak }}</td>
                                            <td class="text-center">{{ $row->no_rak }}</td>
                                            <td class="text-center" style="max-width: 100px;">{{ $row->jumlah_ambalan }}
                                            </td>
                                            <td class="text-center">{{ $row->keterangan }}</td>
                                            <td class="text-end">
                                                <div class="dropdown">
                                                    <a class="btn btn-link text-body shadow-none dropdown-toggle"
                                                        href="#" role="button" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="bx bx-dots-horizontal-rounded"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li class="text-center"><a class="dropdown-item"
                                                                href="{{ route('admin.shelf.edit', $row->id) }}">Edit
                                                                Rak</a></li>
                                                        <li class="text-center">
                                                            <button class="btn btn-sm btn-danger btn-delete"
                                                                data-id="{{ $row->id }}">Hapus Rak</button>
                                                        </li>
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
                                    {{ $shelf->links("vendor.pagination.bootstrap-4") }}
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

<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    
    $(document).on('click', '.btn-delete', function (e) {
        e.preventDefault();
        var id = $(this).data('id');

        Swal.fire({
            title: 'Konfirmasi',
            text: 'Anda yakin ingin menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                
                $.ajax({
                    url: '/admin/shelf/' + id, 
                    type: 'DELETE',
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function (data) {
                        
                        Swal.fire(
                            'Sukses!',
                            'Data berhasil dihapus.',
                            'success'
                        ).then(() => {
                            
                            window.location.reload();
                        });
                    },
                    error: function (data) {
                        
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan saat menghapus data.',
                            'error'
                        );
                    }
                });
            }
        });
    });
</script>
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

             //ajax delete

             const button = document.getElementById("destroyRak");
                button.addEventListener("click", function() {
                        // code to execute when button is clicked
                        // Swal.fire("Hello, SweetAlert!");
                        Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: !0,
                        confirmButtonColor: "#51d28c",
                        cancelButtonColor: "#f34e4e",
                        confirmButtonText: "Yes, delete it!",
                    }).then(function (t) {
                        t.value &&
                            Swal.fire(
                                "Deleted!",
                                "Your file has been deleted.",
                                "success"
                            );
                    });
                });

    }); 
        
</script>

@endsection