<?php $__env->startSection('content'); ?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lead/Contact/User List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Lead/Contact/User List</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Lead/Contact/User List</h3>
                </div>
                <?php echo $__env->make('admin.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
             <!-- /.box-header -->
             <div class="box-body">
            <table id="account" class="table table-bordered table-striped dataTable ">
                <thead>
                <tr class="col-sm-12">
                <th>SN</th>
                <th>Name</th>
                <th>Title</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>User Name</th>
                <th>Account Manager</th>
                <th>Type</th>
                <th>Created Date</th>
                <th>Updated Date</th>
                <th>Status</th>
                <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php if(count($userlist) > 0): ?>
                    <?php $__currentLoopData = $userlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr role="row" class="odd col-sm-12">
                  <td><?php echo e($k+1); ?></td>
                  <td><?php echo e($user['first_name']); ?> <?php echo e($user['last_name']); ?></td>
                  <td><?php echo e($user['title']); ?></td>
                  <td><?php echo e($user['email']); ?></td>
                  <td><?php echo e($user['mobile']); ?></td>
                  <td><?php echo e($user['user_name']); ?></td>
                  <td><?php echo e($user['account']['account_name']); ?></td>
                  <td><?php echo e($user['type']); ?></td>
                  <td><?php echo date('D, d M, Y',strtotime($user['created_at'])) ?></td>
                  <td><?php echo date('D, d M, Y',strtotime($user['updated_at'])) ?></td>
                  <td><?php echo ($user['status']=='1'?"Active":"Inactive"); ?></td>
                  <td>
                  <?php if($user['status'] =='1'): ?>
                    <a href="<?php echo e(url('admin/users/status/0/'.$user['id'])); ?>" title="Make Inactive"><i class="fa fa-star" aria-hidden="true" style="color:#090;"></i> </a>
                  <?php elseif($user['status'] =='0'): ?>
                    <a href="<?php echo e(url('admin/users/status/1/'.$user['id'])); ?>" title="Make Active"><i class="fa fa-star" aria-hidden="true" style="color:#F00;"></i></a>
                  <?php endif; ?>
                  <a href="<?php echo e(URL::to('admin/users/'.$user['id'].'/edit')); ?>"><i class="fa fa-edit" aria-hidden="true"></i></a> &nbsp; &nbsp;

                  <form action="<?php echo e(route('users.destroy', $user['id'])); ?>" method="POST">
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
    $('#account').DataTable();
 })
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\imagefootage\imagefootagenew\resources\views/admin/user/index.blade.php ENDPATH**/ ?>