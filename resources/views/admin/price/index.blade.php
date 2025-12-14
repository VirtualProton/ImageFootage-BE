@extends('admin.layouts.default')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Price Management
            <small>Control panel</small>
        </h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Price List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @include('admin.partials.message')

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>License Type</th>
                            <th>Product Type</th>
                            <th>Small Image Price</th>
                            <th>Medium Image Price</th>
                            <th>Large Image Price</th>
                            <th>Extra Large Image Price</th>
                            <th>Music Price</th>
                            <th>HD Footage Price</th>
                            <th>4K Footage Price</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prices as $price)
                        <tr>
                            <td>{{ $price->id }}</td>
                            <td>{{ $price->licenceType->licence_name ?? 'N/A' }}</td>
                            <td>{{ ucfirst($price->product_type) }}</td>
                            <td>{{ $price->small_image_price ? '$' . number_format($price->small_image_price, 2) : '0' }}</td>
                            <td>{{ $price->medium_image_price ? '$' . number_format($price->medium_image_price, 2) : '0' }}</td>
                            <td>{{ $price->large_image_price ? '$' . number_format($price->large_image_price, 2) : '0' }}</td>
                            <td>{{ $price->extra_large_image_price ? '$' . number_format($price->extra_large_image_price, 2) : '0' }}</td>
                            <td>{{ $price->music_price ? '$' . number_format($price->music_price, 2) : '0' }}</td>
                            <td>{{ $price->high_resolution_footage_price ? '$' . number_format($price->high_resolution_footage_price, 2) : '0' }}</td>
                            <td>{{ $price['4k_footage_price'] ? '$' . number_format($price['4k_footage_price'], 2) : '0' }}</td>
                            <td>{{ $price->created_at->format('Y-m-d H:i:s') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ URL::to('admin/price/'.$price->id.'/edit') }}" class="btn btn-sm btn-info" style="width: 65.5px;">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    {!! Form::open(['method' => 'DELETE', 'url' => 'admin/price/'.$price->id, 'style' => 'display:inline-block; margin:0']) !!}
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this price?')">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                    {!! Form::close() !!}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('scripts')
<script>
    $(function() {
        $('#example1').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': false
        });

        // Auto-dismiss alerts
        setTimeout(function() {
            $('.alert-success').fadeOut('slow');
        }, 2000);

        setTimeout(function() {
            $('.alert-danger').fadeOut('slow');
        }, 2000);
    });
</script>
@endsection