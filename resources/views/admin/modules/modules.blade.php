@extends('admin.layouts.default')

@section('content')
<div class="content-wrapper">
<section class="content">
<div class="box box-info">
        <!-- form start -->
        <form action="{{ url('admin/createmodule') }}" role="form" method="post" enctype="multipart/form-data" id="moduleform">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
            {{-- @include('admin.partials.message') --}}
            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
                @endif
              <div class="box-body">
                <div class="form-group">
                    <label for="module name">Module Name </label>
                    <input type="text" class="form-control" name="module_name" id="module_name"  value="{{ old('module_name') }}" placeholder="Module Name">
                     @if ($errors->has('module_name'))
                            <div class="has_error" style="color:red;">{{ $errors->first('module_name') }}</div>
                     @endif
                </div>                
                <div class="form-group">
                    <label for="url">URL</label>
                    <input type="text" class="form-control" name="url" id="url" value="{{ old('url') }}" placeholder="URL">
                     @if ($errors->has('url'))
                            <div class="has_error" style="color:red;">{{ $errors->first('url') }}</div>
                     @endif
                </div>

                <div class="form-group">
                  <label for="parent_module">Parent Module</label>
                  <select class="form-control" name="parent_module" id="parent_module">
                    <option value="0">Select</option>
                    @if(count($getModuleslist) > 0)
                    @foreach($getModuleslist as $getModule)
                      @if (old('parent_module') == $getModule['id'])
                        <option value="{{ $getModule['id'] }}" selected>{{$getModule['module_name']}}</option>
                      @else
                        <option value="{{ $getModule['id'] }}">{{$getModule['module_name']}}</option>
                      @endif
                    @endforeach
                    @endif
                  </select> 
                </div>

                
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="A" {{ old('status') == "A" ? 'selected' : '' }}>Active</option>
                        <option value="I" {{ old('status') == "I" ? 'selected' : '' }}>Inactive</option>
                    </select>
                  
                  @if($errors->has('status'))
                     <div class="has_error" style="color:red;">{{ $errors->first('status') }}</div>
                  @endif
                </div>
              <div class="form-group">
                <label for="sortorder">Sort order</label>
                <input type="text" class="form-control" name="sortorder" id="sortorder" value="{{ old('sortorder') }}" placeholder="Sort Order">
                 @if ($errors->has('sortorder'))
                        <div class="has_error" style="color:red;">{{ $errors->first('sortorder') }}</div>
                 @endif
            </div>
            <div class="form-group">
                <label for="moduleicon">Module Icon</label>
                <input type="text" class="form-control" name="moduleicon" id="moduleicon" value="{{ old('moduleicon') }}" placeholder="Module Icon">
                 @if ($errors->has('moduleicon'))
                        <div class="has_error" style="color:red;">{{ $errors->first('moduleicon') }}</div>
                 @endif
            </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary" id="validateButton2">Submit</button>
                 <a href="{{ url('admin/list_module') }}" class="btn btn-primary">Back</a>
              </div>
              <!-- /.box-footer -->
              </div>  
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
