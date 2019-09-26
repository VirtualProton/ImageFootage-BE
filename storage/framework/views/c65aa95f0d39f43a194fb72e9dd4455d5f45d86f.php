<?php $__env->startSection('content'); ?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Edit Product Subcategory
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Product Subcategory</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Product Subcategory</h3>
                </div>
               <?php if( Session::has( 'success' )): ?>
     			<?php echo e(Session::get( 'success' )); ?>

			   <?php elseif( Session::has( 'warning' )): ?>
                <?php echo e(Session::get( 'warning' )); ?> <!-- here to 'withWarning()' -->
			   <?php endif; ?>
                <form action="<?php echo e(url('admin/editproductsubcategory')); ?>" role="form" method="post" enctype="multipart/form-data" id="productform">
                 <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                 <input type="hidden" name="product_subcategory_id" value="<?php echo e($ProductSubCategory['subcategory_id']); ?>">
                 <div class="form-group">
                      <label for="exampleInputEmail1">Category</label>
                      <select class="form-control" name="category" id="category"> 
                      	<option value="">Select Category</option>
                        <?php $__currentLoopData = $productcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category['category_id']); ?>" <?php if( $ProductSubCategory['category_id']==$category['category_id'] ): ?> selected="selected" <?php endif; ?> ><?php echo e($category['category_name']); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                       <?php if($errors->has('category')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('category')); ?></div>
                       <?php endif; ?>
                  </div>
                  <div class="box-body">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Sub Category Name </label>
                      <input type="text" class="form-control" name="sub_category_name" id="sub_category_name" placeholder="Sub Category Name" value="<?php echo e($ProductSubCategory['subcategory_name']); ?>">
                       <?php if($errors->has('sub_category_name')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('sub_category_name')); ?></div>
                       <?php endif; ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Sub Category Display Order </label>
                      <input type="text" class="form-control" name="sub_category_order" id="sub_category_order" placeholder="Sub Category Display Order" value="<?php echo e($ProductSubCategory['subcategory_order']); ?>">
                       <?php if($errors->has('sub_category_order')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('sub_category_order')); ?></div>
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
                category: {
                    validators: {
                        notEmpty: {
                            message: 'Category is required'
                        }
                    }
                },
				sub_category_name: {
                    validators: {
                        notEmpty: {
                            message: 'Sub Category Name is required'
                        }
                    }
                },
                sub_category_order: {
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

<?php echo $__env->make('admin.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\imagefootage\imagefootagenew\resources\views/admin/product/editproductsubcategory.blade.php ENDPATH**/ ?>