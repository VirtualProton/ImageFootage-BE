@extends('admin.layouts.default')

@section('content')
<div class="content-wrapper">
    <section class="content">

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Add Price</h3>
                <a href="{{ URL::to('admin/price') }}" class="btn pull-right">Back</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(array('url' => URL::to('admin/price'), 'method' => 'post', 'class'=>"form-horizontal",'id'=>'priceform')) !!}
            @include('admin.partials.message')

            <div class="box-body">
                <div class="form-group" id="productTypeButton">
                    <label for="product_type" class="col-sm-2 control-label">Product Type</label>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <select class="form-control" name="product_type" id="product_type">
                                <option value="">Select</option>
                                <option value="image">Image</option>
                                <option value="footage">Footage</option>
                                <option value="music">Music</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="licence_type" class="col-sm-2 control-label">License Type</label>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <select class="form-control" name="license_type" id="license_type">
                                <option value="">-- Select Product Type First --</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Image Prices -->
                <div class="image-prices price-section" style="display:none;">
                    <div class="form-group">
                        <label for="small_image_price" class="col-sm-2 control-label">Small Image Price</label>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="number" step="0.01" class="form-control" name="small_image_price" id="small_image_price" placeholder="Enter small image price">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="medium_image_price" class="col-sm-2 control-label">Medium Image Price</label>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="number" step="0.01" class="form-control" name="medium_image_price" id="medium_image_price" placeholder="Enter medium image price">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="large_image_price" class="col-sm-2 control-label">Large Image Price</label>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="number" step="0.01" class="form-control" name="large_image_price" id="large_image_price" placeholder="Enter large image price">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="extra_large_image_price" class="col-sm-2 control-label">Extra Large Image Price</label>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="number" step="0.01" class="form-control" name="extra_large_image_price" id="extra_large_image_price" placeholder="Enter extra large image price">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footage Prices -->
                <div class="footage-prices price-section" style="display:none;">
                    <div class="form-group">
                        <label for="high_resolution_footage_price" class="col-sm-2 control-label">High Resolution Footage Price</label>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="number" step="0.01" class="form-control" name="high_resolution_footage_price" id="high_resolution_footage_price" placeholder="Enter high resolution footage price">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="4k_footage_price" class="col-sm-2 control-label">4K Footage Price</label>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="number" step="0.01" class="form-control" name="4k_footage_price" id="4k_footage_price" placeholder="Enter 4K footage price">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Music Price -->
                <div class="music-prices price-section" style="display:none;">
                    <div class="form-group">
                        <label for="music_price" class="col-sm-2 control-label">Music Price</label>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="number" step="0.01" class="form-control" name="music_price" id="music_price" placeholder="Enter music price">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="{{ URL::previous() }}">
                    <button type="button" class="btn btn-default" id="cancelButton">Cancel</button>
                </a>
                {!! Form::submit('Submit', array('class' => 'btn btn-info', 'id' => 'submitButton')) !!}
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

        // License types data (passed from controller)
        var licenseTypes = @json($licenceTypes);

        // Form validation
        var fv = $('#priceform').formValidation({
            framework: "bootstrap",
            button: {
                selector: '#submitButton',
                disabled: 'disabled'
            },
            icon: null,
            fields: {
                product_type: {
                    validators: {
                        notEmpty: {
                            message: 'Product type is required'
                        }
                    }
                },
                license_type: {
                    validators: {
                        notEmpty: {
                            message: 'License type is required'
                        }
                    }
                },
                small_image_price: {
                    validators: {
                        greaterThan: {
                            value: 0.01,
                            message: 'Price must be greater than 0'
                        }
                    }
                },
                medium_image_price: {
                    validators: {
                        greaterThan: {
                            value: 0.01,
                            message: 'Price must be greater than 0'
                        }
                    }
                },
                large_image_price: {
                    validators: {
                        greaterThan: {
                            value: 0.01,
                            message: 'Price must be greater than 0'
                        }
                    }
                },
                extra_large_image_price: {
                    validators: {
                        greaterThan: {
                            value: 0.01,
                            message: 'Price must be greater than 0'
                        }
                    }
                },
                high_resolution_footage_price: {
                    validators: {
                        greaterThan: {
                            value: 0.01,
                            message: 'Price must be greater than 0'
                        }
                    }
                },
                '4k_footage_price': {
                    validators: {
                        greaterThan: {
                            value: 0.01,
                            message: 'Price must be greater than 0'
                        }
                    }
                },
                music_price: {
                    validators: {
                        greaterThan: {
                            value: 0.01,
                            message: 'Price must be greater than 0'
                        }
                    }
                }
            }
        }).data('formValidation');

        // Handle product type change
        $('#product_type').on('change', function() {
            var selectedType = $(this).val();
            var productTypeId = 0;

            // Map product type to ID
            if (selectedType === 'image') {
                productTypeId = 1;
            } else if (selectedType === 'footage') {
                productTypeId = 2;
            } else if (selectedType === 'music') {
                productTypeId = 3;
            }

            // Reset and populate license type dropdown
            $('#license_type').html('<option value="">-- Select License Type --</option>');

            if (productTypeId > 0) {
                var filteredLicenses = licenseTypes.filter(function(license) {
                    return license.product_type == productTypeId;
                });

                filteredLicenses.forEach(function(license) {
                    $('#license_type').append(
                        '<option value="' + license.id + '">' + license.licence_name + '</option>'
                    );
                });
            }

            // Reset the license type field validation
            fv.resetField('license_type');

            // Hide all price sections and disable inputs
            $('.price-section').hide();
            $('.price-section input').prop('disabled', true).val('');

            // Show selected price section and enable inputs
            if (selectedType === 'image') {
                $('.image-prices').show();
                $('.image-prices input').prop('disabled', false);
            } else if (selectedType === 'footage') {
                $('.footage-prices').show();
                $('.footage-prices input').prop('disabled', false);
            } else if (selectedType === 'music') {
                $('.music-prices').show();
                $('.music-prices input').prop('disabled', false);
            }
            checkDuplicateCombination();
        });

        // Function to check duplicate product type and license type combination
        // Check duplicate when license type changes
        $('#license_type').on('change', function() {
            checkDuplicateCombination();
        });
        // Function to check if combination already exists
        function checkDuplicateCombination() {
            var productType = $('#product_type').val();
            var licenseType = $('#license_type').val();
            if (productType && licenseType) {
                $.ajax({
                    url: '{{ route("admin.price.check-duplicate") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_type: productType,
                        license_type: licenseType
                    },
                    success: function(response) {
                        if (response.exists) {
                            alert('A price already exists for this license type and product type combination!');
                            $('#submitButton').prop('disabled', true);
                        } else {
                            $('#submitButton').prop('disabled', false);
                        }
                    }
                });
            }
        }

        // Custom validation on form submit
        $('#priceform').on('submit', function(e) {
            var productType = $('#product_type').val();

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
