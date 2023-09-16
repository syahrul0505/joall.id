@extends('layouts.app')

@section('title')
    Cart
@endsection

@section('content')
    <div class="container page-cart bg-white">
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
                            <div class="row mt-3 border-gray-cart shadow rounded">
                                <div class="col-9">
                                    <div class="d-flex flex-row my-3">
                                        <div class="col-8 fs-12">
                                            {{ $cart->product->name }}
                                            @if ($addons->count() > 0)
                                                <div class="d-flex flex-row gap-2 mt-3">
                                                    <p>Addon: </p>
                                                    @foreach ($addons as $addon)
                                                        @if ($cart->id == $addon->cart_id)
                                                            <p>{{ $addon->addon->name }},</p>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <button type="button" class="btn btn-primary fs-12 p-1" data-bs-toggle="modal" data-bs-target="#editCart" data-productid={{ $cart->id }}>
                                                    Ubah
                                                </button>
                                                <button type="button" class="btn btn-danger fs-12 p-1" data-bs-toggle="modal" data-bs-target="#editCart" data-productid={{ $cart->id }}>
                                                    Delete
                                                </button>
                                            @endif
                                        </div>
                                        <div class="col-4 ml-1 d-flex justify-content-center">
                                            <div class="input-group">
                                                    {{-- <button type="button" class="btn" onclick="deleteCart({{ $cart->id }})"  data-type="minus">
                                                    <span class="">-</span>
                                                    </button> --}}
                                                <input type="number" id="quantity{{ $cart->id }}" name="quantity" class="form-control w-25 text-center quantity" value="{{ $cart->quantity }}" disabled>
                                                    {{-- <button type="button" class="quantity-right-plus btn" data-type="plus" data-id="{{ $cart->id }}">
                                                        <span class="">+</span>
                                                    </button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 mt-3 fs-12">
                                    <p>Rp. {{ number_format($cart->product->price * $cart->quantity) }}</p>
                                    @php
                                        $addon_total = 0;
                                    @endphp
                                    @foreach ($addons as $addon)
                                        @if ($addon->cart_id == $cart->id)
                                            @php
                                                $addon_total += $addon->addon->price
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if ($addon_total > 0)
                                        <p>Rp. {{ number_format($addon_total) }}</p>
                                    @endif
                                </div>
                            </div>

                            @php
                                $sub_total = $cart->product->price * $cart->quantity;
                                $total += $sub_total + $addon_total;
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


    {{-- Modal Pesan --}}
    <!-- Modal -->
        <div class="modal fade" id="editCart" tabindex="-1" aria-labelledby="editCartLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-pesan">
                    <div class="modal-header bg-custom-gradient text-white">
                        <h1 class="modal-title fs-5" id="editCartLabel">Pesan Sekarang</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="POST" id="form-add">
                        <div class="modal-body">
                                @csrf
                                <input type="hidden" name="product_id" id="product_id">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 d-flex justify-content-center align-items-center">
                                                <div class="form-group">
                                                    <img alt="" style="max-height: 200px; max-width: 200px;" id='img-product-add'>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Nama Product</label>
                                                    <input type="name" class="form-control" id="name" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="price">Harga Product</label>
                                                    <input type="price" class="form-control" id="price" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="deskripsi">Deskripsi Product</label>
                                                    <textarea class="form-control" id="deskripsi" rows="3" disabled></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="card">
                                                <div class="card-body">
                                                    <span class="fs-20 font-weight-bold">Tambahan Menu</span>

                                                    <div class="row mt-3">
                                                        <div class="card">
                                                            <span class="fs-14">Pilih Menu (opsional)</span>
                                                            <div class="card-body">
                                                                @forelse ($addons as $addon)
                                                                    <div class="row">
                                                                        <div class="col-6 fs-14">{{ $addon->name }}</div>
                                                                        <div class="col-6 d-flex flex-row justify-content-end">
                                                                            <div class="form-check">
                                                                                <label class="form-check-label fs-14" for="flexCheckDefault">
                                                                                    Rp. {{ number_format($addon->price) }}
                                                                                </label>
                                                                                <input class="form-check-input checkbox-addons pointer" type="checkbox" value="{{ $addon->id }}" id="flexCheckDefault" name="addons[]">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @empty
                                                                    <div class="row">
                                                                        <div class="col-12"><p>Tidak ada Menu</p></div>
                                                                    </div>
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <div class="row">
                                    <div class="col-12 d-flex flex-row justify-content-between mb-3">
                                        <div class="d-flex align-items-center gap-2 m-0">
                                            <label for="qty">Qty : </label>
                                            <input type="number" min="0" class="w-25" id="qty" name="quantity" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary my-2 btn-add-cart">Add to Cart</button>
                                    </div>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    {{-- End Modal Pesan --}}
@endsection

@push('scripts')
<script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
    <script>

        function deleteCart(id) {
            var quantity = parseInt($(`#quantity${id}`).val());
            
            // If is not undefined
            if(quantity == 1) {
                    axios.post('/delete-cart/' + id);
                    location.reload();
            }
            // Increment
            if(quantity > 1){
                $(`#quantity${id}`).val(quantity - 1);
            }
        }
        $(document).ready(function(){
            var quantitiy = 0 ;
            $('.quantity-right-plus').click(function(e){
                    
                    // Stop acting like a button
                    e.preventDefault();
                    // Get the field name
                    let cart_id = $(this).data('id');
                    var quantity = parseInt($(`#quantity${cart_id}`).val());
                    
                    // If is not undefined
                        
                        $(`#quantity${cart_id}`).val(quantity + 1);

                    
                        // Increment
                    
            });

            // $('.quantity-left-minus').click(function(e){
            //     // Stop acting like a button
            //     e.preventDefault();
            //     // Get the field name
            //     let cart_id = $(this).data('id');
            //     var quantity = parseInt($(`#quantity${cart_id}`).val());
                
            //     // If is not undefined
            //         if(quantitiy == 1) {
            //             axios.post('/delete-cart/', 2);
            //         }
            //         // Increment
            //         if(quantity>0){
            //             $(`#quantity${cart_id}`).val(quantity - 1);
            //         }
            // });
        });
    </script>
@endpush