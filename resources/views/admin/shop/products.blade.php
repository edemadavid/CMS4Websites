@extends('layouts.admin-layout')

@section('extraCSS')
<link rel="stylesheet" href="{{asset('AdminAssets/vendor/summernote/summernote-bs4.min.css')}}">
@endsection


@section('extraJS')
<script src="{{asset('AdminAssets/vendor/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{ asset('AdminAssets/vendor/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script>
    $(function() {
        // Summernote
        $('#summernote').summernote()
    });
    $(function() {
        bsCustomFileInput.init();
    });
</script>
@endsection

@section('contents')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-lg-8 col-md-12 order-sm-1">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">All Product List</h3>

                        <button type="button" class="btn btn-success d-md-none d-block" data-toggle="modal" data-target="#modal-default">
                            New Product
                        </button>

                        <div class="modal fade" id="modal-default">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">New Product</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="">
                                        <div class="modal-body">
                                            @csrf
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="name">Product Name</label>
                                                    <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-6">
                                                        <label for="price">Price</label>
                                                        <input type="number" class="form-control" name="price" id="price" value="{{old('price')}}">
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="discount_price">Discount Price</label>
                                                        <input type="number" class="form-control" name="discount_price" id="discount_price" value="{{old('discount_price')}}">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="short_desc">Short Description</label>
                                                    <textarea class="form-control" name="short_desc" id="short_desc" cols="30" rows="3">{{old('short_desc')}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="long_desc">Main Description</label>
                                                    <textarea class="form-control" name="long_desc" id="summernote" cols="30" rows="3">{{old('long_desc')}}</textarea>
                                                </div>

                                                <div class="custom-file">
                                                    <input type="file" name="main_image" class="custom-file-input" id="File">
                                                    <label class="custom-file-label" for="File">Select a display picture</label>
                                                </div>
                                            </div>

                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Product Name</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Discount Price</th>
                                    <th>Main Image</th>
                                    <th style="width: 40px">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @forelse ($products as $product)
                                <tr>
                                    <td>{{$i++}}.</td>
                                    <td>{{$product->name}}</td>
                                    <td></td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->price}}</td>
                                    <td><img src="{{ asset('images/products/'.$product->main_image) }}" alt="" width="80px"></td>
                                    <td><a href="{{route('admin.products.show', $product->id)}}">view</a></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" style="text-align: center">No Product Found</td>
                                </tr>

                                @endforelse

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>

            <div class="d-md-block d-none col-md-4 order-sm-0">
                <form method="post" action="{{route('admin.products.store')}}" enctype="multipart/form-data">

                    <div class="card">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Product Category</label>
                                <select class="form-control" name="product_category_id" id="product_category_id">
                                    <option value="">Select a category</option>
                                    @foreach ($product_categories as $product_category)
                                    <option value="{{$product_category->id}}">{{$product_category->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" name="price" id="price" value="{{old('price')}}">
                                </div>
                                <div class="form-group col-6">
                                    <label for="discount_price">Discount Price</label>
                                    <input type="number" class="form-control" name="discount_price" id="discount_price" value="{{old('discount_price')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="short_desc">Short Description</label>
                                <textarea class="form-control" name="short_desc" id="short_desc" cols="30" rows="3">{{old('short_desc')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="long_desc">Main Description</label>
                                <textarea class="form-control" name="long_desc" id="summernote" cols="30" rows="3">{{old('long_desc')}}</textarea>
                            </div>

                            <div class="custom-file">
                                <input type="file" name="main_image" class="custom-file-input" id="File">
                                <label class="custom-file-label" for="File">Select a display picture</label>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-success m-3">Save changes</button>

                    </div>
                </form>
            </div>
        </div>

    </div>
</section>

@endsection
