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

                <!-- Product Type Filter -->
                <div class="row" style="margin-bottom: 12px;">
                    <div class="col-md-3">
                        <label for="productTypeFilter">Product Type</label>
                        <select id="productTypeFilter" class="form-control">
                            <option value="">All</option>
                            <option value="image">Image</option>
                            <option value="footage">Footage</option>
                            <option value="music">Music</option>
                        </select>
                    </div>
                </div>

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
                            <td>{{ $price->small_image_price ? 'INR' . number_format($price->small_image_price, 2) : '0' }}</td>
                            <td>{{ $price->medium_image_price ? 'INR' . number_format($price->medium_image_price, 2) : '0' }}</td>
                            <td>{{ $price->large_image_price ? 'INR' . number_format($price->large_image_price, 2) : '0' }}</td>
                            <td>{{ $price->extra_large_image_price ? 'INR' . number_format($price->extra_large_image_price, 2) : '0' }}</td>
                            <td>{{ $price->music_price ? 'INR' . number_format($price->music_price, 2) : '0' }}</td>
                            <td>{{ $price->high_resolution_footage_price ? 'INR' . number_format($price->high_resolution_footage_price, 2) : '0' }}</td>
                            <td>{{ $price['4k_footage_price'] ? 'INR' . number_format($price['4k_footage_price'], 2) : '0' }}</td>
                            <td>{{ $price->created_at->format('Y-m-d H:i:s') }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ URL::to('admin/price/'.$price->id.'/edit') }}" class="btn-action btn-edit" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    {!! Form::open(['method' => 'DELETE', 'url' => 'admin/price/'.$price->id, 'style' => 'display:inline-block; margin:0']) !!}
                                    <button type="submit" class="btn-action btn-delete" onclick="return confirm('Are you sure you want to delete this price?')" title="Delete">
                                        <i class="fa fa-trash"></i>
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

@section('styles')
<style>
    .action-buttons {
        display: flex;
        gap: 5px;
        justify-content: center;
    }
    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        padding: 0;
        background: transparent;
    }
    .btn-action i {
        font-size: 16px;
    }
    .btn-edit {
        color: #28a745;
    }
    .btn-edit:hover {
        color: #fff;
        background-color: #28a745;
    }
    .btn-delete {
        color: #dc3545;
    }
    .btn-delete:hover {
        color: #fff;
        background-color: #dc3545;
    }
    /* Remove default button styling */
    .btn-action.btn-delete {
        outline: none;
        box-shadow: none;
    }
    .btn-action.btn-delete:focus {
        outline: none;
        box-shadow: none;
    }
</style>
@endsection

@section('scripts')
<script>
    $(function() {
        var table = $('#example1').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': false
        });

        // Product Type Filter
        $('#productTypeFilter').on('change', function() {
            var selectedType = this.value;

            // Search in the Product Type column (index 2)
            table.column(2).search(selectedType).draw();
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
