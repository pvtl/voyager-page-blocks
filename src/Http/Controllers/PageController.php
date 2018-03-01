<?php

namespace Pvtl\VoyagerPageBlocks\Http\Controllers;

use Pvtl\VoyagerPageBlocks\Page;
use Pvtl\VoyagerFrontend\Http\Controllers\VoyagerFrontendController;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    protected $request;

    protected $frontendController;

    /**
     * PageController constructor.
     *
     * @param Request $request
     * @param VoyagerFrontendController $frontendController
     */
    public function __construct(Request $request, VoyagerFrontendController $frontendController)
    {
        $this->request = $request;
        $this->frontendController = $frontendController;
    }

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
                ];
            });
        
        // Override standard body content, with page block content
        $page['body'] = view('voyager-page-blocks::default', [
            'page' => $page,
            'blocks' => $blocks,
            'breadcrumbs' => $this->frontendController->getBreadcrumbs($this->request),
        ]);

        // Check that the page Layout View exists
        $layout = (!empty($page->layout)) ? $page->layout : 'default';
        if (!View::exists('voyager-frontend::layouts.' . $layout)) $layout = 'default';

        // Return the full page
        return view('voyager-frontend::modules/pages/default', [
            'page' => $page,
            'layout' => $layout,
            'breadcrumbs' => $this->frontendController->getBreadcrumbs($this->request),
        ]);
    }
}
