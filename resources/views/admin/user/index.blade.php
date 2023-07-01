@extends('layouts.master')
@section('title') Manajemen User @endsection

@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}">
<link href="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css">
<!-- Sweet Alert-->
<link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') User @endslot
@slot('title') Manajemen User @endslot
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
                                    <a href="{{ route('admin.user.create') }}" type="button" class="btn btn-success mb-4" ><i class="mdi mdi-plus me-1"></i> Tambah User</a>
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
                                                <th class="text-center">User name</th>
                                                <th class="text-center">Email</th>
                                                {{-- <th class="text-center">Password</th> --}}
                                                <th class="text-center">User Role</th>
                                                <th class="text-center">Cabang</th>
                                                <th class="text-center">Profil Image</th>
                                                <th class="text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($users as $item => $member)
                                            <tr>
                                                <td class="text-center">{{ $item + 1 }}</td>
                                                <td class="text-center">{{ $member->name }}</td>
                                                <td class="text-center">{{ $member->email }}</td>
                                                {{-- <td class="text-center" style="max-width: 100px;">{{ $member->password }}</td> --}}
                                                <td class="text-center"><span class="badge bg-success font-size-12"><i class="mdi mdi-star me-1"></i>{{ $member->role }}</span></td>
                                                <td class="text-center">{{ $member->cabang }}</td>
                                                <td class="text-center">
                                                    <img class="rounded-circle header-profile-user" src="{{ (isset($member->avatar) && $member->avatar != '')  ? url('/storage/users/'. $member->avatar ) : asset('/assets/images/users/avatar-1.jpeg') }}" alt="Header Avatar">
                                                </td>
                                                <td class="text-end">
                                                    <div class="dropdown">
                                                        <a class="btn btn-link text-body shadow-none dropdown-toggle" href="#"
                                                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bx bx-dots-horizontal-rounded"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="{{ route('admin.user.edit', $member->id) }}">Edit User</a></li>
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
                                        {{ $users->links("vendor.pagination.bootstrap-4") }}
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

