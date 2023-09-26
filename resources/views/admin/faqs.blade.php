@extends('layouts.admin-layout')

@section('contents')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-6">
                @php $i=1; @endphp
                @forelse ($faqs as $faq)
                <div class="card">
                    <div class="card-header d-flex">
                        <div>
                            Faq {{$i++}}
                        </div>
                        <div class="ml-auto d-flex">
                            <button type="button" class="btn btn-secondary mr-2" data-toggle="modal" data-target="#modal{{$faq->id}}">
                                Edit
                            </button>

                            <form action="{{route('admin.faqs.destroy', $faq->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger float-right" >Delete</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>
                            Question: {{$faq->question}}
                        </p>

                        <p>
                            Answer: {{$faq->answer}}
                        </p>

                    </div>
                </div>

                <div class="modal fade" id="modal{{$faq->id}}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Faq</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="{{route('admin.faqs.update', $faq->id)}}">
                                <div class="modal-body">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="title">Question</label>
                                            <input type="text" class="form-control" name="question" id="title" value="{{$faq->question}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="desc">Answer</label>
                                            <textarea class="form-control" name="answer" id="desc" cols="30" rows="10">{{$faq->answer}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                @empty
                <div class="card">
                    <div class="card-header">
                        No Faq yet, Please add one..
                    </div>
                </div>
                @endforelse
            </div>

            <div class="col-6">
                <form action="{{route('admin.faqs.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="type" value="1">
                    <div class="card">
                        <div class="card-header">
                            Add New FAQ
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Question</label>
                                <input type="text" class="form-control" name="question" id="title">
                            </div>
                            <div class="form-group">
                                <label for="desc">Answer</label>
                                <textarea class="form-control" name="answer" id="desc" cols="30" rows="10"></textarea>
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
