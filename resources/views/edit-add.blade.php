@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <form role="form" action="{{ route('voyager.page-blocks.store', $page->id) }}" method="POST"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="panel-body">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <h2>Add Block</h2>

                            <label for="type">Block Type: </label>
                            <select name="type" id="type">
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

                            <input type="hidden" name="page_id" value="{{ $page->id }}"/>

                            <br>
                            <button type="submit"
                                    class="btn btn-success btn-sm">{{ __('voyager.generic.add') }}</button>
                        </div>
                    </form>
                </div>

                @foreach($pageBlocks as $block)
                    @php
                        $template = $block->template();
                        $dataTypeContent = $block->data;
                    @endphp

                    <form role="form" action="{{ route('voyager.page-blocks.update', $block->id) }}" method="POST"
                          enctype="multipart/form-data">
                        <div class="panel-body">
                            <h2>{{ $template->name }}</h2>
                            {{ method_field("PUT") }}
                            {{ csrf_field() }}

                            <div class="form-group">
                                @foreach($template->fields as $row)
                                    @php $options = $row; @endphp

                                    <br>

                                    <h6>{{ $row->display_name }}</h6>

                                    @include($row->partial)

                                @endforeach

                                <br>
                                <br>

                                <label for="is_hidden" style="display: inline; padding-right: 5px;">Hide Block </label>
                                <input type="checkbox" name="is_hidden" id="is_hidden" data-name="is_hidden"
                                       class="toggleswitch"
                                       value="1"
                                       data-on="Yes" {!! $block->is_hidden ? 'checked="checked"' : '' !!}
                                       data-off="No">

                                <br>
                                <br>

                                <label for="is_delete_denied" style="display: inline; padding-right: 5px;">Prevent
                                    Deletion</label>
                                <input type="checkbox" name="is_delete_denied" id="is_delete_denied"
                                       data-name="is_delete_denied"
                                       class="toggleswitch" value="1"
                                       data-on="Yes" {!! $block->is_delete_denied ? 'checked="checked"' : '' !!}
                                       data-off="No">

                                <br>
                                <br>

                                <label for="cache_ttl" style="display: inline; padding-right: 5px;">Cache Time</label>
                                <select name="cache_ttl" id="cache_ttl">
                                    <option value="0" selected="selected">None / Off</option>
                                    <option value="5">5 mins</option>
                                    <option value="30">30 mins</option>
                                    <option value="60">1 Hour</option>
                                    <option value="240">4 Hours</option>
                                    <option value="1440">1 Day</option>
                                    <option value="10080">7 Days</option>
                                </select>

                                <br>
                                <br>

                                <label for="order" style="display: inline;">Order:</label>
                                <input type="number" name="order" id="order" data-name="order"
                                       value="{!! $block->order !!}">
                            </div>
                        </div>

                        <button style="float: left; margin-left: 15px;" type="submit"
                                class="btn btn-primary save">{{ __('voyager.generic.save') }}</button>
                    </form>

                    <form method="POST" action="{{ route('voyager.page-blocks.destroy', $block->id) }}">
                        {{ method_field("DELETE") }}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-danger delete">{{ __('voyager.generic.delete') }}</button>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
@stop
