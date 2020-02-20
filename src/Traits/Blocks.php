<?php

namespace Pvtl\VoyagerPageBlocks\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Pvtl\VoyagerFrontend\Helpers\ClassEvents;
use Pvtl\VoyagerFrontend\Helpers\BladeCompiler;

trait Blocks
{
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
                $block->html = ClassEvents::executeClass($block->path)->render();
            }

            // 'Template' block types
            if ($block->type === 'template' && !empty($block->template)) {
                $block = $this->prepareTemplateBlockTypes($block);
            }

            // Add HTML to cache by key: $block->id - $block->page_id - $block->updated_at
            $cacheKey = "blocks/$block->id-$block->page_id-$block->updated_at";

            $ttl = $block->cache_ttl;
            // When not in local dev (eg. prod), let's always cache for at least 1min
            if (empty($ttl) && app('env') != 'local') {
                $ttl = 1;
            }
            return Cache::remember($cacheKey, $ttl, function () use ($block) {
                return $block;
            });
        }, $blocks->toArray());
    }

    /**
     * Ensure each page block has all of the keys from
     * config, in the DB output (to prevent errors in views)
     * + compile each piece of HTML (eg. for short codes)
     *
     * @param $block
     * @return mixed
     * @throws \Exception
     */
    protected function prepareTemplateBlockTypes($block)
    {
        $templateKey = $block->path;
        $templateConfig = Config::get("page-blocks.$templateKey");

        // Ensure every key from config exists in collection
        foreach ((array)$templateConfig['fields'] as $fieldName => $fieldConfig) {
            if (!isset($block->data->$fieldName)) {
                $block->data->$fieldName = null;
            }
        }

        // Compile each piece of content from the DB, into HTML
        foreach ($block->data as $key => $data) {
            $block->data->$key = BladeCompiler::getHtmlFromString($data);
        }

        // Compile the Blade View to give us HTML output
        if (View::exists($block->template)) {
            $block->html = View::make($block->template, [
                'blockData' => $block->data,
            ])->render();
        }

        return $block;
    }

    public function uploadImages(Request $request, array $data): array
    {
        foreach ($request->files as $key => $field) {
            unset($data[$key]);
            if (is_array($request->file($key))) {
                $multiImages = array();
                foreach ($request->file($key) as $key2 => $file) {
                    $filePath = $file->store('public/blocks');
                    $multiImages[] = str_replace('public/', '', $filePath);
                }
                $data[$key] = json_encode($multiImages);
            } else {
                $filePath = $request->file($key)->store('public/blocks');
                $data[$key] = str_replace('public/', '', $filePath);
            }
        }
        return $data;
    }

    public function generatePlaceholders(Request $request): array
    {
        $configKey = explode('|', $request->input('type'))[1];

        return array_map(function ($field) {
            return array_key_exists('placeholder', $field) ? $field['placeholder'] : '';
        }, config("page-blocks.$configKey.fields"));
    }
}
