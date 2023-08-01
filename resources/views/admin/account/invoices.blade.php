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
                  <a href="{{ url('admin/quotation/'.$user_id) }}" style="float:right;"><strong>Create Quotation/Proforma Invoice</strong></a><br>
                  <a href="{{ url('admin/quotation2/'.$user_id) }}" style="float:right;"><strong>Custom Invoice</strong></a>
                </div>
                @include('admin.partials.message')
                <div class="tabs">
                  <ul class="nav nav-tabs">
                    <li class="@if($active_tab=="tab1") active @endif">
                      <a href="#users" role="tab" data-toggle="tab">
                        <icon class="fa fa-home"></icon> Client Information
                      </a>
                    </li>
                    <li class="@if($active_tab=="tab2") active @endif">
                      <a href="#posts" role="tab" data-toggle="tab" onclick="activeSubscriptionTab()">
                        <i class="fa fa-user"></i> Sale
                      </a>
                    </li>
                    @if(in_array(Auth::guard('admins')->user()->role_id,config('constants.SUPER_ADMIN_ROLE_ID')))
                    <li class="@if($active_tab=="tab3") active @endif">
                      <a href="#clientinfo" role="tab" data-toggle="tab">
                        <i class="fa fa-pencil-square-o"></i> Client Info Update
                      </a>
                    </li>
                    @endif
                    <!-- <li class="@if($active_tab=="tab4") active @endif">
                      <a href="#comment" role="tab" data-toggle="tab">
                        <i class="fa fa-comment"></i> Comment
                      </a>
                      
                    </li> -->
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane fade @if($active_tab=="tab1") in active @endif" id="users">
                      <div class="box-body">
                        <table id="info" class="account table table-bordered table-striped dataTable" class="col-sm-12">
                          <thead>
                            <div class="form-group col-sm-12">
                              <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!}Account Info</h4>
                              <div class="form-group col-sm-6">
                                <h5>User Name : {{$user->user_name}}</h5>
                                <h5>Deactivated ? : {{$user->status=1?"No":"Yes"}}</h5>
                                <h5>Password :
                                  <input type="password" class="" name="" id="" value=""></br></br>
                                  <button class="btn btn-primary" id="resetButton" onclick="resetPassword({{$user->id}})">Reset</button>
                                </h5>
                                <h5>First Name : {{$user->first_name}}</h5>
                                <h5>Last Name : {{$user->last_name}}</h5>
                                <h5>Email : {{$user->email}}
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
                                <h5>GST : {{$user->gst}}</h5>
                                <h5>PAN : {{$user->pan}}</h5>
                              </div>
                            </div>
                            <div class="form-group col-sm-12">
                              <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!}Other Info</h4>
                              <div class="form-group col-sm-12">
                                <h5>Partner ? : </h5>
                                <h5>White List User ? : </h5>
                                <h5>Black List User ? : </h5>
                                <h5>Checkout Frozen : </h5>
                                <h5>Allow Download Certificate : </h5>
                                <h5>Enable Subs Multi-logins ? : </h5>
                                <h5>Preferred Contact Method : </h5>
                                <h5>Client Description : <textarea rows="7" class="form-control" style="width: 50%;height:auto;" id="user_description">{{$user->description}}</textarea></h5>
                                <button class="btn btn-primary" id="resetButton" onclick="saveDescription({{$user->id}})">Save</button>
                              </div>
                            </div>
                          </thead>
                        </table>
                        {{-- @include('admin.account.add-comment')
                        @include('admin.account.comment') --}}
                      </div>
                    </div>
                    <div class="tab-pane fade @if($active_tab=="tab2") in active @endif" id="posts">
                      <div class="box-body">
                        <div class="tabs">
                          <ul class="nav nav-tabs">
                            <li class="@if($active_tab=="subscription_tab") active @endif">
                              <a href="#subscription_invoices" role="tab" data-toggle="tab">
                                <i class="fa fa-user"></i> Subscription Plan
                              </a>
                            </li>
                            <li class="@if($active_tab=="download_tab") active @endif">
                              <a href="#download_invoices" role="tab" data-toggle="tab">
                                <i class="fa fa-user"></i> Download Packs
                              </a>
                            </li>
                            <li class="@if($active_tab=="custom_tab") active @endif">
                              <a href="#custom_invoices" role="tab" data-toggle="tab">
                                <i class="fa fa-user"></i> Custom
                              </a>
                            </li>
                            <li class="@if($active_tab=="others_tab") active @endif">
                              <a href="#other_invoices" role="tab" data-toggle="tab">
                                <i class="fa fa-user"></i> Others
                              </a>
                            </li>
                          </ul>
                          <div class="tab-content">
                            <div class="tab-pane fade @if($active_tab=="subscription_tab") in active @endif" id="subscription_invoices">
                              <div class="box-body">
                                <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!} Subscription Quotation</h4>

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
                                      <th>Status</th>
                                      <th>Cancelled By</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @if(count($account_subscription_quotations) > 0)
                                      @foreach($account_subscription_quotations as $k=>$quotations)

                                    <tr role="row" class="odd">
                                      <td>{{(($account_subscription_quotations->currentPage()-1)*10)+$k+1}}</td>
                                      <td>
                                        @if($quotations->quotation_url)
                                          <a href="{{$quotations->quotation_url}}" target="_blank">Q{{$quotations->invoice_name}}</a>
                                        @else
                                          Q{{$quotations->invoice_name}}
                                        @endif
                                      </td>
                                      <td>{{$quotations->created}}</td>
                                      <td>{{$quotations->total}}</td>
                                      <td>
                                        Subscription
                                      </td>
                                      <td>{{$quotations->status == 3 ? 'Cancelled' : ''}}</td>
                                      <td>{{ !empty($quotations->calcelled_user_first_name) && !empty($quotations->calcelled_user_last_name) ? ($quotations->calcelled_user_first_name . $quotations->calcelled_user_last_name) : '' }}</td>
                                      <td>
                                        @if($quotations->status != 3)
                                        <a href="{{ url('admin/edit_quotation/'.$user_id.'/'.$quotations->id) }}" title="Edit Quotation"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> &nbsp;&nbsp;
                                        <a  href="javascript:void(0);" ng-click="create_invoice_subscription({{json_encode($quotations)}},{{$user_id}})" title="Convert to Invoice"  data-target="#modal-default" data-toggle="modal"><i class="fa fa-file-pdf-o " aria-hidden="true" alt="Convert to Invoice"></i></a> &nbsp;&nbsp;&nbsp;
                                        <a href="{{ url('admin/invoice_cancel/'.$quotations->id) }}" title="Cancel" onclick="return confirm('Do You want to remove ?')"><i class="fa fa-close" aria-hidden="true" style="color: red;"></i></a> &nbsp;&nbsp;&nbsp;
                                        @endif
                                      </td>
                                    </tr>
                                    @endforeach
                                    <tr style="text-align: right;">
                                      <td colspan="9">{{$account_subscription_quotations->fragment('posts')->render()}}</td>
                                    </tr>
                                    @else
                                    <tr style="text-align: center;">
                                      <td colspan="9"><strong> No Quotation Yet ... </strong></td>
                                    </tr>
                                    @endif
                                </table>
                                <br />
                                <br />

                                <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!} Subscription Invoice</h4>

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

                                    </tr>
                                  </thead>
                                  <tbody>
                                    @if(count($account_subscriptions_invoices) > 0)
                                      @foreach($account_subscriptions_invoices as $k=>$invioces)
                                      <tr role="row" class="odd">
                                      <td>{{(($account_subscription_quotations->currentPage()-1)*10)+$k+1}}</td>

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
                                        <option value="3"  <?php if($invioces->status =='3'){ echo "Selected";} ?>>Cancel</option>
                                        </select>
                                      </td>
                                      <td>
                                      <a href="javascript:void(0);" ng-click="open_modal_update_po({{$invioces->id}},{{$invioces->job_number}})" title="Update PO" data-target="#modal-update_po" data-toggle="modal">  
                                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;</a>{{$invioces->job_number ?? ''}}
                                      </td>
                                      @endforeach
                                      <tr style="text-align: right;">
                                        <td colspan="10">{{$account_subscriptions_invoices->fragment('posts')->render()}}</td>
                                      </tr>
                                    @else
                                    <tr style="text-align: center;">
                                      <td colspan="10"><strong> No Invoice Yet ...</strong></td>
                                    </tr>
                                    @endif
                                  </tbody>
                                </table>
                                <br />
                                <br />
                                @include('admin.account.add-comment', ['tab' => 'sub'])
                                @include('admin.account.comment')
                              </div>
                            </div>

                            <div class="tab-pane fade @if($active_tab=="download_tab") in active @endif" id="download_invoices">
                              <div class="box-body">
                                <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!} Download Pack Quotation</h4>

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
                                      <th>Status</th>
                                      <th>Cancelled By</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                    @if(count($account_download_pack_quotations) > 0)
                                      @foreach($account_download_pack_quotations as $k=>$quotations)

                                    <tr role="row" class="odd">
                                      <td>{{(($account_download_pack_quotations->currentPage()-1)*10)+$k+1}}</td>
                                      <td>
                                        @if($quotations->quotation_url)
                                          <a href="{{$quotations->quotation_url}}" target="_blank">Q{{$quotations->invoice_name}}</a>
                                        @else
                                          Q{{$quotations->invoice_name}}
                                        @endif
                                      </td>
                                      <td>{{$quotations->created}}</td>
                                      <td>{{$quotations->total}}</td>
                                      <td>
                                        Download
                                      </td>
                                      <td>{{$quotations->status == 3 ? 'Cancelled' : ''}}</td>
                                      <td>{{ !empty($quotations->calcelled_user_first_name) && !empty($quotations->calcelled_user_last_name) ? ($quotations->calcelled_user_first_name . $quotations->calcelled_user_last_name) : '' }}</td>
                                      <td>
                                        @if($quotations->status != 3)
                                        <a href="{{ url('admin/edit_quotation/'.$user_id.'/'.$quotations->id) }}" title="Edit Quotation"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> &nbsp;&nbsp;
                                        @if($quotations->invoice_type == 3)
                                        <a href="javascript:void(0);" ng-click="create_invoice({{json_encode($quotations)}},{{$user_id}})" title="Convert to Invoice" data-target="#modal-default_custom" data-toggle="modal"><i class="fa fa-file-pdf-o " aria-hidden="true" alt="Convert to Invoice"></i></a> &nbsp;&nbsp;&nbsp;
                                        @else
                                        <a  href="javascript:void(0);" ng-click="create_invoice_subscription({{json_encode($quotations)}},{{$user_id}})" title="Convert to Invoice"  data-target="#modal-default" data-toggle="modal"><i class="fa fa-file-pdf-o " aria-hidden="true" alt="Convert to Invoice"></i></a> &nbsp;&nbsp;&nbsp;
                                        @endif
                                        <a href="{{ url('admin/invoice_cancel/'.$quotations->id) }}" title="Cancel" onclick="return confirm('Do You want to remove ?')"><i class="fa fa-close" aria-hidden="true" style="color: red;"></i></a> &nbsp;&nbsp;&nbsp;
                                        @endif
                                      </td>

                                    </tr>
                                    @endforeach
                                    <tr style="text-align: right;">
                                      <td colspan="9">{{$account_download_pack_quotations->fragment('posts')->render()}}</td>
                                    </tr>
                                    @else
                                    <tr style="text-align: center;">
                                      <td colspan="9"><strong> No Quotation Yet ... </strong></td>
                                    </tr>
                                    @endif
                                </table>
                                <br />
                                <br />

                                <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!} Download Pack Invoice</h4>

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

                                    </tr>
                                  </thead>
                                  <tbody>
                                    @if(count($account_download_pack_invoices) > 0)
                                      @foreach($account_download_pack_invoices as $k=>$invioces)
                                      <tr role="row" class="odd">
                                      <td>{{(($account_download_pack_quotations->currentPage()-1)*10)+$k+1}}</td>
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
                                        <option value="3"  <?php if($invioces->status =='3'){ echo "Selected";} ?>>Cancel</option>
                                        </select>
                                      </td>
                                      <td>
                                      <a href="javascript:void(0);" ng-click="open_modal_update_po({{$invioces->id}},{{$invioces->job_number}})" title="Update PO" data-target="#modal-update_po" data-toggle="modal">  
                                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;</a>{{$invioces->job_number ?? ''}}
                                      </td>
                                      @endforeach
                                      <tr style="text-align: right;">
                                        <td colspan="10">{{$account_download_pack_invoices->fragment('posts')->render()}}</td>
                                      </tr>
                                    @else
                                    <tr style="text-align: center;">
                                      <td colspan="10"><strong> No Invoice Yet ...</strong></td>
                                    </tr>
                                    @endif
                                  </tbody>
                                </table>
                                <br />
                                <br />
                                @include('admin.account.add-comment', ['tab' => 'download'])
                                @include('admin.account.comment')
                              </div>
                            </div>

                            <div class="tab-pane fade @if($active_tab=="custom_tab") in active @endif" id="custom_invoices">
                              <div class="box-body">
                                <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!} Custom Quotation</h4>

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
                                      <th>Status</th>
                                      <th>Cancelled By</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @if(count($account_custom_quotations) > 0)
                                      @foreach($account_custom_quotations as $k=>$quotations)

                                    <tr role="row" class="odd">
                                      <td>{{(($account_custom_quotations->currentPage()-1)*10)+$k+1}}</td>
                                      <td>
                                        @if($quotations->quotation_url)
                                          <a href="{{$quotations->quotation_url}}" target="_blank">Q{{$quotations->invoice_name}}</a>
                                        @else
                                          Q{{$quotations->invoice_name}}
                                        @endif
                                      </td>
                                      <td>{{$quotations->created}}</td>
                                      <td>{{$quotations->total}}</td>
                                      <td>
                                        Custom
                                      </td>
                                      <td>{{$quotations->status == 3 ? 'Cancelled' : ''}}</td>
                                      <td>{{ !empty($quotations->calcelled_user_first_name) && !empty($quotations->calcelled_user_last_name) ? ($quotations->calcelled_user_first_name . $quotations->calcelled_user_last_name) : '' }}</td>
                                      <td>
                                        @if($quotations->status != 3)
                                        <a href="{{ url('admin/edit_quotation/'.$user_id.'/'.$quotations->id) }}" title="Edit Quotation"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> &nbsp;&nbsp;
                                        @if($quotations->invoice_type == 3)
                                        <a href="javascript:void(0);" ng-click="create_invoice({{json_encode($quotations)}},{{$user_id}})" title="Convert to Invoice" data-target="#modal-default_custom" data-toggle="modal"><i class="fa fa-file-pdf-o " aria-hidden="true" alt="Convert to Invoice"></i></a> &nbsp;&nbsp;&nbsp;
                                        @else
                                        <a  href="javascript:void(0);" ng-click="create_invoice_subscription({{json_encode($quotations)}},{{$user_id}})" title="Convert to Invoice"  data-target="#modal-default" data-toggle="modal"><i class="fa fa-file-pdf-o " aria-hidden="true" alt="Convert to Invoice"></i></a> &nbsp;&nbsp;&nbsp;
                                        @endif
                                        <a href="{{ url('admin/invoice_cancel/'.$quotations->id) }}" title="Cancel" onclick="return confirm('Do You want to remove ?')"><i class="fa fa-close" aria-hidden="true" style="color: red;"></i></a> &nbsp;&nbsp;&nbsp;
                                        @endif
                                      </td>

                                    </tr>
                                    @endforeach
                                    <tr style="text-align: right;">
                                      <td colspan="9">{{$account_custom_quotations->fragment('posts')->render()}}</td>
                                    </tr>
                                    @else
                                    <tr style="text-align: center;">
                                      <td colspan="9"><strong> No Quotation Yet ... </strong></td>
                                    </tr>
                                    @endif
                                </table>
                                <br />
                                <br />

                                <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!} Custom Invoice</h4>

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
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @if(count($account_custom_invoices) > 0)
                                      @foreach($account_custom_invoices as $k=>$invioces)
                                      <tr role="row" class="odd">
                                      <td>{{(($account_custom_quotations->currentPage()-1)*10)+$k+1}}</td>
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
                                        <option value="3"  <?php if($invioces->status =='3'){ echo "Selected";} ?>>Cancel</option>
                                        </select>
                                      </td>
                                      <td>
                                      <a href="javascript:void(0);" ng-click="open_modal_update_po({{$invioces->id}},{{$invioces->job_number}})" title="Update PO" data-target="#modal-update_po" data-toggle="modal">  
                                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;</a>{{$invioces->job_number ?? ''}}
                                      </td>
                                      @endforeach
                                      <tr style="text-align: right;">
                                        <td colspan="10">{{$account_custom_invoices->fragment('posts')->render()}}</td>
                                      </tr>
                                    @else
                                    <tr style="text-align: center;">
                                      <td colspan="10"><strong> No Invoice Yet ...</strong></td>
                                    </tr>
                                    @endif
                                  </tbody>
                                </table>
                                <br />
                                <br />
                                @include('admin.account.add-comment', ['tab' => 'custom'])
                                @include('admin.account.comment')
                              </div>
                            </div>

                            <div class="tab-pane fade @if($active_tab=="others_tab") in active @endif" id="other_invoices">
                              <div class="box-body">
                                <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!} Other Quotation</h4>

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
                                      <th>Status</th>
                                      <th>Cancelled By</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @if(count($account_custom_quotations2) > 0)
                                      @foreach($account_custom_quotations2 as $k=>$quotations)

                                    <tr role="row" class="odd">
                                      <td>{{(($account_custom_quotations2->currentPage()-1)*10)+$k+1}}</td>
                                      <td>
                                        @if($quotations->quotation_url)
                                          <a href="{{$quotations->quotation_url}}" target="_blank">Q{{$quotations->invoice_name}}</a>
                                        @else
                                          Q{{$quotations->invoice_name}}
                                        @endif
                                      </td>
                                      <td>{{$quotations->created}}</td>
                                      <td>{{$quotations->total}}</td>
                                      <td>
                                        Custom
                                      </td>
                                      <td>{{$quotations->status == 3 ? 'Cancelled' : ''}}</td>
                                      <td>{{ !empty($quotations->calcelled_user_first_name) && !empty($quotations->calcelled_user_last_name) ? ($quotations->calcelled_user_first_name . $quotations->calcelled_user_last_name) : '' }}</td>
                                      <td>
                                        @if($quotations->status != 3)
                                        <a href="{{ url('admin/edit_quotation/'.$user_id.'/'.$quotations->id) }}" title="Edit Quotation"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> &nbsp;&nbsp;
                                        <a href="javascript:void(0);" ng-click="create_invoice({{json_encode($quotations)}},{{$user_id}})" title="Convert to Invoice" data-target="#modal-default_custom" data-toggle="modal"><i class="fa fa-file-pdf-o " aria-hidden="true" alt="Convert to Invoice"></i></a> &nbsp;&nbsp;&nbsp;
                                        <a href="{{ url('admin/invoice_cancel/'.$quotations->id) }}" title="Cancel" onclick="return confirm('Do You want to remove ?')"><i class="fa fa-close" aria-hidden="true" style="color: red;"></i></a> &nbsp;&nbsp;&nbsp;
                                        @endif
                                      </td>

                                    </tr>
                                    @endforeach
                                    <tr style="text-align: right;">
                                      <td colspan="9">{{$account_custom_quotations2->fragment('posts')->render()}}</td>
                                    </tr>
                                    @else
                                    <tr style="text-align: center;">
                                      <td colspan="9"><strong> No Quotation Yet ... </strong></td>
                                    </tr>
                                    @endif
                                </table>
                                <br />
                                <br />

                                <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!} Other Invoice</h4>

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
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @if(count($account_custom_invoices2) > 0)
                                      @foreach($account_custom_invoices2 as $k=>$invioces)
                                      <tr role="row" class="odd">
                                      <td>{{(($account_custom_quotations2->currentPage()-1)*10)+$k+1}}</td>
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
                                        <option value="3"  <?php if($invioces->status =='3'){ echo "Selected";} ?>>Cancel</option>
                                        </select>
                                      </td>
                                      <td>
                                      <a href="javascript:void(0);" ng-click="open_modal_update_po({{$invioces->id}},{{$invioces->job_number}})" title="Update PO" data-target="#modal-update_po" data-toggle="modal">  
                                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;</a>{{$invioces->job_number ?? ''}}
                                      </td>
                                      @endforeach
                                      <tr style="text-align: right;">
                                        <td colspan="10">{{$account_custom_invoices2->fragment('posts')->render()}}</td>
                                      </tr>
                                    @else
                                    <tr style="text-align: center;">
                                      <td colspan="10"><strong> No Invoice Yet ...</strong></td>
                                    </tr>
                                    @endif
                                  </tbody>
                                </table>
                                <br />
                                <br />
                                @include('admin.account.add-comment', ['tab' => 'custom1'])
                                @include('admin.account.comment')
                              </div>
                            </div>
                          </div>
                        </div>
                        </div>
                    </div>

                    <div class="tab-pane fade @if($active_tab=="tab3") in active @endif" id="clientinfo">
                      <div class="box-body">
                        @include('admin.account.update-user') 
                        @include('admin.account.client-des')
                        <br />
                        <br />
                        @include('admin.account.add-comment', ['tab' => 'clientinfo'])
                        @include('admin.account.comment')
                      </div>
                    </div>
                    {{--<div class="tab-pane fade @if($active_tab=="tab4") in active @endif" id="comment">
                      <div class="box-body">
                      
                         @include('admin.account.add-comment')
                        @include('admin.account.comment')
                      </div>
                    </div> --}}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal invoice-modal" id="modal-default" style="padding-right: 16px;"> 
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                  <h4 class="modal-title">Create Invoice</h4>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="" class="col-md-6">Trasaction Id</label>
                        <div class="col-md-6">
                            <p>Q<%quotationObj.invoice_name%></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-6">User Name</label>
                        <div class="col-md-6">
                            <p>{{$user->user_name}}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-6">GST No. :</label>
                        <div class="col-md-6">
                            <p><input type="text" name="gstNo" id="gstNo" value="{{$user->gst}}" class="form-control"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-6">Phone No. :</label>
                        <div class="col-md-6">
                            <p><input type="text" name="phone" id="phone" value="{{$user->phone}}" class="form-control"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-6">Package :</label>
                        <div class="col-md-6">
                            <p><%quotationObj.package_description%></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-6">Purchase Date :</label>
                        <div class="col-md-6">
                            <p>{{date('Y-m-d H:i:s')}}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-6">Subtotal :</label>
                        <div class="col-md-6">
                            <p><%quotationObj.total - quotationObj.tax%></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-6">Discount :</label>
                        <div class="col-md-6">
                            <p></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-6">Tax :</label>
                        <div class="col-md-6">
                            <p><%quotationObj.tax%></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-6">Total :</label>
                        <div class="col-md-6">
                            <p><%quotationObj.total%></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-6">Agent :</label>
                        <div class="col-md-6">
                            <p>{{Auth::guard('admins')->user()->name}}</p>
                        </div>
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="" class="col-md-6">Method :</label>
                        <div class="col-md-6">
                            <p><select class="form-control" name="payment_method" ng-model="payment_method">
                          <option value="">Select Method</option>
                          <option value="chq">Terms Granted</option>
                          <option value="online">Online</option>
                        </select></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-6">Pan No. :</label>
                        <div class="col-md-6">
                            <p><input type="text" name="panNo" id="panNo" value="{{$user->pan}}" class="form-control"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-6">Job Ref/ PO # :</label>
                        <div class="col-md-6">
                            <p><input type="text" name="po" id="po" ng-model="po" class="form-control"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-6">Country :</label>
                        <div class="col-md-6">
                          @if(empty($country_name))
                          <p>
                            <select class="form-control" name="country_invoice" ng-model="country_invoice" id="country_invoice" onchange="getStateInvoice(this)">
                              <option  value="">Please Select</option>
                              @if(count($countries) > 0)
                              @foreach($countries as $country)
                              <option value={{$country->id}} <?php if($user_data['country']==$country->id){echo 'selected="selected"';}?>>{{$country->name}}</option>
                              @endforeach
                              @endif
                            </select>
                          </p>
                          @else
                            <p>{{$country_name}}</p>
                          @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-6">State :</label>
                        <div class="col-md-6">
                          @if(empty($state_name))
                          <p>
                            <select class="form-control" name="state_invoice" ng-model="state_invoice" id="state_invoice" onchange="getCityInvoice(this)">
                              <option value="">Please Select</option>
                            </select>
                          </p>
                          @else
                            <p>{{$state_name}}</p>
                          @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-6">City :</label>
                        <div class="col-md-6">
                          @if(empty($city_name))
                            <p>
                              <select class="form-control" name="city_invoice" ng-model="city_invoice" id="city_invoice">
                                <option value="">Please Select</option>
                              </select>
                            </p>
                          @else
                            <p>{{$city_name}}</p>
                          @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-6">Street :</label>
                        <div class="col-md-6">
                          @if(empty($user->address))
                            <p><input type="text" name="address_invoice" id="address_invoice" ng-model="address_invoice" class="form-control"></p>
                          @else
                            <p>{{$user->address}}</p>
                          @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-6">Street2 :</label>
                        <div class="col-md-6">
                          @if(empty($user->address2))
                            <p><input type="text" name="address2_invoice" id="address2_invoice" ng-model="address2_invoice" class="form-control"></p>
                          @else
                            <p>{{$user->address2}}</p>
                          @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-6">Zip Code :</label>
                        <div class="col-md-6">
                            @if(empty($user->postal_code))
                            <p><input type="text" name="postal_code_invoice" id="postal_code_invoice" ng-model="postal_code_invoice" class="form-control"></p>
                          @else
                            <p>{{$user->postal_code}}</p>
                          @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-6">Checkout via Online :</label>
                        <div class="col-md-6">
                            <p><span ng-show="payment_method=='chq'">No</span><span ng-show="payment_method=='online'">Yes</span></p>
                        </div>
                    </div>
                    </div>
                    </div>
                  </div>
                  <p style="text-align: center;color:red;"><strong>Be Patient. Do not click more than once</strong></p>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" ng-click="send_invoice(quotationObj.id, quotation_user)">Confirm Submission</button>
                  </div>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
          </div>
          <div class="modal invoice-modal" id="modal-default_custom" style="padding-right: 16px;" ng-controller="invoiceController">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                  <h4 class="modal-title">Create Invoice</h4>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <div class="col-sm-6">
                      <div class="form-group row">
                          <label for="" class="col-md-6">Trasaction Id :</label>
                          <div class="col-md-6">
                              <p>Q{{isset($quotations) ? $quotations->invoice_name : ''}}</p>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="" class="col-md-6">User Name :</label>
                          <div class="col-md-6">
                              <p>{{$user->user_name}}</p>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="" class="col-md-6">GST No. :</label>
                          <div class="col-md-6">
                              <p><input type="text" name="gstNocus" id="gstNocus" value="{{$user->gst}}" class="form-control"></p>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="" class="col-md-6">Phone No. :</label>
                          <div class="col-md-6">
                              <p><input type="text" name="phonecus" id="phonecus" value="{{$user->phone}}" class="form-control"></p>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="" class="col-md-6">Purchase Date :</label>
                          <div class="col-md-6">
                              <p>{{date('Y-m-d H:i:s')}}</p>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="" class="col-md-6">Subtotal :</label>
                          <div class="col-md-6">
                              <p>{{isset($quotations) ? ($quotations->total - $quotations->tax) : ''}}</p>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="" class="col-md-6">Discount :</label>
                          <div class="col-md-6">
                              <p></p>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="" class="col-md-6">Tax :</label>
                          <div class="col-md-6">
                              <p>{{isset($quotations) ? $quotations->tax : ''}}</p>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="" class="col-md-6">Total :</label>
                          <div class="col-md-6">
                              <p>{{isset($quotations) ? $quotations->total : ''}}</p>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="" class="col-md-6">Agent :</label>
                          <div class="col-md-6">
                              <p>{{Auth::guard('admins')->user()->name}}</p>
                          </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group row">
                          <label for="" class="col-md-6">Method :</label>
                          <div class="col-md-6">
                              <p><select class="form-control" name="payment_method" ng-model="payment_method">
                                  <option value="">Select Method</option>
                                  <option value="chq">Terms Granted</option>
                                  <option value="online">Online</option>
                                </select>
                              </p>
                          </div>
                      </div>
                      <div class="form-group row" ng-show="payment_method=='chq'">
                          <label for="" class="col-md-6">How many days : </label>
                          <div class="col-md-6">
                              <p>
                                <select class="form-control" id="expiry_due_date" name="expiry_due_date" ng-model="expiry_due_date">
                                  <option value="">Select Days</option>
                                  <option value="7">7 Days</option>
                                  <option value="15">15 Days</option>
                                  <option value="30">30 Days</option>
                                  <option value="45">45 Days</option>
                                </select>
                              </p>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="" class="col-md-6">Pan No. :</label>
                          <div class="col-md-6">
                              <p><input type="text" name="panNocus" id="panNocus" value="{{$user->pan}}" class="form-control"></p>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="" class="col-md-6">Job Ref/ PO # :</label>
                          <div class="col-md-6">
                              <p><input type="text" name="poCustom" id="poCustom" ng-model="poCustom" class="form-control"></p>
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="" class="col-md-6">Country :</label>
                        <div class="col-md-6">
                          @if(empty($country_name))
                          <p>
                            <select class="form-control" name="country_invoice_cus" ng-model="country_invoice_cus" id="country_invoice_cus" onchange="getStateInvoiceCus(this)">
                              <option  value="">Please Select</option>
                              @if(count($countries) > 0)
                              @foreach($countries as $country)
                              <option value={{$country->id}} <?php if($user_data['country']==$country->id){echo 'selected="selected"';}?>>{{$country->name}}</option>
                              @endforeach
                              @endif
                            </select>
                          </p>
                          @else
                            <p>{{$country_name}}</p>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                          <label for="" class="col-md-6">State :</label>
                          <div class="col-md-6">
                            @if(empty($state_name))
                            <p>
                              <select class="form-control" name="state_invoice_cus" ng-model="state_invoice_cus" id="state_invoice_cus" onchange="getCityInvoiceCus(this)">
                                <option value="">Please Select</option>
                              </select>
                            </p>
                            @else
                              <p>{{$state_name}}</p>
                            @endif
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="" class="col-md-6">City :</label>
                          <div class="col-md-6">
                            @if(empty($city_name))
                              <p>
                                <select class="form-control" name="city_invoice_cus" ng-model="city_invoice_cus" id="city_invoice_cus">
                                  <option value="">Please Select</option>
                                </select>
                              </p>
                            @else
                              <p>{{$city_name}}</p>
                            @endif
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="" class="col-md-6">Street :</label>
                          <div class="col-md-6">
                            @if(empty($user->address))
                              <p><input type="text" name="address_invoice_cus" id="address_invoice_cus" ng-model="address_invoice_cus" class="form-control"></p>
                            @else
                              <p>{{$user->address}}</p>
                            @endif
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="" class="col-md-6">Street2 :</label>
                          <div class="col-md-6">
                            @if(empty($user->address2))
                              <p><input type="text" name="address2_invoice_cus" id="address2_invoice_cus" ng-model="address2_invoice_cus" class="form-control"></p>
                            @else
                              <p>{{$user->address2}}</p>
                            @endif
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="" class="col-md-6">Zip Code :</label>
                          <div class="col-md-6">
                              @if(empty($user->postal_code))
                              <p><input type="text" name="postal_code_invoice_cus" id="postal_code_invoice_cus" ng-model="postal_code_invoice_cus" class="form-control"></p>
                            @else
                              <p>{{$user->postal_code}}</p>
                            @endif
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="" class="col-md-6">Checkout via Online :</label>
                          <div class="col-md-6">
                              <p><span ng-show="payment_method=='chq'">No</span><span ng-show="payment_method=='online'">Yes</span></p>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                        <table width="100%" style="border-spacing: 1em .5em;padding: 0 2em 1em 0;border: 1px solid orange;">
                          <tr ng-repeat="item in quotationObjCus.items">
                            <td style="padding:5px;"><%item.type%></td>
                            <td style="padding:5px;"><img src="<%item.product_image%>" width="150px" /></td>
                            <td style="padding:5px;"><%item.product_id%></td>
                            <td style="padding:5px;"><%item.product_size%></td>
                            <td style="padding:5px;"><%item.total%></td>
                          </tr>
                        </table>
                    </div>  
                  </div>

                  <p style="text-align: center;color:red;"><strong>Be Patient. Do not click more than once</strong></p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  @if(isset($quotations) && !empty($quotations))
                  <button type="button" class="btn btn-primary" ng-click="send_invoice_cus({{$quotations->id}}, {{$user_id}})">Confirm Submission</button>
                  @endif
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
          </div>
          <div class="modal" id="modal-update_po" style="padding-right: 16px;" ng-controller="invoiceController">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                  <h4 class="modal-title">Update PO #</h4>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                      <label for="exampleInputEmail1">PO #</label>
                      <input type="text" class="form-control" ng-model="po_no" name="po_no" id="po_no" placeholder="PO #">
                      <input type="hidden" name="invoice_id" ng-model="invoice_id" id="invoice_id" />
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" ng-click="update_po()">Update</button>
                </div>
              </div>
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
    var nestedActiveTab = "{{$active_nested_tab}}";
    var nestedActiveTabId = nestedActiveTab.slice(0,-3);

    if ($.trim(activeTab) == 'posts' || $.trim(activeTab) == 'users') // check hash tag name for prevent error
    {
      $(".tab-pane").removeClass("active in");
      $("#" + activeTab).addClass("active in");
      $('a[href="#' + activeTab + '"]').tab('show');
      $('a[href="#' + nestedActiveTabId + 'invoices"]').tab('show');
    }
  });

  function activeSubscriptionTab() {
    $('a[href="#subscription_invoices"]').tab('show');
  }

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
  function saveDescription(id) {
    event.preventDefault();
    var description = $('#user_description').val();
    if(description.length > 0){
      $('#loading').show();
      $.ajax({
        type: "POST",
        url: "{{ url('admin/ajaxRequestForUserDesc')}}",
        data: {
          id: id,
          description: description
        },
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

    $("#poDateCustom").datepicker({
      autoclose: true,
      format: "yyyy/mm/dd"
    }).attr("autocomplete", "off");

    $('#expiry').datepicker({
      format: "yyyy/mm/dd",
      autoclose: true
    });
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
  function getstate(data){
   $.ajax({
            url: '{{ URL::to("admin/getStatesByCounty") }}',
            data: {
            country_code: data.value,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            error: function() {
            //$('#info').html('<p>An error has occurred</p>');
            },
            success: function(data) {
               if(data.response=='success'){
                  var option='<option value="">Please Select</option>';
                $.each(data.data, function( i, val ) {
                     option = option+'<option value="'+val.id+'">'+val.state+'</option>';
                });
                $('#state').html(option);
               }

            },
            type: 'POST'
            });
}
  function getcity(data){
      console.log(data.value);
      $.ajax({
              url: '{{ URL::to("admin/getCityByState") }}',
            data: {
            state_code: data.value,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            error: function() {
            //$('#info').html('<p>An error has occurred</p>');
            },
            success: function(data) {
               if(data.response=='success'){
                  var option='<option value="">Please Select</option>';
                $.each(data.data, function( i, val ) {
                     option = option+'<option value="'+val.id+'">'+val.name+'</option>';
                });
                $('#city').html(option);
               }

            },
            type: 'POST'
            });
}
function getStateInvoice(data){
   $.ajax({
            url: '{{ URL::to("admin/getStatesByCounty") }}',
            data: {
            country_code: data.value,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            error: function() {
            //$('#info').html('<p>An error has occurred</p>');
            },
            success: function(data) {
               if(data.response=='success'){
                  var option='<option value="">Please Select</option>';
                $.each(data.data, function( i, val ) {
                     option = option+'<option value="'+val.id+'">'+val.state+'</option>';
                });
                $('#state_invoice').html(option);
                $('#city_invoice').val('');
               }
            },
            type: 'POST'
            });
}
  function getCityInvoice(data){
      $.ajax({
              url: '{{ URL::to("admin/getCityByState") }}',
            data: {
            state_code: data.value,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            error: function() {
            //$('#info').html('<p>An error has occurred</p>');
            },
            success: function(data) {
               if(data.response=='success'){
                  var option='<option value="">Please Select</option>';
                $.each(data.data, function( i, val ) {
                     option = option+'<option value="'+val.id+'">'+val.name+'</option>';
                });
                $('#city_invoice').html(option);
               }
            },
            type: 'POST'
            });
}
function getStateInvoiceCus(data){
   $.ajax({
            url: '{{ URL::to("admin/getStatesByCounty") }}',
            data: {
            country_code: data.value,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            error: function() {
            //$('#info').html('<p>An error has occurred</p>');
            },
            success: function(data) {
               if(data.response=='success'){
                  var option='<option value="">Please Select</option>';
                $.each(data.data, function( i, val ) {
                     option = option+'<option value="'+val.id+'">'+val.state+'</option>';
                });
                $('#state_invoice_cus').html(option);
                $('#city_invoice_cus').val('');
               }
            },
            type: 'POST'
            });
}
  function getCityInvoiceCus(data){
      $.ajax({
              url: '{{ URL::to("admin/getCityByState") }}',
            data: {
            state_code: data.value,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            error: function() {
            //$('#info').html('<p>An error has occurred</p>');
            },
            success: function(data) {
               if(data.response=='success'){
                  var option='<option value="">Please Select</option>';
                $.each(data.data, function( i, val ) {
                     option = option+'<option value="'+val.id+'">'+val.name+'</option>';
                });
                $('#city_invoice_cus').html(option);
               }
            },
            type: 'POST'
            });
}
</script>

@stop