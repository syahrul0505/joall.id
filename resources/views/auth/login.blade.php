@extends('layouts.auth')

@section('content')
<div class="page-auth">
    <div class="section-store-auth" data-aos="fade-up">
        <div class="container">
            <div class="text-center">
                <h1>Joal <sup>id</sup></h1>
            </div>
            <div class="row align-items-center justify-content-center row-login">
                @if(session()->has('message'))
                    <div class="alert alert-success col-md-8 d-flex justify-content-between align-items-center" id="success">{{ session('message') }} <span class="btn border-0 font-weight-bold" id="btnClose">X</span></div>
                @endif
                <div class="col-lg-6 text-center">
                    <img src="/images/login-placeholder.png" alt="" class="w-50 mb-4 mb-lg-none">
                </div>
                <div class="col-lg-5">
                    <h2>
                    Belanja kebutuhan utama, <br>
                    menjadi lebih mudah
                    </h2>
                    <form method="POST" action="{{ route('login') }}" class="mt-3">
                        @csrf
                        <div class="form-group">
                            <label>Email Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <p>
                            Dont have account ? 
                            <a href="{{ route('register') }}" class="text-decoration-none">
                                    Register
                            </a>
                        </p>
                        <button type="submit" class="btn btn-success btn-block mt-4">
                            Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session()->has('message'))
    @push('script')
        <script>
            const success = document.querySelector('#success');
            const close = document.querySelector('#btnClose');

            setTimeout(() => {
                success.classList.add('d-none');
            }, 5000);
        
            close.addEventListener('click', () => {
                success.classList.add('d-none');
            });
        </script>
    @endpush
@endif

@endsection
