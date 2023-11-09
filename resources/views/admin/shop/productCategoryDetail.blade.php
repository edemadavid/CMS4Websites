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
        <!-- Info boxes -->
        <div class="row">

        </div>

    </div>
</section>

@endsection
