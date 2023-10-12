@extends('admin.layouts.default')

@section('content')
<div class="content-wrapper" ng-controller="PromotionController">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit Promotion
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Edit Promotion</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Promotion</h3><a href="{{ URL::to('admin/list_promotion') }}" class="btn pull-right">Back</a>
            </div>
            <!-- form start -->
            <form action="{{ url('admin/editpromotion') }}" role="form" method="post" enctype="multipart/form-data" id="promotionform">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="promotion_id" value="{{ $promotionDetails['id']  }}">
                {{-- @include('admin.partials.message') --}}
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
                        <label for="event name">Name </label>
                        <input type="text" class="form-control" name="event_name" id="event_name" value="{{ $promotionDetails['event_name'] }}" placeholder="Name">
                        @if ($errors->has('event_name'))
                        <div class="has_error" style="color:red;">{{ $errors->first('event_name') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="">Page Type</label>
                        <select id="PageType" class="form-control" name="page_type">
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
                        <label class="">Media Type (Image/Footage)</label>
                        <select id="ProductType" class="form-control" ng-model="product.type" name="media_type" ng-change="checkProduct(product)">
                        <option [ngValue]="Image" {{ $promotionDetails['media_type'] == "Image" ? 'selected' : '' }}>Image</option>
                        <option [ngValue]="Footage" {{ $promotionDetails['media_type'] == "Footage" ? 'selected' : '' }}>Footage</option>
                        </select>
                        <div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Desktop Banner Image</label>
                        @if(!empty($promotionDetails['desktop_banner_image']))
                        </br><img src="{{$promotionDetails['desktop_banner_image']}}" width="150" height="150" /></br></br>
                        @endif
                        <input type="file" id="desktop_banner_image" name="desktop_banner_image">
                        <p class="help-block">Image upload size (1920px * 554px)</p>
                        @if ($errors->has('desktop_banner_image'))
                        <div class="has_error" style="color:red;">{{ $errors->first('desktop_banner_image') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Mobile Banner Image</label>
                        @if(!empty($promotionDetails['mobile_banner_image']))
                        </br><img src="{{$promotionDetails['mobile_banner_image']}}" width="150" height="150" /></br></br>
                        @endif
                        <input type="file" id="mobile_banner_image" name="mobile_banner_image">
                        <p class="help-block">Image upload size (575px * 380px)</p>
                        @if ($errors->has('mobile_banner_image'))
                        <div class="has_error" style="color:red;">{{ $errors->first('mobile_banner_image') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="eventBanner">Event Banner</label>
                        <input type="hidden" class="form-control" ng-model="product.id" ng-init="product.name = '{{ $promotionDetails['product_name'] }}'">
                        <input type="text" class="form-control" value="{{ $promotionDetails['product_name'] }}" name="product_name" id="product_1" ng-blur="getproduct(product)" >

                        @if ($errors->has('product_name'))
                                <div class="has_error" style="color:red;">{{ $errors->first('product_name') }}</div>
                        @endif
                    </div>
                    <div class="form-group" ng-show="product.type=='Image'">
                        <input type="hidden" class="form-control" id="image_url" name="image_url">

                        <span id="product_image_container" style="display: none">
                            <img id="product_image" width="150" height="150" />
                        </span>
                    </div>
                    <div class="form-group" ng-show="product.type =='Footage'">
                        <input type="hidden" class="form-control" id="footage_url" name="footage_url">
                        <video style="display: none" id="product_footage" class="for_mobile" controls="" width="300px" controlslist="nodownload" onmouseout="this.load()" onmouseover="this.play()" poster="<%product.image%>">
                        <source type="video/mp4" src="<%product.footage%>"> 
                        Your browser does not support the video tag. 
                        </video>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <input type="text" class="form-control" name="event_des" id="event_des" value="{{ $promotionDetails['event_des'] }}" placeholder="Description">
                        @if ($errors->has('event_des'))
                        <div class="has_error" style="color:red;">{{ $errors->first('event_des') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" {{ $promotionDetails['status'] == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $promotionDetails['status'] == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    @if($errors->has('status'))
                    <div class="has_error" style="color:red;">{{ $errors->first('status') }}</div>
                    @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="validateButton2">Submit</button>
                    <a href="{{ url('admin/list_promotion') }}" class="btn btn-primary">Back</a>
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
    $(document).ready(function(e) {
        $("#PageType").val("{{ $promotionDetails['page_type'] }}")
        $("#PageType").trigger('change')
        $("#ProductType").val("{{ $promotionDetails['media_type'] }}")
        $("#ProductType").trigger('change')
    })
</script>
@stop