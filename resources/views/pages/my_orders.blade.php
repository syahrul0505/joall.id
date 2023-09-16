@extends('layouts.app')

@section('title')
    Pesanan Saya
@endsection

@section('content') 
    <div class="container page-pesanan-saya bg-white">

        <div class="row mt-3">
            <div class="col-12 d-flex flex-row shadow align-items-center">
                <a href="{{ route('profile') }}">
                    <img src="https://rsrc.easyeat.ai/mweb/arrowbg1.webp" alt="left-Arrow-Back" width="21" height="15" style="opacity: 1; transition: opacity 0.5s ease 0s;">
                </a>
                <h4 class="mt-1 ml-2 py-2">Pesanan Saya</h4>
            </div>
        </div>

        <div class="row mt-5">
            <h3>Pesanan Aktif</h3>
            {{-- <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        tes
                    </div>
                </div>
            </div> --}}
            <div span="order">
                <a class="text-decoration-none text-secondary" href="#">
                    <div class=" cardContainer mb-4 fs-16">
                        <div class="flex-column d-flex justify-content-between">
                            <div class="active-order-img text-center">
                                <img src="images/order-plate1.png" class="order-image" alt="default_image" style="opacity: 1; transition: opacity 0.5s ease 0s;">
                            </div>
                            <div class=" d-flex justify-content-between  px-10 py-3">
                                <div class="d-flex flex-1 flex-column gap-1">
                                    <div class="mb-0 appSubHeader  fs-16 fw-600">
                                        NOB Cafe
                                    </div>
                                    <div class="opacity-70 appSubHeader fs-12">
                                        1 item
                                    </div>
                                </div>
                                <div class="d-flex flex-2 flex-column justify-content-between align-items-end gap-2">
                                    <div class="text-tag fs-12 px-2 waiting-tag">
                                        Menunggu Konfirmasi
                                    </div>
                                    <div class="fs-12 appHeader">
                                        15 Sep, 1.56 PM
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
@endpush