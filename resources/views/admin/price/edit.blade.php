@extends('admin.layouts.default')

@section('content')
<div class="content-wrapper">
    <section class="content">

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Price</h3>
                <a href="{{ URL::to('admin/price') }}" class="btn pull-right">Back</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::model($price, ['method' => 'PATCH', 'url' => URL::to('admin/price/'.$price->id), 'class'=>"form-horizontal",'id'=>'priceform']) !!}
            @include('admin.partials.message')

            <div class="box-body">

                <div class="form-group">
                    <label for="product_type" class="col-sm-2 control-label">Product Type</label>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{ ucfirst($price->product_type) }}" disabled>
                            <input type="hidden" name="product_type" value="{{ $price->product_type }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="licence_type" class="col-sm-2 control-label">License Type</label>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{ $price->licenceType->licence_name ?? 'N/A' }}" disabled>
                            <input type="hidden" name="license_type" value="{{ $price->license_type }}">
                        </div>
                    </div>
                </div>

                <!-- Image Prices -->
                <div class="image-prices price-section" style="display:{{ $price->product_type == 'image' ? 'block' : 'none' }};">
                    <div class="form-group">
                        <label for="small_image_price" class="col-sm-2 control-label">Small Image Price</label>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="number" step="0.01" min="0.01" class="form-control" name="small_image_price" id="small_image_price" value="{{ $price->small_image_price }}" placeholder="Enter small image price">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="medium_image_price" class="col-sm-2 control-label">Medium Image Price</label>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="number" step="0.01" min="0.01" class="form-control" name="medium_image_price" id="medium_image_price" value="{{ $price->medium_image_price }}" placeholder="Enter medium image price">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="large_image_price" class="col-sm-2 control-label">Large Image Price</label>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="number" step="0.01" min="0.01" class="form-control" name="large_image_price" id="large_image_price" value="{{ $price->large_image_price }}" placeholder="Enter large image price">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="extra_large_image_price" class="col-sm-2 control-label">Extra Large Image Price</label>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="number" step="0.01" min="0.01" class="form-control" name="extra_large_image_price" id="extra_large_image_price" value="{{ $price->extra_large_image_price }}" placeholder="Enter extra large image price">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footage Prices -->
                <div class="footage-prices price-section" style="display:{{ $price->product_type == 'footage' ? 'block' : 'none' }};">
                    <div class="form-group">
                        <label for="high_resolution_footage_price" class="col-sm-2 control-label">High Resolution Footage Price</label>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="number" step="0.01" min="0.01" class="form-control" name="high_resolution_footage_price" id="high_resolution_footage_price" value="{{ $price->high_resolution_footage_price }}" placeholder="Enter high resolution footage price">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="4k_footage_price" class="col-sm-2 control-label">4K Footage Price</label>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="number" step="0.01" min="0.01" class="form-control" name="4k_footage_price" id="4k_footage_price" value="{{ $price['4k_footage_price'] }}" placeholder="Enter 4K footage price">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Music Price -->
                <div class="music-prices price-section" style="display:{{ $price->product_type == 'music' ? 'block' : 'none' }};">
                    <div class="form-group">
                        <label for="music_price" class="col-sm-2 control-label">Music Price</label>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="number" step="0.01" min="0.01" class="form-control" name="music_price" id="music_price" value="{{ $price->music_price }}" placeholder="Enter music price">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="{{ URL::to('admin/price') }}">
                    <button type="button" class="btn btn-default" id="cancelButton">Cancel</button>
                </a>
                {!! Form::submit('Update', array('class' => 'btn btn-info', 'id' => 'submitButton')) !!}
            </div>
            <!-- /.box-footer -->
            {!! Form::close() !!}
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('scripts')
<script src="{{ asset('js/formvalidation/formValidation.min.js') }}"></script>
<script src="{{ asset('js/formvalidation/framework/bootstrap.min.js') }}"></script>

<script>
    $(document).ready(function() {

        // Form validation
        var fv = $('#priceform').formValidation({
            framework: "bootstrap",
            button: {
                selector: '#submitButton',
                disabled: 'disabled'
            },
            icon: null,
            fields: {
                small_image_price: {
                    validators: {
                        greaterThan: {
                            value: 0,
                            message: 'Price must be greater than 0'
                        }
                    }
                },
                medium_image_price: {
                    validators: {
                        greaterThan: {
                            value: 0,
                            message: 'Price must be greater than 0'
                        }
                    }
                },
                large_image_price: {
                    validators: {
                        greaterThan: {
                            value: 0,
                            message: 'Price must be greater than 0'
                        }
                    }
                },
                extra_large_image_price: {
                    validators: {
                        greaterThan: {
                            value: 0,
                            message: 'Price must be greater than 0'
                        }
                    }
                },
                high_resolution_footage_price: {
                    validators: {
                        greaterThan: {
                            value: 0,
                            message: 'Price must be greater than 0'
                        }
                    }
                },
                '4k_footage_price': {
                    validators: {
                        greaterThan: {
                            value: 0,
                            message: 'Price must be greater than 0'
                        }
                    }
                },
                music_price: {
                    validators: {
                        greaterThan: {
                            value: 0,
                            message: 'Price must be greater than 0'
                        }
                    }
                }
            }
        }).data('formValidation');

         var currentPriceId = '{{ $price->id }}';
        // Custom validation on form submit
        $('#priceform').on('submit', function(e) {
            var productType = $('input[name="product_type"]').val();
                        var licenseType = $('input[name="license_type"]').val();
            var isDuplicate = false;
            $.ajax({
                url: '{{ route("admin.price.check-duplicate") }}',
                method: 'POST',
                async: false, // Make synchronous to prevent form submission
                data: {
                    _token: '{{ csrf_token() }}',
                    product_type: productType,
                    license_type: licenseType,
                    exclude_id: currentPriceId
                },
                success: function(response) {
                    if (response.exists) {
                        isDuplicate = true;
                    }
                }
            });
            if (isDuplicate) {
                e.preventDefault();
                alert('A price already exists for this license type and product type combination!');
                return false;
            }

            if (productType === 'image') {
                var hasImagePrice = $('#small_image_price').val() ||
                    $('#medium_image_price').val() ||
                    $('#large_image_price').val() ||
                    $('#extra_large_image_price').val();

                if (!hasImagePrice) {
                    e.preventDefault();
                    alert('Please enter at least one image price.');
                    return false;
                }
            } else if (productType === 'footage') {
                var hasFootagePrice = $('#high_resolution_footage_price').val() ||
                    $('#4k_footage_price').val();

                if (!hasFootagePrice) {
                    e.preventDefault();
                    alert('Please enter at least one footage price.');
                    return false;
                }
            } else if (productType === 'music') {
                var hasMusicPrice = $('#music_price').val();

                if (!hasMusicPrice) {
                    e.preventDefault();
                    alert('Please enter music price.');
                    return false;
                }
            }
        });

    });
</script>
@stop
