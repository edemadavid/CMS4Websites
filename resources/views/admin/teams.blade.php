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
            <div class="col-md-6 col-12">
                @php $i=1; @endphp
                @forelse ($teams as $team)
                <form action="{{route('admin.teams.update', $team->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header d-flex">
                            <div>
                                Team {{$i++}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-4">
                                    <img src="{{asset('/images/teams/'.$team->photo)}}" alt="team image" width="50%">

                                    <label for="exampleInputFile">Upload photo</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="file" class="custom-file-input" id="File">
                                            <label class="custom-file-label" for="File">Choose file</label>
                                        </div>

                                    </div>

                                    <div class="d-flex mt-2">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" name="name" id="name" value="{{$team->name}}">
                                        </div>
                                    </div>
                                    <div class="d-flex mt-2">
                                        <div class="form-group">
                                            <label for="position">Position</label>
                                            <input type="text" class="form-control" name="position" id="position" value="{{$team->position}}">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="bio">Bio</label>
                                        <textarea class="form-control" name="bio" id="bio" cols="30" rows="12">{{$team->bio}}</textarea>
                                    </div>

                                    <div class="form-group">
                                            <label for="facebook_link">Facebook Link</label>
                                            <input type="text" class="form-control" name="facebook_link" id="facebook_link" value="{{$team->facebook_link}}">
                                    </div>
                                    <div class="form-group">
                                            <label for="linkedin_link">Linkedin Link</label>
                                            <input type="text" class="form-control" name="linkedin_link" id="linkedin_link" value="{{$team->linkedin_link}}">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>

                    </div>
                </form>
                @empty
                <div class="card">
                    <div class="card-header">
                        No team, Please add a team
                    </div>
                </div>
                @endforelse

            </div>

            <div class="col-md-6 col-12">
                <form action="{{route('admin.teams.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="1">
                    <div class="card">
                        <div class="card-header">
                            Add New Team
                        </div>
                        <div class="card-body">

                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="File">
                                <label class="custom-file-label" for="File">Choose file</label>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>

                            <div class="form-group">
                                <label for="position">Position</label>
                                <input type="text" class="form-control" name="position" id="position">
                            </div>

                            <div class="form-group">
                                <label for="bio">Message</label>
                                <textarea class="form-control" name="bio" id="bio" cols="30" rows="5"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="facebook_link">Facebook Link</label>
                                <input type="text" class="form-control" name="facebook_link" id="facebook_link">
                            </div>

                            <div class="form-group">
                                <label for="linkedin_link">LinkedIn Link</label>
                                <input type="text" class="form-control" name="linkedin_link" id="linkedin_link">
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
