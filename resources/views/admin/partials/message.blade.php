@if(Session::has('success'))
<div class="summary-errors alert alert-success alert-dismissible">
    <button type="button" class="close" aria-label="Close" data-dismiss="alert">
        <span aria-hidden="true">×</span>
    </button>
    <span class="">{{ Session::get('success') }}</span>
    <!-- help-block -->
</div>
@endif
@if(Session::has('error'))
<div class="summary-errors alert alert-danger alert-dismissible">
    <button type="button" class="close" aria-label="Close" data-dismiss="alert">
        <span aria-hidden="true">×</span>
    </button>
    <span class="">{{ Session::get('error') }}</span>
    <!-- help-block -->
</div>
@endif

@if(count($errors) > 0)
<div class="summary-errors alert alert-danger alert-dismissible">
<button type="button" class="close" aria-label="Close" data-dismiss="alert">
    <span aria-hidden="true">×</span>
</button>
<ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>
</div>
@endif