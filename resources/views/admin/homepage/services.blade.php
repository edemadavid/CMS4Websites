@extends('layouts.admin-layout')


@section('extraCSS')

@endsection


@section('extraJS')

@endsection


@section('contents')

<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Front Page Services</h1>

    </div>
    <div class="content">

        <div class="mb-3">
            <form action="{{route('admin.frontpage.service.update', $services[0]->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Service 1</h5>
                    </div>
                    <div class="card-body">

                        <div class="row mb-2">
                            <div class="col-4">
                                <i class="fas fa-fw fa-cog"></i>
                                <h1>{{$services[0]->h1}}</h1>
                                <p>{{$services[0]->p}}</p>
                            </div>
                            <div class="col-8">

                                <div class="d-flex">
                                    <div class="form-group col-6">
                                        <label for="h1">Heading 1</label>
                                        <input type="text" class="form-control" name="h1" id="h1" value="{{$services[0]->h1}}">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="icon">Icon</label> *get from font Awesome
                                        <input type="text" class="form-control" name="icon" id="icon" placeholder="fab fa boy" value="{{$services[0]->icon}}">
                                    </div>

                                </div>


                                <div class="form-group">
                                    <label for="p">Paragraph</label>
                                    <input type="text" class="form-control" name="p" id="p" value="{{$services[0]->p}}">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success float-right" type="submit" name="submit">Update</button>
                    </div>


                </div>
            </form>
        </div>


        <div class="mb-3">
            <form action="{{route('admin.frontpage.service.update', $services[1]->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Service 2</h5>
                    </div>
                    <div class="card-body">

                        <div class="row mb-2">
                            <div class="col-4">
                                <i class="fas fa-fw fa-cog"></i>
                                <h1>{{$services[1]->h1}}</h1>
                                <p>{{$services[1]->p}}</p>
                            </div>
                            <div class="col-8">
                                <div class="d-flex">
                                    <div class="form-group col-6">


                                        <label for="h1">Heading 1</label>
                                        <input type="text" class="form-control" name="h1" id="h1" value="{{$services[1]->h1}}">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="icon">Icon</label> *get from font Awesome
                                        <input type="text" class="form-control" name="icon" id="icon" placeholder="fab fa boy" value="{{$services[0]->icon}}">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="p">Paragraph</label>
                                    <input type="text" class="form-control" name="p" id="p" value="{{$services[1]->p}}">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success float-right" type="submit" name="submit">Update</button>
                    </div>


                </div>
            </form>
        </div>

        <div class="mb-3">
            <form action="{{route('admin.frontpage.service.update', $services[2]->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card mb-3 pb-5">
                    <div class="card-header">
                        <h5 class="card-title">Service 3</h5>
                    </div>
                    <div class="card-body">

                        <div class="row mb-2">
                            <div class="col-4">
                                <i class="fas fa-fw fa-cog"></i>
                                <h1>{{$services[2]->h1}}</h1>
                                <p>{{$services[2]->p}}</p>
                            </div>
                            <div class="col-8">
                                <div class="d-flex">
                                    <div class="form-group col-6">

                                        <div class="form-group">
                                            <label for="h1">Heading 3</label>
                                            <input type="text" class="form-control" name="h1" id="h1" value="{{$services[2]->h1}}">
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="icon">Icon</label> *get from font Awesome
                                            <input type="text" class="form-control" name="icon" id="icon" placeholder="fab fa boy" value="{{$services[0]->icon}}">
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="p">Paragraph</label>
                                        <input type="text" class="form-control" name="p" id="p" value="{{$services[2]->p}}">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success float-right" type="submit" name="submit">Update</button>
                        </div>


                    </div>
            </form>
        </div>

    </div>

</div>

@endsection
