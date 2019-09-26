<?php if(Session::has('success')): ?>
<div class="summary-errors alert alert-success alert-dismissible">
    <button type="button" class="close" aria-label="Close" data-dismiss="alert">
        <span aria-hidden="true">×</span>
    </button>
    <span class="help-block"><?php echo e(Session::get('success')); ?></span>

</div>
<?php endif; ?>
<?php if(Session::has('error')): ?>
<div class="summary-errors alert alert-danger alert-dismissible">
    <button type="button" class="close" aria-label="Close" data-dismiss="alert">
        <span aria-hidden="true">×</span>
    </button>
    <span class="help-block"><?php echo e(Session::get('error')); ?></span>

</div>
<?php endif; ?>

<?php if(count($errors) > 0): ?>
<div class="summary-errors alert alert-danger alert-dismissible">
<button type="button" class="close" aria-label="Close" data-dismiss="alert">
    <span aria-hidden="true">×</span>
</button>
<ul>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li><?php echo e($error); ?></li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
</div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\imagefootage\imagefootagenew\resources\views/admin/partials/message.blade.php ENDPATH**/ ?>