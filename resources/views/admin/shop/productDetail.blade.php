@extends('layouts.admin-layout')


@section('extraJS')
<script src="{{ asset('AdminAssets/vendor/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>

<script>
    function confirmDelete(imageId) {
        if (confirm('Are you sure you want to delete this image?')) {
            deleteImage(imageId, deleteRoute);
        }
    }
    function deleteImage(imageId, deleteRoute) {
    axios.post(deleteRoute)
        .then(response => {
            // Handle successful deletion
            if (response.status === 200) {
                document.getElementById('image-' + imageId).remove();
                alert('Image deleted successfully');
            }
        })
        .catch(error => {
            // Handle errors or display a message to the user
            console.error(error);
            alert('Error deleting the image');
        });
}
</script>

@endsection

@section('contents')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="d-flex justify-space-between">
            <h1>{{$product->name}}</h1>

            <button class="btn btn-success">Edit</button>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('images/products/' . $product->main_image) }}" alt="Main product image">
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-secondary btn-block" type="button" data-toggle="modal" data-target="#uploadModal">
                                        Upload Other Photos
                                    </button>
                                </div>
                                <div class="mt-3">
                                    <div class="others">
                                        <div class="row">
                                            @forelse($product->other_images as $image)
                                            <div class="col-6 mb-3">
                                                <div class="image-container position-relative">
                                                    <img src="{{asset($image->image_path)}}" class="img-fluid" alt="Other product image">
                                                    @php
                                                        $imageid = $image->id;
                                                    @endphp
                                                    <a class="delete-button btn btn-danger" style="position: absolute; top: 5px; right: 5px;"
                                                        onclick="confirmDelete({{$imageid}}, '{{ route('images.custom.delete', $imageid) }}')"
                                                        >
                                                        <i class="fas fa-trash"></i></a>
                                                </div>
                                            </div>
                                            @empty
                                            <div class="col-12">
                                                <p>No other images yet.</p>
                                            </div>
                                            @endforelse

                                            <!-- Modal -->
                                            <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="uploadModalLabel">Upload Product Photos</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('admin.upload.product.images', ['productId' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="file" name="images[]" multiple accept="image/*">
                                                                <button class="btn btn-success" type="submit">Upload</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <p class="text-muted text-center">{{$product->short_desc}}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Price</b> <a class="float-right">{{$product->price}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Discount Price</b> <a class="float-right">{{$product->discount_price}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Category</b> <a class="float-right">{{$product->product_category->name}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Created at</b> <a class="float-right">{{$product->created_at}}</a>
                                    </li>

                                    <li class="list-group-item">
                                        <b>Long Description</b>
                                        <div>

                                 {!! $product->long_desc !!}
                                        </div>
                                    </li>
                                </ul>
                            </div>


                        </div>

                    </div>

                </div>
</section>

@endsection