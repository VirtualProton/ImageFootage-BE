@extends('admin.layouts.default')

@section('content')
<div class="content-wrapper">
<section class="content">

<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add Lead/User/Contact</h3><a href="{{ URL::to('admin/users') }}" class="btn pull-right">Back</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(array('url' => URL::to('admin/users'), 'method' => 'post', 'class'=>"form-horizontal",'id'=>'adminform','files'=> true,'autocomplete'=>false)) !!}
              @include('admin.partials.message')

              <div class="box-body">
              <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">First Name</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name">
                  {{ csrf_field() }}
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Last Name</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name">
                </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Title</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                </div>
                  </div>
                </div>
                  <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">User Name</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" name="user_name" id="user_name" placeholder="User Name">
                </div>
                </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Contact Owner</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" name="contact_owner" id="contact_owner" placeholder="Contact Owner">
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
                    <option value={{ $account['id'] }}>{{$account['account_name']}}</option>
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
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Mobile</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile">
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Extension</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" id="extension" name="extension" placeholder="Extension">
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
                  <label for="inputEmail3" class="col-sm-2 control-label">Country</label>

                  <div class="col-sm-4">
                <div class="form-group">
                 <select class="form-control" name="bill_country" id="bill_country" onchange="getstate(this)">
                    <option  value="">Select</option>
                    @if(count($countries) > 0)
                    @foreach($countries as $country)
                    <option value={{$country->id}}>{{$country->name}}</option>
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

                  </select>
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Address</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <textarea name="bill_address" id="bill_address" style="width:422px;height:74px;"></textarea>
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Postal</label>
                  <div class="col-sm-4">
                  <div class="form-group">
                  <input type="text" class="form-control" id="bill_postal" name="bill_postal" placeholder="Postal Code">
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Type</label>

                  <div class="col-sm-4">
                  <div class="form-group">
                 <select class="form-control" name="type" id="type">
                    <option value="">Select</option>
                    <option value="L">Lead</option>
                    <option value="U">User</option>
                    <option value="C">Contact</option>
                  </select>
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Notes</label>

                  <div class="col-sm-4">
                  <div class="form-group">
                  <textarea type="text" class="form-control" id="notes" name="notes" placeholder="Notes"></textarea>
                </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Description</label>

                  <div class="col-sm-4">
                  <div class="form-group">
                  <textarea class="form-control" id="description" name="description" placeholder="Description"></textarea>
                </div>
                  </div>
                </div>

</div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ URL::previous() }}"><button type="button" class="btn btn-default">Cancel</button></a>
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
