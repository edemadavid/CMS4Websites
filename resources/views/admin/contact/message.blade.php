@extends('layouts.admin-layout')


@section('extraCSS')
@endsection


@section('extraJS')
@endsection


@section('contents')
<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Contact Message</h1>
    </div>

    <div class="row">
        <!-- Main content -->

        <div class="col-md-11 mx-3">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Inbox</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" placeholder="Search Mail">
                            <div class="input-group-append">
                                <div class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">

                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <tbody>
                                @forelse ($contactMessages as $contactMessage )
                                <tr>
                                    <td class="mailbox-name">
                                        <a href="{{route('contactmessages.show',  $contactMessage->id)}}">
                                            {{$contactMessage->email}}</a>
                                    </td>
                                    <td class="mailbox-subject"><b>{{$contactMessage->name}}</b> - {!! Str::limit("$contactMessage->message", 15, ' ...') !!}


                                    </td>
                                    <td class="mailbox-date">{{$contactMessage->created_at->format('d-m-Y')}}</td>
                                </tr>
                                @empty

                                @endforelse

                            </tbody>
                        </table>
                        <!-- /.table -->
                    </div>
                    <!-- /.mail-box-messages -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer p-0">

                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->


    </div>
</div>

@endsection
