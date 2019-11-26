
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{URL::asset('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::guard('admins')->user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <?php /*?><form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form><?php */?>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        @if(count($modules)>0)
        @foreach($modules as $eachmodule)

        <li class="treeview @if($eachmodule['id']== $parent_id) active @endif">
          <a href="#">
          <i class="{{$eachmodule['module_icon']}}" aria-hidden="true"></i>
            
            <span>{{$eachmodule['module_name']}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          @if(count($eachmodule['submodules']) > 0)

          <ul class="treeview-menu">
          @foreach($eachmodule['submodules'] as $submodule)
            <li><a href="{{ url('admin/'.$submodule['url']) }}"><i class="fa fa-arrow-right"></i>{{$submodule['module_name']}}</a></li>
         @endforeach
          </ul>
         @endif
        </li>
        @endforeach
        @endif
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Products</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('admin/all_products') }}"><i class="fa fa-circle-o"></i> List Product</a></li>
            <li><a href="{{ url('admin/add_product') }}"><i class="fa fa-circle-o"></i> Add Product</a></li>
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
            <li><a href="{{ url('admin/all_product_category') }}"><i class="fa fa-circle-o"></i>Product Category List</a></li>
            <li><a href="{{ url('admin/add_product_category') }}"><i class="fa fa-circle-o"></i> Add Product Category</a></li>
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
            <li><a href="{{ url('admin/all_product_sudcategory') }}"><i class="fa fa-circle-o"></i>Product Sub Category List</a></li>
            <li><a href="{{ url('admin/add_product_subcategory') }}"><i class="fa fa-circle-o"></i> Add Product Sub Category</a></li>
          </ul>
        </li> -->

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
