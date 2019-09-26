<?php $__env->startSection('content'); ?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Product
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Product</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Product</h3>
                </div>
               <?php if( Session::has( 'success' )): ?>
     			<?php echo e(Session::get( 'success' )); ?>

			   <?php elseif( Session::has( 'warning' )): ?>
                <?php echo e(Session::get( 'warning' )); ?> <!-- here to 'withWarning()' -->
			   <?php endif; ?>
                <form action="<?php echo e(url('admin/editproduct')); ?>" role="form" method="post" enctype="multipart/form-data" id="productform">
                 <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                 <input type="hidden" name="product_id" value="<?php echo e($product['id']); ?>">
                 <input type="hidden" name="file_name" value="<?php echo e($product['product_main_image']); ?>">
                  <div class="box-body">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Product Title </label>
                      <input type="text" class="form-control" name="product_title" id="product_title" placeholder="Product Title" value="<?php echo e($product['product_title']); ?>">
                       <?php if($errors->has('product_title')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('product_title')); ?></div>
                       <?php endif; ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Bank/Owner Name </label>
                      <select class="form-control" name="owner_name" id="owner_name">
                      <option value="">--Product Bank/Owner Name--</option>
                        <?php $__currentLoopData = $contributor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contributor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($contributor['contributor_memberid']); ?>" <?php if($product['product_owner']==$contributor['contributor_memberid']): ?> selected="selected" <?php endif; ?> ><?php echo e($contributor['contributor_name']); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                       <?php if($errors->has('owner_name')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('owner_name')); ?></div>
                       <?php endif; ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Category </label>
                      <select class="form-control" name="product_category" id="product_category">
                        <option value="">--Select Category--</option>
                        <?php $__currentLoopData = $productcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category['category_id']); ?>" <?php if($product['product_category']==$category['category_id']): ?> selected="selected" <?php endif; ?> ><?php echo e($category['category_name']); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                    <?php if($errors->has('product_category')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('product_category')); ?></div>
                    <?php endif; ?>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Sub Category </label>
                      <select class="form-control" name="product_sub_category" id="product_sub_category">
                        <option value="">--Select Sub Category --</option>
                      	
                      </select>
                    </div>
                    <?php if($errors->has('product_sub_category')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('product_sub_category')); ?></div>
                    <?php endif; ?>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Product Type</label>
                      <div class="checkbox">
                          <label>
                            <input type="radio" name="product_type" value="Image" class="product_type" <?php if($product['product_main_type']=='Image'): ?> checked="checked" <?php endif; ?> > Image
                          </label>
                          <label>
                            <input type="radio" name="product_type" value="Footage" class="product_type" <?php if($product['product_main_type']=='Footage'): ?> checked="checked" <?php endif; ?>> Footage
                          </label>
                          <label>
                            <input type="radio" name="product_type" value="Editorial" class="product_type" <?php if($product['product_main_type']=='Editorial'): ?> checked="checked" <?php endif; ?>> Editorial
                          </label>
                    	</div>
                        <?php if($errors->has('product_type')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('product_type')); ?></div>
                       <?php endif; ?>
                    </div>
                    
                   
                    <div class="form-group"     <?php if($product['product_main_type']=='Image' || $product['product_main_type']=='Editorial' ): ?> 
                    style="display:block;" <?php elseif($product['product_main_type']=='Footage'): ?>  style="display:none;" <?php endif; ?> id="sub_product_type">
                      <label for="exampleInputPassword1">Sub Product Type</label>
                      <div class="checkbox">
                          <label>
                            <input type="radio" name="sub_product_type" value="Photo" <?php if($product['product_sub_type']=='Photo'): ?> checked="checked" <?php endif; ?>> Photo
                          </label>
                          <label>
                            <input type="radio" name="sub_product_type" value="Vector" <?php if($product['product_sub_type']=='Vector'): ?> checked="checked" <?php endif; ?>> Vector
                          </label>
                          <label>
                            <input type="radio" name="sub_product_type" value="Illustrator" <?php if($product['product_sub_type']=='Illustrator'): ?> checked="checked" <?php endif; ?>> Illustrator
                          </label>
                    	</div>
                    </div>
                     <?php if($errors->has('sub_product_type')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('sub_product_type')); ?></div>
                    <?php endif; ?>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Product Vertical</label>
                      <div class="checkbox">
                          <label>
                            <input type="radio" name="product_vertical" value="Royalty Free"  <?php if($product['product_vertical']=='Royalty Free'): ?> checked="checked" <?php endif; ?>> Royalty Free
                          </label>
                          <label>
                            <input type="radio" name="product_vertical" value="Rights Managed" <?php if($product['product_vertical']=='Rights Managed'): ?> checked="checked" <?php endif; ?>> Rights Managed
                          </label>
                          <label>
                            <input type="radio" name="product_vertical" value="Premium Rights Managed" <?php if($product['product_vertical']=='Premium Rights Managed'): ?> checked="checked" <?php endif; ?>> Premium Rights Managed
                          </label>
                    	</div>
                         <?php if($errors->has('product_vertical')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('product_vertical')); ?></div>
                         <?php endif; ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Product Keywords</label>
                      <textarea name="prodect_keywords" class="form-control" placeholder="Product Keywords" ><?php echo e($product['product_keywords']); ?></textarea>
                       <?php if($errors->has('prodect_keywords')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('prodect_keywords')); ?></div>
                      <?php endif; ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Release Details</label>
                      <textarea name="release_details" class="form-control" placeholder="Release Details"><?php echo e($product['product_release_details']); ?></textarea>
                       <?php if($errors->has('release_details')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('release_details')); ?></div>
                    <?php endif; ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Price For Small </label>
                      <input type="text" class="form-control" name="Price_small" id="owner_name" placeholder="Product Bank/Owner Name" value="<?php echo e($product['product_price_small']); ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Price For Medium </label>
                      <input type="text" class="form-control" name="price_medium" id="price_medium" placeholder="Product Bank/Owner Name" value="<?php echo e($product['product_price_medium']); ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Price For Large </label>
                      <input type="text" class="form-control" name="price_large" id="price_large" placeholder="Product Bank/Owner Name" value="<?php echo e($product['product_price_large']); ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Price For Extra Large </label>
                      <input type="text" class="form-control" name="price_extra_large" id="price_extra_large" placeholder="Product Bank/Owner Name" value="<?php echo e($product['product_price_extralarge']); ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Product</label>
                      <input type="file" id="product_image" name="product_image">
    
                      <p class="help-block">Example block-level help text here.</p>
                      <?php if($errors->has('product_image')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('product_image')); ?></div>
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
 	var prod_id=$("#product_category").val();
	var prod_subcat="<?php echo e($product['product_subcategory']); ?>";
	var csrf='<?php echo e(csrf_token()); ?>';
	$.ajax({
			url: '<?php echo e(url("admin/get_related_subcat")); ?>',
			type: 'POST',
			data: {'prod_id':prod_id,'_token':csrf,'prod_subcat':prod_subcat},
			success:function(data){
				$("#product_sub_category").html('');
				$("#product_sub_category").html(data);
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
                }
			 

            }
        });
    })();

});
</script>
  <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\imagefootage\imagefootagenew\resources\views/admin/product/editproduct.blade.php ENDPATH**/ ?>