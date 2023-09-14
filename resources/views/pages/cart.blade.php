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

    <div class="container page-cart">
        <div class="row mt-3">
            <div class="col-12 d-flex flex-row shadow align-items-center">
                <a href="{{ route('home') }}">
                    <img src="https://rsrc.easyeat.ai/mweb/arrowbg1.webp" alt="left-Arrow-Back" width="21" height="15" style="opacity: 1; transition: opacity 0.5s ease 0s;">
                </a>
                <h3 class="mt-1 ml-2">Joal.Id</h3>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 shadow">
                <div class="row mt-3">
                    <div class="col-8">
                        <span class="fontStyleMedium">Ringkasan Pesanan</span>
                    </div>
                    <div class="col-4">
                        <p>2 item</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-8">
                        <div class="d-flex flex-row my-3">
                            Avocado on toast
                            <div class="ml-1">
                                <div class="input-group">
                                        <button type="button" class="quantity-left-minus btn btn-danger"  data-type="minus" data-field="">
                                          <span class="">-</span>
                                        </button>
                                    <input type="number" id="quantity" name="quantity" class="border-1 w-25 text-center" value="2" min="1" max="100">
                                        <button type="button" class="quantity-right-plus btn btn-success" data-type="plus" data-field="">
                                            <span class="">+</span>
                                        </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 mt-3">
                        <p>Rp. 150.000</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-8">
                        <div class="d-flex flex-row my-3">
                            Avocado on toast
                            <div class="ml-1">
                                <div class="input-group">
                                        <button type="button" class="quantity-left-minus btn btn-danger"  data-type="minus" data-field="">
                                          <span class="">-</span>
                                        </button>
                                    <input type="number" id="quantity" name="quantity" class="border-1 w-25 text-center" value="2" min="1" max="100">
                                        <button type="button" class="quantity-right-plus btn btn-success" data-type="plus" data-field="">
                                            <span class="">+</span>
                                        </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 mt-3">
                        <p>Rp. 150.000</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-8">
                        <div class="d-flex flex-row my-3">
                            Avocado on toast
                            <div class="ml-1">
                                <div class="input-group">
                                        <button type="button" class="quantity-left-minus btn btn-danger"  data-type="minus" data-field="">
                                          <span class="">-</span>
                                        </button>
                                    <input type="number" id="quantity" name="quantity" class="border-1 w-25 text-center" value="2" min="1" max="100">
                                        <button type="button" class="quantity-right-plus btn btn-success" data-type="plus" data-field="">
                                            <span class="">+</span>
                                        </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 mt-3">
                        <p>Rp. 150.000</p>
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
                                    Rp.150.000
                                </div>
                                <div class="col-6 mb-3">
                                    Biaya Layanan @5%
                                </div>
                                <div class="col-6 mb-3 d-flex justify-content-end align-items-end">
                                    Rp.7.500
                                </div>
                                <div class="col-6 mb-3">
                                    Pajak @10%
                                </div>
                                <div class="col-6 mb-3 d-flex justify-content-end align-items-end">
                                    Rp.15.750
                                </div>
                            </div>

                            <div class="row divider-border">
                                <div class="col-6 my-3 fontStyleMedium">
                                    Total
                                </div>
                                <div class="col-6 mb-3 d-flex justify-content-end align-items-end fontStyleMedium">
                                    Rp.150.000
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
                        <span class="fs-12 appHeader">2 item</span><span class="fw-700 fs-14 font-weight-bold">Rp 173.300</span>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="/vendor/jquery/jquery.min.js"></script>
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
  </body>
</html>