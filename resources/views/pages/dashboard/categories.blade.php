@extends('layouts.dashboard.app')

@section('title')
    Categories
@endsection

@section('content')
    <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Categories</h1>
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
                                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCategory">
                                + Add Category
                                </button>
                                <div class="table table-responsive">
                                    <table class="w-100" id="crudTable">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Kategori</th>
                                                <th>Slug</th>
                                                <th>Image</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($categories as $category)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $category->name }}</td>
                                                    <td>{{ $category->slug }}</td>
                                                    <td><img src="{{ Storage::url($category->photos) }}" style="max-height: 50px;" /></td>
                                                    <td style="width: 10%;">
                                                        <div class="d-flex flex-row">
                                                                <button type="button" class="btn btn-primary edit-category mr-2" data-bs-toggle="modal" data-bs-target="#editCategory" data-categoryid={{ $category->id }}>Edit</button>
                                                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" id="form{{ $category->id }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                            <button type="button" class="btn btn-danger border-0 modalDelete" data-id="{{ $category->id }}">Delete</button>
                                                                </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5"><p>No category found</p></td>
                                                </tr>
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
<div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addCategoryLabel">Add Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('categories.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name-add">Nama Kategori</label>
                                <input type="text" id="name-add" name="name" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-12">
                            <label for="image-add" class="form-label">Category Image (max 1MB)</label>
                            <img class="img-preview-add img-fluid mb-3 col-sm-5" style="max-height: 80px; max-width: 80px;">
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image-add" name="image" onchange="previewImageAdd()" required>
                            @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
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
<div class="modal fade" id="editCategory" tabindex="-1" aria-labelledby="editCategoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editCategoryLabel">Edit Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="updateCategory" enctype="multipart/form-data" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="category_id" id="category_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Nama Kategori</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-12">
                            <label for="image-edit" class="form-label">Category Image (max 1MB)</label>
                            <img class="img-preview-edit img-fluid mb-3 col-sm-5" style="max-height: 80px; max-width: 80px;">
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image-edit" name="image" onchange="previewImageEdit()">
                            @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
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

            $('.edit-category').on('click', function(value){

                let categoryId = $(this).data('categoryid');
                
                $('#category_id').val('')
                $('#name').val('')

                $.get("getCategoryById/" + categoryId, function(data, status){
                    $('#category_id').val(data.category.id)
                    $('#name').val(data.category.name)
                    $('.img-preview-edit').attr('src', `/storage/${data.category.photos}`);
                });
            });
        });
    </script>
@endpush