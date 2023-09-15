@extends('layouts.app')

@section('title')
    Profile
@endsection

@section('content') 
    <div class="container page-profile">

        @section('nav-title')
            Profile
        @endsection
        @include('includes.nav-app')

        <div class="row mt-3">
            @auth
            <div class="col-12 px-5">
                <div class="d-flex align-items-center justify-content-start gap-2">
                    <div class="user-initial__block d-flex justify-content-center align-items-center">
                        {{ auth()->user()->name[0] }}
                    </div>
                    <div class="d-flex flex-column col50 gap-2">
                        <div class="text-decoration-none d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column justify-content-start w-100 gap-1">
                                <div class="fs-18 pl-2 my-1">
                                    <span class="font-weight-bold">
                                        {{ auth()->user()->name }}
                                    </span>
                                </div>
                                <div class="custom-button-class pointer gap-2  w-100 h-auto p-2 m-0 z-index-1">
                                    <div class="d-flex align-items-center fs-12 font-weight-bold gap-2 py-1">
                                        Lengkapi Profil Anda
                                        <img src="https://rsrc.easyeat.ai/mweb/halfarrow2.webp" width="7" height="13" style="opacity: 1; transition: opacity 0.5s ease 0s;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
                <div class="col-12 shadow py-2 px-4">
                    <p>Masuk / Daftar untuk cek profile lengkap anda</p>
                    <div class="custom-button-class gap-2 pointer" id="login">
                        <div class="d-flex align-items-center gap-2">
                            Masuk Sekarang
                            <img src="/images/arrow-right.webp" width="7" height="13" style="opacity: 1; transition: opacity 0.5s ease 0s;">
                        </div>
                    </div>
                </div>
            @endauth
        </div>
        <div class="d-flex flex-column gap-4 p-5">
            <div class="d-flex justify-content-between align-items-center pointer" id="pesanan-saya">
                <div class="d-flex align-items-center gap-3">
                    <img src="images/myorders-icon.png" alt="Pesanan Saya" width="18" height="18" style="opacity: 1; transition: opacity 0.5s ease 0s;">
                    <div class="font-weight-bold">
                        Pesanan Saya
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <img src="images/arrow-right-gray.webp" alt="arrow" width="9" height="16" style="opacity: 1; transition: opacity 0.5s ease 0s;">
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center pointer" id="syarat_ketentuan">
                <div class="d-flex align-items-center gap-3">
                    <img src="/images/help.webp" alt="Syarat dan Ketentuan" width="18" height="18" style="opacity: 1; transition: opacity 0.5s ease 0s;">
                    <div class="font-weight-bold">
                        Syarat dan Ketentuan
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <img src="images/arrow-right-gray.webp" alt="arrow" width="9" height="16" style="opacity: 1; transition: opacity 0.5s ease 0s;">
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center pointer fs-16 fw-600" id="keluar">
                <div class="d-flex align-items-center gap-3">
                    <img src="/images/logout.webp" alt="Keluar" width="18" height="18" style="opacity: 1; transition: opacity 0.5s ease 0s;">
                    <div class="text-danger font-weight-bold">
                            Keluar
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <img src="images/arrow-right-gray.webp" alt="arrow" width="9" height="16" style="opacity: 1; transition: opacity 0.5s ease 0s;">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){

            // Click login
            $('#login').click(function(){
                window.location.href='{{ route('login') }}';
            })

            // Click Pesanan saya
            $('#pesanan-saya').click(function(){
                window.location.href='{{ route('order') }}';
            })
            // Click S & K
            $('#syarat_ketentuan').click(function(){
                window.location.href='{{ route('home') }}';
            })

            // Click keluar
            $('#keluar').click(function(){
                $('#logout-form').submit();
            })
            

            var quantitiy=0;
            $('.quantity-right-plus').click(function(e){
                    
                    // Stop acting like a button
                    e.preventDefault();
                    // Get the field name
                    var quantity = parseInt($('#quantity').val());
                    
                    // If is not undefined
                        
                        $('#quantity').val(quantity + 1);

                    
                        // Increment
                    
            });

            $('.quantity-left-minus').click(function(e){
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());
                
                // If is not undefined
            
                    // Increment
                    if(quantity>0){
                    $('#quantity').val(quantity - 1);
                    }
            });
        });
    </script>
@endpush