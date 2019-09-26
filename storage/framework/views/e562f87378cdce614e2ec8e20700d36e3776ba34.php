
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo e(URL::asset('dist/img/user2-160x160.jpg')); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo e(Auth::guard('admins')->user()->name); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <?php if(count($modules)>0): ?>
        <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eachmodule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span><?php echo e($eachmodule['module_name']); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <?php if(count($eachmodule['submodules']) > 0): ?>

          <ul class="treeview-menu">
          <?php $__currentLoopData = $eachmodule['submodules']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submodule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><a href="<?php echo e(url('admin/'.$submodule['url'])); ?>"><i class="fa fa-circle-o"></i><?php echo e($submodule['module_name']); ?></a></li>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
         <?php endif; ?>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Products</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo e(url('admin/all_products')); ?>"><i class="fa fa-circle-o"></i> List Product</a></li>
            <li><a href="<?php echo e(url('admin/add_product')); ?>"><i class="fa fa-circle-o"></i> Add Product</a></li>
          </ul>
        </li> -->
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Product Category</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo e(url('admin/all_product_category')); ?>"><i class="fa fa-circle-o"></i>Product Category List</a></li>
            <li><a href="<?php echo e(url('admin/add_product_category')); ?>"><i class="fa fa-circle-o"></i> Add Product Category</a></li>
          </ul>
        </li> -->
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Product Sub Category</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo e(url('admin/all_product_sudcategory')); ?>"><i class="fa fa-circle-o"></i>Product Sub Category List</a></li>
            <li><a href="<?php echo e(url('admin/add_product_subcategory')); ?>"><i class="fa fa-circle-o"></i> Add Product Sub Category</a></li>
          </ul>
        </li> -->

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
<?php /**PATH C:\xampp\htdocs\imagefootage\imagefootagenew\resources\views/admin/partials/left.blade.php ENDPATH**/ ?>