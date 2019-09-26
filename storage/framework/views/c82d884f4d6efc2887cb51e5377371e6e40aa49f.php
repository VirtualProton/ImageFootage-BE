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
                        <th>Title</th>
                        <th>URL </th>
                        <th>Description</th>
                        <th>Keywords</th>
                        <th>Content</th>
                        <th>Added On</th>
                        <th>Actions</th>
                    </thead>

                    <tbody>
                     <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
  <td><?php echo e($page['page_id']); ?> </td>
  <td><?php echo e($page['page_title']); ?> </td>
  <td><?php echo e($page['page_url']); ?> </td>
  <td><?php echo e($page['page_meta_desc']); ?> </td>
  <td><?php echo e($page['page_meta_keywords']); ?> </td>
  <td><?php echo e($page['page_content']); ?> </td>
  <td><?php echo e(date('Y-m-d',strtotime($page['page_added_on']))); ?> </td>
  <td>  <?php if($page['image_status'] =='Active'): ?>
  			<a href="<?php echo e(url('admin/staticpages/Inactive/'.$page['page_id'])); ?>" title="Make Inactive"><i class="fa fa-star" aria-hidden="true" style="color:#090;"></i> </a>
         <?php elseif($page['image_status'] =='Inactive'): ?>
         	<a href="<?php echo e(url('admin/staticpages/Active/'.$page['page_id'])); ?>" title="Make Active"><i class="fa fa-star" aria-hidden="true" style="color:#F00;"></i></a>
        <?php endif; ?>
            <a href="<?php echo e(url('admin/updatestaticpage/'.$page['page_id'])); ?>" title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            <a href="<?php echo e(url('admin/deletestaticpage/'.$page['page_id'])); ?>" title="Deleate" onclick="return confirm('Are you sure you want to delete this static page?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </td>
 </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                       <th>Id</th>
                        <th>Title</th>
                        <th>URL </th>
                        <th>Description</th>
                        <th>Keywords</th>
                        <th>Content</th>
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

<?php echo $__env->make('admin.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\imagefootage\imagefootagenew\resources\views/admin/staticpages/staticpageslist.blade.php ENDPATH**/ ?>