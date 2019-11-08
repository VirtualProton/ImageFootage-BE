@extends('admin.layouts.default')

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Contributor
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Contributor</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Add Contributor</h3>
                </div>
               @if( Session::has( 'success' ))
     			{{ Session::get( 'success' ) }}
			   @elseif( Session::has( 'warning' ))
                {{ Session::get( 'warning' ) }} <!-- here to 'withWarning()' -->
			   @endif
                <form action="{{ url('admin/addcontributor') }}" role="form" method="post" enctype="multipart/form-data">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="box-body">
                   <div class="form-group">
                      <label for="exampleInputEmail1">Contributor Name</label>
                      <input type="text" class="form-control" name="contributor_name" id="contributor_name" placeholder="Contributor Name">
                       @if ($errors->has('contributor_name'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('contributor_name') }}</div>
                       @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Contributor Email</label>
                      <input type="email" class="form-control" name="contributor_email" id="contributor_email" placeholder="Contributor Email">
                       @if ($errors->has('contributor_email'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('contributor_email') }}</div>
                       @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Contributor Password</label>
                      <input type="password" class="form-control" name="contributor_password" id="contributor_password">
                    </div>
                    @if ($errors->has('contributor_password'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('contributor_password') }}</div>
                    @endif
                    
                     <div class="form-group">
                      <label for="exampleInputEmail1">Contributor Confirm Password</label>
                      <input type="password" class="form-control" name="contributor_confirm_password" id="contributor_confirm_password" placeholder="Contributor Confirm Password">
                    </div>
                    @if ($errors->has('contributor_confirm_password'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('contributor_confirm_password') }}</div>
                    @endif
                    
                    <div class="form-group">
                      <label for="exampleInputFile">ID Proof</label>
                      <input type="file" id="contributor_idproof" name="contributor_idproof">
    
                      <p class="help-block">Example :– Aadhar/Voter ID/Pan Card/Passport.</p>
                      @if ($errors->has('contributor_idproof'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('contributor_idproof') }}</div>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Product Type</label>
                      <div class="checkbox">
                          <label>
                            <input type="radio" name="contributor_type" value="For Sale" class="product_type"> For Sale
                          </label>
                          <label>
                            <input type="radio" name="contributor_type" value="Donor" class="product_type"> Donor
                          </label>
                    	</div>
                    </div>
                    @if ($errors->has('contributor_type'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('contributor_type') }}</div>
                    @endif
                    <div class="form-group">
                      <label for="exampleInputEmail1">Bank Holder Name</label>
                      <input type="text" class="form-control" name="bank_holder_name" id="bank_holder_name" placeholder="Bank Holder Name">
                    </div>
                    @if ($errors->has('bank_holder_name'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('bank_holder_name') }}</div>
                    @endif
                    <div class="form-group">
                      <label for="exampleInputEmail1">Bank Name</label>
                      <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Bank Name">
                    </div>
                    @if ($errors->has('bank_name'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('bank_name') }}</div>
                    @endif
                    <div class="form-group">
                      <label for="exampleInputEmail1">Bank Account Number</label>
                      <input type="text" class="form-control" name="bank_account_number" id="bank_account_number" placeholder="Bank Account Number">
                    </div>
                    @if ($errors->has('bank_account_number'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('bank_account_number') }}</div>
                    @endif
                    <div class="form-group">
                      <label for="exampleInputEmail1">IFSC number</label>
                      <input type="text" class="form-control" name="ifsc_number" id="ifsc_number" placeholder="IFSC number">
                    </div>
                    @if ($errors->has('ifsc_number'))
                      		<div class="has_error" style="color:red;">{{ $errors->first('ifsc_number') }}</div>
                    @endif

                  </div>
                                    <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection