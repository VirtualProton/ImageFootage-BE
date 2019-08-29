@extends('admin.layouts.default')
 
@section('content')
<?php //echo $record[0]->id; echo '<pre>';print_r($record);die;?>
<div class="page animsition" style="animation-duration: 0s; opacity: 1;">
    <div class="page-header">
        <h1 class="page-title">Edit Banner</h1>
    </div>
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <!-- Panel Standard Mode -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Banner Information</h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(array('url' => URL::to('admin/banners/'.$record->id), 'method' => 'PUT', 'class'=>"form-horizontal",'id'=>'AddCMSPage','files'=> true,'autocomplete'=>false)) !!} 
                        
                        @include('admin.partials.message')
                        
                        <div class="form-group">
                            <div class="input-group input-group-file col-sm-12 col-xs-12">   
                                <label class="col-sm-3 text-left control-label">Banner Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="banner_name" value="{{ $record->banner_name }}" >
                                </div>
                                <div class="col-sm-offset-4 col-xs-offset-4"></div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="input-group input-group-file col-sm-12 col-xs-12">   
                                <label class="col-sm-3 text-left control-label">Banner Link to</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="link_to" value="{{ $record->link_to }}" >
                                </div>
                                <div class="col-sm-offset-4 col-xs-offset-4"></div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-sm-3 text-left">Show Only</label>
                            <div class="col-sm-6">
                                <div class="radio-custom radio-default radio-inline marnone col-sm-4">
                                    <input type="radio" id="inputBannerText" name="show_only" value="0" <?php if($record->status==0){echo 'checked="checked"';}?>>
                                    <label for="inputBannerText">Banner Text</label>
                                </div>
                                <div class="radio-custom radio-default radio-inline marnone col-sm-4">
                                    <input type="radio" id="inputBannerImage" name="show_only" value="1" <?php if($record->status==1){echo 'checked="checked"';}?>>
                                    <label for="inputBannerImage">Banner Image</label>
                                </div>
                                <div class="radio-custom radio-default radio-inline marnone col-sm-4">
                                    <input type="radio" id="inputBannertTextImage" name="show_only" value="2" <?php if($record->status==2){echo 'checked="checked"';}?>>
                                    <label for="inputBannertTextImage">Banner Text & Image</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="input-group input-group-file col-sm-12 col-xs-12">   
                                <label class="col-sm-3 text-left control-label">Banner Image</label>
                                <div class="col-sm-6">
                                    <div class="nav-tabs-horizontal">
                                        <ul class="nav nav-tabs" data-plugin="nav-tabs" role="tablist">
                                            @if(count($languages)>0)
                                                @foreach($languages as $key => $lang)
                                                    <li <?php if($key==0){echo 'class="active"';}?> role="presentation">
                                                        <a data-toggle="tab" href="#banner_lang_image_<?php echo $lang->id; ?>" aria-controls="banner_lang_image_<?php echo $lang->id; ?>" role="tab">{{ $lang->name }}</a>
                                                    </li>
                                                @endforeach
                                            @endif 
                                        </ul>
                                        <div class="tab-content padding-top-20">
                                            @if(count($languages)>0)
                                                @foreach($languages as $key => $lang)
                                                    <div class="tab-pane <?php if($key==0){echo 'active';}?>" id="banner_lang_image_<?php echo $lang->id; ?>" role="tabpanel">
                                                        <input type="file" class="form-control" name="banner_lang_image_<?php echo $lang->id; ?>" value="" style="border:none; padding-left:0" >
                                                        
                                                        @if (isset($bannerImages[$lang->id]['banner_image']) && !empty($bannerImages[$lang->id]['banner_image']))
                                                        <img src="{{ asset('uploads/banners/'.$bannerImages[$lang->id]['banner_image'])}}" width="150" />
                                                        <input type="hidden" name="old_image_<?php echo $lang->id; ?>" value="{{ $bannerImages[$lang->id]['banner_image'] }}" />
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @endif 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-offset-4 col-xs-offset-4"></div>
                            </div>
                        </div>  
                        
                         <div class="form-group">
                            <div class="input-group input-group-file col-sm-12 col-xs-12">   
                                <label class="col-sm-3 text-left control-label">Banner Content</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="banner_text" rows="6" cols="100">{{ $record->banner_text }}</textarea> 
                                </div>
                                <div class="col-sm-offset-4 col-xs-offset-4"></div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-sm-3 text-left">Status</label>
                            <div class="col-sm-6">
                                <div class="radio-custom radio-default radio-inline">
                                    <input type="radio" id="inputBasicActive" name="inputStatus" value="1" <?php if($record->status==1){echo 'checked="checked"';}?>>
                                    <label for="inputBasicActive">Active</label>
                                </div>
                                <div class="radio-custom radio-default radio-inline">
                                    <input type="radio" id="inputBasicinactive" name="inputStatus" value="0" <?php if($record->status==0){echo 'checked="checked"';}?>>
                                    <label for="inputBasicinactive">De Active</label>
                                </div>
                            </div>
                        </div>        
                        <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3 col-xs-offset-0">
                                <button type="submit" class="btn btn-primary" id="validateButton2">Update</button>
                        </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>

            </div>


        </div>
    </div>  
</div>    
@endsection

@section('scripts')
<script src="{{ asset('assets/vendor/formvalidation/formValidation.min.js') }}"></script>
<script src="{{ asset('assets/vendor/formvalidation/framework/bootstrap.min.js') }}"></script>
<script>

$(document).ready(function ($) {

    (function (document, window, $) {
        'use strict';

        var Site = window.Site;
        $(document).ready(function () {
            Site.run();
        });
    })(document, window, jQuery);

    // Example Validataion Standard Mode
    // ---------------------------------
    (function () {
        $('#AddCMSPage').formValidation({
            framework: "bootstrap",
            button: {
                selector: '#validateButton2',
                disabled: 'disabled'
            },
            icon: null,
            fields: {
                banner_name: {
                    validators: {
                        notEmpty: {
                            message: 'Banner name is required'
                        }

                    }
                },
                link_to: {
                    validators: {
                        notEmpty: {
                            message: 'Banner link to is required'
                        } 
                    }
                }, 
                banner_text: {
                    validators: {
                        notEmpty: {
                            message: 'Banner text is required'
                        } 
                    }
                },
                banner_lang_image_1:{
                    validators:{
                        file: {
                            extension: 'jpeg,jpg,png,gif',
                            type: 'image/jpeg,image/png,image/gif',
                            message: 'Banner image must be an image' 
                    } 
                    }
                },
                banner_lang_image_2:{
                    validators:{
                        file: {
                            extension: 'jpeg,jpg,png,gif',
                            type: 'image/jpeg,image/png,image/gif',
                            message: 'Banner image must be an image' 
                    } 
                    }
                },
                banner_lang_image_3:{
                    validators:{
                        file: {
                            extension: 'jpeg,jpg,png,gif',
                            type: 'image/jpeg,image/png,image/gif',
                            message: 'Banner image must be an image' 
                    } 
                    }
                }
                 
            }
        });
    })();

});
</script>
@stop