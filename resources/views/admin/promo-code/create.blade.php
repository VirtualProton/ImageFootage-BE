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
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" required="required" value="{{ old('name') }}">

                        {{ csrf_field() }}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Type</label>
                <div class="col-sm-4">
                <div class="form-group">
                    <label style="font-weight: 500">
                        <input type="radio" name="type" value="flat" @if (old('type') == "flat") {{ 'checked' }} @endif> Flat
                    </label>
                    <label style="font-weight: 500">
                        <input type="radio" name="type" value="percentage" @if (old('type') == "percentage") {{ 'checked' }} @endif> Percentage
                    </label>
                </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Discount value</label>
                <div class="col-sm-4">
                    <div class="form-group">
                    <input required="required" type="text" class="form-control" name="discount" id="discount" placeholder="Discount value" value="{{ old('discount') }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Max usage</label>
                <div class="col-sm-4">
                    <div class="form-group">
                    <input required="required" type="text" class="form-control" name="max_usage" id="max_usage" placeholder="Max usage" value="{{ old('max_usage') }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Valid Upto Type</label>
                <div class="col-sm-4">
                <div class="form-group">
                    <label style="font-weight: 500">
                        <input type="radio" name="valid_type" value="fixed" @if (old('valid_type') == "fixed") {{ 'checked' }} @endif> Fixed
                    </label>
                    <label style="font-weight: 500">
                        <input type="radio" name="valid_type" value="range" @if (old('valid_type') == "range") {{ 'checked' }} @endif> Range
                    </label>
                    </div>
                </div>
            </div>

            <div class="form-group" id="start-datepicker" style="display: none">
                <label for="inputPassword3" class="col-sm-2 control-label">Valid Start Date</label>
                <div class="col-sm-4">
                    <div class="form-group">
                    <input type="text" class="form-control" name="valid_start_date" id="valid_start_date" placeholder="Valid start date" value="{{ old('valid_start_date') }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Valid Till Date</label>
                <div class="col-sm-4">
                    <div class="form-group">
                    <input type="text" class="form-control" name="valid_till_date" id="valid_till_date" placeholder="Valid till date" value="{{ old('valid_till_date') }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Status</label>

            <div class="col-sm-4">
                <div class="form-group">
                    <select class="form-control" name="status" id="status">
                        <option value="">Select</option>
                        <option value="1" @if (old('status') == "1") {{ 'selected' }} @endif>Active</option>
                        <option value="0" @if (old('status') == "0") {{ 'selected' }} @endif>Inactive</option>
                    </select>
                </div>
            </div>
            </div>

            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Valid For</label>

            <div class="col-sm-4">
                <div class="form-group">
                    <select class="form-control" name="will_apply_by" id="will_apply_by">
                        <option value="">Select</option>
                        <option value="1" @if (old('will_apply_by') == "1") {{ 'selected' }} @endif>Frontend</option>
                        <option value="2" @if (old('will_apply_by') == "2") {{ 'selected' }} @endif>Backend</option>
                        <option value="3" @if (old('will_apply_by') == "3") {{ 'selected' }} @endif>All</option>
                    </select>
                </div>
            </div>
            </div>

        </div>

        <!-- /.box-body -->
        <div class="box-footer">
        <a href="{{ url('admin/promo-codes') }}" class="btn btn-primary">Back</a>
        <!-- <button type="button" class="btn btn-default">Cancel</button> -->
        {!! Form::submit('Submit', array('class' => 'btn btn-primary', 'id' => 'validateButton2')) !!}
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
                discount: {
                    validators: {
                    notEmpty: {
                        message: 'Discount is required'
                    },
                    integer: {
                        message: 'Discount should be number only'
                    }
                    },
                },
                max_usage: {
                    validators: {
                        notEmpty: {
                            message: 'Max usage is required'
                        },
                        integer: {
                            message: 'Max usage should be number only'
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
                will_apply_by: {
                    validators: {
                        notEmpty: {
                            message: 'Will apply on is required'
                        }
                    }
                },
            }
        });
    })();

    $('input[type="radio"]').click(function() {
        if ($(this).val() === 'range') {
            $("#start-datepicker").show();
        } else {
            $("#start-datepicker").hide();
        }
    });

    $( function() {
        $("#valid_till_date, #valid_start_date").datepicker({
        autoclose: true,
        format: "yyyy-mm-dd"
        }).attr("autocomplete", "off");
    } );
    });

</script>
@stop
