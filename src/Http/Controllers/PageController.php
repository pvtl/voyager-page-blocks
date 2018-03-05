<?php

namespace Pvtl\VoyagerPageBlocks\Http\Controllers;

use Pvtl\VoyagerPageBlocks\Page;
use Illuminate\Support\Collection;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    /**
     * Fetch all pages and their associated blocks
     *
     * @param string $slug
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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
                    'path' => $block->path,
                ];
            });

        // Format and execute all includes ready for rendering
        $blocks = $this->prepareIncludedControllers($blocks);

        // Override standard body content, with page block content
        $page['body'] = view('voyager-page-blocks::default', [
            'page' => $page,
            'blocks' => $blocks,
        ]);

        // Check that the page Layout View exists
        $layout = (!empty($page->layout)) ? $page->layout : 'default';

        if (!View::exists('voyager-frontend::layouts.' . $layout)) {
            $layout = 'default';
        }

        // Return the full page
        return view('voyager-frontend::modules/pages/default', [
            'page' => $page,
            'layout' => $layout,
        ]);
    }

    public function prepareIncludedControllers(Collection $blocks)
    {
        return array_map(function ($block) {
            if ($block->template === 'include' && !empty($block->path)) {
                list($className, $methodName) = explode('::', $block->path);

                $class = new $className();

                return $class->$methodName();
            }

            return $block;
        }, $blocks->toArray());
    }
}
