@extends('layouts.dashboard.app')

@section('title')
    Products
@endsection

@section('content')
    <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Products</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>


    <!-- Content Row -->

    <div class="row">
        <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addProduct">
                                + Add Product
                                </button>
                                <div class="table table-responsive">
                                    <table class="w-100" id="crudTable">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Product</th>
                                                <th>Kategori</th>
                                                <th>stock</th>
                                                <th>Price</th>
                                                <th>images</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($products as $product)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->category->name }}</td>
                                                    <td>{{ $product->stock }}</td>
                                                    <td>{{ number_format($product->price) }}</td>
                                                    <td><img src="{{ Storage::url($product->photos) }}" style="max-height: 50px;" /></td>
                                                    <td style="width: 10%;">
                                                        <div class="d-flex flex-row">
                                                                <button type="button" class="btn btn-primary edit-product mr-2" data-bs-toggle="modal" data-bs-target="#editProduct" data-productid="{{ $product->id }}">edit</button>
                                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" id="form{{ $product->id }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                            <button type="button" class="btn btn-danger border-0 modalDelete" data-id="{{ $product->id }}">Delete</button>
                                                                </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                    <p>No category found</p>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

</div>
@endsection


@section('modal-box')
    {{-- Modal Box Confirm --}}
    <div id="modal-dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="px-3 py-3 text-white">
                    <a href="#" data-bs-dismiss="modal" aria-hidden="true" class="close text-white">×</a>
                    <h3>Are you sure</h3>
                </div>
                <div class="modal-body text-white">
                    <p>
                        Are you sure you want to delete this product ? <br/><br/>
                        This command will also delete all product photos in the product section of the gallery
                    </p>
                </div>
                <div class="modal-footer">
                <a href="#" id="btnYes" class="btn confirm text-white">Yes</a>
                <a href="#" data-bs-dismiss="modal" aria-hidden="true" class="btn text-white">No</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal-add')
<!-- Modal -->
<div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addProductLabel">Add Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.store') }}" enctype="multipart/form-data" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input type="number" min="0" id="stock" name="stock" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" min="0" id="price" name="price" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="category">Category</label>
                            <select id="category" name="categories_id" class="form-control">
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-12">
                            <label for="image-add" class="form-label">Product Image (max 1MB)</label>
                            <img class="img-preview-add img-fluid mb-3 col-sm-5" style="max-width: 100px; max-height: 100px;">
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image-add" name="photos" onchange="previewImageAdd()">
                            @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-floating my-3">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="description"></textarea>
                            <label for="floatingTextarea2">Description Product</label>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal-edit')
<!-- Modal -->
<div class="modal fade" id="editProduct" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editProductLabel">Edit Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="updateProduct" enctype="multipart/form-data" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="product_id" id="product_id">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit_name">Product Name</label>
                                <input type="text" id="edit_name" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit_price">Price</label>
                                <input type="number" min="0" id="edit_price" name="price" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit_stock">Stock</label>
                                <input type="number" min="0" id="edit_stock" name="stock" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="category">Category</label>
                            <select id="category" name="categories_id" class="form-control">
                                <option selected id="edit_category">
                                    
                                </option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            {{-- <select id="contoh" name="categories_id" class="form-control">
                            </select> --}}
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-12">
                            <label for="image-edit" class="form-label">Product Image (max 1MB)</label>
                            <img class="img-preview-edit img-fluid mb-3 col-sm-5" style="max-width: 100px; max-height: 100px;">
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image-edit" name="photos" onchange="previewImageEdit()">
                            @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-floating my-3">
                            <textarea class="form-control" placeholder="Leave a comment here" id="edit_description" style="height: 100px" name="description"></textarea>
                            <label for="edit_description">Description Product</label>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary mr-2" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-scripts')
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        function previewImageAdd() {
                const image = document.querySelector('#image-add');
                const imgPreview = document.querySelector('.img-preview-add');

                imgPreview.style.display = 'block';

                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);

                oFReader.onload = function(oFREvent) {
                    imgPreview.src = oFREvent.target.result;
                }
        }
        function previewImageEdit() {
                const image = document.querySelector('#image-edit');
                const imgPreview = document.querySelector('.img-preview-edit');

                imgPreview.style.display = 'block';

                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);

                oFReader.onload = function(oFREvent) {
                    imgPreview.src = oFREvent.target.result;
                }
        }


        $(document).ready(function(){
            $('#crudTable').DataTable();

            $('#crudTable').on('click','.modalDelete',function(){
                var id = $(this).attr('data-id');
                $('#modal-dialog').modal('show'); 

                $('#btnYes').click(function() {
                    // handle form processing here
                    $('#form' + id).submit();
                });
            });

            $('.edit-product').on('click', function(value){

                let productId = $(this).data('productid');
                
                $('#product_id').val('')
                $('#edit_name').val('')
                $('#edit_price').val('')
                $('#edit_stock').val('')
                $('#edit_category').val('')
                $('#edit_category').html('')
                $('#edit_description').val('')

                $.get("getProductById/" + productId, function(data, status){
                $('#product_id').val(data.product.id)
                $('#edit_name').val(data.product.name)
                $('#edit_price').val(data.product.price)
                $('#edit_stock').val(data.product.stock)
                $('#edit_category').val(data.product.categories_id)
                $('#edit_category').html(data.product.category.name)
                $('.img-preview-edit').attr('src', `/storage/${data.product.photos}`)
                $('#edit_description').val(data.product.description)
                
                
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