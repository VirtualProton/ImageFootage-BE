<?php $__env->startSection('content'); ?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Admin/Agent List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Accounts</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Products List</h3>
                </div>
                <?php echo $__env->make('admin.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
             <!-- /.box-header -->
             <div class="box-body">
            <table id="subadmin" class="table table-bordered table-striped dataTable">
                <thead>
                <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Department</th>
                <th>Role</th>
                <th>Created Date</th>
                <th>Status</th>
                <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php if(count($agentlist) > 0): ?>
                    <?php $__currentLoopData = $agentlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$agent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr role="row" class="odd">
                  <td><?php echo e($k+1); ?></td>
                  <td><?php echo e($agent['name']); ?></td>
                  <td><?php echo e($agent['email']); ?></td>
                  <td><?php echo e($agent['mobile']); ?></td>
                  <td><?php echo e($agent['department']['department']); ?></td>
                  <td><?php echo e($agent['role']['role']); ?></td>
                  <td><?php echo date('D, d M, Y',strtotime($agent['created_at'])) ?></td>
                  <td><?php echo ($agent['admin_status']=='A'?"Active":"Inactive"); ?></td>
                  <td>
                  <?php if($agent['admin_status'] =='A'): ?>
                    <a href="<?php echo e(url('admin/subadmin/status/I/'.$agent['id'])); ?>" title="Make Inactive"><i class="fa fa-star" aria-hidden="true" style="color:#090;"></i> </a>
                  <?php elseif($agent['admin_status'] =='I'): ?>
                    <a href="<?php echo e(url('admin/subadmin/status/A/'.$agent['id'])); ?>" title="Make Active"><i class="fa fa-star" aria-hidden="true" style="color:#F00;"></i></a>
                  <?php endif; ?>
                  <a href="<?php echo e(URL::to('admin/subadmin/'.$agent['id'].'/edit')); ?>"><i class="fa fa-edit" aria-hidden="true"></i></a> &nbsp; &nbsp;

                  <form action="<?php echo e(route('subadmin.destroy', $agent['id'])); ?>" method="POST">
                        <?php echo method_field('DELETE'); ?>
                        <?php echo csrf_field(); ?>
                        <button  onclick="return confirm('Do You want to remove ?')"><i class="fa fa-remove" aria-hidden="true"></i></button>
                        </form>
                  </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

              </table>
              </table>
              </div>
            </div>
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
    $('#subadmin').DataTable();
 })
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\imagefootage\imagefootagenew\resources\views/admin/subadmin/index.blade.php ENDPATH**/ ?>