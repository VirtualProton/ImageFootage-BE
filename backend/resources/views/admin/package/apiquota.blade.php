@extends('admin.layouts.default')

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        API Quata
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">API Quata</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Create API Quata</h3>
                </div>
               @if( Session::has( 'success' ))
     			{{ Session::get( 'success' ) }}
			   @elseif( Session::has( 'warning' ))
                {{ Session::get( 'warning' ) }} <!-- here to 'withWarning()' -->
			   @endif
                <form action="{{ url('admin/insertapiquota') }}" role="form" method="post" enctype="multipart/form-data" id="productform">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="box-body">
                  
                   <div class="form-group">
                      <label for="exampleInputEmail1">API Provider</label>
                      <input type="text" class="form-control" name="api_provider" id="api_provider" placeholder="API Provider">
                       @if ($errors->has('api_provider'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('api_provider') }}</div>
                       @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Amount</label>
                      <input type="text" class="form-control" name="api_amount" id="api_amount" placeholder="Amount">
                    </div>
                    @if ($errors->has('api_amount'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('api_amount') }}</div>
                    @endif
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="validateButton2">Submit</button>
                    <a href="{{ url('admin/api_quota_list') }}" class="btn btn-primary">Back</a>
                  </div>
                </form>
              </div>
            </div>
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
    // ---------------------------------
    (function () {

        var i = 1;

        $('#productform').formValidation({
            framework: "bootstrap",
            button: {
                selector: '#validateButton2',
                disabled: 'disabled'
            },
            icon: null,
            fields: {
                api_provider: {
                    validators: {
                        notEmpty: {
                            message: 'API Provider is required'
                        }
                    }
                },
                api_amount: {
                    validators: {
                        notEmpty: {
                            message: 'API amount is required'
                        }
                    }
                }
               
          
            }
        });
    })();

});
$("#package_plan").change(function(){
	var pack_type=$(this).val();
	if(pack_type =='Download Pack'){
		$("#package_month_count").val("");
		$('#for_pro').css('display','none');
	}else{
		$('#for_pro').css('display','block');
	}
	
});

</script>
  @endsection
  
