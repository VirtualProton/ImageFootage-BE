@extends('admin.layouts.default')

@section('content')
<div class="content-wrapper" ng-controller="PromotionController">
<section class="content">
<div class="box box-info">
        <!-- form start -->
        <?php //dd($promotionDetails);
//           "id" => 10
//   "event_name" => "yoga"
//   "date_start" => "2022-12-29"
//   "date_end" => "2023-01-03"
//   "media_type" => ""
//   "product_name" => "11979403"
//   "media_url" => "https://p5resellerp.s3-accelerate.amazonaws.com/011979403_main_xl.mp4"
//   "event_des" => "tttt"
//   "status" => "1"
//   "created_at" => null
//   "update_at" => null
        ?>
        <form action="{{ url('admin/editpromotion') }}" role="form" method="post" enctype="multipart/form-data" id="promotionform">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
            {{-- @include('admin.partials.message') --}}
              <div class="box-body">
                <div class="form-group">
                    <label for="event name">Event Name </label>
                    <input type="text" class="form-control" name="event_name" id="event_name"  value="{{ $promotionDetails['event_name'] }}" placeholder="Event Name">
                     @if ($errors->has('event_name'))
                            <div class="has_error" style="color:red;">{{ $errors->first('event_name') }}</div>
                     @endif
                </div>                
                <div class="form-group">
                    <label for="startdate">Start Date</label>
                    <input type="date" class="form-control" name="date_start" id="date_start" value="{{ $promotionDetails['date_start'] }}" placeholder="Start Date">
                     @if ($errors->has('date_start'))
                            <div class="has_error" style="color:red;">{{ $errors->first('date_start') }}</div>
                     @endif
                </div>
                <div class="form-group">
                    <label for="enddate">End Date</label>
                    <input type="date" class="form-control" name="date_end" id="date_end" value="{{ $promotionDetails['date_end'] }}" placeholder="End Date">
                     @if ($errors->has('date_end'))
                            <div class="has_error" style="color:red;">{{ $errors->first('date_end') }}</div>
                     @endif
                </div>
                <div class="form-group">
                    <label class="">Media Type (Image/Footage)</label>
                    <select required="" id="ProductType" class="form-control" ng-model="product.type" (change)="checkProduct(product)" ng-change="checkProduct(product)" name="media_type">
                       <option [ngValue]="Image" {{ $promotionDetails['media_type'] == "Image" ? 'selected' : '' }}>Image</option>
                       <option [ngValue]="Footage" {{ $promotionDetails['media_type'] == "Footage" ? 'selected' : '' }}>Footage</option>
                    </select>
                    <div>
                    </div>
                 </div>
                <div class="form-group">
                    <label for="eventBanner">Event Banner</label>
                    <input type="hidden" class="form-control" ng-model="product.id" ng-init="product.name = '{{ $promotionDetails['product_name'] }}'">
					<input type="text" class="form-control" value="{{ $promotionDetails['product_name'] }}" name="product_name" id="product_1" required="" ng-blur="getproduct(product)" >

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
                 </span>
                 </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Event Description</label>
                    <input type="text" class="form-control" name="event_des" id="event_des" value="{{ $promotionDetails['event_des'] }}" placeholder="Event Description">
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
    // $("#ProductType").change(function(e){
    //     console.log("Ssss");
    //     // $promotionDetails['media_type']
    // })
    $(document).ready(function(e){
        $("#ProductType").val("{{ $promotionDetails['media_type'] }}")
        $("#ProductType").trigger('change')
    })
  </script>
@stop
