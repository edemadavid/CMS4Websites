@extends('layouts.admin-layout')

@section('extraCSS')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css')}}">

<link rel="stylesheet" href="{{ asset('vendor/summernote/summernote-bs4.min.css')}}">
@endsection

@section('extraJS')
<script src="{{ asset('vendor/select2/select2.full.min.js')}}"></script>
<script src="{{ asset('vendor/bootstrap-switch/bootstrap-switch.min.js')}}"></script>
<script src="{{ asset('vendor/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{ asset('vendor/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script>
    $(function() {
        // Summernote
        $('#summernote').summernote()
    });
    $(function() {
        bsCustomFileInput.init();
    });

    //Initialize Select2 Elements
    $('.select2').select2()

    $("input[data-bootstrap-switch]").each(function() {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

    //Initialize Select2 Elements
    // $('.select2bs4').select2({
    //   theme: 'bootstrap4'
    // })
</script>

@endsection


@section('contents')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Blog</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">blog</li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="col-12">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{route('admin.blogpost.update', $blog->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card card-outline card-info mt-3">
                    <div class="card-header">
                        <h3 class="card-title">Updating :{{$blog->title}}</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-10 ">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Input the name of blog" value="{{$blog->title}}">
                            </div>

                            <!-- Bootstrap Switch -->
                            <div class="card card-secondary col-2">
                                <div class="card-header">
                                    <h3 class="card-title">Status</h3>
                                </div>
                                <div class="card-body text-center">
                                    <input type="checkbox" name="status" @if ($blog->status == 1)
                                    checked
                                    @else

                                    @endif
                                    data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                </div>
                            </div>
                            <!-- /.card -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="category" class="form-control select2" style="width: 100%;">
                                        <option disabled>Select a Category</option>
                                        @foreach($categories as $category)
                                        <option @if ($blog->category_id == $category->id)
                                            Selected
                                            @else

                                            @endif
                                            value="{{$category->id}}">{{$category->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mr-2" for="exampleInputFile">Upload Blog Cover Picture</label>

                                    <div class="input-group col-12 mb-3">
                                        <div class="custom-file">
                                            <input type="file" name="file" class="custom-file-input" id="File">
                                            <label class="custom-file-label" for="File">Choose file</label>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="col-md-4">
                                <div class="card mb-2">
                                    <img class="card-img-top" src="/images/blog/{{$blog->image}}" alt="Dist Photo 3">
                                </div>
                                <!-- /.card -->
                            </div><!-- /.col-md-4 -->


                            <div class="card-body">
                                <label for="exampleInputFile">Preject Contents</label>
                                <textarea id="summernote" name="blog_content">{!! $blog->contents !!}</textarea>
                            </div>

                            <div class="col-12 text-center">
                                <button class="btn btn-success btn-lg" type="submit" name="submit">Update</button>

                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </form>




        </div>
        <!-- /.card -->

    </div><!-- /.container-fluid -->
</div><!-- /.content -->
@endsection
