{!! Form::open(array('url' => URL::to('admin/users/comments'), 'method' => 'POST', 'class'=>"form-horizontal" , 'id' => 'commentform', 'name' => 'commentform')) !!}
<h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!}Add New Comment</h4>
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label>Subject</label>
      <input type="hidden" name="tabId2" value="tab2">

      <input type="text" class="form-control" width="200" name="subject" id="subject" placeholder="Subject" value="">
      <input type="hidden" name="user_id" value="{{$user_id}}">
      <input type="hidden" name="created_by" value="{{Auth::guard('admins')->user()->id}}">
    </div>
  </div>
  <div class="col-sm-4" style="margin-left:50px;">
    <div class="">
      <label>Status</label>
      <br />
      <select name="status" style="width:200px;">
        <option value="">-Select-</option>
        <option value="Open">Open</option>
        <option value="In Progress">In Progress</option>
        <option value="Closed">Closed</option>
      </select>
    </div>
    <div class="">
      <label>To Agent ?</label>
      <br />
      <select name="agent_id" style="width:200px;">
        <option value="">-Select-</option>
        @foreach($agentlist as $agent)
        <option value="{{$agent['id']}}">{{$agent['account_name']}}</option>
        @endforeach
      </select>
    </div>
    <div class="">
      <label>Expiry</label>
      <br />
      <input type="text" name="expiry" id="expiry" data-provide="datepicker" style="width:200px;" />
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-6">
    <div class="form-group" style="margin-top: -76px;">
      <label>Description</label>
      <textarea name="comment" rows="10" cols="10" class="form-control"></textarea>
    </div>
  </div>
  <div class="col-sm-6">

  </div>
</div>
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
    </div>
  </div>
  <div class="col-sm-6">

  </div>
</div>
<div class="form-group col-sm-12">
  <div class="box-footer">
    {!! Form::submit('Submit', array('class' => 'btn btn-info', 'id' => 'commentbtn', 'name' => 'commentbtn')) !!}
  </div>
</div>
{!! Form::close() !!}