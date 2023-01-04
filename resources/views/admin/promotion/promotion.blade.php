@extends('admin.layouts.default')

@section('content')
<div class="content-wrapper" ng-controller="PromotionController">
<section class="content">
<div class="box box-info">
        <!-- form start -->
        <form action="{{ url('admin/createpromotion') }}" role="form" method="post" enctype="multipart/form-data" id="promotionform">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
            {{-- @include('admin.partials.message') --}}
              <div class="box-body">
                <div class="form-group">
                    <label for="event name">Event Name </label>
                    <input type="text" class="form-control" name="event_name" id="event_name"  value="{{ old('event_name') }}" placeholder="Event Name">
                     @if ($errors->has('event_name'))
                            <div class="has_error" style="color:red;">{{ $errors->first('event_name') }}</div>
                     @endif
                </div>                
                <div class="form-group">
                    <label for="startdate">Start Date</label>
                    <input type="date" class="form-control" name="date_start" id="date_start" value="{{ old('date_start') }}" placeholder="Start Date">
                     @if ($errors->has('date_start'))
                            <div class="has_error" style="color:red;">{{ $errors->first('date_start') }}</div>
                     @endif
                </div>
                <div class="form-group">
                    <label for="enddate">End Date</label>
                    <input type="date" class="form-control" name="date_end" id="date_end" value="{{ old('date_end') }}" placeholder="End Date">
                     @if ($errors->has('date_end'))
                            <div class="has_error" style="color:red;">{{ $errors->first('date_end') }}</div>
                     @endif
                </div>
                <div class="form-group">
                    <label class="">Media Type <%$index+1%> (Image/Footage)</label>
                    <select required="" class="form-control" ng-model="product.type" ng-change="checkProduct(product)" name="media_type">
                       <option value="">--Select a Type--</option>
                       <option value="Image">Image</option>
                       <option value="Footage">Footage</option>
                    </select>
                    <div>
                    </div>
                 </div>
                <div class="form-group">
                    <label for="eventBanner">Event Banner</label>
                    {{-- <input type="text" class="form-control" name="event_banner" id="event_banner" value="{{ old('event_banner') }}" placeholder="Event Banner"> --}}
                    <input type="hidden" class="form-control" ng-model="product.id">
					<input type="text" class="form-control" ng-model="product.name" name="product_name" id="product_1" required="" ng-blur="getproduct(product)" >

                    @if ($errors->has('product_name'))
                            <div class="has_error" style="color:red;">{{ $errors->first('event_banner') }}</div>
                     @endif
                </div>

                <div class="form-group" ng-show="product.type=='Image'">
                    <input type="hidden" class="form-control" id="image_url" name="image_url">

                    <span id="product_image_container" style="display: none"><img id="product_image" width="150" height="150" /></span>
                    <!-- <span ng-show="!product.thumbnail_image"> <input  class="form-control" type="file" name="file<%$index+1%>" ng-model="product.image" id="file<%$index+1%>" style="position:inherit;top:0;left:0;z-index:2;opacity:1;cursor:pointer;" ng-file-select="onFileSelect($files)"></span> -->
                 </div>
                 <div class="form-group" ng-show="product.type =='Footage'">
                    <input type="hidden" class="form-control" id="footage_url" name="footage_url">
                    <video style="display: none" id="product_footage" class="for_mobile" controls="" width="300px" controlslist="nodownload" onmouseout="this.load()" onmouseover="this.play()" poster="<%product.image%>">
                       <source type="video/mp4" src="<%product.footage%>"> 
                       Your browser does not support the video tag. 
                    </video>
                 </span>
                 </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Event Description</label>
                    <input type="text" class="form-control" name="event_des" id="event_des" value="{{ old('event_des') }}" placeholder="Event Description">
                     @if ($errors->has('event_des'))
                            <div class="has_error" style="color:red;">{{ $errors->first('event_des') }}</div>
                     @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
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
@stop
