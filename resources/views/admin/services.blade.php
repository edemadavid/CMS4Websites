@extends('layouts.admin-layout')

@section('title') Edit service @endsection

@section('extraJS')
<script src="{{ asset('vendor/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

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
            <div class="col-6">
                @php $i=1; @endphp
                @forelse ($services as $service)
                <form action="{{route('admin.services.update', $service->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header d-flex">
                            <div>
                                services {{$i++}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-4">
                                    <img src="{{asset('images/services/'.$service->photo)}}" alt="service image" width="50%">

                                    <label for="exampleInputFile">Upload photo</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="file" class="custom-file-input" id="File">
                                            <label class="custom-file-label" for="File">Choose file</label>
                                        </div>
                                    </div>


                                    <div class="d-flex mt-2">
                                        <div class="form-group">
                                            <label for="h1">Title</label>
                                            <input type="text" class="form-control" name="h1" id="h1" value="{{$service->h1}}">
                                        </div>
                                    </div>

                                    <div class="d-flex mt-2">
                                        <div class="form-group">
                                            <label for="icon">icon</label>
                                            <input type="text" class="form-control" name="icon" id="icon" value="{{$service->icon}}">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="p">Content</label>
                                        <textarea class="form-control" name="p" id="p" cols="30" rows="5">{{$service->p}}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <form action="{{route('admin.services.destroy', $service->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger float-right">Delete</button>
                            </form>
                        </div>

                    </div>
                </form>
                @empty
                <div class="card">
                    <div class="card-header">
                        No service, Please add a service
                    </div>
                </div>
                @endforelse

            </div>

            <div class="col-6">
                <form action="{{route('admin.services.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="1">
                    <div class="card">
                        <div class="card-header">
                            Add New Service
                        </div>
                        <div class="card-body">

                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="File">
                                <label class="custom-file-label" for="File">Choose file</label>
                            </div>
                            <div class="form-group">
                                <label for="h1">Title</label>
                                <input type="text" class="form-control" name="h1" id="h1">
                            </div>

                            <div class="form-group">
                                <label for="icon">Icon</label>
                                <input type="text" class="form-control" name="icon" id="icon">
                            </div>

                            <div class="form-group">
                                <label for="p">Content</label>
                                <textarea class="form-control" name="p" id="p" cols="30" rows="5"></textarea>
                            </div>


                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success float-right" type="submit" name="submit">Add</button>

                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</section>

@endsection
