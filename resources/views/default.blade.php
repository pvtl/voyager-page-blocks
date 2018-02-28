@foreach($blocks as $block)
    @component('voyager-page-blocks::block_templates/' . $block->template, ['blockData' => $block->data])
    @endcomponent
@endforeach
