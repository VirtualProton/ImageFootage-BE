@extends('admin.layouts.default')

@section('content')
<div class="content-wrapper">
<section class="content">
<div class="box box-info">
        <!-- form start -->
        <?php //dd($modulesDetails);?>
        <form action="{{ url('admin/editmodules') }}" role="form" method="post" enctype="multipart/form-data" id="modulesform">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
            <input type="hidden" class="form-control" name="module_id" id="module_id"  value="{{ $modulesDetails['id'] }}" >
            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
                @endif
            <div class="box-body">
            <div class="form-group">
                <label for="module name">Module Name </label>
                <input type="text" class="form-control" name="module_name" id="module_name"  value="{{ $modulesDetails['module_name'] }}" placeholder="Module Name">
                 @if ($errors->has('module_name'))
                        <div class="has_error" style="color:red;">{{ $errors->first('module_name') }}</div>
                 @endif
            </div>                
            <div class="form-group">
                <label for="url">URL</label>
                <input type="text" class="form-control" name="url" id="url" value="{{ $modulesDetails['url'] }}" placeholder="URL">
            </div>

            <div class="form-group">
                <label for="parent_module">Parent Module</label>
                <select class="form-control" name="parent_module" id="parent_module"> 
                    <option value="">Select</option>
                  @foreach($getModuleslist as $getModule)
                  <option value="{{ $getModule['id'] }}" @if( $modulesDetails['parent_module_id']==$getModule['id'] ) selected="selected" @endif >{{ $getModule['module_name'] }}</option>
                  @endforeach
                </select>
              </div>

            
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status" id="status">
                    <option value="A" {{ $modulesDetails['status'] == "A" ? 'selected' : '' }}>Active</option>
                    <option value="I" {{ $modulesDetails['status'] == "I" ? 'selected' : '' }}>Inactive</option>
                </select>
              
              @if($errors->has('status'))
                 <div class="has_error" style="color:red;">{{ $errors->first('status') }}</div>
              @endif
            </div>
          <div class="form-group">
            <label for="sortorder">Sort order</label>
            <input type="text" class="form-control" name="sortorder" id="sortorder" value="{{ $modulesDetails['sort_order'] }}" placeholder="Sort Order">
             @if ($errors->has('sortorder'))
                    <div class="has_error" style="color:red;">{{ $errors->first('sortorder') }}</div>
             @endif
        </div>
        <div class="form-group">
            <label for="moduleicon">Module Icon</label>
            <input type="text" class="form-control" name="moduleicon" id="moduleicon" value="{{ $modulesDetails['module_icon'] }}" placeholder="Module Icon">
        </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" id="validateButton2">Submit</button>
             <a href="{{ url('admin/list_module') }}" class="btn btn-primary">Back</a>
          </div>
          <!-- /.box-footer -->
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
