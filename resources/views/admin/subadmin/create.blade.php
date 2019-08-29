@extends('admin.layouts.default')

@section('content')
<div class="content-wrapper">
<section class="content">

<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add Admin/Agent</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Department</label>

                  <div class="col-sm-4">
                <div class="form-group">
                 <select class="form-control">
                    <option  value="">Select</option>
                    @if(count($deparments) > 0)
                    @foreach($deparments as $depatment)
                    <option value={{$depatment->id}}>{{$depatment->department}}</option>
                    @endforeach
                    @endif
                  </select>
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Role</label>

                  <div class="col-sm-4">
                  <div class="form-group">

                  <select class="form-control">
                    <option value="">Select</option>
                    @if(count($roles) > 0)
                    @foreach($roles as $role)
                    <option value={{$role->id}}>{{$role->role}}</option>
                    @endforeach
                    @endif
                  </select>
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" id="inputEmail3" placeholder="Name">
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" id="inputEmail3" placeholder="Email">
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="password" class="form-control" id="inputEmail3" placeholder="Password">
                </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Mobile</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" id="inputEmail3" placeholder="Mobile">
                </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Address</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <textarea name="address" style="width:422px;height:74px;"></textarea>
                </div>
                  </div>
                </div>

</div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info">Create</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>

    </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    @endsection
