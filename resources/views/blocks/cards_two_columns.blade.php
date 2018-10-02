<!-- TWO CARD BLOCK -->
<div class="page-block @if (in_array($blockData->spaces, [0, 2])) page-block-space-bottom @endif @if (in_array($blockData->spaces, [1, 2])) page-block-space-top @endif">
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="cell small-12 medium-6" @if (!empty($blockData->animate)) data-scrollreveal @endif>
                <div class="card">
                    @if (!empty($blockData->image_1))
                        @if (!empty($blockData->link_1))<a href="{{ $blockData->link_1 or '' }}">@endif
                        <img src="{{ imageUrl($blockData->image_1, 570, 260) }}">
                        @if (!empty($blockData->link_1))</a>@endif
                    @endif

                    <div class="card-section">
                        @if (!empty($blockData->title_1))
                            <h4>{{ $blockData->title_1 }}</h4>
                        @endif

                        @if (!empty($blockData->content_1))
                            <p>{{ $blockData->content_1 }}</p>
                        @endif

                        @if (!empty($blockData->link_1))
                            <a href="{{ $blockData->link_1 }}" class="button">{{ $blockData->button_text_1 }}</a>
                        @endif
                    </div> <!-- /.card-section -->
                </div> <!-- /.card -->
            </div> <!-- /.cell -->

            <div class="cell small-12 medium-6" @if (!empty($blockData->animate)) data-scrollreveal @endif>
                <div class="card">
                    @if (!empty($blockData->image_2))
                        @if (!empty($blockData->link_2))<a href="{{ $blockData->link_2 or '' }}">@endif
                        <img src="{{ imageUrl($blockData->image_2, 570, 260) }}">
                        @if (!empty($blockData->link_2))</a>@endif
                    @endif

                    <div class="card-section">
                        @if (!empty($blockData->title_2))
                            <h4>{{ $blockData->title_2 }}</h4>
                        @endif

                        @if (!empty($blockData->content_2))
                            <p>{{ $blockData->content_2 }}</p>
                        @endif

                        @if (!empty($blockData->link_2))
                            <a href="{{ $blockData->link_2 }}" class="button">{{ $blockData->button_text_2 }}</a>
                        @endif
                    </div> <!-- /.card-section -->
                </div> <!-- /.card -->
            </div> <!-- /.cell -->
        </div> <!-- /.grid -->
    </div> <!-- /.container -->
</div> <!-- /.page-block -->
<!-- /TWO CARD BLOCK -->
