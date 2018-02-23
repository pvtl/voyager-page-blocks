<div class="grid-container">
    <div class="grid-x grid-padding-x grid-padding-y">
        <div class="cell small-12 medium-6">
            <div class="card">
                <img src="{!! $blockData->image1 or '' !!}">
                <div class="card-section">
                    <h4>{!! $blockData->title1 or '' !!}</h4>
                    <p>{!! $blockData->content1 or '' !!}</p>
                    <a href="{!! $blockData->link1 or '' !!}" class="button">{!! $blockData->button_text1 or '' !!}</a>
                </div> <!-- /.card-section -->
            </div> <!-- /.card -->
        </div> <!-- /.cell -->

        <div class="cell small-12 medium-6">
            <div class="card">
                <img src="{!! $blockData->image2 or '' !!}">
                <div class="card-section">
                    <h4>{!! $blockData->title2 or '' !!}</h4>
                    <p>{!! $blockData->content2 or '' !!}</p>
                    <a href="{!! $blockData->link2 or '' !!}" class="button">{!! $blockData->button_text2 or '' !!}</a>
                </div> <!-- /.card-section -->
            </div> <!-- /.card -->
        </div> <!-- /.cell -->
    </div> <!-- /.grid -->
</div> <!-- /.container -->