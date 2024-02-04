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
                Subscribers List
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Subscribers List</li>
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
                                @if(count($userlist) > 0)
                                    <table class="col-sm-12 table table-bordered table-striped dataTable">
                                        <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>User Name</th>
                                            <th>Name</th>
                                            <th>Title</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Address</th>
                                            <th>View more</th>
                                        </tr>
                                        </thead>

                                        @foreach($userlist as $k=>$user)
                                                     <tr role="row" <?php if($k % 2 == 0){ ?> class="even"
                                                        <?php }else{ ?> class="odd" <?php } ?>>
                                                        <td>{{$k+1}}</td>
                                                        <td><a href="{{ url('admin/users/invoices/'.$user['id'])}}"
                                                               target="_blank">{{$user['user_name']}}</a></td>
                                                        <td>{{$user['first_name']}} {{$user['last_name']}}</td>
                                                        <td>{{$user['title']}}</td>
                                                        <td>{{$user['email']}}</td>
                                                        <td>{{$user['mobile']}}</td>
                                                        <td><?php echo isset($user['city']['name']) && isset($user['state']['state'] ) && isset($user['country']['name']) ? $user['city']['name']. " " . $user['state']['state'] . " " . $user['country']['name'] : '-'?></td>
                                                        <td>
                                                            <a href="{{ url('/admin/subscribers/details/'.$user['id']) }}" aria-expanded="false" class=""><i class="fa fa-plus" aria-hidden="true"></i></a> &nbsp; &nbsp;
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
