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
        <li class="active">Admin/Agent List</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Admin List</h3>
                </div>
                <?php echo $__env->make('admin.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
             <!-- /.box-header -->
             <div class="box-body">
            <table id="account" class="table table-bordered table-striped dataTable">
                <thead>
                <tr class="col-sm-12">
                <th>SN</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Global Region</th>
                <th>Domestic Region</th>
                <th>Created Date</th>
                <th>Updated Date</th>
                <th>Status</th>
                <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php if(count($accountlist) > 0): ?>
                    <?php $__currentLoopData = $accountlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr role="row" class="odd col-sm-12">
                  <td><?php echo e($k+1); ?></td>
                  <td><?php echo e($account['account_name']); ?></td>
                  <td><?php echo e($account['email']); ?></td>
                  <td><?php echo e($account['phone']); ?></td>
                  <td><?php echo e($account['global_region']); ?></td>
                  <td><?php echo e($account['domestic_region']); ?></td>
                  <td><?php echo date('D, d M, Y',strtotime($account['created_at'])) ?></td>
                  <td><?php echo date('D, d M, Y',strtotime($account['updated_at'])) ?></td>
                  <td><?php echo ($account['status']=='1'?"Active":"Inactive"); ?></td>
                  <td>
                  <?php if($account['status'] =='1'): ?>
                    <a href="<?php echo e(url('admin/accounts/status/0/'.$account['id'])); ?>" title="Make Inactive"><i class="fa fa-star" aria-hidden="true" style="color:#090;"></i> </a>
                  <?php elseif($account['status'] =='0'): ?>
                    <a href="<?php echo e(url('admin/accounts/status/1/'.$account['id'])); ?>" title="Make Active"><i class="fa fa-star" aria-hidden="true" style="color:#F00;"></i></a>
                  <?php endif; ?>
                  <a href="<?php echo e(URL::to('admin/accounts/'.$account['id'].'/edit')); ?>"><i class="fa fa-edit" aria-hidden="true"></i></a> &nbsp; &nbsp;

                  <form action="<?php echo e(route('accounts.destroy', $account['id'])); ?>" method="POST">
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

<?php echo $__env->make('admin.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\imagefootage\imagefootagenew\resources\views/admin/account/index.blade.php ENDPATH**/ ?>