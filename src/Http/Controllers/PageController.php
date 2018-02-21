<?php

namespace Pvtl\VoyagerPageBlocks\Http\Controllers;

use App\Page;

class PageController extends Controller
{
    public function getPage($slug = 'home')
    {
        $page = Page::where('slug', '=', $slug)->firstOrFail();
        $blocks = $page->blocks()
            ->where('is_hidden', '=', '0')
            ->orderBy('order', 'asc')
            ->get()
            ->map(function ($block) {
                return (object)[
                    'template' => $block->template()->template,
                    'data' => $block->data,
                ];
            });

        return view('voyager-frontend::modules/pages/default', compact('page', 'blocks'));
    }
}
