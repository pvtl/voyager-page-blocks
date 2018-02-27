@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style type="text/css">
        /* Image field type */
        .vpb-image-group label { display: block; }
        .vpb-image-group img { float: left; width: 28% !important; margin-right: 2%; }
        .vpb-image-group input[type=file] { float: left; width: 70%; }

        /* Toggle Button */
        .toggle.btn {
            box-shadow: 0 5px 9px -3px rgba(0,0,0,0.2);
            border: 1px solid rgba(0,0,0,0.2) !important;
        }

        /* Make Inputs a 'lil more visible */
        select,
        input[type="text"],
        .panel-body .select2-selection, {
            border: 1px solid rgba(0,0,0,0.17)
        }
    </style>
@stop

@section('page_title', 'Edit Page Content')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-file-text"></i>
        Edit Page Content
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-4 col-lg-3 col-xl-2">
                <div class="panel panel-bordered panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add Block</h3>
                        <div class="panel-actions">
                            <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                        </div> <!-- /.panel-actions -->
                    </div> <!-- /.panel-heading -->

                    <div class="panel-body">
                        <form role="form" action="{{ route('voyager.page-blocks.store', $page->id) }}" method="POST"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="type">Block Type</label>
                                <select class="form-control" name="type" id="type">
                                    <option value="">-- Select --</option>
                                    <optgroup label="Developer Tools">
                                        <option value="include">File Include</option>
                                    </optgroup>
                                    <optgroup label="Block Templates">
                                        @php $templates = config('page-blocks'); @endphp

                                        @foreach ($templates as $template)
                                            <option
                                                value="template|{!! $template['template'] !!}.blade.php">{!! $template['name'] !!}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div> <!-- /.form-group -->

                            <input type="hidden" name="page_id" value="{{ $page->id }}"/>
                            <button type="submit" class="btn btn-success btn-sm">{{ __('voyager.generic.add') }}</button>
                        </form>
                    </div> <!-- /.panel-body -->
                </div> <!-- /.panel -->
            </div> <!-- /.col -->

            <div class="col-md-8 col-lg-9 col-xl-10">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @foreach($pageBlocks as $block)
                    @php
                        $template = $block->template();
                        $dataTypeContent = $block->data;
                        $numOfBlocks = count($pageBlocks);
                    @endphp
                    <div class="panel panel-bordered panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <a
                                    class="panel-action @if ($numOfBlocks > 1)panel-collapsed voyager-angle-up @else voyager-angle-down @endif"
                                    data-toggle="panel-collapse"
                                    style="cursor:pointer"
                                >
                                    {{ $template->name }}
                                    @if (!empty($template->description)) <span class="panel-desc"> {{ $template->description }}</span>@endif
                                </a>
                            </h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-resize-full" data-toggle="panel-fullscreen" aria-hidden="true"></a>
                            </div>
                        </div>

                        <div class="panel-body" @if ($numOfBlocks > 1)style="display:none" @endif>
                            <form role="form" action="{{ route('voyager.page-blocks.update', $block->id) }}" method="POST"
                                enctype="multipart/form-data">
                                {{ method_field("PUT") }}
                                {{ csrf_field() }}

                                <div class="row">
                                    @foreach($template->fields as $row)
                                        @if ($row->partial === 'break')</div> <!-- /.row --><div class="row">@continue @endif

                                        @php $options = $row; @endphp

                                        <div class="@if (strpos($row->partial, 'rich_text_box') !== false)col-md-12 @else col-md-6 @endif">
                                            <div class="form-group">
                                                <label>{{ $row->display_name }}</label>
                                                @include($row->partial)
                                            </div> <!-- /.form-group -->
                                        </div> <!-- /.col -->
                                    @endforeach
                                </div> <!-- /.row -->

                                <div class="well" style="padding-bottom:0; margin-bottom:10px">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input
                                                    type="checkbox"
                                                    name="is_hidden"
                                                    id="is_hidden"
                                                    data-name="is_hidden"
                                                    class="toggleswitch"
                                                    value="1"
                                                    data-on="Yes" {!! $block->is_hidden ? 'checked="checked"' : '' !!}
                                                    data-off="No"
                                                />
                                                <label for="is_hidden">Hide Block </label>
                                            </div> <!-- /.form-group -->

                                            <div class="form-group">
                                                <label for="cache_ttl">Cache Time</label>
                                                <select name="cache_ttl" id="cache_ttl" class="form-control">
                                                    <option value="0" selected="selected">None / Off</option>
                                                    <option value="5">5 mins</option>
                                                    <option value="30">30 mins</option>
                                                    <option value="60">1 Hour</option>
                                                    <option value="240">4 Hours</option>
                                                    <option value="1440">1 Day</option>
                                                    <option value="10080">7 Days</option>
                                                </select>
                                            </div> <!-- /.form-group -->
                                        </div> <!-- /.col -->

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input
                                                    type="checkbox"
                                                    name="is_delete_denied"
                                                    id="is_delete_denied"
                                                    data-name="is_delete_denied"
                                                    class="toggleswitch"
                                                    value="1"
                                                    data-on="Yes" {!! $block->is_delete_denied ? 'checked="checked"' : '' !!}
                                                    data-off="No"
                                                />
                                                <label for="is_delete_denied">Prevent Deletion </label>
                                            </div> <!-- /.form-group -->

                                            <div class="form-group">
                                                <label for="order">Order</label>
                                                <input type="number" name="order" id="order" class="form-control" data-name="order" value="{!! $block->order !!}">
                                            </div> <!-- /.form-group -->
                                        </div> <!-- /.col -->
                                    </div> <!-- /.row -->
                                </div> <!-- /.well -->

                                <span class="btn-group-lg">
                                    <button
                                        style="float:left"
                                        type="submit"
                                        class="btn btn-success btn-lg save"
                                    >{{ __('voyager.generic.save') }} This Block</button>
                                </span>
                            </form>

                            @if (!$block->is_delete_denied)
                                <form method="POST" action="{{ route('voyager.page-blocks.destroy', $block->id) }}">
                                    {{ method_field("DELETE") }}
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <span class="btn-group-xs">
                                        <button
                                            data-delete-block-btn
                                            type="submit"
                                            style="float:right; margin-top:22px"
                                            class="btn btn-danger btn-xs delete"
                                        >{{ __('voyager.generic.delete') }} This Block</button>
                                    </span>
                                </form>
                            @endif
                        </div> <!-- /.panel-body -->
                    </div> <!-- /.panel -->
                @endforeach
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $('document').ready(function () {
            // Enable CHECKBOX toggle component
            $('.toggleswitch').bootstrapToggle();

            // Make TINYMCE a 'lil smaller, height-wise
            setTimeout(function() {
                $('.mce-tinymce').each(function() {
                    $(this).find('iframe').css({'height': 250, 'min-height': 250});
                });
            }, 1000);

            // IMAGE fields types
            $('input[type=file]').each(function() {
                $(this).closest('.form-group').addClass('vpb-image-group');
            });

            // Confirm DELETE block
            $("[data-delete-block-btn]").on('click', function(e){
                e.preventDefault();
                var result = confirm("Are you sure you want to delete this block?");
                if (result) $(this).closest('form').submit();
            });
        });
    </script>
@endsection