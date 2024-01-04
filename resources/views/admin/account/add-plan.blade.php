{!! Form::open(array('url' => URL::to('admin/users/plan'), 'method' => 'POST', 'class'=>"form-horizontal" , 'id' => 'addPlan', 'name' => 'planform')) !!}
<h4 class="box-title add-new news_add-div">Add New Plan</h4>
<div class="inner-mail-top-top">
<div class="inner-mail-right">
    <input type="hidden" id="user_id" name="user_id" value="{{$user->id}}"/>
<div class="row">
  <div class="col-sm-4 comment-sec-wrap">
    <div class="custom-width">
      <label>Select Plan</label>
      <select name="plan_id" required>
        <option value="">-Select-</option>
        @foreach($plans as $plan)
        <option value="{{$plan['package_id']}}">{{$plan['package_name']}} ({{$plan['package_description']}})</option>
        @endforeach
      </select>
    </div>
  </div>
</div>
</div>
</div>
<div class="form-group col-sm-12">
    <div class="box-footer comme-button">
      {!! Form::submit('Submit', array('class' => 'btn btn-info', 'id' => 'addPlan', 'name' => 'planbtn')) !!}
    </div>
  </div>
