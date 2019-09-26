<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Products List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Products List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary" style="overflow-x:auto;">
                <div class="box-header with-border" style="overflow-x:auto;">
                  <h3 class="box-title">Products List</h3>
                </div>

                <?php echo $__env->make('admin.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                <table id="example2" class="table table-bordered table-hover">
                	<thead>
                        <th>Id</th>
                        <th>Product Id</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Owner</th>
                        <th>Vertical</th>
                        <th>Keywords</th>
                        <th>Type</th>
                        <th>Product</th>
                        <th>Added On</th>
                        <th>Actions</th>
                    </thead>

                    <tbody>
                     <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
  <td><?php echo e($product['id']); ?> </td>
  <td><?php echo e($product['product_id']); ?> </td>
  <td><?php echo e($product['category_name']); ?> </td>
  <td><?php echo e($product['subcategory_name']); ?> </td>
  <td><?php echo e($product['product_owner']); ?> </td>
  <td><?php echo e($product['product_vertical']); ?> </td>
  <td><?php echo e($product['product_keywords']); ?> </td>
  <td><?php echo e($product['product_main_type']); ?> </td>
  <td>

  <?php if($product['product_main_type'] =='Image'): ?>
  	<?php if($product['product_sub_type'] =='Vector'): ?>

    <?php elseif($product['product_sub_type'] =='Photo'): ?>
    <img src="<?php echo e(URL::asset('uploads/image/photo/'.$product['product_main_image'])); ?>" alt="User Image" width="100">
    <?php elseif($product['product_sub_type'] =='Illustrator'): ?>
    <?php endif; ?>

  <?php elseif($product['product_main_type'] =='Footage'): ?>
  <?php elseif($product['product_main_type'] =='Editorial'): ?>
  	<?php if($product['product_sub_type'] =='Vector'): ?>

    <?php elseif($product['product_sub_type'] =='Photo'): ?>
    <img src="<?php echo e(URL::asset('uploads/editorial/photo/'.$product['image_name'])); ?>" alt="User Image" width="100">
    <?php elseif($product['product_sub_type'] =='Illustrator'): ?>
    <?php endif; ?>
  <?php endif; ?>

			</td>
  <td><?php echo e(date('Y-m-d',strtotime($product['product_added_on']))); ?> </td>
  <td>  <?php if($product['product_status'] =='Active'): ?>
  			<a href="<?php echo e(url('admin/product/Inactive/'.$product['id'])); ?>" title="Make Inactive"><i class="fa fa-star" aria-hidden="true" style="color:#090;"></i> </a>
         <?php elseif($product['product_status'] =='Inactive'): ?>
         	<a href="<?php echo e(url('admin/product/Active/'.$product['id'])); ?>" title="Make Active"><i class="fa fa-star" aria-hidden="true" style="color:#F00;"></i></a>
        <?php endif; ?>

            <a href="<?php echo e(url('admin/editproduct/'.$product['id'])); ?>" title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            <a href="<?php echo e(url('admin/deleteproduct/'.$product['id'])); ?>" title="Deleate" onclick="return confirm('Are you sure you want to delete this product?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
            <a href="<?php echo e(url('admin/viewproduct/'.$product['id'])); ?>" title="View" ><i class="fa fa-eye" aria-hidden="true"></i></a>
            </td>
 </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <th>Id</th>
                        <th>Product Id</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Owner</th>
                        <th>Vertical</th>
                        <th>Keywords</th>
                        <th>Type</th>
                        <th>Product</th>
                        <th>Added On</th>
                        <th>Actions</th>
                    </tfoot>
                </table>
              </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $__env->stopSection(); ?>
  <?php $__env->startSection('scripts'); ?>
  <script>
  $(function () {

    $('#example2').DataTable(/*{
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    }*/);
  });
</script>
  <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\imagefootage\imagefootagenew\resources\views/admin/product/productlist.blade.php ENDPATH**/ ?>