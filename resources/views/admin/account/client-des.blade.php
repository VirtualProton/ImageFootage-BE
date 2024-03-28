@if(count($descriptions) > 0 )
<h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!}Update Client Information</h4>
<div class="form-group col-sm-12">
  <table class="account table table-bordered table-striped dataTable col-sm-12" class="">
    <thead>
      <tr>
        <th>Sl No</th>
        <th>Description</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      @foreach($descriptions as $key=>$description)
      <tr role="row" class="odd">
        <td>{{$key+1}}</td>
        <td>{{$description['description']}}</td>
        <td>{{$description['created_at']}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@else
{{-- <h4 class="box-title">{!! "&nbsp;" !!}{!! "&nbsp;" !!} No Update Client</h4> --}}
@endif