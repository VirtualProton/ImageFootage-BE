@extends('admin.layouts.default')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Discount Message
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Discount Message</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Add Discount Message</h3><a href="{{ URL::to('admin/list_discount_message') }}" class="btn pull-right">Back</a>
            </div>
            <!-- form start -->
            <form action="{{ url('admin/creatediscountmessage') }}" role="form" method="post" id="discountmessageform">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
                @endif
                @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
                @endif
                <div class="box-body">
                    <div class="form-group">
                        <label class="">Page Type</label>
                        <select class="form-control" name="page_type" id="page_type">
                            <option value="">--Select a Type--</option>
                            <option value="home_page">Home</option>
                            <option value="image_page">Image</option>
                            <option value="footage_page">Footage</option>
                            <option value="editorial_page">Editorial</option>
                            <option value="pricing_page">Pricing</option>
                            <option value="music_page">Music</option>
                        </select>
                        @if ($errors->has('page_type'))
                        <div class="has_error" style="color:red;">{{ $errors->first('page_type') }}</div>
                        @endif
                        <div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title">Title </label>
                        <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" placeholder="Title">
                        @if ($errors->has('title'))
                        <div class="has_error" style="color:red;">{{ $errors->first('title') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea type="text" class="form-control" name="description" id="description" placeholder="Description">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                        <div class="has_error" style="color:red;">{{ $errors->first('description') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="link">Link </label>
                        <input type="text" class="form-control" name="link" id="link" value="{{ old('link') }}" placeholder="Link">
                        @if ($errors->has('link'))
                        <div class="has_error" style="color:red;">{{ $errors->first('link') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="button_text">Button Text </label>
                        <input type="text" class="form-control" name="button_text" id="button_text" value="{{ old('button_text') }}" placeholder="Button Text">
                        @if ($errors->has('button_text'))
                        <div class="has_error" style="color:red;">{{ $errors->first('button_text') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @if($errors->has('status'))
                        <div class="has_error" style="color:red;">{{ $errors->first('status') }}</div>
                        @endif
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="validateButton2">Submit</button>
                    <a href="{{ url('admin/list_discount_message') }}" class="btn btn-primary">Back</a>
                </div>
                <!-- /.box-footer -->
            </form>
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
    $(document).ready(function($) {

        // Example Validataion Standard Mode
        (function() {

            var i = 1;

            $('#discountmessageform').formValidation({
                framework: "bootstrap",
                button: {
                    selector: '#validateButton2',
                    disabled: 'disabled'
                },
                icon: null,
                fields: {
                    page_type: {
                        validators: {
                            notEmpty: {
                                message: 'Page type is required'
                            }
                        }
                    },
                    title: {
                        validators: {
                            notEmpty: {
                                message: 'Title is required'
                            }
                        }
                    },
                    link: {
                        validators: {
                            notEmpty: {
                                message: 'Link is required'
                            }
                        }
                    },
                    button_text: {
                        validators: {
                            notEmpty: {
                                message: 'Button text is required'
                            }
                        }
                    },
                    status: {
                        validators: {
                            notEmpty: {
                                message: 'Status is required'
                            }
                        }
                    }
                }
            });
        })();
    });
</script>
@stop