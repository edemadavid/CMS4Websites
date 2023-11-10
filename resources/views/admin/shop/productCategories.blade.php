@extends('layouts.admin-layout')


@section('extraJS')

@endsection

@section('contents')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <h1>Product Categories</h1>
        <!-- Info boxes -->
        <div class="row d-flex">
            <div class="col-md-8 col-12 order-sm-1">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">Category List</h3>
                        <div class="">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newProductCat">
                                new category
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Category</th>
                                    <th>Count</th>
                                    <th style="width: 40px">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @forelse ($productCategories as $productCategory)
                                <tr>
                                    <td>{{$i++}}.</td>
                                    <td>{{$productCategory->name}}</td>
                                    <td>{{$productCategory->products->count()}}</td>
                                    <td><a href="{{route('admin.productcategories.show', $productCategory->id)}}">view</a></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" style="text-align: center">No Category Found</td>
                                </tr>

                                @endforelse

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>

            <div class="col-md-4 col-12 order-sm-0">
                <form action="{{route('admin.productcategories.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="1">
                    <div class="card">
                        <div class="card-header">
                            Add New Team
                        </div>
                        <div class="card-body">

                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="File">
                                <label class="custom-file-label" for="File">Choose file</label>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>

                            <div class="form-group">
                                <label for="desc">Description</label>
                                <textarea class="form-control" name="desc" id="desc" cols="30" rows="5"></textarea>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success float-right" type="submit" name="submit">Add</button>
                        </div>
                </form>
            </div>

        </div>

        @include('components.admincom.modals.new-product-cat')
    </div>
</section>
@endsection
