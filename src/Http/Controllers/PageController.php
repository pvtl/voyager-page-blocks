<?php

namespace Pvtl\VoyagerPageBlocks\Http\Controllers;

use Pvtl\VoyagerPageBlocks\Page;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

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
                    'data' => $block->cachedData,
                ];
            });
        
        // Override standard body content, with page block content
        $page['body'] = view('voyager-page-blocks::default', compact('page', 'blocks'));

        // Check that the page Layout View exists
        $layout = (!empty($page->layout)) ? $page->layout : 'default';
        if (!View::exists('voyager-frontend::layouts.' . $layout)) $layout = 'default';

        // Return the full page
        return view('voyager-frontend::modules/pages/default', compact('page', 'layout'));
    }
}
