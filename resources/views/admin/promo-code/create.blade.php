@extends('admin.layouts.default')

@section('content')
<div class="content-wrapper">
<section class="content">

<div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Add Promo Code</h3><a href="{{ URL::to('admin/promo-codes') }}" class="btn pull-right">Back</a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {!! Form::open(array('url' => URL::to('admin/promo-codes'), 'method' => 'post', 'class'=>"form-horizontal",'id'=>'promocodeform','files'=> true,'autocomplete'=>false)) !!}
            @include('admin.partials.message')

        <div class="box-body">
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-4">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" required="required">

                        {{ csrf_field() }}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Type</label>
                <div class="col-sm-4">
                <div class="checkbox">
                    <label>
                        <input type="radio" name="type" value="flat" class="type"> Flat
                    </label>
                    <label>
                        <input type="radio" name="type" value="percentage" class="type"> Percentage
                    </label>
                </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Max usage</label>
                <div class="col-sm-4">
                    <div class="form-group">
                    <input required="required" type="text" class="form-control" name="max_usage" id="max_usage" placeholder="Max usage">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Valid Upto Type</label>
                <div class="col-sm-4">
                <div class="checkbox">
                    <label>
                        <input type="radio" name="valid_type" value="fixed" class="type"> Fixed
                    </label>
                    <label>
                        <input type="radio" name="valid_type" value="range" class="type"> Range
                    </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Valid Till Date</label>
                <div class="col-sm-4">
                    <div class="form-group">
                    <input type="text" class="form-control" name="valid_till_date" id="valid_till_date" placeholder="Valid till date">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Status</label>

            <div class="col-sm-4">
                <div class="form-group">
                    <select class="form-control" name="status" id="status">
                        <option value="">Select</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
            </div>
        </div>

        <!-- /.box-body -->
        <div class="box-footer">
        <a href="{{ URL::previous() }}">
        <button type="button" class="btn btn-default">Cancel</button></a>
        <!-- <button type="button" class="btn btn-default">Cancel</button> -->
        {!! Form::submit('Submit', array('class' => 'btn btn-info', 'id' => 'validateButton2')) !!}
        </div>
        <!-- /.box-footer -->
        {!! Form::close() !!}
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
    $(document).ready(function ($) {

    // Example Validataion Standard Mode
    (function () {

        var i = 1;

        $('#promocodeform').formValidation({
            framework: "bootstrap",
            button: {
                selector: '#validateButton2',
                disabled: 'disabled'
            },
            icon: null,
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: 'Name is required'
                        }
                    }
                },
                type: {
                    validators: {
                    notEmpty: {
                        message: 'Type is required'
                        }
                    }
                },
                max_usage: {
                    validators: {
                        notEmpty: {
                            message: 'Max usage is required'
                        }
                    }
                },
                valid_type: {
                    validators: {
                    notEmpty: {
                        message: 'Valid upto type is required'
                        }
                    }
                },
                status: {
                    validators: {
                        notEmpty: {
                            message: 'Status is required'
                        }
                    }
                },
            }
        });
    })();

    $( function() {
        $("#valid_till_date").datepicker({
        autoclose: true,
        format: "yyyy-mm-dd"
        }).attr("autocomplete", "off");
    } );
    });

</script>
@stop
