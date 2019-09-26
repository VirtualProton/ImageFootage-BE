<?php $__env->startSection('content'); ?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Edit Product Category
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Product Category</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Product Category</h3>
                </div>
               <?php if( Session::has( 'success' )): ?>
     			<?php echo e(Session::get( 'success' )); ?>

			   <?php elseif( Session::has( 'warning' )): ?>
                <?php echo e(Session::get( 'warning' )); ?> <!-- here to 'withWarning()' -->
			   <?php endif; ?>
                <form action="<?php echo e(url('admin/editproductcategory')); ?>" role="form" method="post" enctype="multipart/form-data" id="productform">
                 <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                 <input type="hidden" name="product_category_id" value="<?php echo e($productcategory['category_id']); ?>">
                  <div class="box-body">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Category Name </label>
                      <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Category Name" value="<?php echo e($productcategory['category_name']); ?>">
                       <?php if($errors->has('category_name')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('category_name')); ?></div>
                       <?php endif; ?>
                    </div>
                    <div class="form-group">
                     <label for="exampleInputEmail1">Category Display Order </label>
                      <input type="text" class="form-control" name="category_order" id="category_order" placeholder="Category Display Order" value="<?php echo e($productcategory['category_order']); ?>">
                       <?php if($errors->has('category_order')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('category_order')); ?></div>
                       <?php endif; ?>
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
                category_name: {
                    validators: {
                        notEmpty: {
                            message: 'Category Name is required'
                        }
                    }
                },
                category_order: {
                    validators: {
                        integer: {
                        	message: 'The value is not an integer'
                    	}
                    }
                }
            }
        });
    })();

});
  </script>
  <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\imagefootage\imagefootagenew\resources\views/admin/product/editproductcategory.blade.php ENDPATH**/ ?>