<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
<section class="content">

<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add Account</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php echo Form::open(array('url' => URL::to('admin/accounts'), 'method' => 'post', 'class'=>"form-horizontal",'id'=>'adminform','files'=> true,'autocomplete'=>false)); ?>

              <?php echo $__env->make('admin.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

              <div class="box-body">
              <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Account Name</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" name="account_name" id="account_name" placeholder="Name">
                  <?php echo e(csrf_field()); ?>

                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                </div>
                  </div>
                </div>
                  <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Phone</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Website</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" name="website" id="website" placeholder="Website">
                </div>
            </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Billing Country</label>

                  <div class="col-sm-4">
                <div class="form-group">
                 <select class="form-control" name="bill_country" id="bill_country" onchange="getstate(this)">
                    <option  value="">Select</option>
                    <?php if(count($countries) > 0): ?>
                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value=<?php echo e($country->id); ?>><?php echo e($country->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                  </select>
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Billing State</label>

                  <div class="col-sm-4">
                  <div class="form-group">

                  <select class="form-control" name="bill_state" id="bill_state" onchange="getcity(this)">
                    <option value="">Select</option>

                  </select>
                </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Billing City</label>

                  <div class="col-sm-4">
                  <div class="form-group">

                  <select class="form-control" name="bill_city" id="bill_city">
                    <option value="">Select</option>

                  </select>
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Billing Address</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <textarea name="bill_address" id="bill_address" style="width:422px;height:74px;"></textarea>
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Billing Postal</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" id="bill_postal" name="bill_postal" placeholder="Postal Code">
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Industry Type</label>

                  <div class="col-sm-4">
                  <div class="form-group">

                  <select class="form-control" name="industry_type_id" id="industry_type_id">
                    <option value="">Select</option>
                    <?php if(count($industry_types) > 0): ?>
                    <?php $__currentLoopData = $industry_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $types): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value=<?php echo e($types->id); ?>><?php echo e($types->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                  </select>
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Curruncy</label>

                  <div class="col-sm-4">
                  <div class="form-group">

                  <select class="form-control" name="curruncy_id" id="curruncy_id">
                    <option value="">Select</option>
                    <?php if(count($curruncies) > 0): ?>
                    <?php $__currentLoopData = $curruncies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value=<?php echo e($cur->id); ?>><?php echo e($cur->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                  </select>
                </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Global Region</label>

                  <div class="col-sm-4">
                  <div class="form-group">

                  <select class="form-control" name="global_region" id="global_region">
                    <option value="">Select</option>
                    <option value="AS">AS</option>
                    <option value="UAE">UAE</option>
                    <option value="US">US</option>
                    <option value="UK">UK</option>
                    <option value="AU">AU</option>

                  </select>
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Local Region</label>

                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" id="domestic_region" name="domestic_region" value="IN" readonly placeholder="Postal Code">
                </div>
                  </div>
                </div>

</div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="button" class="btn btn-default">Cancel</button>
                <?php echo Form::submit('Submit', array('class' => 'btn btn-info', 'id' => 'validateButton2')); ?>

              </div>
              <!-- /.box-footer -->
              <?php echo Form::close(); ?>

          </div>

    </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('js/formvalidation/formValidation.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/formvalidation/framework/bootstrap.min.js')); ?>"></script>
<script>

$(document).ready(function ($) {

   // Example Validataion Standard Mode
    // ---------------------------------
    (function () {

        var i = 1;

        $('#adminform').formValidation({
            framework: "bootstrap",
            button: {
                selector: '#validateButton2',
                disabled: 'disabled'
            },
            icon: null,
            fields: {
                account_name: {
                    validators: {
                        notEmpty: {
                            message: 'Account Name is required'
                        }
                    }
                },

                email: {
                 validators: {
                notEmpty: {
                  message: 'The email address is required and cannot be empty'
                },
                emailAddress: {
                  message: 'The email address is not valid'
                }
              }
            },

            phone: {
              validators: {
                notEmpty: {
                  message: 'The phone number is required and cannot be empty'
                },
                digits: {
                    message: 'Please enter only digits'
                },
                stringLength:{
                    min:10,
                    max:10,
                    message: 'Mobile number length should be 10 digits'
                }
              }
             },
             website: {
                    validators: {
                        uri: {
                            message: 'Please enter valid URL.'
                        }
                    }
                },
             bill_country: {
                    validators: {
                        notEmpty: {
                            message: 'Billing country is required'
                        }
                    }
                },
             bill_state: {
                    validators: {
                        notEmpty: {
                            message: 'Billing state is required'
                        }
                    }
                },
            bill_city: {
                    validators: {
                        notEmpty: {
                            message: 'Billing city is required'
                        }
                    }
                },
             bill_address: {
                    validators: {
                        notEmpty: {
                            message: 'Address is required'
                        }
                    }
                },
                bill_postal: {
                    validators: {
                        notEmpty: {
                            message: 'Bill postal is required'
                        },
                        digits: {
                            message: 'Please enter only digits'
                        },
                    }
                },
                industry_type_id: {
                    validators: {
                        notEmpty: {
                            message: 'Industry Type is required'
                        }
                    }
                },
                curruncy_id: {
                    validators: {
                        notEmpty: {
                            message: 'Curruncy is required'
                        }
                    }
                },
                global_region: {
                    validators: {
                        notEmpty: {
                            message: 'Global region is required'
                        }
                    }
                },

            }
        });
    })();

});

function getstate(data){
   $.ajax({
            url: '<?php echo e(URL::to("admin/getStatesByCounty")); ?>',
            data: {
            country_code: data.value,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            error: function() {
            //$('#info').html('<p>An error has occurred</p>');
            },
            success: function(data) {
               console.log(data);
               if(data.response=='success'){
                  var option='<option value="">Please Select</option>';
                $.each(data.data, function( i, val ) {
                     option = option+'<option value="'+val.id+'">'+val.state+'</option>';
                });
                $('#bill_state').html(option);
               }

            },
            type: 'POST'
            });
}
function getcity(data){
    console.log(data.value);
    $.ajax({
            url: '<?php echo e(URL::to("admin/getCityByState")); ?>',
            data: {
            state_code: data.value,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            error: function() {
            //$('#info').html('<p>An error has occurred</p>');
            },
            success: function(data) {
               console.log(data);
               if(data.response=='success'){
                  var option='<option value="">Please Select</option>';
                $.each(data.data, function( i, val ) {
                     option = option+'<option value="'+val.id+'">'+val.name+'</option>';
                });
                $('#bill_city').html(option);
               }

            },
            type: 'POST'
            });
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\imagefootage\imagefootagenew\resources\views/admin/account/create.blade.php ENDPATH**/ ?>