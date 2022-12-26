@extends('admin.layouts.default')

@section('content')
<div class="content-wrapper">
<section class="content">

<div class="box box-info">
        <!-- form start -->
        <form action="{{ url('admin/createpromotion') }}" role="form" method="post" enctype="multipart/form-data" id="promotionform">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
            {{-- @include('admin.partials.message') --}}
              <div class="box-body">
                <div class="form-group">
                    <label for="event name">Event Name </label>
                    <input type="text" class="form-control" name="event_name" id="event_name" placeholder="Event Name">
                     @if ($errors->has('event_name'))
                            <div class="has_error" style="color:red;">{{ $errors->first('event_name') }}</div>
                     @endif
                </div>                
                <div class="form-group">
                    <label for="startdate">Start Date</label>
                    <input type="date" class="form-control" name="date_start" id="date_start" placeholder="Start Date">
                     @if ($errors->has('date_start'))
                            <div class="has_error" style="color:red;">{{ $errors->first('date_start') }}</div>
                     @endif
                </div>
                <div class="form-group">
                    <label for="enddate">End Date</label>
                    <input type="date" class="form-control" name="date_end" id="date_end" placeholder="End Date">
                     @if ($errors->has('date_end'))
                            <div class="has_error" style="color:red;">{{ $errors->first('date_end') }}</div>
                     @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Event Banner</label>
                    <input type="text" class="form-control" name="event_banner" id="event_banner" placeholder="Event Banner">
                     @if ($errors->has('event_banner'))
                            <div class="has_error" style="color:red;">{{ $errors->first('event_banner') }}</div>
                     @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Event Description</label>
                    <input type="text" class="form-control" name="event_des" id="event_des" placeholder="Event Description">
                     @if ($errors->has('event_des'))
                            <div class="has_error" style="color:red;">{{ $errors->first('event_des') }}</div>
                     @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
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
