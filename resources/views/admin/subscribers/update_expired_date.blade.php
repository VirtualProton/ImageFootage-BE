@extends('admin.layouts.default')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Edit Subcription Expiration Date
        </h1>
        <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Subcription Expiration Date</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title">Edit Subcription Expiration Date</h3><a href="{{ URL::to('admin/subscribers') }}" class="btn pull-right">Back</a>
                </div>
            @if( Session::has( 'success' ))
                {{ Session::get( 'success' ) }}
            @elseif( Session::has( 'warning' ))
                {{ Session::get( 'warning' ) }} <!-- here to 'withWarning()' -->
            @endif
                <form action="{{ route('updateExpiredDate') }}" role="form" method="post" id="productform">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" class="form-control" name="user_transaction_id" id="user_transaction_id"  value="{{ $UserPackage->id }}">

                    <div class="box-body">
                    <div class="form-group">
                        <label for="extended_date">Enter Days</label>
                        <input type="text" class="form-control" name="extended_date" id="extended_date" placeholder="" value="">
                         @if ($errors->has('extended_date'))
                                <div class="has_error" style="color:red;">{{ $errors->first('extended_date') }}</div>
                         @endif
                      </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" id="validateButton2">Save</button>
                        <a href="{{ url('/admin/dashboard') }}" class="btn btn-primary">Back</a>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </section>
<!-- /.content -->
</div>
@endsection
