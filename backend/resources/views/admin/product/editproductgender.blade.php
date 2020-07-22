@extends('admin.layouts.default')

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Product Gender</h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Edit Product Gender</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"> Edit Product Gender</h3><a href="{{ URL::to('admin/product_gender_list') }}" class="btn pull-right">Back</a>
                </div>
               @if( Session::has( 'success' ))
     			{{ Session::get( 'success' ) }}
			   @elseif( Session::has( 'warning' ))
                {{ Session::get( 'warning' ) }} <!-- here to 'withWarning()' -->
			   @endif
                <form action="{{ url('admin/updateproductgender') }}" role="form" method="post" enctype="multipart/form-data" id="productform">
                <input type="hidden" class="form-control" name="id" id="id"  value="{{ $page[0]['id'] }}">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="box-body">
                   <div class="form-group">
                      <label for="exampleInputEmail1">Product Color Name</label>
                      <input type="text" class="form-control" name="product_gender_name" id="product_gender_name" placeholder="Product Color Name" value="{{ $page[0]['name'] }}">
                       @if ($errors->has('product_gender_name'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('product_gender_name') }}</div>
                       @endif
                    </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="validateButton2">Save</button>
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
  <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
  <script>
 //sub_product_type
 $('.product_type').click(function(){
 	if($(this).is(":checked")){
               var ptype=$(this).val();
			   if(ptype == 'Image' || ptype == 'Editorial' ){
				   $("#sub_product_type").css("display","block");
			   }else{
				   $("#sub_product_type").css("display","none");
			   }
    }
 });
 $("#product_category").on('change',function(){
	var prod_id=$(this).val();
	var csrf='{{ csrf_token() }}';
	$.ajax({
			url: '{{ url("admin/get_related_subcat") }}',
			type: 'POST',
			data: {'prod_id':prod_id,'_token':csrf},
			success:function(data){
				$("#product_sub_category").html('');
				$("#product_sub_category").html(data);
			}
		});
 });
  </script>
  <script>

$(document).ready(function ($) {
	CKEDITOR.replace( 'page_content' );
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
                page_title: {
                    validators: {
                        notEmpty: {
                            message: 'Page Title is required'
                        }
                    }
                },
                page_url: {
                    validators: {
                        notEmpty: {
                            message: 'Page URL is required'
                        }
                    }
                },
                page_meta_desc: {
                    validators: {
                        notEmpty: {
                            message: 'Page Meta Description is required'
                        }
                    }
                },
                page_meta_keywords: {
                 validators: {
                notEmpty: {
                  message: 'Page Meta Keywords is required'
                }
              }
            },
            page_content: {
              validators: {
               stringLength: {
                  message: 'Page Content is required'
                }
              }
            }
            }
        });
    })();

});
</script>
  @endsection
  
