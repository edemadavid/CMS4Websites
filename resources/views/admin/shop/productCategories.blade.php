@extends('layouts.admin-layout')


@section('extraJS')
<script src="{{ asset('AdminAssets/vendor/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>
@endsection

@section('contents')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <h1>Product Categories</h1>
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-8">
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
                                    <td>{{$productCategory->title}}</td>
                                    <td>{{$productCategory->product->count()}}</td>
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

        </div>

        @include('components.admincom.modals.new-product-cat')
    </div>
</section>
@endsection
