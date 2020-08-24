@extends('admin.layouts.default')
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper" ng-controller="invoiceController">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Quotation/Invoices List
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Quotation/Invoices List</li>
      </ol>
    </section>
    <section class="content" ng-co>
      <?php //echo "<pre>"; print_r($account_invoices); die; ?>
        <div class="row">
        	<div class="col-md-12">
         		<div class="box">
                <div class="box-header">
                 <!--  @if (\Session::has('success'))
                      <div class="alert alert-success">
                          <ul>
                              <li>{!! \Session::get('success') !!}</li>
                          </ul>
                      </div>
                  @endif -->
                  <a href="{{ url('admin/quotation/'.$user_id) }}" style="float:right;"><strong>Create Quotation/Proforma Invoice</strong></a>
                </div>
                 
                @include('admin.partials.message')
             <!-- /.box-header -->
             <div class="tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#users" role="tab" data-toggle="tab">
                        <icon class="fa fa-home"></icon>User Info
                    </a>
                </li>
                <li>
                    <a href="#posts" role="tab" data-toggle="tab" onclick="postsDataTables()">
                        <i class="fa fa-user"></i>Sale
                    </a>
                </li>
            </ul>
            <div class="tab-content">
            <div class="tab-pane fade active in" id="users">
              <div class="box-body">
          <table id="info" class="account table table-bordered table-striped dataTable" class="col-sm-12">
                <thead>
                  <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!}Account Info</h4>
                  <div class="form-group col-sm-12">
                  <h5>User Id : {{$user->id}}</h5>
                  <h5>Deactivated ? : {{$user->status=1?"No":"Yes"}}</h5>
                  <h5>Password : 
                    <input type="password" class="" name="" id="" value="{{$user->password}}"><button id="resetButton" onclick="resetPassword({{$user->id}})">reset</button>
                  </h5>
                  <h5>First Name : {{$user->first_name}}</h5>
                  <h5>Last Name : {{$user->last_name}}</h5>
                  <h5>Email : <input  type="text" class="" name="" id="" value="{{$user->email}}"></h5>
                  <!-- <h5>Email Verified : {{$user->last_name}}</h5> -->
                  <h5>Date Registered : {{date('d-m-Y', strtotime($user->created_at))}}</h5>
                  <h5>Dedicated Account Manager : {{$account_manager_name}}</h5>
                  </div>




                  <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!}Personal Info</h4>
                  <div class="form-group col-sm-12">
                    <h5>Company : {{$user->company}}</h5>
                    <h5>Occupation : {{$user->occupation}}</h5>
                    <h5>Address : {{$user->address}}</h5>
                    <h5>City : {{$city_name}}</h5>
                    <h5>State : {{$state_name}}</h5>
                    <h5>Country : {{$country_name}}</h5>
                    <h5>Postal Code : {{$user->postal_code}}</h5>
                    <h5>Phone : {{$user->phone}}</h5>
                  </div>


                  <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!}Other Info</h4>
                  <div class="form-group col-sm-12">
                    <h5>Partner ? : </h5>
                    <h5>White List User ? : </h5>
                    <h5>Black List User ? : </h5>
                    <h5>Checkout Frozen : </h5>
                    <h5>Allow Download Certificate : </h5>
                    <h5>Enable Subs Multi-logins ? : </h5>
                    <h5>Preferred Contact Methid : </h5>
                    <h5 >Client Description : <textarea rows="3" class="form-control" style="width: 30%;">{{$user->description}}</textarea></h5>
                    
                  </div>


                
                </thead>
                <tbody>
                  
                </tbody>
            </table>

            <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!}Add New Comment</h4>
                  <div class="form-group col-sm-12">
                    {!! Form::open(array('url' => URL::to('admin/users/comments'),  'method' => 'POST', 'class'=>"form-horizontal")) !!}
                    <!-- @include('admin.partials.message') -->
                    <table>
                      <tbody>
                        <input type="hidden" name="user_id" value="{{$user_id}}">
                        <input type="hidden" name="created_by" value="{{Auth::guard('admins')->user()->id}}">
                    <tr><td><h5>Subject : </h5></td><td><input required="true" type="text" class="form-control" name="subject" id="subject" placeholder="Subject" value=""></td></tr>
                    <tr><td><h5 >Description : </h5></td><td><textarea required="true" name="comment" rows="3" class="form-control"></textarea></td></tr>
                     <tr><td><h5>Status : </h5></td><td><select name="status" required="true">
                      <option value="">-Select-</option>
                      <option value="Open">Open</option>
                      <option value="In Progress">In Progress</option>
                      <option value="Closed">Closed</option>
                    </select></td></tr>
                     <tr><td><h5>To Agent ? : </h5></td><td><select name="agent_id" required="true">
                      <option value="">-Select-</option>
                      @foreach($agentlist as $agent)
                      <option value="{{$agent['id']}}">{{$agent['account_name']}}</option>
                      @endforeach
                    </select></td></tr>

                     <tr><td><h5>Expiry : </h5></td><td><input required="true" type="number" name="expiry" id="expiry"/></td></tr>
                    </tbody>
                    </table>
                    <div class="box-footer">
                {!! Form::submit('Submit', array('class' => 'btn btn-info', 'id' => 'submit')) !!}
              </div>
                  </div>

                   @if(count($comments) > 0 )
                  <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!}Existing Comments</h4>
                  <div class="form-group col-sm-12">
                    <table id="account" class="account table table-bordered table-striped dataTable" class="col-sm-12">
                <div class="form-group">
                </div>
                <thead>
                <tr>
                    <th>Sl No</th>
                    <th>Subject</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Assigned To</th>
                    <th>Created By</th>
                    <th>Created Date</th>
                    <th>Expiry Date</th>
                    <!-- <th>Show Downloads</th> -->
                </tr>
                </thead>
                <tbody>
                        @foreach($comments as $key=>$comment)
                            <tr role="row" class="odd">
                                <td>{{$key+1}}</td>
                                
                                <td>{{$comment['subject']}}</td>
                                <td>{{$comment['comment']}}</td>
                                <td>{{$comment['status']}}</td>
                                <td>{{(!empty($comment['agent']['account_name']))?$comment['agent']['account_name']:""}}</td>
                                <td>{{(!empty($comment['admin']['name']))?$comment['admin']['name']:""}}</td>
                                <!-- <?php 
                                $created_at = date('d-m-Y', strtotime($comment['created_at']));
                                ?> -->
                                <td>{{$comment['created_at']}}</td>
                                <td>{{$comment['expiry']}}</td>




                            </tr>
                        @endforeach
                    @else
                    <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!}No Existing Comments</h4>
                    @endif

              </table>
                    
                  </div>
          </div>
            </div>
        <div class="tab-pane fade" id="posts">
             <div class="box-body">

              <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!}Quotation/Invoices List</h4>

              <table id="account" class="account table table-bordered table-striped dataTable" class="col-sm-12">
                <thead>
                              <div class="form-group">
                  <h5 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!}{!! "&nbsp;" !!}{!! "&nbsp;" !!}Transaction Type Custom</h5>
                </div>
                <tr>
                <th>Sl No</th>
                <th>Trans Id</th>
                
                <th>Inv Date</th>
                <th>Amount</th>
                <th>Payment</th>
                <th>Payment Mode</th>
                <th>Transaction Type Custom</th>
                <!-- <th>Activation Date</th>
                <th>Expiry Date</th>
                <th>Available Download</th> -->

                
                </tr>
                </thead>
                <tbody>
                    @if(count($account_invoices) > 0)
                    @foreach($account_invoices as $k=>$invioces)
                    @if($invioces['invoice_type']==3)
                <tr role="row" class="odd">
                  <td>{{$k+1}}</td>
                  <td>
                      @if($invioces['proforma_type']==2)
                        @if($invioces['invoice_url'])
                          <a href="{{$invioces['quotation_url']}}" target="_blank">Q{{$invioces['invoice_name']}}</a><br>
                          <a href="{{$invioces['invoice_url']}}" target="_blank">IN{{$invioces['invoice_name']}}</a>
                        @else
                          IN{{$invioces['invoice_name']}}
                        @endif
                      @else
                       @if($invioces['quotation_url'])
                        <a href="{{$invioces['quotation_url']}}" target="_blank">Q{{$invioces['invoice_name']}}</a>
                        @else
                          Q{{$invioces['invoice_name']}}
                        @endif
                      @endif

                  </td>
                  
                    <td>{{$invioces['created']}}</td>
                    <td>{{$invioces['total']}}</td>
                  <td>
                  <select <?php if($invioces['status']==3){ echo "disabled" ; } ?> onchange="changestatus(this,{{$invioces['id']}},{{$invioces['status']}})">
                      <option value="0"  <?php if($invioces['status'] =='0'){ echo "Selected";} ?>>Pending</option>
                      <option value="1" <?php if($invioces['status'] =='1'){ echo "Selected";} ?>>Paid</option>
                      <option value="2" <?php if($invioces['status'] =='2'){ echo "Selected";} ?>>Purched</option>
                      <option value="3"  <?php if($invioces['status'] =='3'){ echo "Selected";} ?>>Cancel</option>
                    </select>
               </td>
               <td>{{$invioces['payment_mode']}}</td>
               <td>
                @if($invioces['invoice_type']==3)
                  Custom
                @endif
               </td>
                 
                </tr>
                @endif
                @endforeach
                @endif

              </table>



            <table id="account" class="account table table-bordered table-striped dataTable" class="col-sm-12">
                <div class="form-group">
                  <h5 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!}{!! "&nbsp;" !!}{!! "&nbsp;" !!}Transaction Type Subscription And Download</h5>
                </div>
                <thead>
                <tr>
                    <th>SN</th>
                    <th>Plan Name</th>
                    <th>Plan Price</th>
                    <th>Plan Type</th>
                    <th>Plan Download Count</th>
                    <th>No of Download</th>
                    <th>Transaction ID</th>
                    <th>Start Date</th>
                    <th>Expire Date</th>
                    <th>Invoice</th>
                    <!-- <th>Show Downloads</th> -->
                </tr>
                </thead>
                <tbody>
                   @if(count($userPlanslist) > 0 )
                        @foreach($userPlanslist[0]['plans'] as $key=>$eachPlan)
                            <tr role="row" class="odd">
                                <td>{{$key+1}}</td>
                                <td>
                                    {{$eachPlan['package_name']}}
                                </td>
                                <td>{{$eachPlan['package_price']}}</td>
                                <td>{{$eachPlan['package_type']}}</td>
                                <td>{{$eachPlan['package_products_count']}}</td>
                                <td>{{$eachPlan['downloaded_product']}}</td>
                                <td>{{$eachPlan['transaction_id']}}</td>
                                <td>{{$eachPlan['created_at']}}</td>
                                <td>{{$eachPlan['package_expiry_date_from_purchage']}}</td>
                                <td><a href="{{$eachPlan['invoice']}}"
                                       target="_blank">Download</a></td>
                                <!-- <td>
                                    <a aria-expanded="true" class="" onclick="downloads(<?php echo json_encode($eachPlan['downloads']) ?>)"><i
                                                class="fa fa-cloud-download"
                                                aria-hidden="true"></i></a>
                                    &nbsp; &nbsp;
                                </td> -->
                            </tr>
                        @endforeach
                    @endif

              </table>

              <?php //echo "<pre>"; print_r($account_invoices); die;?>
              <!-- <table id="account" class="account table table-bordered table-striped dataTable" class="col-sm-12">
                <table id="account" class="account table table-bordered table-striped dataTable" class="col-sm-12">
                <div class="form-group">
                  <h5 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!}{!! "&nbsp;" !!}{!! "&nbsp;" !!}Transaction Type Download</h5>
                </div>
                <thead>
                <tr>
                <th>Sl No</th>
                <th>Trans Id</th>
               
                <th>Inv Date</th>
                <th>Amount</th>
                <th>Payment</th>
                <th>Payment Mode</th>
                <th>Transaction Type Download</th>
                <th>Activation Date</th>
                <th>Expiry Date</th>
                <th>Available Download</th>
                
                </tr>
                </thead>
                <tbody>
                    @if(count($account_invoices) > 0)
                    @foreach($account_invoices as $k=>$invioces)
                    @if($invioces['invoice_type']==2)
                <tr role="row" class="odd">
                  <td>{{$k+1}}</td>
                  <td>
                      @if($invioces['proforma_type']==2)
                        @if($invioces['invoice_url'])
                          <a href="{{$invioces['quotation_url']}}" target="_blank">Q{{$invioces['invoice_name']}}</a><br>
                          <a href="{{$invioces['invoice_url']}}" target="_blank">IN{{$invioces['invoice_name']}}</a>
                        @else
                          IN{{$invioces['invoice_name']}}
                        @endif
                      @else
                       @if($invioces['quotation_url'])
                        <a href="{{$invioces['quotation_url']}}" target="_blank">Q{{$invioces['invoice_name']}}</a>
                        @else
                          Q{{$invioces['invoice_name']}}
                        @endif
                      @endif

                  </td>
                  
                    <td>{{$invioces['created']}}</td>
                    <td>{{$invioces['total']}}</td>
                  <td>
                  <select <?php if($invioces['status']==3){ echo "disabled" ; } ?> onchange="changestatus(this,{{$invioces['id']}},{{$invioces['status']}})">
                      <option value="0"  <?php if($invioces['status'] =='0'){ echo "Selected";} ?>>Pending</option>
                      <option value="1" <?php if($invioces['status'] =='1'){ echo "Selected";} ?>>Paid</option>
                      <option value="2" <?php if($invioces['status'] =='2'){ echo "Selected";} ?>>Purched</option>
                      <option value="3"  <?php if($invioces['status'] =='3'){ echo "Selected";} ?>>Cancel</option>
                    </select>
               </td>
               <td>{{$invioces['payment_mode']}}</td>
               <td>
                @if($invioces['invoice_type']==2)
                  Download
                @endif
               </td>
                 
                </tr>
                @endif
                @endforeach
                @endif

              </table>
 -->
              


              </div>
              </div>
    </div>
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
    $('.account').DataTable({
        paging: false
    });
 })

     function changestatus(statust,quotation_id,oldstatus){
         event.preventDefault();
         if(confirm('Do you want to change the status of invoice/quotation')===true) {
             $('#loading').show();
             $.ajax({
                 type: "POST",
                 data: {quotation_id: quotation_id, status: statust.value},
                 url: "{{ url('admin/change_invoice_status')}}",
                 success: function (result) {
                     $('#loading').hide();
                     console.log(result);
                     if (result.resp.statuscode == '1') {
                         alert(result.resp.statusdesc);
                     } else {
                         alert(result.resp.statusdesc);
                     }
                     window.location.reload();
                 }
             });
         }else{
             statust.value = oldstatus;
            return false;
         }
     }

     function resetPassword(id){
         event.preventDefault();
         if(confirm('Do you want to reset the password')===true) {
             $('#loading').show();
             $.ajax({
                 type: "POST",
                 url: "{{ url('admin/ajaxRequestForUserPass')}}/"+id,
                 success: function (result) {
                     $('#loading').hide();
                     console.log(result);
                     if (result.resp.statuscode == '1') {
                         alert(result.resp.statusdesc);
                     } else {
                         alert(result.resp.statusdesc);
                     }
                     window.location.reload();
                 }
             });
         }
     }

    //  $("#resetButton").click(function(e) {
    //     e.preventDefault();
    //     $.ajax({
    //         type: "POST",
    //         url: "{{ url('admin/request_for_contributorpass')}}",
    //         data: { 
    //             id: $(this).val(), // < note use of 'this' here
    //             access_token: $("#access_token").val() 
    //         },
    //         success: function(result) {
    //             alert('ok');
    //         },
    //         error: function(result) {
    //             alert('error');
    //         }
    //     });
    // });
    </script>

@stop
