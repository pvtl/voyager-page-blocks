<?php

namespace Pvtl\VoyagerPageBlocks\Http\Controllers;

use Pvtl\VoyagerPageBlocks\Page;
use Illuminate\Support\Collection;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;

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
                    'type' => $block->type,
                ];
            });

        // Format and execute all includes ready for rendering
        $blocks = $this->prepareEachBlock($blocks);

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

    /**
     * Ensure each page block has the correct data, in the correct format
     *
     * @param obj $blocks
     *
     * @return obj
     */
    protected function prepareEachBlock(Collection $blocks)
    {
        return array_map(function ($block) {
            if (!empty($block->path)) {
                // 'Include' block types
                if ($block->type === 'include') {
                    $block = $this->prepareIncludeBlockTypes($block);
                } else if ($block->type === 'template') {
                    $block = $this->prepareTemplateBlockTypes($block);
                }

                return $block;
            }
        }, $blocks->toArray());
    }

    /**
     * Ensure each page block has all of the keys from
     * config, in the DB output (to prevent errors in views)
     *
     * @param obj $blocks
     *
     * @return obj
     */
    protected function prepareTemplateBlockTypes($block)
    {
        $templateKey = substr($block->path, 0, strpos($block->path, '.'));
        $templateConfig = Config::get("page-blocks.$templateKey");

        if (!empty($templateConfig['fields'])) {
            foreach ($templateConfig['fields'] as $fieldName => $fieldConfig) {
                if (!array_key_exists($fieldName, $block->data)) {
                    $block->data->$fieldName = null;
                }
            }
        }

        return $block;
    }

    /**
     * Prepare each 'include' type block
     *
     * @param obj $blocks
     *
     * @return obj
     */
    protected function prepareIncludeBlockTypes($block)
    {
        list($className, $methodName) = explode('::', $block->path);
        $class = new $className();

        $block->html = $class->$methodName();
        return $block;
    }
}
