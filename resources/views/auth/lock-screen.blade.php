@extends('layouts.master-without_nav')

@section('title')Lock Screen E-Dosel @endsection

@section('content')

<div class="authentication-bg min-vh-100">
    <div class="bg-overlay"></div>
    <div class="container">
        <div class="d-flex flex-column min-vh-100 px-3 pt-4">
            <div class="row justify-content-center my-auto">
                <div class="col-md-8 col-lg-6 col-xl-5">

                    <div class="text-center mb-4">
                        <a href="index.html">
                            <img src="assets/images/logo-sm.svg" alt="" height="22"> <span class="logo-txt">E-Dosel</span>
                        </a>
                   </div>

                    <div class="card">
                        <div class="card-body p-4"> 
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Lock Screen</h5>
                                <p class="text-muted">Masukan Kembali Password anda untuk Login!</p>
                            </div>
                            <div class="p-2 mt-4">
                                <div class="user-thumb text-center mb-4">
                                    <img src="{{ (isset(Auth::user()->avatar) && Auth::user()->avatar != '')  ? url('/storage/users/'. auth()->user()->avatar ) : asset('/assets/images/users/avatar-1.jpeg') }}" class="rounded-circle img-thumbnail avatar-lg" alt="thumbnail">
                                    <h5 class="font-size-15 mt-3">{{ auth()->user()->name }}</h5>
                                </div>
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <input name="email" type="hidden" class="form-control @error('email') is-invalid @enderror" id="username" value="{{ auth()->user()->email }}"  placeholder="Enter Email" autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>Kolom Email harus terisi!</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="userpassword">Password</label>
                                        <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" id="userpassword" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>Kolom Password harus terisi!</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="mt-3 text-end">
                                        <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">Unlock</button>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <p class="mb-0">Bukan Anda ? kembali <a href="auth-login.html" class="fw-medium text-primary"> Sign In </a></p>
                                    </div>
                                </form>
                            </div>
        
                        </div>
                    </div>

                </div><!-- end col -->
            </div><!-- end row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center text-muted p-4">
                        <p class="text-white-50">© <script>document.write(new Date().getFullYear())</script> E-Dosel.</p>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- end container -->
</div>

@endsection
