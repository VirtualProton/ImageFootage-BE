<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product Category List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Product Category List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary" style="overflow-x:auto;">
                <div class="box-header with-border" style="overflow-x:auto;">
                  <h3 class="box-title">Product Category List</h3>
                </div>

                <?php echo $__env->make('admin.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                <table id="example2" class="table table-bordered table-hover">
                	<thead>
                        <th>Id</th>
                        <th>Product Category</th>
                        <th>Product Category Alignment</th>
                        <th>Added On</th>
                        <th>Actions</th>
                    </thead>

                    <tbody>
                     <?php $__currentLoopData = $productcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
  <td><?php echo e($category['category_id']); ?> </td>
  <td><?php echo e($category['category_name']); ?> </td>
  <td><?php echo e($category['category_order']); ?> </td>
  <td><?php echo e(date('Y-m-d',strtotime($category['category_added_on']))); ?> </td>
  <td>  <?php if($category['category_status'] =='Active'): ?>
  			<a href="<?php echo e(url('admin/productcategory/Inactive/'.$category['category_id'])); ?>" title="Make Inactive"><i class="fa fa-star" aria-hidden="true" style="color:#090;"></i> </a>
         <?php elseif($category['category_status'] =='Inactive'): ?>
         	<a href="<?php echo e(url('admin/productcategory/Active/'.$category['category_id'])); ?>" title="Make Active"><i class="fa fa-star" aria-hidden="true" style="color:#F00;"></i></a>
        <?php endif; ?>

            <a href="<?php echo e(url('admin/updateproductcategory/'.$category['category_id'])); ?>" title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            <a href="<?php echo e(url('admin/deleteproductcategory/'.$category['category_id'])); ?>" title="Deleate" onclick="return confirm('Are you sure you want to delete this product category?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </td>
 </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                       <th>Id</th>
                        <th>Product Category</th>
                        <th>Product Category Order</th>
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

<?php echo $__env->make('admin.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\imagefootage\imagefootagenew\resources\views/admin/product/productcategorylist.blade.php ENDPATH**/ ?>