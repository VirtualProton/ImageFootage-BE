@extends('admin.layouts.default')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Package
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Edit Package</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Package</h3><a href="{{ URL::to('admin/package_list') }}" class="btn pull-right">Back</a>
          </div>
          @if(session()->has('success'))
          <div class="alert alert-success">
            {{ session()->get('success') }}
          </div>
          @endif
          @if(session()->has('error'))
          <div class="alert alert-danger">
            {{ session()->get('error') }}
          </div>
          @endif
          <form action="{{ url('admin/editpackage') }}" role="form" method="post" enctype="multipart/form-data" id="productform">
            <input type="hidden" class="form-control" name="package_id" id="package_id" value="{{ $package[0]['package_id'] }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="box-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Package Plan </label>
                <select class="form-control" name="package_plan" id="package_plan">
                  <option value="1" @if($package[0]['package_plan']=='1' ) selected="selected" @endif>Download Pack</option>
                  <option value="2" @if($package[0]['package_plan']=='2' ) selected="selected" @endif>Subscription</option>
                </select>
                @if ($errors->has('package_plan'))
                <div class="has_error" style="color:red;">{{ $errors->first('package_plan') }}</div>
                @endif
              </div>

              <div class="form-group">
                  <label for="exampleInputEmail1">Package Type</label>
                  <select type="text" class="form-control" name="package_type" id="package_type">
                      <option value="Image" @if($package[0]['package_type']=='Image' ) selected="selected" @endif>Image</option>
                      <option value="Footage" @if($package[0]['package_type']=='Footage' ) selected="selected" @endif>Footage</option>
                      <option value="Music" @if($package[0]['package_type']=='Music' ) selected="selected" @endif>Music</option>
                  </select>
              </div>
              @if ($errors->has('package_type'))
                  <div class="has_error" style="color:red;">{{ $errors->first('package_type') }}</div>
              @endif

              <div class="form-group" id="package_size">
                <label for="exampleInputEmail1">HD/4k </label>
                <select class="form-control" name="pacage_size" id="pacage_size">
                  <option value="1" @if($package[0]['pacage_size']=='1' ) selected="selected" @endif>HD</option>
                  <option value="2" @if($package[0]['pacage_size']=='2' ) selected="selected" @endif>4K</option>
                </select>
                @if ($errors->has('pacage_size'))
                <div class="has_error" style="color:red;">{{ $errors->first('pacage_size') }}</div>
                @endif
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Package Name </label>
                <input type="text" class="form-control" name="package_name" id="package_name" placeholder="Package name" value="{{ $package[0]['package_name'] }}">
                @if ($errors->has('package_name'))
                <div class="has_error" style="color:red;">{{ $errors->first('package_name') }}</div>
                @endif
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Package Price</label>
                <input type="text" class="form-control" name="package_price" id="package_price" placeholder="Package Price" value="{{ $package[0]['package_price'] }}">
              </div>
              @if ($errors->has('package_price'))
              <div class="has_error" style="color:red;">{{ $errors->first('package_price') }}</div>
              @endif

              <div class="form-group">
                <label for="exampleInputPassword1">Package Description</label>
                <textarea type="text" class="form-control" name="package_description" id="package_description" placeholder="Package Description">{{ $package[0]['package_description'] }}</textarea>
                @if ($errors->has('package_description'))
                <div class="has_error" style="color:red;">{{ $errors->first('package_description') }}</div>
                @endif
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Package Products Count</label>
                <input type="text" class="form-control" name="package_products_count" id="package_products_count" placeholder="Package Products Count" value="{{ $package[0]['package_products_count'] }}">
              </div>
              @if ($errors->has('package_products_count'))
              <div class="has_error" style="color:red;">{{ $errors->first('package_products_count') }}</div>
              @endif
              <div id="for_pro" @if($package[0]['package_permonth_download']=='Pro' ) style="display:block" elseif style="display:none;" @endif>
                <div class="form-group">
                  <label for="exampleInputEmail1">Per Month Download</label>
                  <input type="text" class="form-control" name="package_month_count" id="package_month_count" placeholder="Products per month Count" value="{{ $package[0]['package_permonth_download'] }}">
                </div>
                @if ($errors->has('package_month_count'))
                <div class="has_error" style="color:red;">{{ $errors->first('package_month_count') }}</div>
                @endif
                <div class="form-group">
                  <label for="exampleInputEmail1">Products Carry Forward <input type="checkbox" name="products_carry_forward" id="products_carry_forward" value="yes" @if($package[0]['package_pcarry_forward']=='yes' ) checked="checked" @endif /> </label>

                </div>
              </div>

              <div class="form-group" id="footageTierDiv">
                <label for="exampleInputEmail1"> Footage Package Type</label>
                <select type="text" class="form-control" name="footage_tier" id="footage_tier">
                  <option value="1" @if($package[0]['footage_tier']=='1' ) selected="selected" @endif>Commercial</option>
                  <option value="2" @if($package[0]['footage_tier']=='2' ) selected="selected" @endif>Media Non-commercial (Editorial)</option>
                  <option value="3" @if($package[0]['footage_tier']=='3' ) selected="selected" @endif>Digital</option>
                  <option value="4" @if($package[0]['footage_tier']=='4' ) selected="selected" @endif>Full RF Licence</option>
                </select>
              </div>
              @if ($errors->has('footage_tier'))
              <div class="has_error" style="color:red;">{{ $errors->first('footage_tier') }}</div>
              @endif

              <div class="form-group" id="musicTierDiv">
                <label for="exampleInputEmail1"> Music Package Type</label>
                <select type="text" class="form-control" name="music_tier" id="music_tier">
                  <option value="1" @if($package[0]['footage_tier']=='1' ) selected="selected" @endif>Standard</option>
                  <option value="2" @if($package[0]['footage_tier']=='2' ) selected="selected" @endif>Extended</option>
                  <option value="3" @if($package[0]['footage_tier']=='3' ) selected="selected" @endif>Digital</option>
                </select>
              </div>
              @if ($errors->has('footage_tier'))
              <div class="has_error" style="color:red;">{{ $errors->first('footage_tier') }}</div>
              @endif

              <div class="form-group">
                <label for="exampleInputPassword1">Package Expiry in Months</label>
                <input type="text" class="form-control" name="package_expiry" id="package_expiry" placeholder="Package Expiry in Months" value="{{ $package[0]['package_expiry'] }}">
              </div>
              @if ($errors->has('package_expiry'))
              <div class="has_error" style="color:red;">{{ $errors->first('package_expiry') }}</div>
              @endif
              <div class="form-group">
                <label for="exampleInputPassword1">Package Expiry Per Year</label>
                <input type="text" class="form-control" name="package_expiry_year" id="package_expiry_year" placeholder="Package Expiry Per Year" value="{{ $package[0]['package_expiry_yearly'] }}">
              </div>
              @if ($errors->has('package_expiry_year'))
              <div class="has_error" style="color:red;">{{ $errors->first('package_expiry_year') }}</div>
              @endif
              <div class="form-group">
                <label for="display_for">Display For</label>
                <select class="form-control" name="display_for" id="display_for">
                  <option value="3" @if($package[0]['display_for']=='3' ) selected="selected" @endif>All</option>
                  <option value="1" @if($package[0]['display_for']=='1' ) selected="selected" @endif>Frontend</option>
                  <option value="2" @if($package[0]['display_for']=='2' ) selected="selected" @endif>Backend</option>
                  <option value="4" @if($package[0]['display_for']=='4' ) selected="selected" @endif>User Specific</option>
                </select>
              </div>
              @if ($errors->has('display_for'))
              <div class="has_error" style="color:red;">{{ $errors->first('display_for') }}</div>
              @endif
              <div class="form-group">
                <label for="exampleInputEmail1">Status</label>
                <select class="form-control" name="package_status">
                  <option value="Active" {{ $package[0]['package_status'] == 'Active' ? 'selected' : '' }}>Active</option>
                  <option value="Inactive" {{ $package[0]['package_status'] == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @if($errors->has('package_status'))
                <div class="has_error" style="color:red;">{{ $errors->first('package_status') }}</div>
                @endif
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" id="validateButton2">Save</button>
              <a href="{{ url('admin/package_list') }}" class="btn btn-primary">Back</a>
            </div>
          </form>
        </div>
      </div>
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
  //sub_product_type
  $('.product_type').click(function() {
    if ($(this).is(":checked")) {
      var ptype = $(this).val();
      if (ptype == 'Image' || ptype == 'Editorial') {
        $("#sub_product_type").css("display", "block");
      } else {
        $("#sub_product_type").css("display", "none");
      }
    }
  });
  $("#product_category").on('change', function() {
    var prod_id = $(this).val();
    var csrf = '{{ csrf_token() }}';
    $.ajax({
      url: '{{ url("admin/get_related_subcat") }}',
      type: 'POST',
      data: {
        'prod_id': prod_id,
        '_token': csrf
      },
      success: function(data) {
        $("#product_sub_category").html('');
        $("#product_sub_category").html(data);
      }
    });
  });
</script>
<script>
  $(document).ready(function($) {
    togglePackageSizeVisibility();
        document.getElementById('package_type').addEventListener('change', function () {
        togglePackageSizeVisibility();
    });
    setPackageExpiry();

    function togglePackageSizeVisibility() {
       /*  var packageType = document.getElementById('package_type').value;
        var pacageSizeDiv = document.getElementById('pacage_size_div');
        pacageSizeDiv.style.display = (packageType === 'Music') ? 'none' : 'block'; */
    }

    var pack_type = $("#package_plan").val();
    var package_type = $("#package_type").val();
    if (package_type == 'Footage') {
        $('#musicTierDiv').hide();
        $("#footageTierDiv").show();
        $('#package_size').show();
    } else if(package_type == 'Music'){
        $("#footageTierDiv").hide();
        $('#musicTierDiv').show();
        $('#package_size').hide();
    }
     else {
        $('#musicTierDiv').hide();
        $("#footageTierDiv").hide();
        $('#package_size').hide();
    }
    if($('#display_for').val() == 3 ||$('#display_for').val() == 2 ){
        $('#music_tier').find('option[value=\'3\']').css('display','block');
    }else {
        $('#music_tier').val('1');
        $('#music_tier').find('option[value=\'3\']').css('display','none');
    }

    // Example Validataion Standard Mode
    // ---------------------------------
    (function() {

      var i = 1;

      $('#productform').formValidation({
        framework: "bootstrap",
        button: {
          selector: '#validateButton2',
          disabled: 'disabled'
        },
        icon: null,
        fields: {
          package_name: {
            validators: {
              notEmpty: {
                message: 'Package name is required.'
              }
            }
          },
          package_price: {
            validators: {
              notEmpty: {
                message: 'Package price is required.'
              },
              numeric: {
                message: 'The value must be an integer.'
              }
            }
          },
          package_description: {
            validators: {
              notEmpty: {
                message: 'Package description is required.'
              }
            }
          },
          package_products_count: {
            validators: {
              notEmpty: {
                message: 'Package products count is required.'
              },
              numeric: {
                message: 'The value must be an integer.'
              }
            }
          },
          package_type: {
            validators: {
              stringLength: {
                message: 'Package type is required.'
              }
            }
          },
          display_for: {
            validators: {
              stringLength: {
                message: 'Display for is required.'
              }
            }
          },
        }
      });
    })();

  });
  $("#package_plan").change(function() {

    var pack_type = $(this).val();
    const dropdown = $('#package_type');
    const optionToHide = dropdown.find('option[value=\'Footage\']');
    const secondOptionToHide = dropdown.find('option[value=\'Music\']');
    if (pack_type == '1') {
        optionToHide.css('display', 'block');
        secondOptionToHide.css('display', 'block');
        $("#package_month_count").val("");
        $('#for_pro').css('display', 'none');
    } else {
        optionToHide.css('display', 'none');
        secondOptionToHide.css('display', 'none');
        dropdown.val('Image')
        $('#for_pro').css('display', 'block');
    }

  });
  $("#package_type").change(function() {
    var pack_type = $(this).val();
    if (pack_type == 'Footage') {
        $('#musicTierDiv').hide();
        $("#footageTierDiv").show();
        $('#package_plan').val('1')
        $('#package_size').show()
    }else if(pack_type == 'Music'){
        $("#footageTierDiv").hide();
        $('#musicTierDiv').show();
        $('#package_plan').val('1')
        $('#package_size').hide()
    }
     else {
        $('#musicTierDiv').hide();
        $("#footageTierDiv").hide();
        $('#package_size').hide()
    }
  });
  $("#display_for").change(function() {
    var type = $(this).val();
    if(type == '2' || type == '3'){
        $('#music_tier').find('option[value=\'3\']').css('display','block');
    }else{
        $('#music_tier').val('1');
        $('#music_tier').find('option[value=\'3\']').css('display','none');
    }
  })
  $('#package_expiry').on('input', function() {
    checkPackageExpiry();
    });

    $('#package_expiry_year').on('input', function() {
      checkPackageExpiryYear();
    });

  function checkPackageExpiry() {
      var packageExpiryValue = $('#package_expiry').val();
      console.log(packageExpiryValue);
      var packageExpiryYearInput = $('#package_expiry_year');

      // Check if package_expiry is 1 or 2
      if (packageExpiryValue != 0) {
        // Disable and set value to 0 for package_expiry_year
        packageExpiryYearInput.prop('disabled', true);
        packageExpiryYearInput.val(0);
      } else {
        // Enable package_expiry_year
        packageExpiryYearInput.val('');
        packageExpiryYearInput.prop('disabled', false);
      }
    }

    function checkPackageExpiryYear() {
      var packageExpiryYearValue = $('#package_expiry_year').val();
      var packageExpiryInput = $('#package_expiry');

      // Check if package_expiry_year is filled
      if (packageExpiryYearValue != 0) {
        // Disable and set value to 0 for package_expiry
        packageExpiryInput.prop('disabled', true);
        packageExpiryInput.val(0);
      } else {
        // Enable package_expiry
        packageExpiryInput.val('')
        packageExpiryInput.prop('disabled', false);
      }
    }
    function setPackageExpiry(){
        var packageExpiryValue = $('#package_expiry').val();
        var packageExpiryYearValue = $('#package_expiry_year').val();
        var packageExpiryYearInput = $('#package_expiry_year');
        var packageExpiryInput = $('#package_expiry');
        if (packageExpiryValue != 0) {
        // Disable and set value to 0 for package_expiry_year
        packageExpiryYearInput.prop('disabled', true);
        packageExpiryYearInput.val(0);
      } else{
        packageExpiryInput.prop('disabled', true);
        packageExpiryInput.val(0);
      }
    }
</script>
@endsection
