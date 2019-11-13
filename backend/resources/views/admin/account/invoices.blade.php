@extends('admin.layouts.default')
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Quotation/Invoices List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Quotation/Invoices List</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
         		<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Quotation/Invoices List</h3>
                  <a href="{{ url('admin/quotation/'.$user_id) }}">Create Quotation/Proforma Invoice</a>
                </div>
                @include('admin.partials.message')
             <!-- /.box-header -->
             <div class="box-body">
            <table id="account" class="table table-bordered table-striped dataTable" class="col-sm-12">
                <thead>
                <tr>
                <th>SN</th>
                <th>Created</th>
                <th>Invoice ID</th>
                <th>Email ID</th>
                <th>Job Ref</th>
                <th>Expiry Invoices</th>
                <th>Status</th>
                <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @if(count($account_invoices) > 0)
                    @foreach($account_invoices as $k=>$invioces)
                <tr role="row" class="odd">
                  <td>{{$k+1}}</td>
                  <td>{{$invioces['created']}}</td>
                  <td>{{$invioces['id']}}</td>
                  <td>{{$invioces['email_id']}}</td>
                  <td>{{$invioces['job_number']}}</td>
                  <td>{{$invioces['expiry_invoices']}}</td>
                  
                  <td>
                  <select>
                      <option value="1" <?php if($invioces['status'] =='1'){ echo "Selected";} ?>>Pending</option>
                      <option value="2" <?php if($invioces['status'] =='2'){ echo "Selected";} ?>>Purched</option>
                      <option value="3" <?php if($invioces['status'] =='3'){ echo "Selected";} ?>>Cancel</option>
                    </select>
               </td>
               <td>
                  <a href="{{ url('admin/accounts/status/1/'.$invioces['id']) }}" title="Cancel">Invoices</a>
                  <form action="{{ route('accounts.destroy', $invioces['id']) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button  onclick="return confirm('Do You want to remove ?')"><i class="fa fa-remove" aria-hidden="true"></i></button>
                        </form>
                  </td>
                </tr>
                @endforeach
                @endif

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
    @endsection
    @section('scripts')
    <script>
    $(function () {
    $('#account').DataTable();
 })
    </script>

@stop
