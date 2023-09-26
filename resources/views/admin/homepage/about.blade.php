@extends('layouts.admin-layout')


@section('extraCSS')
<link rel="stylesheet" href="{{asset('AdminAssets/vendor/summernote/summernote-bs4.min.css')}}">
@endsection


@section('extraJS')
<script src="{{asset('AdminAssets/vendor/summernote/summernote-bs4.min.js')}}"></script>

<script>
    $(function() {
        // Summernote
        $('#summernote1').summernote()
    });
</script>
@endsection


@section('contents')
<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Front Page About</h1>
    </div>

    <div class="row">
        <div class="m-3">
            <form action="{{route('admin.frontpage.about.update', $about->id)}}" method="post">
                @csrf
                <div class="card m-3 p-3">

                    <div class="form-group">
                        <label for="content">Front Page</label>
                        <textarea id="summernote1" class="form-control" name="content" id="content" cols="30" rows="10">{!! $about->content !!}</textarea>
                    </div>


                </div>
                <div class="card-footer">
                    <button class="btn btn-success float-right" type="submit" name="submit">Update</button>
                </div>

            </form>
        </div>

    </div>

</div>

@endsection
