@extends('layouts.admin-layout')

@section('contents')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{$blog->title}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Blog</li>
                    <li class="breadcrumb-item active">{{$blog->blogCategory->title}}</li>

                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">

                <div class="card card-secondary card-outline">
                    <div class="card-header d-flex">
                        <h5 class="m-0">Contents</h5>
                        <a class="ml-auto btn btn-info" href="{{route ('admin.blogpost.update', $blog->id)}}">Edit</a>
                    </div>
                    <div class="card-body">
                        {!! $blog->contents !!}

                    </div><!-- /.card -->

                </div>
            </div><!-- /.col-md-6 -->

            <div class="col-lg-4">
                <div class="card mb-2">
                    <img class="card-img-top" src="/images/blog/{{$blog->image}}" alt="Dist Photo 3">
                </div>
                <!-- /.card -->
            </div><!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection
