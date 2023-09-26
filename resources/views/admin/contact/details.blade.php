@extends('layouts.admin-layout')


@section('extraCSS')

@endsection


@section('extraJS')

@endsection


@section('contents')
<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Contact Details</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>
    <div class="row">
        <div class="container-fluid">
            <form action="{{route ('admin.contactdetails.store') }}" method="post">
                @csrf
                <div class="row">

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Contacts</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="card-body">
                                    <label>Email</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input name="email" type="email" class="form-control" placeholder="Email" value="{{$contact->email}}">
                                    </div>
                                    <label>Address</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                                        </div>
                                        <input name="address" type="text" class="form-control" placeholder="Address" value="{{$contact->address}}">
                                    </div>

                                    <label>Phone Number</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        </div>
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        <input name="tel" type="text" class="form-control" placeholder="Phone No" value="{{$contact->tel}}">
                                    </div>


                                    <label>Map Link</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        </div>
                                        <span class="input-group-text"><i class="fas fa-map"></i></span>
                                        <textarea class="form-control" name="map" id="" cols="30" rows="5" placeholder="Enter Embedded Google Map Link">{{$contact->map}}</textarea>
                                        <!-- <input type="text" class="form-control" placeholder="Phone No"> -->
                                    </div>


                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Social Link</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <div class="card-body">
                                    <label>Facebook</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fab fa-facebook"></i></span>
                                        </div>
                                        <input name="facebook" type="text" class="form-control" placeholder="Facebook Link" value="{{$contact->facebook}}">
                                    </div>
                                    <label>Twitter</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                                        </div>
                                        <input name="twitter" type="text" class="form-control" placeholder="Twitter Link" value="{{$contact->twitter}}">
                                    </div>

                                    <label>LinkedIn</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        </div>
                                        <span class="input-group-text"><i class="fab fa-linkedin"></i></span>
                                        <input name="linkedin" type="text" class="form-control" placeholder="Linkedin Link" value="{{$contact->linkedin}}">
                                    </div>

                                    <label>Instagram</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        </div>
                                        <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                                        <input name="instagram" type="text" class="form-control" placeholder="Instagram Link" value="{{$contact->instagram}}">
                                    </div>


                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>


                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </form>
        </div><!-- /.container-fluid -->

    </div>
</div>

@endsection

