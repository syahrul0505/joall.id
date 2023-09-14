@extends('layouts.app')

@section('title')
    Store Home Page
@endsection

@section('content')
    <div class="page-content page-home">
    <section class="store-carousel">
        <div class="container">
        <div class="row">
            <div class="col-lg-12" data-aos="zoom-in">
            <div id="storeCarousel" class="carousel slide" dara-ride="carousel">
                <ol class="carousel-indicators">
                <li class="active" data-target="#storeCarousel" data-slide-to="0">
                </li>
                <li data-target="#storeCarousel" data-slide-to="1">
                </li>
                <li data-target="#storeCarousel" data-slide-to="2">
                </li>
                </ol>
                <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="/images/food-banner.jpg" class="d-block w-100" style="max-height: 390px;">
                </div>
                <div class="carousel-item">
                    <img src="/images/food-banner.jpg" class="d-block w-100" style="max-height: 390px;">
                </div>
                <div class="carousel-item">
                    <img src="/images/food-banner.jpg" class="d-block w-100" style="max-height: 390px;">
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </section>

    <section class="store-trend-categories">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                <h5>Trend Categories</h5>
                </div>
            </div>
            <div class="row">
                @php
                    $incrementCategory = 0
                @endphp
                @forelse ($categories as $category)
                <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up" data-aos-delay="{{ $incrementCategory += 100 }}">
                    <a href="" class="component-categories d-block text-decoration-none">
                        <div class="categories-image">
                        <img src="{{ Storage::url($category->photos) }}" class="w-100">
                        </div>
                        <p class="categories-text">
                        {{ $category->name }}
                        </p>
                    </a>
                </div>
                @empty
                <div class="col-12">
                    <h2>No Categories Found</h2>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="store-new-products">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                <h5>New Products</h5>
                </div>
            </div>
            <div class="row">
                @php
                    $incrementProduct = 0
                @endphp
                @forelse ($products as $product)    
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $incrementProduct += 100 }}">
                    <a href="#" class="component-products d-block text-decoration-none">
                        <div class="products-thumbnail">
                        <div 
                            class="products-image" 
                            style="
                                    background-image: url('{{ Storage::url($product->photos) }}')
                            "></div>
                        </div>
                        <div class="bg-success best-seller">
                            Best Seller
                        </div>
                        <div class="products-text my-2 font-weight-bold">
                            {{ $product->name }}
                        </div>
                        <div class="products-price">
                            Rp. {{ number_format($product->price) }}
                            <button class="btn btn-success float-right add-to-cart" data-bs-toggle="modal" data-bs-target="#addToCart" data-productid="{{ $product->id }}">Pesan</button>
                        </div>
                        <div class="add-to-cart float-right my-4">
                        </div>
                    </a>
                </div>
                @empty
                    <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                        <h2>No Product Found</h2>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection

@push('modal-pesan')
<!-- Modal -->
<div class="modal fade" id="addToCart" tabindex="-1" aria-labelledby="addToCartLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h1 class="modal-title fs-5" id="addToCartLabel">Pesan Sekarang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
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
                                        <textarea class="form-control" id="deskripsi" rows="3" disabled>Tes123</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="qty">Qty : </label>
                                        <input type="number" min="0" class="w-25" id="qty" autofocus required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="ml-3">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@endpush

@push('scripts')
    <script>
        $(document).ready(function(){

            $('.add-to-cart').on('click', function(value){

                let productId = $(this).data('productid');
                
                $('#product_id').val('')
                $('#name').val('')
                $('#price').val('')
                $('#deskripsi').val('')
                $('#img-product-add').attr('src', '');

                $.get("getProductAddById/" + productId, function(data, status){
                $('#product_id').val(data.product.id)
                $('#name').val(data.product.name)
                $('#price').val(data.product.price)
                $('#deskripsi').val(data.data)
                $('#img-product-add').attr('src', `/storage/${data.product.photos}`);
                
                
                // Contoh passing data bentuk array
                // $contoh = $('#contoh');
                // data.contoh.forEach(function(item) {
                //      $contoh.append('<option value="' + item.id + '">' +item.name + '</li>')
                // });


                });
        
            });
        });
    </script>
@endpush