<?php $__env->startSection('content'); ?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Contributor
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Contributor</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Add Contributor</h3>
                </div>
               <?php if( Session::has( 'success' )): ?>
     			<?php echo e(Session::get( 'success' )); ?>

			   <?php elseif( Session::has( 'warning' )): ?>
                <?php echo e(Session::get( 'warning' )); ?> <!-- here to 'withWarning()' -->
			   <?php endif; ?>
                <form action="<?php echo e(url('admin/addcontributor')); ?>" role="form" method="post" enctype="multipart/form-data">
                 <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                  <div class="box-body">
                   <div class="form-group">
                      <label for="exampleInputEmail1">Contributor Name</label>
                      <input type="text" class="form-control" name="contributor_name" id="contributor_name" placeholder="Contributor Name">
                       <?php if($errors->has('contributor_name')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('contributor_name')); ?></div>
                       <?php endif; ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Contributor Email</label>
                      <input type="email" class="form-control" name="contributor_email" id="contributor_email" placeholder="Contributor Email">
                       <?php if($errors->has('contributor_email')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('contributor_email')); ?></div>
                       <?php endif; ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Contributor Password</label>
                      <input type="password" class="form-control" name="contributor_password" id="contributor_password">
                    </div>
                    <?php if($errors->has('contributor_password')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('contributor_password')); ?></div>
                    <?php endif; ?>
                    
                     <div class="form-group">
                      <label for="exampleInputEmail1">Contributor Confirm Password</label>
                      <input type="password" class="form-control" name="contributor_confirm_password" id="contributor_confirm_password" placeholder="Contributor Confirm Password">
                    </div>
                    <?php if($errors->has('contributor_confirm_password')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('contributor_confirm_password')); ?></div>
                    <?php endif; ?>
                    
                    <div class="form-group">
                      <label for="exampleInputFile">ID Proof</label>
                      <input type="file" id="contributor_idproof" name="contributor_idproof">
    
                      <p class="help-block">Example :– Aadhar/Voter ID/Pan Card/Passport.</p>
                      <?php if($errors->has('contributor_idproof')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('contributor_idproof')); ?></div>
                      <?php endif; ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Product Type</label>
                      <div class="checkbox">
                          <label>
                            <input type="radio" name="contributor_type" value="For Sale" class="product_type"> For Sale
                          </label>
                          <label>
                            <input type="radio" name="contributor_type" value="Donor" class="product_type"> Donor
                          </label>
                    	</div>
                    </div>
                    <?php if($errors->has('contributor_type')): ?>
                      		<div class="has_error" style="color:red;"><?php echo e($errors->first('contributor_type')); ?></div>
                    <?php endif; ?>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
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
<?php echo $__env->make('admin.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\imagefootage\imagefootagenew\resources\views/admin/contributor/addcontributor.blade.php ENDPATH**/ ?>