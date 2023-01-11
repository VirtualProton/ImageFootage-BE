{!! Form::open(array('url' => URL::to('admin/users/update_user'), 'method' => 'POST', 'class'=>"form-horizontal", 'name' => 'updateuser', 'id' => 'updateuser')) !!}
<div class="form-group col-sm-12">
      <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!}Account Info</h4>
      <div class="form-group col-sm-6">
        <input type="hidden" name="tabId1" value="tab1">
        <input type="hidden" id="user_id" name="user_id" value="{{$user->id}}"/>
        <h5>User Name : {{$user->user_name}} </h5>
        <h5>Deactivated ? : {{$user->status=1?"No":"Yes"}}</h5>
        <h5>Password :
          <input type="password" class="" name="" id="" value="{{$user->password}}"><button id="resetButton" onclick="resetPassword({{$user->id}})">reset</button>
        </h5>
        <h5>First Name : <input type="text" id="user_name" name="user_name" value="{{$user->first_name}}"/></h5>
        <h5>Last Name : <input type="text" class="" name="user_last_name" id="user_last_name" value="{{$user->last_name}}" /></h5>
        <h5>Email : <input type="text" class="" name="user_email" id="user_email" value="{{$user->email}}" /></h5>
        <!-- <h5>Email Verified : {{$user->last_name}}</h5> -->
        <h5>Date Registered : {{date('d-m-Y', strtotime($user->created_at))}}</h5>
        <h5>Dedicated Account Manager : {{$account_manager_name}}</h5>
      </div>
      <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!}Personal Info</h4>
      <div class="form-group col-sm-6">
        <h5>Company : <input type="text" class="" name="user_company" id="user_company" value="{{$user->company}}" /></h5>
        <h5>Occupation : <input type="text" class="" name="user_occupation" id="user_occupation" value="{{$user->occupation}}" /></h5>
        <h5>Address : <textarea name="user_address" id="user_address" rows="4"  cols="50">{{$user->address}}</textarea> 
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Country</label>

            <div class="col-sm-4">
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
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">State</label>

            <div class="col-sm-4">
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

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Billing City</label>

            <div class="col-sm-4">
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
          {{-- <h5>City : {{$city_name}}</h5>
        <h5>State : {{$state_name}}</h5>
        <h5>Country : {{$country_name}}</h5> --}}
        <h5>Postal Code : {{$user->postal_code}}</h5>
        <h5>Phone : <input type="text" class="" name="user_phone" id="user_phone" value="{{$user->phone}}" /></h5>
        <h5>GST : <input type="text" class="" name="user_gst" id="user_gst" value="{{$user->gst}}" /></h5>
        <h5>PAN : <input type="text" class="" name="user_pan" id="user_pan" value="{{$user->pan}}" /></h5>
      </div>
    </div>
   
    <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!}Other Info</h4>
    <div class="form-group col-sm-12">
      <h5>Partner ? : <input type="text" class="" name="user_partner" id="user_partner" value=" {{$user_info['partner'] ?? ''}}" /> </h5>
      <h5>White List User ? : <input type="text" class="" name="user_whitelist" id="user_whitelist" value="{{$user_info['whitelist'] ?? ''}}" /></h5>
      <h5>Black List User ? : <input type="text" class="" name="user_blacklist" id="user_blacklist" value="{{$user_info['blacklist'] ?? ''}}" /></h5>
      <h5>Checkout Frozen : <input type="text" class="" name="user_checkout_frozen" id="user_checkout_frozen" value="{{$user_info['frozen'] ?? ''}}" /> </h5>
      <h5>Allow Download Certificate : <input type="text" class="" name="user_allow_certi" id="user_allow_certi" value="{{$user_info['allow_certi'] ?? ''}}" /></h5>
      <h5>Enable Subs Multi-logins ? : <input type="text" class="" name="user_enable_subs_multi" id="user_enable_subs_multi" value="{{$user_info['enable_subs_multi'] ?? ''}}" /></h5>
      <h5>Preferred Contact Method : <input type="text" class="" name="user_preferred_contact_method" id="user_preferred_contact_method" value="{{$user_info['preferred_contact_method'] ?? ''}}" /></h5>
      <h5>Client Description : <textarea rows="3" class="form-control" name="user_client_des" id="user_client_des" style="width: 30%;">{{$user->description}}</textarea></h5>
    </div>
<div class="form-group col-sm-12">
  <div class="box-footer">
    {!! Form::submit('Submit', array('class' => 'btn btn-info', 'id' => 'updatebtn', 'name' => 'updatebtn')) !!}
  </div>
</div>
{!! Form::close() !!}