@extends('layouts.admin-layout')

@section('title') Edit Clients @endsection

@section('extraJS')
<script src="{{ asset('AdminAssets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>
@endsection

@section('contents')

<section class="content">
    <div class="container-fluid">
        <div class="row d-flex">
            <div class="col-md-8 col-12 d-flex">
                <div class="row">
                    @forelse ($clients as $client)
                        <div class="card mb-2 col-5 col-md-3">
                            <img class="card-img-top" src="{{asset('images/clients/'.$client->image)}}" alt="Dist Photo 3" width="400px">

                            <h5 class="card-title ">{{$client->image}}</h5>

                            <div>
                                <form action="{{route('admin.clients.destroy', $client->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="card mb-2">
                            <div class="card-body">
                                <h5 class="card-title">No Pictures yet</h5>
                            </div>
                        </div>
                    @endforelse


                </div>


            </div>

            <div class="col-md-4 col-12">
                <form action="{{route('admin.clients.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="2">
                    <div class="card">
                        <div class="card-header">
                            Add a New Project
                        </div>
                        <div class="card-body">

                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="File">
                                <label class="custom-file-label" for="File">Choose file</label>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title">
                            </div>

                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success float-right" type="submit" name="submit">Add</button>
                        </div>
                </form>

            </div>
        </div>

    </div>
</section>

@endsection
