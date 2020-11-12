@extends('admin.layouts.default')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
      <h1>
      Edit Profile</h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Edit Profile</li>
      </ol>
    </section>
<section class="content">

<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Profile</h3><a href="{{ URL::to('admin/subadmin') }}" class="btn pull-right">Back</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(array('url' => URL::to('admin/subadmin/edit_profile/'.$agent_data['id']),  'method' => 'POST', 'class'=>"form-horizontal",'id'=>'adminform','files'=> true,'autocomplete'=>false)) !!}
              @include('admin.partials.message')

              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Department</label>

                  <div class="col-sm-4">
                <div class="form-group">
                 <select class="form-control" name="department" id="department">
                    <option  value="">Select</option>
                    @if(count($deparments) > 0)
                    @foreach($deparments as $depatment)
                    <option value={{$depatment->id}} <?php if($agent_data['department']['id']==$depatment->id){echo 'selected="selected"';}?>>{{$depatment->department}}</option>
                    @endforeach
                    @endif
                  </select>
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Role</label>

                  <div class="col-sm-4">
                  <div class="form-group">

                  <select class="form-control" name="role" id="role">
                    <option value="">Select</option>
                    @if(count($roles) > 0)
                    @foreach($roles as $role)
                    <option value={{$role->id}} <?php if($agent_data['role']['id']==$role->id){echo 'selected="selected"';}?>>{{$role->role}}</option>
                    @endforeach
                    @endif
                  </select>
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $agent_data['name']; ?>">
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $agent_data['email']?>">
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Country</label>

                  <div class="col-sm-4">
                  <div class="form-group">

                  <select class="form-control" name="bill_country" id="bill_country" onchange="getstate(this)">
                    <option value="">Select</option>
                    @if(count($countries) > 0)
                    @foreach($countries as $country)
                    <option value={{$country->id}} <?php if($agent_data['country']==$country->id){echo 'selected="selected"';}?>>{{$country->name}}</option>
                    @endforeach
                    @endif
                  </select>
                </div>
                  </div>
                </div>

                <!-- <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">State</label>

                  <div class="col-sm-4">
                  <div class="form-group">

                  <select class="form-control" name="country" id="country">
                    <option value="">Select</option>
                    @if(count($countries) > 0)
                    @foreach($countries as $country)
                    <option value={{$role->id}} <?php if($agent_data['country']==$country->id){echo 'selected="selected"';}?>>{{$country->name}}</option>
                    @endforeach
                    @endif
                  </select>
                </div>
                  </div>
                </div> -->

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">State</label>

                  <div class="col-sm-4">
                  <div class="form-group">

                  <select class="form-control" name="bill_state" id="bill_state" onchange="getcity(this)">
                    <option value="">Select</option>
                    @if(count($states) > 0)
                    @foreach($states as $state)
                    <option value={{$state->id}} <?php if($agent_data['state']==$state->id){echo 'selected="selected"';}?>>{{$state->state}}</option>
                    @endforeach
                    @endif
                  </select>
                </div>
                  </div>
                </div>



                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Mobile</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" value="<?php echo $agent_data['mobile']?>">
                </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Location</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <textarea name="address" id="address" style="width:422px;height:74px;"><?php echo $agent_data['address']?></textarea>
                </div>
                  </div>
                </div>

</div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ URL::previous() }}"><button type="button" class="btn btn-default">Cancel</button></a>
<!--                 <button type="button" class="btn btn-default">Cancel</button>
 -->                {!! Form::submit('Submit', array('class' => 'btn btn-info', 'id' => 'validateButton2')) !!}
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
                department: {
                    validators: {
                        notEmpty: {
                            message: 'Department is required'
                        }
                    }
                },
                role: {
                    validators: {
                        notEmpty: {
                            message: 'Role is required'
                        }
                    }
                },
                name: {
                    validators: {
                        notEmpty: {
                            message: 'Name is required'
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
            password: {
              validators: {
               stringLength: {
                  min: 6,
                  message: 'The password must be more than 6 characters long'
                }
              }
            },
            mobile: {
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
                address: {
                    validators: {
                        notEmpty: {
                            message: 'Address is required'
                        }
                    }
                }

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
</script>
@stop
