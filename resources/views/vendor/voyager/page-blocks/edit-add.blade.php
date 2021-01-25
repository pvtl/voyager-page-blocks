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

        /* Collapsed Panel */
        .panel-collapsed .panel-body {
            /* display: none; */
        }
        .panel-collapsed .panel-collapse-icon {
            transform: rotate(180deg);
        }

        /* Make Inputs a 'lil more visible */
        select,
        input[type="text"],
        .panel-body .select2-selection {
            border: 1px solid rgba(0,0,0,0.17)
        }

        /* Reorder */
        .dd .dd-placeholder {
            max-height: 61px;
            margin-bottom: 22px;
        }
        .dd h3.panel-title,
        .dd-dragel h3.panel-title {
            padding-left: 55px;
        }
        .dd-dragel .panel-body,
        .dd-dragging .panel-body {
            display: none !important;
        }
        .order-handle {
            z-index: 1;
            position: absolute;
            padding: 20px 15px;
            background: rgba(255,255,255,0.2);
            font-size: 15px;
            color: #fff;
            line-height: 20px;
            box-shadow: inset -2px 0px 2px rgba(0,0,0,0.1);
            cursor: move;
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
            <div class="col-md-3 col-lg-2">
                <div class="panel panel-bordered panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add Block</h3>
                        <div class="panel-actions">
                            <a class="panel-collapse-icon voyager-angle-down" data-toggle="block-collapse" aria-hidden="true"></a>
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
                                        <option value="include">Developer Controller</option>
                                    </optgroup>
                                    <optgroup label="Block Templates">
                                        @php $templates = config('page-blocks'); @endphp

                                        @foreach ($templates as $path => $template)
                                            <option value="template|{{ $path }}">
                                                {{ $template['name'] }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div> <!-- /.form-group -->

                            <input type="hidden" name="page_id" value="{{ $page->id }}"/>
                            <button type="submit" class="btn btn-success btn-sm">{{ __('voyager::generic.add') }}</button>
                        </form>

                        <iframe id="form_target" name="form_target" style="display:none"></iframe>
                        <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                              enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                            <input name="image" id="upload_file" type="file"
                                   onchange="$('#my_form').submit();this.value='';">
                            <input type="hidden" name="type_slug" id="type_slug" value="page_blocks">
                            {{ csrf_field() }}
                        </form>
                    </div> <!-- /.panel-body -->
                </div> <!-- /.panel -->
            </div> <!-- /.col -->

            <div class="col-md-9 col-lg-10">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="dd">
                    <ol class="dd-list">
                        @foreach($pageBlocks as $block)
                            @php
                                $template = $block->template();
                                $dataTypeContent = new \Pvtl\VoyagerPageBlocks\MockedModel($block->data);
                            @endphp

                            @if ($block->type === 'template')
                                @include('voyager::page-blocks.partials.template')
                            @else
                                @include('voyager::page-blocks.partials.include')
                            @endif
                        @endforeach
                    </ol> <!-- /.dd-list -->
                </div> <!-- /.dd -->
            </div> <!-- /.col -->
        </div> <!-- /.row -->
    </div> <!-- /.page-content -->
@stop

@section('javascript')
    <script>
        $('document').ready(function () {
            /**
             * Enable CHECKBOX toggle component
             */
            $('.toggleswitch').bootstrapToggle();

            /**
             * Make TINYMCE a 'lil smaller, height-wise
             */
            setTimeout(function() {
                $('.mce-tinymce').each(function() {
                    $(this).find('iframe').css({'height': 250, 'min-height': 250});
                });
            }, 1000);

            /**
             * IMAGE fields types
             */
            $('input[type=file]').each(function() {
                $(this).closest('.form-group').addClass('vpb-image-group');
            });

            /**
             * MULTIPLE-IMAGES Delete function
             */
            /*$(".remove-multi-image").on('click', function(e){
                e.preventDefault();
                var result = confirm("Are you sure you want to delete this image?");
                if (result) {
                    $.post('{{-- route('voyager.page-blocks.delete-multiple-image') --}}', {
                        field: $(this).data('id'),
                        file_name: $(this).data('file-name'),
                        _token: '{{ csrf_token() }}'
                    });
                }
            });*/

            /**
             * Confirm DELETE block
             */
            $("[data-delete-block-btn]").on('click', function(e){
                e.preventDefault();
                var result = confirm("Are you sure you want to delete this block?");
                if (result) $(this).closest('form').submit();
            });

            /**
             * COLLAPSE blocks
             */
            // Init
            $(document).on('click', '.panel-heading [data-toggle="block-collapse"]', function (e) {
                e.preventDefault();

                $(this).parents('.panel').toggleClass('panel-collapsed');
                $(this).parents('.panel').find('.panel-body').slideToggle();

                var minimized = 0;
                if ($(this).parents('.panel').hasClass('panel-collapsed')) {
                    minimized = 1;
                }

                $.post('{{ route('voyager.page-blocks.minimize') }}', {
                    id: $(this).parents('li').data('id'),
                    is_minimized: minimized,
                    _token: '{{ csrf_token() }}'
                });
            });

            /**
             * ORDER blocks
             */
             // Init drag 'n drop
            $('.dd').nestable({ handleClass: 'order-handle', maxDepth: 1 });

            // Close all panels when dragging
            $('.order-handle').on('mousedown', function() { $('.dd').addClass('dd-dragging'); });

            // Fire request when drag complete
            $('.dd').on('change', function (e) {
                // Only when it's a result of drag and drop
                // -- Otherwise this triggers on every form change within .dd
                if ($('.dd').hasClass('dd-dragging')) {
                    // And reopen panels once drag has finished
                    $('.dd').removeClass('dd-dragging');

                    // Post the request
                    $.post('{{ route('voyager.page-blocks.sort') }}', {
                        order: JSON.stringify($('.dd').nestable('serialize')),
                        _token: '{{ csrf_token() }}'
                    }, function (data) {
                        toastr.success("Block order saved");
                    });
                }
            });
        });
    </script>
@endsection
