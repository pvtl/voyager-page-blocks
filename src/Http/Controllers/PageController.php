<?php

namespace Pvtl\VoyagerPageBlocks\Http\Controllers;

use Pvtl\VoyagerPageBlocks\Page;
use Illuminate\Routing\Controller;

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
                    'template' => $block->template(),
                    'data' => $block->cachedData,
                ];
            });

        $page['body'] = view('voyager-page-blocks::default', compact('page', 'blocks'));

        return view('voyager-frontend::modules/pages/default', compact('page'));
    }
}
