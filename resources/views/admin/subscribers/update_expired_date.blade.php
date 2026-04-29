@extends('admin.layouts.default')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Edit Subcription Expiration Date
        </h1>
        <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Subcription Expiration Date</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title">Edit Subcription Expiration Date</h3><a href="{{ URL::to('admin/subscribers') }}" class="btn pull-right">Back</a>
                </div>
            @if( Session::has( 'success' ))
                {{ Session::get( 'success' ) }}
            @elseif( Session::has( 'warning' ))
                {{ Session::get( 'warning' ) }} <!-- here to 'withWarning()' -->
            @endif
                <form action="{{ route('updateExpiredDate') }}" role="form" method="post" id="productform">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" class="form-control" name="user_transaction_id" id="user_transaction_id"  value="{{ $UserPackage->id }}">

                    @php
                        $baseExpiryDate = !empty($UserPackage->package_expiry_date_from_purchage) ? date('Y-m-d', strtotime($UserPackage->package_expiry_date_from_purchage)) : null;
                        $extendedExpiryDate = !empty($UserPackage->package_extended_expiry_data) ? date('Y-m-d', strtotime($UserPackage->package_extended_expiry_data)) : null;
                        $extendedDays = 0;

                        if ($baseExpiryDate && $extendedExpiryDate) {
                            $extendedDays = max(
                                \Carbon\Carbon::parse($baseExpiryDate)->diffInDays(\Carbon\Carbon::parse($extendedExpiryDate), false),
                                0
                            );
                        }
                    @endphp

                    <div class="box-body">
                    <div class="form-group">
                        <div style="font-size:14px; color:#666; line-height:1.8;">
                            <div><strong>Expiry date:</strong> {{ $baseExpiryDate ?? '-' }}</div>
                            @if($extendedExpiryDate)
                            <div><strong>Extended expiry date:</strong> {{ $extendedExpiryDate ?? '-' }}</div>
                            <div><strong>Days extended:</strong> {{ $extendedDays }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="extend_expiry_option">Extend Expiry</label>
                        <select class="form-control js-extend-expiry-select" name="extend_expiry_option" id="extend_expiry_option">
                            <option value="">Select days</option>
                            <option value="15">15 Days</option>
                            <option value="30">30 Days</option>
                            <option value="45">45 Days</option>
                            <option value="60">60 Days</option>
                            <option value="custom">Custom Days</option>
                        </select>
                        @if ($errors->has('extend_expiry_option'))
                            <div class="has_error" style="color:red;">{{ $errors->first('extend_expiry_option') }}</div>
                        @endif
                    </div>
                    <div class="form-group js-custom-expiry-wrapper" style="display:none;">
                        <label for="custom_days">Custom Days</label>
                        <input type="number" min="1" class="form-control js-custom-expiry-days" name="custom_days" id="custom_days" placeholder="" value="">
                    </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" id="validateButton2">Save</button>
                        @if($extendedExpiryDate)
                        <button type="submit" name="reset_extended_expiry" value="1" class="btn btn-default" onclick="return confirm('Reset the extended expiry date?');">Reset Extended Date</button>
                        @endif
                        <a href="{{ url('/admin/dashboard') }}" class="btn btn-primary">Back</a>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </section>
<!-- /.content -->
</div>
<script>
document.addEventListener('change', function(event) {
    if (!event.target.classList.contains('js-extend-expiry-select')) {
        return;
    }
    var wrapper = document.querySelector('.js-custom-expiry-wrapper');
    var input = document.querySelector('.js-custom-expiry-days');
    if (!wrapper || !input) {
        return;
    }
    if (event.target.value === 'custom') {
        wrapper.style.display = 'block';
        input.required = true;
        input.focus();
    } else {
        wrapper.style.display = 'none';
        input.required = false;
        input.value = '';
    }
});
</script>
@endsection
