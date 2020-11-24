@extends('admin.layouts.default')
    @section('content')
      <div class="content-wrapper" ng-controller="invoiceController">
        <section class="content-header">
          <h1>
            Quotation/Invoices List
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Quotation/Invoices List</li>
          </ol>
        </section>
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box" style="padding-left: 10px;padding-right: 10px;">
                <div class="box-header">
                  <a href="{{ url('admin/quotation/'.$user_id) }}" style="float:right;"><strong>Create Quotation/Proforma Invoice</strong></a>
                </div>
                @include('admin.partials.message')
                <div class="tabs">
                  <ul class="nav nav-tabs">
                    <li class="active">
                      <a href="#users" role="tab" data-toggle="tab">
                        <icon class="fa fa-home"></icon>User Info
                      </a>
                    </li>
                    <li>
                      <a href="#posts" role="tab" data-toggle="tab">
                        <i class="fa fa-user"></i>Sale
                      </a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane fade active in" id="users">
                      <div class="box-body">
                        <table id="info" class="account table table-bordered table-striped dataTable" class="col-sm-12">
                          <thead>
                            <div class="form-group col-sm-12">
                              <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!}Account Info</h4>
                              <div class="form-group col-sm-6">
                                <h5>User Id : {{$user->id}}</h5>
                                <h5>Deactivated ? : {{$user->status=1?"No":"Yes"}}</h5>
                                <h5>Password :
                                  <input type="password" class="" name="" id="" value="{{$user->password}}"><button id="resetButton" onclick="resetPassword({{$user->id}})">reset</button>
                                </h5>
                                <h5>First Name : {{$user->first_name}}</h5>
                                <h5>Last Name : {{$user->last_name}}</h5>
                                <h5>Email : <input type="text" class="" name="" id="" value="{{$user->email}}"></h5>
                                <!-- <h5>Email Verified : {{$user->last_name}}</h5> -->
                                <h5>Date Registered : {{date('d-m-Y', strtotime($user->created_at))}}</h5>
                                <h5>Dedicated Account Manager : {{$account_manager_name}}</h5>
                              </div>
                              <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!}Personal Info</h4>
                              <div class="form-group col-sm-6">
                                <h5>Company : {{$user->company}}</h5>
                                <h5>Occupation : {{$user->occupation}}</h5>
                                <h5>Address : {{$user->address}}</h5>
                                <h5>City : {{$city_name}}</h5>
                                <h5>State : {{$state_name}}</h5>
                                <h5>Country : {{$country_name}}</h5>
                                <h5>Postal Code : {{$user->postal_code}}</h5>
                                <h5>Phone : {{$user->phone}}</h5>
                              </div>
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
                              <h5>Client Description : <textarea rows="3" class="form-control" style="width: 30%;">{{$user->description}}</textarea></h5>
                            </div>
                          </thead>
                        </table>
                        <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!}Add New Comment</h4>
                        <div class="form-group col-sm-12">
                          {!! Form::open(array('url' => URL::to('admin/users/comments'), 'method' => 'POST', 'class'=>"form-horizontal")) !!}
                          <!-- @include('admin.partials.message') -->
                          <table>
                            <tbody>
                              <input type="hidden" name="user_id" value="{{$user_id}}">
                              <input type="hidden" name="created_by" value="{{Auth::guard('admins')->user()->id}}">
                              <tr>
                                <td>
                                  <h5>Subject : </h5>
                                </td>
                                <td><input required="true" type="text" class="form-control" name="subject" id="subject" placeholder="Subject" value=""></td>
                              </tr>
                              <tr>
                                <td>
                                  <h5>Description : </h5>
                                </td>
                                <td><textarea required="true" name="comment" rows="3" class="form-control"></textarea></td>
                              </tr>
                              <tr>
                                <td>
                                  <h5>Status : </h5>
                                </td>
                                <td><select name="status" required="true">
                                    <option value="">-Select-</option>
                                    <option value="Open">Open</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Closed">Closed</option>
                                  </select></td>
                              </tr>
                              <tr>
                                <td>
                                  <h5>To Agent ? : </h5>
                                </td>
                                <td><select name="agent_id" required="true">
                                    <option value="">-Select-</option>
                                    @foreach($agentlist as $agent)
                                    <option value="{{$agent['id']}}">{{$agent['account_name']}}</option>
                                    @endforeach
                                  </select></td>
                              </tr>

                              <tr>
                                <td>
                                  <h5>Expiry : </h5>
                                </td>
                                <td><input required="true" type="number" name="expiry" id="expiry" /></td>
                              </tr>
                            </tbody>
                          </table>
                          <div class="box-footer">
                            {!! Form::submit('Submit', array('class' => 'btn btn-info', 'id' => 'submit')) !!}
                          </div>
                        </div>
                        @if(count($comments) > 0 )
                        <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!}Existing Comments</h4>
                        <div class="form-group col-sm-12">
                          <table class="account table table-bordered table-striped dataTable col-sm-12" class="">
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
                            </tbody>
                          </table>
                        </div>
                        @else
                        <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!} No Existing Comments</h4>
                        @endif
                      </div>
                    </div>
                    <div class="tab-pane fade" id="posts">
                      <div class="box-body">
                        <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!}Quotation</h4>
                        <table id="account" class="account table table-bordered table-striped dataTable" class="col-sm-12">
                          <thead>
                            <div class="form-group">
                              <h5 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!}{!! "&nbsp;" !!}{!! "&nbsp;" !!}Transaction Type Custom</h5>
                            </div>
                            <tr>
                              <th>Sl No</th>
                              <th>Trans Id</th>

                              <th>Quotation Date</th>
                              <th>Amount (In INR)</th>
                              <th>Plan</th>
                              <!-- <th>Payment Mode</th>
                                <th>Transaction Type Custom</th> -->
                              <th>Action</th>
                              <!-- <th>Activation Date</th>
                                <th>Expiry Date</th>
                                <th>Available Download</th> -->
                            </tr>
                          </thead>
                          <tbody>
                            @if(count($account_quotations) > 0)
                              @foreach($account_quotations as $k=>$quotations)

                            <tr role="row" class="odd">
                              <td>{{(($account_quotations->currentPage()-1)*10)+$k+1}}</td>
                              <td>
                                @if($quotations->proforma_type == '2')
                                  @if($invioces->invoice_url)
                                    <a href="{{$invioces->quotation_url}}" target="_blank">Q{{$invioces->invoice_name}}</a><br>
                                    <a href="{{$invioces->invoice_url}}" target="_blank">IN{{$invioces->invoice_name}}</a>
                                  @else
                                    IN{{$invioces->invoice_name}}
                                  @endif
                                @else
                                  @if($quotations->quotation_url)
                                    <a href="{{$quotations->quotation_url}}" target="_blank">Q{{$quotations->invoice_name}}</a>
                                  @else
                                    Q{{$quotations->invoice_name}}
                                  @endif
                                @endif
                              </td>
                              <td>{{$quotations->created}}</td>
                              <td>{{$quotations->total}}</td>
                              <td>
                                @if($quotations->invoice_type==3)
                                Custom
                                @elseif($quotations->invoice_type==2)
                                Download
                                @else
                                Subscription
                                @endif
                              </td>
                              <td>
                                @if($quotations->status != 3)
                                <a href="{{ url('admin/edit_quotation/'.$quotations->id) }}" title="Edit Quotation"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> &nbsp;&nbsp;
                                @if($quotations->invoice_type == 3)
                                <a href="javascript:void(0);" ng-click="create_invoice({{json_encode($quotations)}},{{$user_id}})" title="Convert to Invoice" data-target="#modal-default_custom" data-toggle="modal"><i class="fa fa-file-pdf-o " aria-hidden="true" alt="Convert to Invoice"></i></a> &nbsp;&nbsp;&nbsp;
                                @else
                                <a  href="javascript:void(0);" ng-click="create_invoice_subscription({{json_encode($quotations)}},{{$user_id}})" title="Convert to Invoice"  data-target="#modal-default" data-toggle="modal"><i class="fa fa-file-pdf-o " aria-hidden="true" alt="Convert to Invoice"></i></a> &nbsp;&nbsp;&nbsp;
                                @endif
                                <a href="{{ url('admin/invoice/'.$quotations->id) }}" title="Cancel" onclick="return confirm('Do You want to remove ?')"><i class="fa fa-trash-o" aria-hidden="true"></i></a> &nbsp;&nbsp;&nbsp;
                                @endif
                              </td>

                            </tr>
                            @endforeach
                            <tr style="text-align: right;">
                              <td colspan="9">{{$account_quotations->fragment('posts')->render()}}</td>
                            </tr>
                            @else
                            <tr style="text-align: center;">
                              <td colspan="9"><strong> No Quotation Yet ... </strong></td>
                            </tr>
                            @endif

                        </table>
                        <br />
                        <br />
                        <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!}Invoice</h4>
                        <table id="invoice" class="account table table-bordered table-striped dataTable" class="col-sm-12">
                          <thead>
                            <tr>
                              <th>Sl No</th>
                              <th>Invoice No.</th>
                              <th>Invoice Date</th>
                              <th>Amount (In INR)</th>
                              <th>Plan</th>
                              <th>Payment Method</th>
                              <th>Payment Status</th>
                              <th>Due Date</th>
                              <th>Payment Date</th>
                              <th>Action</th>
                              <th>Update PO</th>
                              <!-- <th>Activation Date</th>
                                <th>Expiry Date</th>
                                <th>Available Download</th> -->
                            </tr>
                          </thead>
                          <tbody>
                            @if(count($account_invoices) > 0)
                              @foreach($account_invoices as $k=>$invioces)
                              <tr role="row" class="odd">
                              <td>{{(($account_quotations->currentPage()-1)*10)+$k+1}}</td>
                              <td>
                                  @if($invioces->invoice_url)
                                    <a href="{{$invioces->invoice_url}}" target="_blank">IN{{$invioces->invoice_name}}</a>
                                  @else
                                    IN{{$invioces->invoice_name}}
                                  @endif
                              </td>
                              <td>{{$invioces->invoice_created}}</td>
                              <td>{{$invioces->total}}</td>
                              <td>{{$invioces->package_description}}</td>
                              <td>{{$invioces->payment_method}}</td>
                              <td>
                                <?php if($invioces->status =='0'){
                                      echo "Pending";
                                } else if($invioces->status =='1') {
                                      echo "Paid";
                                }else if($invioces->status =='2') {
                                      echo "Purchased";
                                } else if($invioces->status =='3') {
                                      echo "Cancel";
                                }
                                ?>
                              </td>
                              <td>{{$invioces->po_detail}}</td>
                              <td>{{$invioces->payment_date ?? ''}}</td>
                              <td>
                                <select <?php if($invioces->status==3){ echo "disabled" ; } ?> onchange="changestatus(this,{{$invioces->id}},{{$invioces->status}})">
                                <option value="0"  <?php if($invioces->status =='0'){ echo "Selected";} ?>>Pending</option>
                                <option value="1" <?php if($invioces->status =='1'){ echo "Selected";} ?>>Paid</option>
                                <option value="2" <?php if($invioces->status =='2'){ echo "Selected";} ?>>Purchased</option>
                                <option value="3"  <?php if($invioces->status =='3'){ echo "Selected";} ?>>Cancel</option>
                                </select>
                              </td>
                              <td>&nbsp;</td>
                              @endforeach
                              <tr style="text-align: right;">
                                <td colspan="9">{{$account_invoices->fragment('posts')->render()}}</td>
                              </tr>
                            @else
                            <tr style="text-align: center;">
                              <td colspan="9"><strong> No Invoice Yet ...</strong></td>
                            </tr>
                            @endif
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal" id="modal-default" style="padding-right: 16px;"> 
                  <%quotationObj %>
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                  <h4 class="modal-title">Create Invoice</h4>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <div class="col-sm-6">
                      <p><strong>Trasaction Id :</strong> Q<%quotationObj.invoice_name%></p>
                      <p><strong>User Name :</strong> {{$user->user_name}}</p>
                      <p><strong>Package :</strong> <%quotationObj.package_description%></p>
                      <p><strong>Purchase Date :</strong> {{date('Y-m-d H:i:s')}}</p>
                      <p><strong>Expiry Date :</strong> <input type="text" name="poDate" id="poDate" ng-model="poDate"></p>
                      <p><strong>Subtotal :</strong> <%quotationObj.total - quotationObj.tax%></p>
                      <p><strong>Discount :</strong> </p>
                      <p><strong>Tax :</strong> <%quotationObj.tax%></p>
                      <p><strong>Total :</strong> <%quotationObj.total%></p>
                    </div>
                    <div class="col-sm-6">
                      <p><strong>Method : </strong>
                        <select class="form-group" name="payment_method" ng-model="payment_method">
                          <option value="">Select Method</option>
                          <option value="chq">Cheque</option>
                          <option value="online">Online</option>
                        </select>
                      </p>
                      <p><strong>Job Ref/ PO # :</strong> <input type="text" name="po" id="po" ng-model="po" class="form-group"></p>
                      <p><strong>Street :</strong> {{$user->address}}</p>
                      <p><strong>City :</strong> {{$city_name}}</p>
                      <p><strong>State :</strong> {{$state_name}}</p>
                      <p><strong>Zip Code :</strong> {{$user->postal_code}}</p>
                      <p><strong>Country :</strong> {{$country_name}}</p>
                      <p><strong>Agent :</strong> {{Auth::guard('admins')->user()->name}}</p>
                      <p><strong>Checkout via Online :</strong> <span ng-show="payment_method=='chq'">No</span><span ng-show="payment_method=='online'">Yes</span></p>
                    </div>
                  </div>
                  <p style="text-align: center;color:red;"><strong>Be Patient. Do not click more than once</strong></p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" ng-click="send_invoice(quotationObj.id, quotation_user)">Confirm Submission</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
          </div>
          <div class="modal" id="modal-default_custom" style="padding-right: 16px;">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                  <h4 class="modal-title">Create Invoice</h4>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <div class="col-sm-6">
                      <p><strong>Trasaction Id :</strong> Q<%quotationObj.invoice_name%></p>
                      <p><strong>User Name :</strong> {{$user->user_name}}</p>
                      <p><strong>Package :</strong> <%quotationObj.package_description%></p>
                      <p><strong>Purchase Date :</strong> {{date('Y-m-d H:i:s')}}</p>
                      <p><strong>Expiry Date :</strong> <input type="text" name="poDate" id="poDate" ng-model="poDate"></p>
                      <p><strong>Subtotal :</strong> <%quotationObj.total - quotationObj.tax%></p>
                      <p><strong>Discount :</strong> </p>
                      <p><strong>Tax :</strong> <%quotationObj.tax%></p>
                      <p><strong>Total :</strong> <%quotationObj.total%></p>
                    </div>
                    <div class="col-sm-6">
                      <p><strong>Method : </strong>
                        <select class="form-group" name="payment_method" ng-model="payment_method">
                          <option value="">Select Method</option>
                          <option value="chq">Cheque</option>
                          <option value="online">Online</option>
                        </select>
                      </p>
                      <p><strong>Job Ref/ PO # :</strong> <input type="text" name="po" id="po" ng-model="po" class="form-group"></p>
                      <p><strong>Street :</strong> {{$user->address}}</p>
                      <p><strong>City :</strong> {{$city_name}}</p>
                      <p><strong>State :</strong> {{$state_name}}</p>
                      <p><strong>Zip Code :</strong> {{$user->postal_code}}</p>
                      <p><strong>Country :</strong> {{$country_name}}</p>
                      <p><strong>Agent :</strong> {{Auth::guard('admins')->user()->name}}</p>
                      <p><strong>Checkout via Online :</strong> <span ng-show="payment_method=='chq'">No</span><span ng-show="payment_method=='online'">Yes</span></p>
                    </div>
                  </div>
                  <p style="text-align: center;color:red;"><strong>Be Patient. Do not click more than once</strong></p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" ng-click="send_invoice(quotationObj.id, quotation_user)">Confirm Submission</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
          </div>
        </section>
      </div>
    @endsection
@section('scripts')
<script>
  //     $(function () {
  //     $('.account').DataTable({
  //         paging: false
  //     });
  //  })
  $(function() {
    var url = window.location.href;
    var activeTab = url.substring(url.indexOf("#!#") + 3);

    if ($.trim(activeTab) == 'posts' || $.trim(activeTab) == 'users') // check hash tag name for prevent error
    {
      $(".tab-pane").removeClass("active in");
      $("#" + activeTab).addClass("active in");
      $('a[href="#' + activeTab + '"]').tab('show');
    }
  });

  function changestatus(statust, quotation_id, oldstatus) {
    event.preventDefault();
    if (confirm('Do you want to change the status of invoice/quotation') === true) {
      $('#loading').show();
      $.ajax({
        type: "POST",
        data: {
          quotation_id: quotation_id,
          status: statust.value
        },
        url: "{{ url('admin/change_invoice_status')}}",
        success: function(result) {
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
    } else {
      statust.value = oldstatus;
      return false;
    }
  }

  function resetPassword(id) {
    event.preventDefault();
    if (confirm('Do you want to reset the password') === true) {
      $('#loading').show();
      $.ajax({
        type: "POST",
        url: "{{ url('admin/ajaxRequestForUserPass')}}/" + id,
        success: function(result) {
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
  $(function() {
    $("#poDate").datepicker({
      autoclose: true,
      format: "yyyy/mm/dd"
    }).attr("autocomplete", "off");
  });

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