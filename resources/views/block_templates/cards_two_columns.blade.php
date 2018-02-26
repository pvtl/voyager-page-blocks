<div class="grid-container">
    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-6">
            <div class="card">
                @if (!empty($blockData->image1))
                    @if (!empty($blockData->link1))<a href="{!! $blockData->link1 or '' !!}">@endif
                    <img src="{!! $blockData->image1 or '' !!}">
                    @if (!empty($blockData->link1))</a>@endif
                @endif

                <div class="card-section">
                    @if (!empty($blockData->title1))
                        <h4>{!! $blockData->title1 or '' !!}</h4>
                    @endif

                    @if (!empty($blockData->content1))
                        <p>{!! $blockData->content1 or '' !!}</p>
                    @endif

                    @if (!empty($blockData->link1))
                        <a href="{!! $blockData->link1 or '' !!}" class="button">{!! $blockData->button_text1 or 'Learn More' !!}</a>
                    @endif
                </div> <!-- /.card-section -->
            </div> <!-- /.card -->
        </div> <!-- /.cell -->

        <div class="cell small-12 medium-6">
            <div class="card">
                @if (!empty($blockData->image2))
                    @if (!empty($blockData->link2))<a href="{!! $blockData->link2 or '' !!}">@endif
                    <img src="{!! $blockData->image2 or '' !!}">
                    @if (!empty($blockData->link2))</a>@endif
                @endif

                <div class="card-section">
                    @if (!empty($blockData->title2))
                        <h4>{!! $blockData->title2 or '' !!}</h4>
                    @endif

                    @if (!empty($blockData->content2))
                        <p>{!! $blockData->content2 or '' !!}</p>
                    @endif

                    @if (!empty($blockData->link2))
                        <a href="{!! $blockData->link2 or '' !!}" class="button">{!! $blockData->button_text2 or 'Learn More' !!}</a>
                    @endif
                </div> <!-- /.card-section -->
            </div> <!-- /.card -->
        </div> <!-- /.cell -->
    </div> <!-- /.grid -->
</div> <!-- /.container -->

<div class="vspace-medium-2"></div>