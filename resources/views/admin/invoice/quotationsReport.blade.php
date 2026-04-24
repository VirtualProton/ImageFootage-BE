@extends('admin.layouts.default')
@section('content')
<div class="content-wrapper" ng-controller="invoiceController">
  <section class="content-header">
    <h1>
      Quotation Report
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Quotation Report</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box" style="padding-left: 10px;padding-right: 10px;">
          <div class="box-header">

          </div>
          @include('admin.partials.message')

          <div class="box-body">
            <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!}Quotation Report</h4>
            <div class="row" style="margin-bottom: 15px; margin-top: 10px;">
              <div class="col-sm-4">
                <label for="agentFilter">Agent Name</label>
                <input
                  type="text"
                  id="agentFilter"
                  class="form-control"
                  placeholder="Enter agent name">
              </div>
            </div>
            <table id="account" class="account table table-bordered table-striped dataTable" class="col-sm-12">
              <thead>
                <!-- <div class="form-group">
                              <h5 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!}{!! "&nbsp;" !!}{!! "&nbsp;" !!}Quotation Report</h5>
                            </div> -->
                <tr>
                  <th>Client ID</th>
                  <th>Client Name</th>
                  <th>Transaction Id</th>
                  <th>Quotation Date</th>
                  <th>Amount</th>
                  <Th>Currency</Th>
                  <th>Plan</th>
                  <th>Region</th>
                  <th>Account Manager</th>
                  <!-- <th>Payment Mode</th>
                                <th>Transaction Type Custom</th> -->
                  <th>Action</th>
                  <!-- <th>Activation Date</th>
                                <th>Expiry Date</th>
                                <th>Available Download</th> -->
                </tr>
              </thead>
              <tbody>
                @if(count($quotations) > 0)
                @foreach($quotations as $quotation)
                <tr role="row" class="odd">
                  <td>{{$quotation['user_id']}}</td>
                  <!-- <td>{{$quotation['user_name']}}</td> -->
                  <td><a href="{{ url('admin/users/invoices/'.$quotation['user_id']) }}">{{$quotation['user_name']}}</a></td>
                  <td>
                     @if($quotation['quotation_url'])
                    <a href="{{$quotation['quotation_url']}}" target="_blank">Q{{$quotation['invoice_name']}}</a>
                    @else
                    Q{{$quotation['invoice_name']}}
                    @endif
                  </td>
                  <td>{{$quotation['created']}}</td>
                  <td>{{$quotation['total']}}</td>
                  <td>{{$quotation['currency']}}</td>
                  <td>
                    @if($quotation['invoice_type']==3)
                    Custom
                    @elseif($quotation['invoice_type']==2)
                    Download
                    @else
                    Subscription
                    @endif
                  </td>
                  <td>
                    @if($quotation['city'])
                    {{$quotation['city']}}
                    @elseIf($quotation['state'])
                    {{$quotation['state']}}
                    @else
                    {{$quotation['country']}}
                    @endif
                  </td>
                  <td>{{$quotation['account_manager_name']}}</td>
                  <td>
                    @if($quotation['status'] != 3)
                    <a href="{{ url('admin/edit_quotation/'.$quotation['user_id'].'/'.$quotation['id']) }}" title="Edit Quotation"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    <!-- <a href="{{ url('admin/users/invoices/'.$quotation['user_id']) }}#!#download_invoices" title="Edit Quotation"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> -->

                    <a href="{{ url('admin/quotation_cancel/'.$quotation['id']) }}" title="Cancel" onclick="return confirm('Do You want to remove ?')"><i class="fa fa-trash-o" aria-hidden="true"></i></a> &nbsp;&nbsp;&nbsp;
                    @endif
                  </td>

                </tr>
                @endforeach

                @else
                <tr style="text-align: center;">
                  <td colspan="9"><strong> No Quotation Yet ... </strong></td>
                </tr>
                @endif

            </table>
            <br />
            <br />

          </div>
        </div>
      </div>
      <!-- </div> -->
    </div>
</div>
</div>
<div class="modal" id="modal-default" style="padding-right: 16px;">

  <!-- /.modal-dialog -->
</div>
</section>
</div>
@endsection
@section('scripts')
<script>
$(function() {
    $('.account').DataTable({
      paging: true,
      order: [[3, 'desc']]
    });
  })

  $(function() {
    var quotationTable = $('.account').DataTable();

    $('#agentFilter').on('keyup change', function() {
      quotationTable.column(8).search(this.value).draw();
    });
  });

  $(function() {
    var url = window.location.href;
    var activeTab = url.substring(url.indexOf("#!#") + 3);

    if ($.trim(activeTab) == 'posts' || $.trim(activeTab) == 'users') // check hash tag name for prevent error
    {
      $(".tab-pane").removeClass("active in");
      $("#" + activeTab).addClass("active in");
      $('a[href="#' + activeTab + '"]').tab('show');
    } else if ($.trim(activeTab) == 'download_invoices') {
      $('a[href="#posts"]').tab('show');
      $('a[href="#download_invoices"]').tab('show');
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