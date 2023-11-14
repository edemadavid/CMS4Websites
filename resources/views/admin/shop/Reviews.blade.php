@extends('layouts.admin-layout')

@section('extraCSS')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('vendor/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('vendor/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('vendor/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('extraJS')

<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('vendor/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('vendor/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('vendor/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('vendor/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('vendor/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script>
    $(function() {
        $("#example1, #example2, #example3").DataTable({
            "responsive": false,
            "lengthChange": true,
            "autoWidth": true,
            "buttons": ["copy"]
        });
    });
</script>
@endsection

@section('contents')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Product Review</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item">Shop</li>
                    <li class="breadcrumb-item active">Review</li>

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
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2 col-sm-2">
                                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#pending" role="tab" aria-controls="vert-tabs-home" aria-selected="true">Pending</a>
                                    <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#approved" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Approved</a>
                                    <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#rejected" role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Rejected</a>
                                </div>
                            </div>
                            <div class="col-10 col-sm-10">
                                <div class="tab-content" id="vert-tabs-tabContent">
                                    <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                                        <table id="example1" class=" table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Product</th>
                                                    <th>Review</th>
                                                    <th>options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 1 @endphp
                                                @foreach ($pendingReviews as $pendingReview)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$pendingReview->user->name}}</td>
                                                    <td>{{$pendingReview->product->name}}</td>
                                                    <td>{{$pendingReview->comment}}</td>
                                                    <td>
                                                        <a class="btn btn-success" href="{{ route('product.review.update', ['status' => 'approved', 'id' => $pendingReview->id]) }}">
                                                            Approve
                                                        </a>

                                                        <a class="btn btn-danger" href="{{ route('product.review.update', ['status' => 'rejected', 'id' => $pendingReview->id]) }}">
                                                            Reject
                                                        </a>
                                                    </td>

                                                </tr>
                                                @endforeach
                                            </tbody>


                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                                        <table id="example2" class=" table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Product</th>
                                                    <th>Review</th>
                                                    <th>options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $j = 1 @endphp

                                                @foreach ($approvedReviews as $approvedReview)
                                                <tr>
                                                    <td>{{$j++}}</td>
                                                    <td>{{$approvedReview->user->name}}</td>
                                                    <td>{{$approvedReview->product->name}}</td>
                                                    <td>{{$approvedReview->comment}}</td>
                                                    <td>
                                                        <a class="btn btn-danger" href="{{ route('product.review.update', ['status' => 'rejected', 'id' => $approvedReview->id]) }}">
                                                            Reject
                                                        </a>
                                                    </td>

                                                </tr>
                                                @endforeach
                                            </tbody>


                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
                                        <table id="example3" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Product</th>
                                                    <th>Review</th>
                                                    <th>options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $k = 1 @endphp
                                                @foreach ($rejectedReviews as $rejectedReview)
                                                <tr>
                                                    <td>{{$k++}}</td>
                                                    <td>{{$rejectedReview->user->name}}</td>
                                                    <td>{{$rejectedReview->product->name}}</td>
                                                    <td>{{$rejectedReview->comment}}</td>
                                                    <td>
                                                        <a class="btn btn-success" href="{{ route('product.review.update', ['status' => 'approved', 'id' => $rejectedReview->id]) }}">
                                                            Approve
                                                        </a>
                                                    </td>

                                                </tr>
                                                @endforeach
                                            </tbody>


                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.card -->
            </div>


        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

@endsection
