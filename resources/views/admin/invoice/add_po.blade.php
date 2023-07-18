@extends('admin.layouts.default')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add PO
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add PO</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add PO</h3><a href="#" class="btn pull-right">Back</a>
                    </div>
                    @if( Session::has( 'success' ))
                    {{ Session::get( 'success' ) }}
                    @elseif( Session::has( 'warning' ))
                    {{ Session::get( 'warning' ) }} <!-- here to 'withWarning()' -->
                    @endif
                    <form action="{{ url('admin/save_po') }}" role="form" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Invoice No.</label>
                                <select class="form-control select2" name="invoice_no" id="invoice_no" data-placeholder="Select Invoice">
                                    <option value="">--Select Invoice --</option>
                                </select>
                                @if ($errors->has('invoice_no'))
                                <div class="has_error" style="color:red;">{{ $errors->first('invoice_no') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">PO #</label>
                                <input type="text" class="form-control" name="po_no" id="po_no" placeholder="PO #">
                                @if ($errors->has('po_no'))
                                <div class="has_error" style="color:red;">{{ $errors->first('po_no') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('scripts')
<script src="{{ asset('js/formvalidation/formValidation.min.js') }}"></script>
<script src="{{ asset('js/formvalidation/framework/bootstrap.min.js') }}"></script>
<script>
    var csrf = '{{ csrf_token() }}';
    getData();

    function getData() {
        $.ajax({
            url: '{{ url("admin/get_invoice") }}',
            type: 'POST',
            data: {
                '_token': csrf
            },
            success: function(data) {
                $("#invoice_no").html('');
                $("#invoice_no").html(data);
            }
        });
    }

    $(".select2").select2({
        matcher: matchCustom
    });

    function matchCustom(params, data) {
        if ($.trim(params.term) === '') {
            return data;
        }
        if (typeof data.text === 'undefined') {
            return null;
        }
        if (data.text.indexOf(params.term) > -1) {
            var modifiedData = $.extend({}, data, true);
            return modifiedData;
        }
        return null;
    }
</script>
@endsection