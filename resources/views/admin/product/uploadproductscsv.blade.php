@extends('admin.layouts.default')

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Upload Products Using Csv
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Upload Products Using Csv</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Upload Products Using Csv</h3>
                </div>
               @if( Session::has( 'success' ))
     			{{ Session::get( 'success' ) }}
			   @elseif( Session::has( 'warning' ))
                {{ Session::get( 'warning' ) }} <!-- here to 'withWarning()' -->
			   @endif
                <form action="{{ url('admin/produt_bulk_upload') }}" role="form" method="post" enctype="multipart/form-data" id="productform">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="box-body">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Contributor ID/Owner Name </label>
                       <select class="form-control" name="owner_name" id="owner_name">
                      <option value="">--Contributor ID/Owner Name--</option>
                        @foreach($contributor as $contributor)
                        <option value="{{ $contributor['contributor_memberid'] }}" >{{ $contributor['contributor_name'] }}</option>
                        @endforeach
                      </select>
                       @if ($errors->has('owner_name'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('owner_name') }}</div>
                       @endif
                    </div>
                   <div class="form-group">
                      <label for="exampleInputEmail1">Upload file</label>
                      <input type="file" class="form-control" name="product_csv" id="product_csv" >
                       @if ($errors->has('product_csv'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('product_csv') }}</div>
                       @endif
                    </div>
                    <a href="{{ url('product.csv') }}" download> Download sample csv</a>
                  </div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="validateButton2">Submit</button>
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
	$('.select2').select2();
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
                product_title: {
                    validators: {
                        notEmpty: {
                            message: 'Product title is required'
                        }
                    }
                },
                owner_name: {
                    validators: {
                        notEmpty: {
                            message: 'Owner name is required'
                        }
                    }
                },
                product_category: {
                    validators: {
                        notEmpty: {
                            message: 'Product category is required'
                        }
                    }
                },
                product_sub_category: {
                 validators: {
                notEmpty: {
                  message: 'Product sub category is required'
                }
              }
            },
            product_type: {
              validators: {
               stringLength: {
                  message: 'Product type is required'
                }
              }
            },
            prodect_keywords: {
              validators: {
                notEmpty: {
                  message: 'Product keywords is required'
                }
              }
             },
              release_details: {
                    validators: {
                        notEmpty: {
                            message: 'Release details is required'
                        }
                    }
                },
			  product_image: {
                    validators: {
                        notEmpty: {
                            message: 'Product image is required'
                        }
                    }
                }

            }
        });
    })();

});
</script>
  @endsection
  
