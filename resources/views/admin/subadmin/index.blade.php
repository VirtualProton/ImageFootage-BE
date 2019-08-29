@extends('admin.layouts.default')

@section('content')

<!-- Page -->
<div class="page animsition" id="banners">
    <div class="page-header">
        <h1 class="page-title">Banners</h1>
        <div class="page-header-actions">
            <a class="btn btn-sm btn-default btn-outline btn-round" href="{{ URL::to('admin/banners/create')  }}" >
                <i class="icon wb-plus-circle" aria-hidden="true"></i>
                <span class="hidden-xs">Add New Banner</span>
            </a>
        </div>
    </div>
    <div class="page-content">
        <!-- Panel Basic -->
        <div class="panel">
            <header class="panel-heading">
                <div class="panel-actions"></div>
                <h3 class="panel-title">List Banners</h3>
            </header>
            @include('admin.partials.message') 
            <div class="panel-body">
                <table class="table table-hover dataTable table-striped width-full" data-plugin="dataTable">
                    <thead>
                        <tr>
                            <th>Banner Name</th> 
                            <th>Link To</th> 
                            <th>Show Only</th>
                            <th>Status</th>
                            <th data-orderable="false">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($records) && count($records) > 0)

                        @foreach($records as $key => $item) 
                        <tr>
                            <td>{{ $item->banner_name }}</td>
                            <td>{{ $item->link_to }}</td> 
                            <td> 
                                @if($item->show_only == 0)
                                {{ "Text" }}
                                @elseif($item->show_only == 1)
                                {{ "Image" }}
                                @else
                                {{ "Text & Image" }}
                                @endif
                            </td>
                            <td>@if ($item->status == 1)
                                {{ "Active" }}
                                @else
                                {{ "De-Active" }}
                                @endif</td>
                            <td><a href="{{ URL::to('admin/banners/'.$item->id).'/edit' }}"><i class="icon wb-edit pull-left" aria-hidden="true"></i></a>
                                {!! Form::open(array('url' => 'admin/banners/' . $item->id, 'class' => 'pull-left deletePage',
                                'data-toggle'=>'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Banner', 'data-message' => 'Are you sure you want to delete this banner ?',
                                'style' => 'display:inline')) !!}
                                {!! Form::hidden('_method', 'DELETE') !!}
                                <button type="button" class="" id="confirm">
                                    <i class="icon wb-trash" aria-hidden="true"></i>
                                </button> 
                                {!! Form::close() !!} 
                            </td>
                        </tr>
                        @endforeach

                        @endif
                    </tbody>
                </table> 
            </div>
        </div>
        <!-- End Panel Basic -->
    </div>
</div>
<!-- End Page -->   

@include('admin.partials.confirm_delete')

@endsection

@section('scripts')

<script>

    $(document).ready(function ($) {

        (function (document, window, $) {
            'use strict';

            var Site = window.Site;
            $(document).ready(function () {
                Site.run();
            });
        })(document, window, jQuery);

        @include('admin.partials.confirm_delete_js')

    });
</script>
@stop