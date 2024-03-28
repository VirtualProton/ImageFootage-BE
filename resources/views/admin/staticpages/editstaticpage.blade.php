@extends('admin.layouts.default')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Static Page
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"> Edit Static Page</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"> Edit Static Page</h3><a href="{{ URL::to('admin/static_pages_list') }}" class="btn pull-right">Back</a>
          </div>
          @if(session()->has('success'))
          <div class="alert alert-success">
            {{ session()->get('success') }}
          </div>
          @endif
          @if(session()->has('error'))
          <div class="alert alert-danger">
            {{ session()->get('error') }}
          </div>
          @endif
          <form action="{{ url('admin/editstaticpage') }}" role="form" method="post" enctype="multipart/form-data" id="productform">
            <input type="hidden" class="form-control" name="page_id" id="page_id" value="{{ $page[0]['page_id'] }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="box-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Page Title</label>
                <input type="text" class="form-control" name="page_title" id="page_title" placeholder="Page name" value="{{ $page[0]['page_title'] }}">
                @if ($errors->has('page_title'))
                <div class="has_error" style="color:red;">{{ $errors->first('page_title') }}</div>
                @endif
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Page URL</label>
                <input type="text" class="form-control" name="page_url" id="page_url" placeholder="Page URL" value="{{ $page[0]['page_url'] }}">
              </div>
              @if ($errors->has('page_url'))
              <div class="has_error" style="color:red;">{{ $errors->first('page_url') }}</div>
              @endif

              <div class="form-group">
                <label for="exampleInputPassword1">Page Meta Description</label>
                <textarea type="text" class="form-control" name="page_meta_desc" id="page_meta_desc" placeholder="Page Meta Description">{{ $page[0]['page_meta_desc'] }}</textarea>
                @if ($errors->has('page_meta_desc'))
                <div class="has_error" style="color:red;">{{ $errors->first('page_meta_desc') }}</div>
                @endif
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Page Meta Keywords</label>
                <textarea type="text" class="form-control" name="page_meta_keywords" id="page_meta_keywords" placeholder="Page Meta Keywords">{{ $page[0]['page_meta_keywords'] }}</textarea>
                @if ($errors->has('page_meta_keywords'))
                <div class="has_error" style="color:red;">{{ $errors->first('page_meta_keywords') }}</div>
                @endif
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Page Slug</label>
                <textarea type="text" class="form-control" name="page_slug" id="page_slug" placeholder="Page slug">{{ $page[0]['page_slug'] ?? ''}}</textarea>
                @if ($errors->has('page_slug'))
                <div class="has_error" style="color:red;">{{ $errors->first('page_slug') }}</div>
                @endif
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Page Content</label>
                <textarea type="text" class="form-control" name="page_content" id="page_content" placeholder="Page Content">{{ $page[0]['page_content'] }}</textarea>
                <div id="ckeditor_error" class="has_error hidden" style="color:red;">Page content is required.</div>
                @if ($errors->has('page_content'))
                <div class="has_error" style="color:red;">{{ $errors->first('page_content') }}</div>
                @endif
              </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" id="validateButton2">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('scripts')
<script src="{{ asset('js/formvalidation/formValidation.min.js') }}"></script>
<script src="{{ asset('js/formvalidation/framework/bootstrap.min.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script>
  //sub_product_type
  $('.product_type').click(function() {
    if ($(this).is(":checked")) {
      var ptype = $(this).val();
      if (ptype == 'Image' || ptype == 'Editorial') {
        $("#sub_product_type").css("display", "block");
      } else {
        $("#sub_product_type").css("display", "none");
      }
    }
  });
  $("#product_category").on('change', function() {
    var prod_id = $(this).val();
    var csrf = '{{ csrf_token() }}';
    $.ajax({
      url: '{{ url("admin/get_related_subcat") }}',
      type: 'POST',
      data: {
        'prod_id': prod_id,
        '_token': csrf
      },
      success: function(data) {
        $("#product_sub_category").html('');
        $("#product_sub_category").html(data);
      }
    });
  });
</script>
<script>
  $(document).ready(function($) {
    var editor = CKEDITOR.replace('page_content');

    editor.on('change', function() {
      $("#ckeditor_error").addClass(' hidden');
      $("#ckeditor_error").parent('.form-group').removeClass(' has-error ').addClass(' has-success ');
      $("button[type=submit]").removeClass('disabled');
      $("button[type=submit]").removeAttr('disabled');
    });

    (function() {

      var i = 1;

      $('#productform').formValidation({
        framework: "bootstrap",
        button: {
          selector: '#validateButton2',
          disabled: 'disabled'
        },
        icon: null,
        fields: {
          page_title: {
            validators: {
              notEmpty: {
                message: 'Page title is required.'
              }
            }
          },
          page_url: {
            validators: {
              notEmpty: {
                message: 'Page URL is required.'
              }
            }
          },
          page_meta_desc: {
            validators: {
              notEmpty: {
                message: 'Page meta description is required.'
              }
            }
          },
          page_meta_keywords: {
            validators: {
              notEmpty: {
                message: 'Page meta keywords is required.'
              }
            }
          },
          page_slug: {
            validators: {
              notEmpty: {
                message: 'Page slug is required.'
              }
            }
          },
          page_content: {
            validators: {
              notEmpty: {
                message: 'Page content is required.'
              },
              stringLength: {
                message: 'Page content is required.'
              }
            }
          }
        }
      }).on('success.form.fv', function(e) {
        var editor = CKEDITOR.instances.page_content;
        var content = editor.getData().trim();
        if (content === '') {
          e.preventDefault();
          $("#ckeditor_error").removeClass('hidden');
          $("#ckeditor_error").parent('.form-group').addClass(' has-error ');
        } else {
          $("button[type=submit]").removeClass('disabled');
          $("button[type=submit]").removeAttr('disabled');
        }
      });
    })();

  });
</script>
@endsection