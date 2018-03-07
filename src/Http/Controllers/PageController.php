<?php

namespace Pvtl\VoyagerPageBlocks\Http\Controllers;

use Pvtl\VoyagerPageBlocks\Page;
use Illuminate\Support\Collection;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
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
                    'id' => $block->id,
                    'page_id' => $block->page_id,
                    'updated_at' => $block->updated_at,
                    'cache_ttl' => $block->cache_ttl,
                    'template' => $block->template()->template,
                    'data' => $block->cachedData,
                    'path' => $block->path,
                    'type' => $block->type,
                ];
            });

        // Override standard body content, with page block content
        $page['body'] = view('voyager-page-blocks::default', [
            'page' => $page,
            'blocks' => $this->prepareEachBlock($blocks),
        ]);

        // Check that the page Layout and its View exists
        if (empty($page->layout)) {
            $page->layout = 'default';
        }
        if (!View::exists('voyager-frontend::layouts.' . $page->layout)) {
            $page->layout = 'default';
        }

        // Return the full page
        return view('voyager-frontend::modules.pages.default', [
            'page' => $page,
            'layout' => $page->layout,
        ]);
    }


    /**
     * Ensure each page block has the correct data, in the correct format
     *
     * @param Collection $blocks
     * @return array
     */
    protected function prepareEachBlock(Collection $blocks)
    {
        return array_map(function ($block) {
            // 'Include' block types
            if ($block->type === 'include' && !empty($block->path)) {
                $block = $this->prepareIncludeBlockTypes($block);
            }

            if ($block->type === 'template' && !empty($block->template)) {
                $block = $this->prepareTemplateBlockTypes($block);
            }

            // Add HTML cache by key: $block->id - $block->page_id - $block->updated_at
            $cacheKey = "blocks/$block->id-$block->page_id-$block->updated_at";
            return Cache::remember($cacheKey, $block->cache_ttl, function () use ($block) {
                return $block;
            });
        }, $blocks->toArray());
    }


    /**
     * Ensure each page block has all of the keys from
     * config, in the DB output (to prevent errors in views)
     *
     * @param $block
     * @return mixed
     */
    protected function prepareTemplateBlockTypes($block)
    {
        $templateKey = $block->path;
        $templateConfig = Config::get("page-blocks.$templateKey");

        foreach ((array)$templateConfig['fields'] as $fieldName => $fieldConfig) {
            if (!array_key_exists($fieldName, $block->data)) {
                $block->data->$fieldName = null;
            }
        }

        if (View::exists($block->template)) {
            $block->html = View::make($block->template, ['blockData' => $block->data])->render();
        }

        return $block;
    }


    /**
     * Prepare each 'include' type block
     *
     * @param $block
     * @return mixed
     */
    protected function prepareIncludeBlockTypes($block)
    {
        list($className, $methodName) = explode('::', $block->path);
        preg_match('/\(.*?\)/', $methodName, $parameters);

        if (count($parameters) > 0) {
            $methodName = str_replace($parameters[0], '', $methodName);
            $parameters = explode(',', str_replace(['(', ')'], '', $parameters[0]));
        }

        $class = new $className();
        $block->html = $class->$methodName(...$parameters)->render();

        return $block;
    }
}
