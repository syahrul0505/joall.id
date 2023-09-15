@extends('layouts.app')

@section('title')
    Cart
@endsection

@section('content')
    <div class="container page-cart">
        @section('nav-title')
            Cart
        @endsection
        @include('includes.nav-app')

        <div class="row mt-3">
            <div class="col-12 shadow">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row mt-3">
                            <div class="col-9">
                                <span class="fontStyleMedium">Ringkasan Pesanan</span>
                            </div>
                            <div class="col-3">
                                <p>{{ $carts->count() }} item</p>
                            </div>
                        </div>
                        @php
                            $sub_total = 0;
                            $total = 0;
                        @endphp
                        @forelse ($carts as $cart)
                            <div class="row mt-3">
                                <div class="col-9">
                                    <div class="d-flex flex-row my-3">
                                        <div class="col-5">
                                            {{ $cart->product->name }}
                                        </div>
                                        <div class="col-7 ml-1">
                                            <div class="input-group">
                                                    <button type="button" class="quantity-left-minus btn btn-danger"  data-type="minus" data-field="">
                                                    <span class="">-</span>
                                                    </button>
                                                <input type="number" id="quantity" name="quantity" class="border-1 w-25 text-center" value="{{ $cart->quantity }}" min="1" max="100">
                                                    <button type="button" class="quantity-right-plus btn btn-success" data-type="plus" data-field="">
                                                        <span class="">+</span>
                                                    </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 mt-3">
                                    <p>Rp. {{ number_format($cart->product->price * $cart->quantity) }}</p>
                                </div>
                            </div>

                            @php
                                $sub_total = $cart->product->price * $cart->quantity;
                                $total += $sub_total;
                            @endphp
                        @empty
                            <div class="row mt-3">
                                <p class="text-center">Keranjang Kosong</p>
                            </div>
                        @endforelse
                    </div>
                </div>
                
            </div>
        </div>
        <div class="row mt-3 mb-5">
            <div class="col-12 shadow">
                <div class="accordion my-3" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                            <span class="fontStyleMedium">Rincian Tagihan</span>
                        </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-6 mb-3">
                                    Total Item
                                </div>
                                <div class="col-6 mb-3 d-flex justify-content-end align-items-end">
                                    Rp. {{ number_format($total) }}
                                </div>
                                <div class="col-6 mb-3">
                                    Biaya Layanan @5%
                                </div>
                                <div class="col-6 mb-3 d-flex justify-content-end align-items-end">
                                    @php
                                        $biaya_layanan = $total * 5 / 100;
                                    @endphp
                                    Rp. {{ number_format($biaya_layanan) }}
                                </div>
                                <div class="col-6 mb-3">
                                    Pajak @10%
                                </div>
                                <div class="col-6 mb-3 d-flex justify-content-end align-items-end">
                                    @php
                                        $pajak = $total * 10 / 100;
                                    @endphp
                                    Rp. {{ number_format($pajak) }}
                                </div>
                            </div>

                            <div class="row divider-border">
                                <div class="col-6 my-3 fontStyleMedium">
                                    Grand Total
                                </div>
                                <div class="col-6 mb-3 d-flex justify-content-end align-items-end fontStyleMedium">
                                    @php
                                        $grand_total = $total + $biaya_layanan + $pajak;
                                    @endphp
                                    Rp. {{ number_format($grand_total) }}
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pageFooter d-flex align-items-center justify-content-center pointer flex-column mt-5">
            <div id="cartFooter" class="cartsNew">
                <div class="d-flex align-items-center justify-content-between flex-row viewCart pr-2 pl-2">
                    <div class="d-flex flex-column col-5">
                        <span class="fs-12 appHeader">{{ $carts->count() }} item</span><span class="fw-700 fs-14 font-weight-bold">Rp {{ number_format($grand_total) }}</span>
                    </div>
                    <div class="fw-600 col-7 d-flex justify-content-end" style="cursor: pointer;">
                        <div class="custom-button-class pointer gap-2  primary fs-14 fw-400 large">
                            <div class="">
                                Lanjut
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
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