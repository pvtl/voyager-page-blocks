@foreach($blocks as $block)
    @component('block_templates/' . $block->template, ['blockData' => $block->data])
    @endcomponent
@endforeach
