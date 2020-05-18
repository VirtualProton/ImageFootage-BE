@extends('admin.layouts.default')

@section('content')
<div class="content-wrapper">
<section class="content">

<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Account </h3><a href="{{ URL::to('admin/users') }}" class="btn pull-right">Back</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(array('url' => URL::to('admin/users/'.$user_data['id']),  'method' => 'PUT', 'class'=>"form-horizontal",'id'=>'adminform','files'=> true,'autocomplete'=>false)) !!}
              @include('admin.partials.message')
              <div class="box-body">
              <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">First Name</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="<?php echo $user_data['first_name']?>">
                  {{ csrf_field() }}
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Last Name</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="<?php echo $user_data['last_name']?>">
                </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Title</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?php echo $user_data['title']?>">
                </div>
                  </div>
                </div>
                  <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">User Name</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" name="user_name" id="user_name" placeholder="User Name" value="<?php echo $user_data['user_name']?>">
                </div>
                </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Contact Owner</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" name="contact_owner" id="contact_owner" placeholder="Contact Owner" value="<?php echo $user_data['contact_owner']?>">
                </div>
                </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Account Manager</label>

                  <div class="col-sm-4">
                  <div class="form-group">

                  <select class="form-control" name="account_manager_id" id="account_manager_id">
                    <option value="">Select</option>
                    @if(count($accountlist) > 0)
                    @foreach($accountlist as $account)
                    <option value={{ $account['id'] }} <?php if($user_data['account_manager_id']==$account['id']){echo 'selected="selected"';}?>>{{$account['account_name']}}</option>
                    @endforeach
                    @endif
                  </select>
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Phone</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="<?php echo $user_data['phone']?>">
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Mobile</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" value="<?php echo $user_data['mobile']?>">
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Extension</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" id="extension" name="extension" placeholder="Extension" value="<?php echo $user_data['extension']?>">
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $user_data['email']?>">
                </div>
                  </div>
                </div>

               <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Country</label>

                  <div class="col-sm-4">
                <div class="form-group">
                 <select class="form-control" name="bill_country" id="bill_country" onchange="getstate(this)">
                    <option  value="">Select</option>
                    @if(count($countries) > 0)
                    @foreach($countries as $country)
                    <option value={{$country->id}} <?php if($user_data['country']==$country->id){echo 'selected="selected"';}?>>{{$country->name}}</option>
                    @endforeach
                    @endif
                  </select>
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">State</label>

                  <div class="col-sm-4">
                  <div class="form-group">

                  <select class="form-control" name="bill_state" id="bill_state" onchange="getcity(this)">
                    <option value="">Select</option>
                    @if(count($states) > 0)
                    @foreach($states as $state)
                    <option value={{$state->id}} <?php if($user_data['state']==$state->id){echo 'selected="selected"';}?>>{{$state->state}}</option>
                    @endforeach
                    @endif
                  </select>
                </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">City</label>

                  <div class="col-sm-4">
                  <div class="form-group">

                  <select class="form-control" name="bill_city" id="bill_city">
                    <option value="">Select</option>
                    @if(count($cities) > 0)
                    @foreach($cities as $city)
                    <option value={{$city->id}} <?php if($user_data['city']==$city->id){echo 'selected="selected"';}?>>{{$city->name}}</option>
                    @endforeach
                    @endif
                  </select>
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Address</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <textarea name="bill_address" id="bill_address" style="width:422px;height:74px;"><?php echo $user_data['address']?></textarea>
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Postal</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" id="bill_postal" name="bill_postal" placeholder="Postal Code" value="<?php echo $user_data['postal_code']?>" >
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Type</label>

                  <div class="col-sm-4">
                  <div class="form-group">
                 <select class="form-control" name="type" id="type">
                    <option value="">Select</option>
                    <option value="L" <?php if($user_data['type']=='L'){echo 'selected="selected"';}?>>Lead</option>
                    <option value="U" <?php if($user_data['type']=='U'){echo 'selected="selected"';}?>>User</option>
                    <option value="C" <?php if($user_data['type']=='C'){echo 'selected="selected"';}?>>Contact</option>
                  </select>
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Notes</label>

                  <div class="col-sm-4">
                  <div class="form-group">
                  <textarea type="text" class="form-control" id="notes" name="notes" placeholder="Notes"><?php echo $user_data['notes']?></textarea>
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Description</label>

                  <div class="col-sm-4">
                  <div class="form-group">
                  <textarea class="form-control" id="description" name="description" placeholder="Description"><?php echo $user_data['description']?></textarea>
                </div>
                  </div>
                </div>

</div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="button" class="btn btn-default">Cancel</button>
                {!! Form::submit('Submit', array('class' => 'btn btn-info', 'id' => 'validateButton2')) !!}
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
                first_name: {
                    validators: {
                        notEmpty: {
                            message: 'First Name is required'
                        }
                    }
                },
                last_name: {
                    validators: {
                        notEmpty: {
                            message: 'Last Name is required'
                        }
                    }
                },
                title: {
                    validators: {
                        notEmpty: {
                            message: 'Title is required'
                        }
                    }
                },
                user_name: {
                    validators: {
                        notEmpty: {
                            message: 'User Name is required'
                        }
                    }
                },
                account_manager_id: {
                    validators: {
                        notEmpty: {
                            message: 'Please select account manager ID'
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
              }
             },
             mobile: {
              validators: {
                notEmpty: {
                  message: 'The mobile number is required and cannot be empty'
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
             extension: {
              validators: {
                notEmpty: {
                  message: 'The Extention is required and cannot be empty'
                },
                digits: {
                    message: 'Please enter only digits'
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
           bill_country: {
                    validators: {
                        notEmpty: {
                            message: 'Country is required'
                        }
                    }
                },
             bill_state: {
                    validators: {
                        notEmpty: {
                            message: 'State is required'
                        }
                    }
                },
            bill_city: {
                    validators: {
                        notEmpty: {
                            message: 'City is required'
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
                            message: 'Postal is required'
                        },
                        digits: {
                            message: 'Please enter only digits'
                        },
                    }
                },
                type: {
                    validators: {
                        notEmpty: {
                            message: 'Type is required'
                        }
                    }
                },
                description: {
                    validators: {
                        notEmpty: {
                            message: 'Description is required'
                        }
                    }
                },
                notes: {
                    validators: {
                        notEmpty: {
                            message: 'Notes is required'
                        }
                    }
                },

            }
        });
    })();

});

function getstate(data){
   $.ajax({
            url: '{{ URL::to("admin/getStatesByCounty") }}',
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
            url: '{{ URL::to("admin/getCityByState") }}',
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
@stop
