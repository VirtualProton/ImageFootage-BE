<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Package List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Package List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary" style="overflow-x:auto;">
                <div class="box-header with-border" style="overflow-x:auto;">
                  <h3 class="box-title">Package List</h3>
                </div>

                <?php echo $__env->make('admin.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                <table id="example2" class="table table-bordered table-hover">
                	<thead>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Price </th>
                        <th>Description</th>
                        <th>Products Count</th>
                        <th>Type</th>
                        <th>Added On</th>
                        <th>Expiry</th>
                        <th>Actions</th>
                    </thead>

                    <tbody>
                     <?php $__currentLoopData = $package; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $packages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
  <td><?php echo e($packages['package_id']); ?> </td>
  <td><?php echo e($packages['package_name']); ?> </td>
  <td><?php echo e($packages['package_price']); ?> </td>
  <td><?php echo e($packages['package_description']); ?> </td>
  <td><?php echo e($packages['package_products_count']); ?> </td>
  <td><?php echo e($packages['package_type']); ?> </td>
  <td><?php echo e(date('Y-m-d',strtotime($packages['package_added_on']))); ?> </td>
  <td><?php echo e($packages['package_expiry']); ?> </td>
  <td>  <?php if($packages['package_status'] =='Active'): ?>
  			<a href="<?php echo e(url('admin/package/Inactive/'.$packages['package_id'])); ?>" title="Make Inactive"><i class="fa fa-star" aria-hidden="true" style="color:#090;"></i> </a>
         <?php elseif($packages['package_status'] =='Inactive'): ?>
         	<a href="<?php echo e(url('admin/package/Active/'.$packages['package_id'])); ?>" title="Make Active"><i class="fa fa-star" aria-hidden="true" style="color:#F00;"></i></a>
        <?php endif; ?>
            <a href="<?php echo e(url('admin/updatepackage/'.$packages['package_id'])); ?>" title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            <a href="<?php echo e(url('admin/deletepackage/'.$packages['package_id'])); ?>" title="Deleate" onclick="return confirm('Are you sure you want to delete this package?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </td>
 </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Price </th>
                        <th>Description</th>
                        <th>Products Count</th>
                        <th>Type</th>
                        <th>Added On</th>
                        <th>Expiry</th>
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

<?php echo $__env->make('admin.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\imagefootage\imagefootagenew\resources\views/admin/package/packagelist.blade.php ENDPATH**/ ?>