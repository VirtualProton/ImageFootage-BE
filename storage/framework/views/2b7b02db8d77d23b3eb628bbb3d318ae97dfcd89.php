<?php $__env->startSection('content'); ?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Static Page
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Edit Static Page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"> Edit Static Page</h3>
                </div>
               <?php if( Session::has( 'success' )): ?>
     			<?php echo e(Session::get( 'success' )); ?>

			   <?php elseif( Session::has( 'warning' )): ?>
                <?php echo e(Session::get( 'warning' )); ?> <!-- here to 'withWarning()' -->
			   <?php endif; ?>
                <form action="<?php echo e(url('admin/editstaticpage')); ?>" role="form" method="post" enctype="multipart/form-data" id="productform">
                <input type="hidden" class="form-control" name="page_id" id="page_id"  value="<?php echo e($page[0]['page_id']); ?>">
                 <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                  <div class="box-body">
                   <div class="form-group">
                      <label for="exampleInputEmail1">Page Title</label>
                      <input type="text" class="form-control" name="page_title" id="page_title" placeholder="Page name" value="<?php echo e($page[0]['page_title']); ?>">
                       <?php if($errors->has('page_title')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('page_title')); ?></div>
                       <?php endif; ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Page URL</label>
                      <input type="text" class="form-control" name="page_url" id="page_url" placeholder="Page URL" value="<?php echo e($page[0]['page_url']); ?>">
                    </div>
                    <?php if($errors->has('page_url')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('page_url')); ?></div>
                    <?php endif; ?>
                    
                    <div class="form-group">
                      <label for="exampleInputPassword1">Page Meta Description</label>
                       <textarea type="text" class="form-control" name="page_meta_desc" id="page_meta_desc" placeholder="Page Meta Description"><?php echo e($page[0]['page_meta_desc']); ?></textarea>
                         <?php if($errors->has('page_meta_desc')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('page_meta_desc')); ?></div>
                         <?php endif; ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Page Meta Keywords</label>
                       <textarea type="text" class="form-control" name="page_meta_keywords" id="page_meta_keywords" placeholder="Page Meta Keywords"><?php echo e($page[0]['page_meta_keywords']); ?></textarea>
                         <?php if($errors->has('page_meta_keywords')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('page_meta_keywords')); ?></div>
                         <?php endif; ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Page Content</label>
                       <textarea type="text" class="form-control" name="page_content" id="page_content" placeholder="Page Content"><?php echo e($page[0]['page_content']); ?></textarea>
                         <?php if($errors->has('page_content')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('page_content')); ?></div>
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
  <?php $__env->stopSection(); ?>
  

<?php echo $__env->make('admin.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\imagefootage\imagefootagenew\resources\views/admin/staticpages/editstaticpage.blade.php ENDPATH**/ ?>