
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
      <?php
        $user = Auth::guard('admins')->user();
        $permissions = \App\Helpers\PermissionHelper::getAllPermissions();
        $isSuperAdmin = \App\Helpers\PermissionHelper::isSuperAdmin();
      ?>

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        @if(count($modules) > 0)
          @foreach($modules as $eachmodule)
            <?php
              $moduleId = $eachmodule['id'];
              // Check if user has view permission for this module
              $canViewModule = $isSuperAdmin || (isset($permissions[$moduleId]) && $permissions[$moduleId]['can_view'] == 1);
            ?>
            @if($canViewModule)
              <li class="treeview @if($eachmodule['id'] == $parent_id) active @endif">
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
                      @if($submodule['module_name'] != 'Access Managment' || $isSuperAdmin)
                        <li><a href="{{ url('admin/'.$submodule['url']) }}"><i class="fa fa-arrow-right"></i>{{$submodule['module_name']}}</a></li>
                      @endif
                    @endforeach
                  </ul>
                @endif
              </li>
            @endif
          @endforeach
        @endif
      </ul>

    </section>
    <!-- /.sidebar -->
  </aside>


<!-- {{ $modules2 = \App\Models\RolesModulesMapping::where('department_id',$user->department['id'])->where('role_id',$user->role['id'])->get() }} -->