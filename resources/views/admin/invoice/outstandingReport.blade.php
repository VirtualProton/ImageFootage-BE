@extends('admin.layouts.default')
@section('styles')
<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<!-- Add datepicker CSS -->
<link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<style>
    /* Hide any extra morris containers that might cause issues */
    #morris-chart,
    .morris-chart {
        display: none !important;
    }

    /* Hide DataTables default processing indicator */
    .dataTables_processing {
        display: none !important;
    }

    /* Table container with opacity for smooth transition */
    #table-container {
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    #table-container.loaded {
        opacity: 1;
    }

    /* Filter styles */
    .filter-container {
        background: #f9f9f9;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .filter-row {
        display: flex;
        gap: 15px;
        align-items: flex-end;
        flex-wrap: wrap;
    }

    .filter-group {
        flex: 1;
        min-width: 200px;
    }

    .filter-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #333;
    }

    .filter-group input,
    .filter-group select {
        width: 100%;
    }

    .filter-buttons {
        display: flex;
        gap: 10px;
    }

    .btn-filter {
        padding: 6px 20px;
    }
</style>
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Outstanding Report</h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Outstanding Report</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Outstanding Report</h3>
                    </div>
                    @include('admin.partials.message')

                    <div id="error-message" style="display:none;" class="alert alert-danger"></div>

                    <!-- Filter Section -->
                    <div class="box-body">
                        <div class="filter-container">
                            <h4 style="margin-top: 0; margin-bottom: 15px;">
                                <i class="fa fa-filter"></i> Filters
                            </h4>
                            <div class="filter-row">
                                <div class="filter-group">
                                    <label for="client_name">Client ID</label>
                                    <input type="text" id="client_name" class="form-control" placeholder="Enter client ID">
                                </div>

                                <div class="filter-group">
                                    <label for="start_date">Start Date</label>
                                    <input type="text" id="start_date" class="form-control datepicker" placeholder="Select start date" autocomplete="off">
                                </div>

                                <div class="filter-group">
                                    <label for="end_date">End Date</label>
                                    <input type="text" id="end_date" class="form-control datepicker" placeholder="Select end date" autocomplete="off">
                                </div>


                                <div class="filter-group" style="flex: 0;">
                                    <label>&nbsp;</label>
                                    <div class="filter-buttons">
                                        <button type="button" id="apply-filter" class="btn btn-primary btn-filter">
                                            <i class="fa fa-search"></i> Apply
                                        </button>
                                        <button type="button" id="reset-filter" class="btn btn-default btn-filter">
                                            <i class="fa fa-refresh"></i> Reset
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="table-container" class="box-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Invoice Number</th>
                                    <th>Client ID</th>
                                    <th>Client Name</th>
                                    <th>Invoice Date</th>
                                    <th>Due Date</th>
                                    <th>Payment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be loaded via AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<!-- Add datepicker JS -->
<script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script>
    // Disable Morris.js
    window.Morris = null;

    $(document).ready(function() {
        // Initialize datepickers
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
            clearBtn: true
        });

        // Destroy any existing DataTable instance
        if ($.fn.DataTable.isDataTable('#example2')) {
            $('#example2').DataTable().destroy();
        }

        var isFirstLoad = true;

        var table = $('#example2').DataTable({
            processing: false,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.outstanding.data') }}",
                type: 'GET',
                data: function(d) {
                    // Add filter parameters
                    d.client_name = $('#client_name').val();
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                },
                dataSrc: function(json) {

                    // Hide error message on successful load
                    $('#error-message').hide();

                    // Hide custom spinner on first load
                    if (isFirstLoad) {
                        $('#custom-spinner').fadeOut(300, function() {
                            $(this).remove();
                        });
                        $('#table-container').addClass('loaded');
                        isFirstLoad = false;

                        // Adjust column widths after table becomes visible
                        setTimeout(function() {
                            table.columns.adjust().draw(false);
                        }, 350);
                    }

                    if (json.error) {
                        $('#error-message').html('Error: ' + json.error).show();
                        return [];
                    }
                    return json.data || [];
                },
                error: function(xhr, error, code) {
                    // Hide custom spinner on error
                    if (isFirstLoad) {
                        $('#custom-spinner').fadeOut(300, function() {
                            $(this).remove();
                        });
                        $('#table-container').addClass('loaded');
                        isFirstLoad = false;
                    }

                    // Only show error for actual HTTP errors (status >= 400)
                    if (xhr.status >= 400 || xhr.status === 0) {
                        var errorMsg = 'Error loading data: ' + xhr.status;
                        try {
                            var response = JSON.parse(xhr.responseText);
                            if (response.error) {
                                errorMsg += ' - ' + response.error;
                            } else if (response.message) {
                                errorMsg += ' - ' + response.message;
                            }
                        } catch (e) {
                            errorMsg += ' - ' + xhr.statusText;
                        }
                        $('#error-message').html(errorMsg).show();
                    }
                }
            },
            columns: [{
                    data: 'invoice_name',
                    name: 'invoice_name',
                    width: '10%',
                    render: function(data, type, row) {
                        if (data && data !== 'N/A' && row.user_id && row.id) {
                            return '<a href="{{ url("admin/invoice") }}/' + row.user_id + '/' + row.id + '" target="_blank" style="color: #3c8dbc; text-decoration: underline;">' + data + '</a>';
                        }
                        return data ? data : 'N/A';
                    }
                },
                {
                    data: 'user_id',
                    name: 'user_id',
                    width: '10%',
                    render: function(data, type, row) {
                        return data ? data : 'N/A';
                    }
                },
                {
                    data: 'user_name',
                    name: 'user_name',
                    width: '25%',
                    render: function(data, type, row) {
                        if (data && row.user_id) {
                            return '<a href="{{ url("admin/users/invoices") }}/' + row.user_id + '" style="color: #3c8dbc; text-decoration: underline;">' + data + '</a>';
                        }
                        return data ? data : 'N/A';
                    }
                },
                {
                    data: 'invoice_created',
                    name: 'invoice_created',
                    width: '20%',
                    render: function(data, type, row) {
                        return data ? data : 'N/A';
                    }
                },
                {
                    data: 'expiry_due_date',
                    name: 'expiry_due_date',
                    width: '15%',
                    render: function(data, type, row) {
                        return data ? data : 'N/A';
                    }
                },
                {
                    data: 'payment_status',
                    name: 'payment_status',
                    width: '15%',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        if (data) {
                            var badgeClass = 'label-default';
                            if (data.toLowerCase() === 'paid') {
                                badgeClass = 'label-success';
                            } else if (data.toLowerCase() === 'pending') {
                                badgeClass = 'label-warning';
                            } else if (data.toLowerCase() === 'failed') {
                                badgeClass = 'label-danger';
                            }
                            return '<span class="label ' + badgeClass + '">' + data + '</span>';
                        }
                        return '<span class="label label-warning">Pending</span>';
                    }
                }
            ],
            pageLength: 10,
            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            order: [
                [0, 'desc']
            ],
            autoWidth: false,
            responsive: true,
            language: {
                emptyTable: "No orders found",
                zeroRecords: "No matching orders found",
                loadingRecords: "Loading...",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "Showing 0 to 0 of 0 entries",
                infoFiltered: "(filtered from _MAX_ total entries)"
            },
            drawCallback: function(settings) {
                console.log('Table drawn with ' + settings.aoData.length + ' rows');
            }
        });

        // Apply filter button
        $('#apply-filter').on('click', function() {
            table.ajax.reload();
        });

        // Reset filter button
        $('#reset-filter').on('click', function() {
            $('#client_name').val('');
            $('#start_date').val('');
            $('#end_date').val('');
            table.ajax.reload();
        });

        // Allow Enter key to apply filter
        $('#client_name, #start_date, #end_date').on('keypress', function(e) {
            if (e.which === 13) { // Enter key
                $('#apply-filter').click();
            }
        });
    });
</script>
@endsection