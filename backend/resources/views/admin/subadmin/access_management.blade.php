@extends('admin.layouts.default')

@section('content')
    <div class="content-wrapper">
        <section class="content">

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Access Management </h3><a href="{{ URL::to('admin/subadmin') }}" class="btn pull-right">Back</a>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(array('url' => URL::to('admin/save_access'), 'method' => 'post', 'class'=>"form-horizontal",'id'=>'adminform','files'=> true,'autocomplete'=>false)) !!}
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
                                            <option value={{$depatment->id}}>{{$depatment->department}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label" >Role</label>

                        <div class="col-sm-4">
                            <div class="form-group">

                                <select class="form-control" name="role" id="role" onchange="getData()">
                                    <option value="">Select</option>
                                    @if(count($roles) > 0)
                                        @foreach($roles as $role)
                                            <option value={{$role->id}}>{{$role->role}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-4 control-label">Module Name</label>
                        <div class="col-sm-4">

                        </div>
                    </div>
                    <div id="module">
                    @foreach($modules as $eachmodule)
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">{{$eachmodule->module_name}}</label>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="checkbox"  name="access_management[{{$eachmodule->id}}]['view']"> Can View/Search &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox"  name="access_management[{{$eachmodule->id}}]['add']"> Can Add &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox"  name="access_management[{{$eachmodule->id}}]['edit']"> Can Edit &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox"  name="access_management[{{$eachmodule->id}}]['delete']"> Can Remove &nbsp;&nbsp;&nbsp;&nbsp;
                            </div>
                        </div>

                    </div>
                    @endforeach
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


                    }
                });
            })();

        });
        function getData(){
             var depart = $('#department').val();
             var role = $('#role').val();
             if(depart==''){
               alert('Please select Department');
               $('#role').val('');
               return false;
            }
            if(role==''){
                alert('Please select Role');
                return false;
            }
            $.ajax({
                url: '{{ URL::to("admin/subadmin/mapping_data") }}',
                data: {
                    role: role,
                    department:depart,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                error: function() {
                    //$('#info').html('<p>An error has occurred</p>');
                },
                success: function(data) {
                    $('#module').html(data.html);
                },
                type: 'POST'
            });
        }
    </script>
@stop
