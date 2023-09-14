<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Joal|ID</title>
    <link href="/style/main.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <div class="container page-home">
        <div class="row mt-3 py-3">
            <div class="col-9 d-flex flex-row">
                <h3 class="font-weight-bold">Joal.id</h3>
                <div class="mx-4">
                    <h4 class="font-weight-bold">Joal.id</h4>
                    <div class="d-flex info-home">
                        <p class="px-2 bg-success text-white rounded rate-home">&#10025; | 5.0</p>
                        <p> | <p class="ml-1 d-none d-lg-block"> Indonesia,</p> <span class="ml-1">Jakarta</span></p>
                    </div>
                </div>
            </div>
            <div class="col-3 d-flex justify-content-end">
                <img src="https://rsrc.easyeat.ai/mweb/bell.png" class="mx-2" alt="bell" width="28" height="28" style="opacity: 1; transition: opacity 0.5s ease 0s;">
                <img src="https://rsrc.easyeat.ai/mweb/profile-red.png" width="28" height="28" style="opacity: 1; transition: opacity 0.5s ease 0s;">
            </div>
        </div>
        
        <div class="row mt-2 mx-1">
            <div class="col-12 py-2 open-info">
                Buka Hari Ini pada 8:00 AM
            </div>
        </div>

        <div class="row mt-3 mx-1 divider-border justify-content-between">
            <div class="col-6 mt-3 py-3 py-md-5 rounded text-white font-weight-bold referral-card">
                Share ke Teman <br>
                Dapatkan Hadiah Menarik
            </div>
            <div class="col-5 bg-warning mt-3 py-3 py-md-5 rounded text-white font-weight-bold promo-card">
                Promo Menarik <br>
                Hemat Biaya
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-10">
                <div class="d-block rounded-pill py-2 recommended-home">
                    <div class="mx-3 d-flex flex-row">
                        <div class="dropdown">
                            <button type="button" class="btn mb-0 border-0 bg-transparent text-danger font-weight-bold d-block w-100 button-dropdown"  data-bs-toggle="dropdown" aria-expanded="false">
                                List Of Category
                                <img src="images/down-arrow.png" class="arrow-button" width="15" height="20" alt="" style="margin-top: 3px;">
                            </button>
                                <ul class="dropdown-menu list-category">
                                    @foreach ($categories as $category)
                                        <li><a class="dropdown-item" href="#{{ $category->slug }}">{{ $category->name }}</a></li>
                                    @endforeach
                                </ul>
                        </div>
                        {{-- <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown button
                            </button>
                            <ul class="dropdown-menu  list-category">
                                @foreach ($categories as $category)
                                        <li><a class="dropdown-item" href="#{{ $category->slug }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-2">
                <img src="https://rsrc.easyeat.ai/mweb/Search2.png" alt="search" width="25" height="25" style="margin-top: 10px;">
            </div>
        </div>

        <div class="row mt-3 component-products">

            @foreach ($categories as $category)
                <div class="col-12 shadow py-3">
                    <h1 id="{{ $category->slug }}">{{ $category->name }}</h1>
                    <div class="accordion">
                        <div class="accordion-item">
                                <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $category->slug }}" aria-expanded="true" aria-controls="{{ $category->slug }}">
                                    <span class="font-weight-bold">{{ $category->name }}</span> <span class="bg-danger rounded mx-2 p-1 text-white product-sum">
                                                @php $count = 0; @endphp
                                                @foreach ($products as $product)
                                                @php
                                                    if ($product->categories_id == $category->id){
                                                        $count += 1;
                                                    }
                                                @endphp
                                                @endforeach
                                                {{ $count }}
                                            </span>
                                </button>
                                </h2>
                                <div id="{{ $category->slug }}" class="accordion-collapse collapse show">
                                    @foreach ($products as $product)
                                        @if ($product->categories_id == $category->id)
                                                <div class="accordion-body">
                                                    <div class="row mb-4 pt-4 divider-border">
                                                        <div class="col-6 col-md-8">
                                                            <div class="bestseller-tag">
                                                            &#10025; Bes Seller
                                                            </div>
                                                            <div class="products-text">
                                                                {{ $product->name }}
                                                            </div>
                                                            <div class="products-subtitle">
                                                                {{ $product->description }}
                                                            </div>
        
                                                            <div class="products-price">
                                                                Rp. {{ number_format($product->price) }}
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-md-4 d-flex align-items-end justify-content-center">
                                                            <img src="{{ Storage::url($product->photos) }}" alt="Beef Goulash Tagliatelle" width="100%"  class="cardImage" style="opacity: 1; transition: opacity 0.5s ease 0s; max-height: 150px;">
                                                            <div class="cardButtonAction">
                                                                <button class="pointer d-flex justify-content-center align-items-center addBtn" data-bs-toggle="modal" data-bs-target="#addToCart" data-productid={{ $product->id }}>
                                                                    <div class="fw-500 fs-16">Tambah</div>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        @endif
                                    @endforeach
                                </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    
    <div class="container page-home">
        <div class="footer mb-2">
            <a href="{{ route('cart') }}" class="d-block text-decoration-none">
                <div class="rounded-pill py-3 recommended-home bg-danger cart-button" role="button">
                    <div class="mx-3 d-flex flex-row justify-content-center align-items-center font-weight-bold text-white">
                        <img src="https://rsrc.easyeat.ai/mweb/cart.webp" alt="cart" width="30" height="25" style="opacity: 1; transition: opacity 0.5s ease 0s;">
                        <div class="card-badge">2</div>
                        <p class="mb-0 ml-1">Lihat Keranjang</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    {{-- Modal Filter --}}
    <!-- Modal -->
    {{-- <div class="modal fade" id="filter" tabindex="-1" aria-labelledby="filterLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h1 class="modal-title fs-5" id="filterLabel">Pesan Sekarang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <button id="click" data-category="pasta">Pasta</button>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- End Modal Filter --}}


    {{-- Modal Pesan --}}
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
                                            <textarea class="form-control" id="deskripsi" rows="3" disabled></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="qty">Qty : </label>
                                            <input type="number" min="0" class="w-25" id="qty" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <button type="submit" class="btn btn-primary my-2">Add to Cart</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Pesan --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script>
        // function closeFilter() {
        //     $('#filter').modal('hide');
        // }
        $(document).ready(function(){
            $('.cart-button').on('click', function() {
                console.log('cart button clicked');
            });

            $("#click").click(function (){
                let data = $(this).data("category");
                $('html, body').animate({
                    scrollTop: $(`#${data}`).offset().top
                }, 500);
            });

            $('.addBtn').on('click', function(value){

                let productId = $(this).data('productid');

                console.log(productId);
                
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
  </body>
</html>