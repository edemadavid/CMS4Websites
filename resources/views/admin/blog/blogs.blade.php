@extends('layouts.admin-layout')

@section('extraCSS')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('AdminAssets/vendor/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('AdminAssets/vendor/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('AdminAssets/vendor/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('extraJS')

<script src="{{ asset('AdminAssets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('AdminAssets/vendor/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('AdminAssets/vendor/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('AdminAssets/vendor/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('AdminAssets/vendor/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('AdminAssets/vendor/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": true,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        // $('#example2').DataTable({
        //     "paging": true,
        //     // "lengthChange": false,
        //     "searching": false,
        //     "ordering": true,
        //     "info": true,
        //     "autoWidth": false,
        //     "responsive": true,
        // });
    });
</script>
@endsection

@section('contents')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Project List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Blog</li>
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><a href="/admin/blog/new" class="btn btn-success">Add New Blog</a></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>status</th>
                                    <th>options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach ($blogs as $blog)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$blog->title}}</td>
                                    <td>{{$blog->blogCategory->title}}</td>
                                    <td>{{$blog->status}}</td>

                                    <td class="d-flex justify-content-around">
                                        <a href="{{route('admin.blogpost.show', $blog->id)}}">View</a>
                                        <a href="{{route('admin.blogpost.destroy', $blog->id)}}">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>


        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

@endsection
