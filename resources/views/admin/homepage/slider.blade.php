@extends('layouts.admin-layout')



@section('contents')
<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Front Page Slider</h1>
    </div>

    <div class="row">
        <div class="content">
            <div class="container-fluid">
                <div class="mb-3">
                    <form action="{{route('admin.frontpage.slider.update', $homeSlider[0]->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Slider 1</h5>
                            </div>
                            <div class="card-body">

                                <div class="row mb-2">
                                    <div class="col-4 col-md-12">
                                        <img src="{{ asset('/images/'.$homeSlider[0]->photo)}}" alt="about image" width="200px">
                                    </div>
                                    <div class="col-8 col-md-12">
                                        <label for="exampleInputFile">Upload Slider 1</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="file" class="custom-file-input" id="File">
                                                <label class="custom-file-label" for="File">Choose file</label>
                                            </div>

                                        </div>
                                        <div class="d-flex mt-2">
                                            <div class="form-group col-6">
                                                <label for="h1">Heading 1</label>
                                                <input type="text" class="form-control" name="h1" id="h1" value="{{$homeSlider[0]->h1}}">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="h2">Heading 2</label>
                                                <input type="text" class="form-control" name="h2" id="h2" value="{{$homeSlider[0]->h2}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="p">Sub Heading</label>
                                            <input type="text" class="form-control" name="p" id="p" value="{{$homeSlider[0]->p}}">
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
                    <form action="{{route('admin.frontpage.slider.update', $homeSlider[1]->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title">Slider 2</h5>
                            </div>
                            <div class="card-body">

                                <div class="row mb-2">
                                    <div class="col-4">
                                        <img src="{{ asset('/images/'.$homeSlider[1]->photo)}}" alt="about image" width="200px">
                                    </div>
                                    <div class="col-8">
                                        <label for="exampleInputFile">Upload Slider 2</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="file" class="custom-file-input" id="File">
                                                <label class="custom-file-label" for="File">Choose file</label>
                                            </div>

                                        </div>
                                        <div class="d-flex mt-2">
                                            <div class="form-group col-6">
                                                <label for="h1">Heading 1</label>
                                                <input type="text" class="form-control" name="h1" id="h1" value="{{$homeSlider[1]->h1}}">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="h2">Heading 2</label>
                                                <input type="text" class="form-control" name="h2" id="h2" value="{{$homeSlider[1]->h2}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="p">Sub Heading</label>
                                            <input type="text" class="form-control" name="p" id="p" value="{{$homeSlider[1]->p}}">
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
                    <form action="{{route('admin.frontpage.slider.update', $homeSlider[2]->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card mb-3 pb-5">
                            <div class="card-header">
                                <h5 class="card-title">Slider 3</h5>
                            </div>
                            <div class="card-body">

                                <div class="row mb-2">
                                    <div class="col-4">
                                        <img src="{{ asset('/images/'.$homeSlider[2]->photo)}}" alt="about image" width="200px">
                                    </div>
                                    <div class="col-8">
                                        <label for="exampleInputFile">Upload About photo</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="file" class="custom-file-input" id="File">
                                                <label class="custom-file-label" for="File">Choose file</label>
                                            </div>

                                        </div>
                                        <div class="d-flex mt-2">
                                            <div class="form-group col-6">
                                                <label for="h1">Heading 1</label>
                                                <input type="text" class="form-control" name="h1" id="h1" value="{{$homeSlider[2]->h1}}">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="h2">Heading 2</label>
                                                <input type="text" class="form-control" name="h2" id="h2" value="{{$homeSlider[2]->h2}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="p">Sub Heading</label>
                                            <input type="text" class="form-control" name="p" id="p" value="{{$homeSlider[2]->p}}">
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

    </div>

</div>

@endsection
