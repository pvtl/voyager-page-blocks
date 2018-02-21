@extends('voyager-frontend::layouts.default')
@section('meta_title', $page->title)
@section('meta_description', $page->meta_description)

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            @foreach($blocks as $block)
                @component('block_templates/' . $block->template, ['blockData' => $block->data])
                @endcomponent
            @endforeach

        </div>
    </div>
@endsection
