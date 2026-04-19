@extends('admin.layouts.default')

@section('styles')
<style>
    .invoice-box {
        max-width: 900px;
        margin: 20px auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        background: #fff;
        border-radius: 5px;
    }
    
    .invoice-header {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #3c8dbc;
    }
    
    .invoice-header h2 {
        margin: 0;
        color: #3c8dbc;
        font-weight: bold;
    }
    
    .info-section {
        margin-bottom: 30px;
    }
    
    .info-section h4 {
        color: #333;
        margin-bottom: 15px;
        font-weight: bold;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
    }
    
    .info-row {
        display: flex;
        margin-bottom: 12px;
        padding: 8px 0;
    }
    
    .info-label {
        font-weight: bold;
        width: 180px;
        color: #555;
        flex-shrink: 0;
    }
    
    .info-value {
        color: #333;
        flex-grow: 1;
        word-break: break-word;
    }
    
    .status-badge {
        display: inline-block;
        padding: 5px 15px;
        border-radius: 3px;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 12px;
    }
    
    .status-paid {
        background-color: #00a65a;
        color: white;
    }
    
    .status-pending {
        background-color: #f39c12;
        color: white;
    }
    
    .status-failed {
        background-color: #dd4b39;
        color: white;
    }
    
    .back-button-container {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }
    
    .amount-display {
        font-size: 24px;
        font-weight: bold;
        color: #3c8dbc;
    }
    
    .po-details-box {
        background: #f9f9f9;
        padding: 15px;
        border-radius: 4px;
        border-left: 3px solid #3c8dbc;
        margin-top: 10px;
    }
</style>
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Invoice Details
            <small>View invoice information</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{url('admin/outstanding-report')}}">Outstanding Report</a></li>
            <li class="active">Invoice Details</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="invoice-box">
                            <!-- Invoice Header -->
                            <div class="invoice-header">
                                <h2>Invoice #{{ $invoice->invoice_name ?? 'N/A' }}</h2>
                            </div>
                            
                            <!-- Basic Information Section -->
                            <div class="info-section">
                                <h4><i class="fa fa-info-circle"></i> Basic Information</h4>
                                
                                <div class="info-row">
                                    <span class="info-label">Invoice ID:</span>
                                    <span class="info-value">{{ $invoice->id ?? 'N/A' }}</span>
                                </div>
                                
                                <div class="info-row">
                                    <span class="info-label">Client ID:</span>
                                    <span class="info-value">{{ $invoice->user_id ?? 'N/A' }}</span>
                                </div>
                                
                                <div class="info-row">
                                    <span class="info-label">Email:</span>
                                    <span class="info-value">{{ $invoice->email_id ?? 'N/A' }}</span>
                                </div>
                                
                                <div class="info-row">
                                    <span class="info-label">Package ID:</span>
                                    <span class="info-value">{{ $invoice->package_id ?? 'N/A' }}</span>
                                </div>
                                
                                <div class="info-row">
                                    <span class="info-label">Invoice Date:</span>
                                    <span class="info-value">
                                        {{ $invoice->invoice_created ? date('F d, Y H:i:s', strtotime($invoice->invoice_created)) : 'N/A' }}
                                    </span>
                                </div>
                                
                                <div class="info-row">
                                    <span class="info-label">Last Updated:</span>
                                    <span class="info-value">
                                        {{ $invoice->modified ? date('F d, Y H:i:s', strtotime($invoice->modified)) : 'N/A' }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Payment Information Section -->
                            <div class="info-section">
                                <h4><i class="fa fa-credit-card"></i> Payment Information</h4>
                                
                                <div class="info-row">
                                    <span class="info-label">Payment Status:</span>
                                    <span class="info-value">
                                        @if(isset($invoice->payment_status))
                                                <span class="status-badge status-paid">COMPLETED</span>
                                        @else
                                            <span class="status-badge status-pending">Pending</span>
                                        @endif
                                    </span>
                                </div>
                                
                                
                                <div class="info-row">
                                    <span class="info-label">Total:</span>
                                    <span class="info-value amount-display">
                                        {{ number_format($invoice->total ?? 0, 2) }} {{ $invoice->currency ?? 'INR' }}
                                    </span>
                                </div>
                                
                                @if(isset($invoice->payment_method))
                                <div class="info-row">
                                    <span class="info-label">Payment Method:</span>
                                    <span class="info-value">{{ ucfirst($invoice->payment_method) }}</span>
                                </div>
                                @endif
                                
                            </div>
                            
                            <!-- PO Details Section -->
                            @if(isset($invoice->po_detail) && !empty($invoice->po_detail))
                            <div class="info-section">
                                <h4><i class="fa fa-file-text-o"></i> Purchase Order Details</h4>
                                <div class="info-row">
                                    <span class="info-label">PO Details:</span>
                                    <span class="info-value">
                                        <div class="po-details-box">
                                            {{ $invoice->po_detail }}
                                        </div>
                                    </span>
                                </div>
                            </div>
                            @endif
                            
                            <!-- Additional Information Section (if available) -->
                            @if(isset($invoice->description) || isset($invoice->notes))
                            <div class="info-section">
                                <h4><i class="fa fa-file-text"></i> Additional Information</h4>
                                
                                @if(isset($invoice->description))
                                <div class="info-row">
                                    <span class="info-label">Description:</span>
                                    <span class="info-value">{{ $invoice->description }}</span>
                                </div>
                                @endif
                                
                                @if(isset($invoice->notes))
                                <div class="info-row">
                                    <span class="info-label">Notes:</span>
                                    <span class="info-value">{{ $invoice->notes }}</span>
                                </div>
                                @endif
                            </div>
                            @endif
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    console.log('Invoice details page loaded');
    
    // Add any additional JavaScript functionality here
});
</script>
@endsection