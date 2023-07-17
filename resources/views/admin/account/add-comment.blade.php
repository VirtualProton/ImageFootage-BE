{!! Form::open(array('url' => URL::to('admin/users/comments'), 'method' => 'POST', 'class'=>"form-horizontal" , 'id' => 'commentform', 'name' => 'commentform')) !!}
<h4 class="box-title add-new news_add-div">Add New Comment</h4>
<div class="inner-mail-top-top">
<div class="inner-mail-right">
<div class="row">
  <div class="col-sm-4 comment-sec-wrap">
    <div class="custom-width">
      <label>Status</label>
      <select name="status">
        <option value="">-Select-</option>
        <option value="Open">Open</option>
        <option value="In Progress">In Progress</option>
        <option value="Closed">Closed</option>
      </select>
    </div>
    <div class="custom-width">
      <label>To Agent ?</label>
      <select name="agent_id">
        <option value="">-Select-</option>
        @foreach($agentlist as $agent)
        <option value="{{$agent['id']}}">{{$agent['account_name']}}</option>
        @endforeach
      </select>
    </div>
    <div class="custom-width">
      <label>Expiry</label>
      <input type="text" name="expiry" id="expiry" data-provide="datepicker"/>
    </div>
  </div>
</div>
</div>
<div class="inner-mail-left">
  <div class="row">
    <div class="col-12">
        <div class="form-group comment-sub-wrap">
          <label>Subject</label>
          <input type="hidden" name="tabId2" value="tab2">
          <input type="text" class="form-control" width="200" name="subject" id="subject" placeholder="Subject" value="">
          <input type="hidden" name="user_id" value="{{$user_id}}">
          <input type="hidden" name="created_by" value="{{Auth::guard('admins')->user()->id}}">
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="form-group comme-desc">
        <label>Description</label>
        <textarea name="comment" rows="10" cols="10" class="form-control"></textarea>
      </div>
    </div>
  </div> 
  <div class="form-group col-sm-12">
    <div class="box-footer comme-button">
      {!! Form::submit('Submit', array('class' => 'btn btn-info', 'id' => 'commentbtn', 'name' => 'commentbtn')) !!}
    </div>
  </div> 
  </div>
 
  </div>
    <!-- </div> -->


{!! Form::close() !!}