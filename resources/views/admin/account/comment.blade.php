@if(count($comments) > 0 )
<h4 class="box-title exist-comment">{!! "&nbsp;" !!}{!! "&nbsp;" !!}Existing Comments</h4>
<div class="form-group col-sm-12">
  <table class="account table table-bordered table-striped dataTable col-sm-12" class="">
    <thead>
      <tr>
        <th>Sl No</th>
        <th>Subject</th>
        <th>Description</th>
        <th>Status</th>
        <th>Assigned To</th>
        <th>Created By</th>
        <th>Created Date</th>
        <th>Expiry Date</th>
        <!-- <th>Show Downloads</th> -->
      </tr>
    </thead>
    <tbody>
      @foreach($comments as $key=>$comment)
      <tr role="row" class="odd">
        <td>{{$key+1}}</td>

        <td>{{$comment['subject']}}</td>
        <td>{{$comment['comment']}}</td>
        <td>{{$comment['status']}}</td>
        <td>{{(!empty($comment['agent']['account_name']))?$comment['agent']['account_name']:""}}</td>
        <td>{{(!empty($comment['admin']['name']))?$comment['admin']['name']:""}}</td>
        <!-- <?php
              $created_at = date('d-m-Y', strtotime($comment['created_at']));
              ?> -->
        <td>{{$comment['created_at']}}</td>
        <td>{{$comment['expiry']}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@else
{{-- <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!} No Existing Comments</h4> --}}
@endif