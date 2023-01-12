@extends('admin.layouts.default')
@section('styles')
    <link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">


@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Subscribers Details List
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Subscribers Details List</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary" style="overflow-x:auto;">
                        <div class="box-header with-border" style="overflow-x:auto;">
                            <h3 class="box-title">Subscribers List</h3>
                        </div>
                        @include('admin.partials.message')
                        <div class="box-body">
                            <div class="box-group" id="accordion">
                                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                <table class="col-sm-12 table table-bordered table-striped dataTable">
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
                                        <th>Show Downloads</th>
                                    </tr>
                                    </thead>
                                    @if(count($userlist['plans']) > 0 )
                                        @foreach($userlist['plans'] as $key=>$eachPlan)
                                            <tr role="row" class="odd">
                                                <td>{{$key+1}}</td>
                                                <td>
                                                    <a target="_blank">{{$eachPlan['package_name']}}
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
                                                <td>
                                                    <a aria-expanded="true" class="" onclick="downloads(<?php echo json_encode($eachPlan['downloads']) ?>)"><i
                                                                class="fa fa-cloud-download"
                                                                aria-hidden="true"></i></a>
                                                    &nbsp; &nbsp;
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </table>
                                                   
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- /.content -->
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Images/Footages Orders Details</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <th>Type</th>
                            <th>Product Image/Footage</th>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Download Date</th>
                            <thead>
                            <tbody id="downloadData">
                            {{--                            <tr ng-repeat="item in products">--}}
                            {{--                                <td ng-show="item['product_web']=='2'"> Image </td>--}}
                            {{--                                <td ng-show="item['product_web']=='3'">Footage</td>--}}
                            {{--                                <td ng-show="item['product_web']=='2'">--}}
                            {{--                                    <img src="<%item['product_thumb']%>" width="150" height="100">--}}
                            {{--                                </td>--}}
                            {{--                                <td ng-show="item['product_web']=='3'">--}}
                            {{--                                    <video controls controlsList="nodownload" onmouseover="this.play()"--}}
                            {{--                                           onmouseout="this.load()" width="150" height="150">--}}
                            {{--                                        <source src="<%item['product_thumb']%>"--}}
                            {{--                                                type="video/mp4">--}}
                            {{--                                        Your browser does not support the video tag.--}}
                            {{--                                    </video>--}}

                            {{--                                </td>--}}
                            {{--                                <td><%item['product_id']%> </td>--}}
                            {{--                                <td><%item['product_name']%> </td>--}}
                            {{--                                <td><%item['standard_size']%> </td>--}}
                            {{--                                <td><%item['standard_price']%></td>--}}
                            {{--                            </tr>--}}
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>

    <!-- /.content-wrapper -->

@endsection

@section('scripts')

    <script>

        $(function () {
            $('.datatable').DataTable();
        });

        function downloads(data) {
            console.log(data);

        }

    </script>
        <!-- <script>

            $(document).ready(function () {
            $(".content").hide();
            $(".show_hide").on("click", function () {
                var txt = $(".content").is(':visible') ? 'Read More' : 'Read Less';
                $(".show_hide").text(txt);
                $(this).next('.content').slideToggle(200);
                });
            });
    </script> -->

@endsection
