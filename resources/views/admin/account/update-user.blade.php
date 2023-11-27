{!! Form::open(array('url' => URL::to('admin/users/update_user'), 'method' => 'POST', 'class'=>"form-horizontal", 'name' => 'updateuser', 'id' => 'updateuser')) !!}
<div class="">
      <h4 class="box-title account-title">Account Info</h4>
      <div class="form-group col-sm-6">
        <input type="hidden" name="tabId1" value="tab1">
        <input type="hidden" id="user_id" name="user_id" value="{{$user->id}}"/>
        <div class="user-name-dec">
          <div class="custom-width custom-font">User Name : {{$user->user_name}} </div>
          <div class="custom-width custom-font">Deactivated ? : {{$user->status=1?"No":"Yes"}}</div>
        </div>
        <div class="ps-wrap">
          <div class="reset-pass"><span class="custom-font">Password :</span>
            <input type="password" class="" name="" id="" value="{{$user->password}}"><button id="resetButton" onclick="resetPassword({{$user->id}})">Reset</button>
          </div>
        </div>
        <div class="f-l-e-wrap">
          <div class="custom-width"><span class="custom-font">First Name :</span> <input type="text" id="user_name" name="user_name" value="{{$user->first_name}}"/></div>
          <div class="custom-width"><span class="custom-font">Last Name :</span> <input type="text" class="" name="user_last_name" id="user_last_name" value="{{$user->last_name}}" /></div>
          <div class="custom-width emails"><span class="custom-font">Email :</span> <input type="text" class="" name="user_email" id="user_email" value="{{$user->email}}" /></div>
        </div>
        
        <div class="reg-acc-wrap">
          <div class="custom-width custom-font">Date Registered : {{date('d-m-Y', strtotime($user->created_at))}}</div>
          <div class="custom-width custom-font">Dedicated Account Manager : {{$account_manager_name}}</div>
        </div>
      </div>
       
      <div class="form-group col-sm-6">
      <h4 class="box-title">Personal Info</h4>
        <div class="user-com-wrap select-button-wrap"> 
          <div class="custom-width"><span class="custom-font">Company :</span> <input type="text" class="" name="user_company" id="user_company" value="{{$user->company}}" /></div>
          <div class="custom-width"><span class="custom-font">Occupation :</span> <input type="text" class="" name="user_occupation" id="user_occupation" value="{{$user->occupation}}" /></div>
            <div class="custom-width"><span class="custom-font">Address:<span>
              <textarea name="user_address" id="user_address" rows="4"  cols="50">{{$user->address}}</textarea>
            </div> 
            <div class="custom-width"><span class="custom-font">Address2:<span>
              <textarea name="user_address2" id="user_address2" rows="4"  cols="50">{{$user->address2}}</textarea>
            </div>
        </div>
        <div class="select-button-wrap">
          <div class="custom-width">   
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Country</label>
                <div class="">
                  <div class="form-group">
                    <select class="form-control" name="country" id="country" onchange="getstate(this)">
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
          </div> 
          <div class="custom-width">  
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">State</label>
              <div class="">
                <div class="form-group">
                  <select class="form-control" name="state" id="state" onchange="getcity(this)">
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
          </div>  
          
          <div class="custom-width">
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">City</label>

                <div class="">
                  <div class="form-group">
                      <select class="form-control" name="city" id="city">
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
            </div>
            <div class="custom-width"><span class="custom-font">Postal Code :</span> {{$user->postal_code}}</div>
            
        </div>  

        <div class="postal-code">
          <div class="custom-width"><span class="custom-font">Phone :</span> <input type="text" class="" name="user_phone" id="user_phone" value="{{$user->phone}}" /></div>
          <div class="custom-width"><span class="custom-font">GST :</span> <input type="text" class="" name="user_gst" id="user_gst" value="{{$user->gst}}" /></div>
          <div class="custom-width"><span class="custom-font">PAN :</span> <input type="text" class="" name="user_pan" id="user_pan" value="{{$user->pan}}" /></div>
        </div>
      </div>
    </div>
   <div>
      <div class="form-group col-sm-12">
        <h4 class="box-title">Other Info</h4>
        <div class="list-user">
          <div class="custom-width"><span class="custom-font">Partner ? :</span> <input type="text" class="" name="user_partner" id="user_partner" value=" {{$user_info['partner'] ?? ''}}" /> </div>
          <div class="custom-width"><span class="custom-font">White List User ? :</span> <input type="text" class="" name="user_whitelist" id="user_whitelist" value="{{$user_info['whitelist'] ?? ''}}" /></div>
          <div class="custom-width"><span class="custom-font">Black List User ? :</span> <input type="text" class="" name="user_blacklist" id="user_blacklist" value="{{$user_info['blacklist'] ?? ''}}" /></div>
          <div class="custom-width"><span class="custom-font">Checkout Frozen :</span> <input type="text" class="" name="user_checkout_frozen" id="user_checkout_frozen" value="{{$user_info['frozen'] ?? ''}}" /> </div>
        </div>
        <div class="preferred">  
          <div class="custom-width"><span class="custom-font">Allow Download Certificate :</span> <input type="text" class="" name="user_allow_certi" id="user_allow_certi" value="{{$user_info['allow_certi'] ?? ''}}" /></div>
          <div class="custom-width"><span class="custom-font">Enable Subs Multi-logins ? :</span> <input type="text" class="" name="user_enable_subs_multi" id="user_enable_subs_multi" value="{{$user_info['enable_subs_multi'] ?? ''}}" /></div>
          <div class="custom-width"><span class="custom-font">Preferred Contact Method :</span> <input type="text" class="" name="user_preferred_contact_method" id="user_preferred_contact_method" value="{{$user_info['preferred_contact_method'] ?? ''}}" /></div>
          <div class="custom-width"><span class="custom-font">Client Description :</span> <textarea rows="3" class="form-control" name="user_client_des" id="user_client_des" style="">{{$user->description}}</textarea></div>
        </div>  
      </div>
      <div class="form-group col-sm-12">
        <div class="box-footer user-blade-sub" style="margin-bottom: 20px;">
          {!! Form::submit('Submit', array('class' => 'btn btn-info', 'id' => 'updatebtn', 'name' => 'updatebtn')) !!}
        </div>
      </div>
  </div>
{!! Form::close() !!}
