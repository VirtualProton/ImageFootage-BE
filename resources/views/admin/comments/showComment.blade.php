@extends('admin.layouts.default')

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <h1>
            Comment Details
            <small>View comment information</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{url('/admin/users')}}">Users</a></li>
            <li class="active">Comment Details</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Comment #{{ $comment->id }}</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Subject:</label>
                            <p>{{ $comment->subject ?? 'No Subject' }}</p>
                        </div>

                        <div class="form-group">
                            <label>Comment:</label>
                            <p>{{ $comment->comment }}</p>
                        </div>

                        <div class="form-group">
                            <label>User ID:</label>
                            <p>{{ $comment->user_id }}</p>
                        </div>

                        <div class="form-group">
                            <label>Status:</label>
                            <p>
                                @if($comment->status == 'Open')
                                    <span class="label label-warning">Open</span>
                                @elseif($comment->status == 'In Progress')
                                    <span class="label label-primary">In Progress</span>
                                @else
                                    <span class="label label-default">{{ $comment->status }}</span>
                                @endif
                            </p>
                        </div>

                        <div class="form-group">
                            <label>Agent ID:</label>
                            <p>{{ $comment->agent_id ?? 'Unassigned' }}</p>
                        </div>

                        <div class="form-group">
                            <label>Created At:</label>
                            <p>{{ $comment->created_at }}</p>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection