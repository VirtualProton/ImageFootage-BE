<?php $__env->startSection('content'); ?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Package
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Package</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Package</h3>
                </div>
               <?php if( Session::has( 'success' )): ?>
     			<?php echo e(Session::get( 'success' )); ?>

			   <?php elseif( Session::has( 'warning' )): ?>
                <?php echo e(Session::get( 'warning' )); ?> <!-- here to 'withWarning()' -->
			   <?php endif; ?>
                <form action="<?php echo e(url('admin/editpackage')); ?>" role="form" method="post" enctype="multipart/form-data" id="productform">
                <input type="hidden" class="form-control" name="package_id" id="package_id"  value="<?php echo e($package[0]['package_id']); ?>">
                 <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                  <div class="box-body">
                   <div class="form-group">
                      <label for="exampleInputEmail1">Package Name </label>
                      <input type="text" class="form-control" name="package_name" id="package_name" placeholder="Package name" value="<?php echo e($package[0]['package_name']); ?>">
                       <?php if($errors->has('package_name')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('package_name')); ?></div>
                       <?php endif; ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Package Price</label>
                      <input type="text" class="form-control" name="package_price" id="package_price" placeholder="Package Price" value="<?php echo e($package[0]['package_price']); ?>">
                    </div>
                    <?php if($errors->has('package_price')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('package_price')); ?></div>
                    <?php endif; ?>
                    
                    <div class="form-group">
                      <label for="exampleInputPassword1">Package Description</label>
                       <textarea type="text" class="form-control" name="package_description" id="package_description" placeholder="Package Description"><?php echo e($package[0]['package_description']); ?></textarea>
                         <?php if($errors->has('package_description')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('package_description')); ?></div>
                         <?php endif; ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Package Products Count</label>
                      <input type="text" class="form-control" name="package_products_count" id="package_products_count" placeholder="Package Products Count" value="<?php echo e($package[0]['package_products_count']); ?>">
                    </div>
                     <?php if($errors->has('package_products_count')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('package_products_count')); ?></div>
                     <?php endif; ?>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Package Type</label>
                      <select type="text" class="form-control" name="package_type" id="package_type" >
                      	<option value="Image" <?php if($package[0]['package_type']=='Image'): ?> selected="selected" <?php endif; ?> >Image</option>
                        <option value="Footage" <?php if($package[0]['package_type']=='Footage'): ?> selected="selected" <?php endif; ?> >Footage</option>
                      </select>
                    </div>
                     <?php if($errors->has('package_type')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('package_type')); ?></div>
                     <?php endif; ?>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Package Expiry in Months</label>
                      <input type="text" class="form-control" name="package_expiry" id="package_expiry" placeholder="Package Expiry in Months" value="<?php echo e($package[0]['package_expiry']); ?>">
                    </div>
                    <?php if($errors->has('package_expiry')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('package_expiry')); ?></div>
                    <?php endif; ?>
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
  <?php $__env->stopSection(); ?>
  <?php $__env->startSection('scripts'); ?>
  <script src="<?php echo e(asset('js/formvalidation/formValidation.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/formvalidation/framework/bootstrap.min.js')); ?>"></script>
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
	var csrf='<?php echo e(csrf_token()); ?>';
	$.ajax({
			url: '<?php echo e(url("admin/get_related_subcat")); ?>',
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
                package_name: {
                    validators: {
                        notEmpty: {
                            message: 'Package name is required'
                        }
                    }
                },
                package_price: {
                    validators: {
                        notEmpty: {
                            message: 'Package price is required'
                        }
                    }
                },
                package_description: {
                    validators: {
                        notEmpty: {
                            message: 'Package description is required'
                        }
                    }
                },
                package_products_count: {
                 validators: {
                notEmpty: {
                  message: 'Package products count is required'
                }
              }
            },
            package_type: {
              validators: {
               stringLength: {
                  message: 'Package type is required'
                }
              }
            },
            package_expiry: {
              validators: {
                notEmpty: {
                  message: 'Package expiry in months is required'
                }
              }
             }
            }
        });
    })();

});
</script>
  <?php $__env->stopSection(); ?>
  

<?php echo $__env->make('admin.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\imagefootage\imagefootagenew\resources\views/admin/package/editpackage.blade.php ENDPATH**/ ?>