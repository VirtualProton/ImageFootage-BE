@extends('admin.layouts.default')

@section('content')

              
<div class="content-wrapper">
<section class="content">

<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Send Invoice</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           
              @include('admin.partials.message')

              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Template</label>

                  <div class="col-sm-4">
                <div class="form-group">
                 <select class="form-control" name="template" id="template" onchange="get_template(this)">
                    <option  value="">Select</option>
                    @if(count($templates) > 0)
                    @foreach($templates as $template)
                    <option value={{$template->id}}>{{$template->draft_name}}</option>
                    @endforeach
                    @endif
                  </select>
                </div>
                  </div>
                  
                </div>
                <div class="clear"></div>
                <div class="form-group">
                   <label for="emailtpl" class="col-sm-2 control-label">Email</label> 
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="email" name="email" class="form-control"/>
                  </div>
                  </div>
                </div>

                <div class="form-group" id="tmp" style="display:none;">
                  <!-- <label for="emailtpl" class="col-sm-2 control-label">Last Name</label> -->
                  <div class="col-sm-10">
                  <div class="form-group">
                  <textarea class="form-control" id="emailtpl" name="emailtpl"></textarea>
                  </div>
                  </div>
                </div>

                <!-- <div id="edit" style="display:none;margin:40px;"><button type="button" class="btn btn-info">Edit</button></div>-->
               <!-- <div id="tmp">
                 <textarea name="emailtpl" id="emailtpl"></textarea>
               </div>  -->
              <input type="hidden" name="template_id" id="template_id" value="" />
              <div class="box-footer" id="send" style="display:none">
              <button type="button" class="btn btn-succsess">Send Email</button>
             </div>
     </div>
              <!-- /.box-body -->
              
              <!-- /.box-footer -->
            
          </div>

    </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    @endsection
    @section('scripts')
<script src="{{ asset('js/formvalidation/formValidation.min.js') }}"></script>
<script src="{{ asset('js/formvalidation/framework/bootstrap.min.js') }}"></script>
<!-- <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script> -->
<script>
   // CKEDITOR.replace( 'emailtpl' );
</script>
<script>
function get_template(data){
   console.log(data.value);
    $.ajax({
            url: '{{ URL::to("admin/get_email_template") }}',
            data: {
            templ_id: data.value,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            error: function() {
            //$('#info').html('<p>An error has occurred</p>');
            },
            success: function(data) {
               $('#tmp').show();
              //  $('#edit').show();
              //  $('#send').show();
              var editor = CKEDITOR.instances.emailtpl;
              if (editor) {
                  //alert('instance exists');
                  editor.destroy(true); 
                  //alert('destroyed');
              }   
              CKEDITOR.replace('emailtpl');
           
              $('#emailtpl').val(data);
               $('#template_id').val(data.value);
               $('#send').show();
            },
            type: 'POST'
            });
}
</script>
@stop
