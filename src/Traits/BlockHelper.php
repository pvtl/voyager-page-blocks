<?php

namespace Pvtl\VoyagerPageBlocks\Traits;

use Illuminate\Http\Request;
use Pvtl\VoyagerPageBlocks\PageBlock;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

trait BlockHelper
{
    public function validateBlock(Request $request, PageBlock $block): Validator
    {
        $configKey = preg_replace('/.blade.php/', '', $block->path);
        $configFields = config("page-blocks.$configKey.fields");
        $validationMessages = array();

        $validationRules = array_map(function ($field) use ($block, $configKey, &$validationMessages) {
            $required = array_key_exists('required', $field) ? $field['required'] : '';

            // When this field already has data in DB, it doesn't need to be validated against 'required'
            if (array_key_exists('field', $field)) {
                $fieldKey = $field['field'];
                if (!empty($block->data->$fieldKey)) return '';
            }

            // Replace the attribute field with its display name
            $validationMessages["{$field['field']}.required"] = "The {$field['display_name']} field is required";

            return $required === 1 ? 'required' : '';
        }, $configFields);

        return Validator::make($request->all(), $validationRules, $validationMessages);
    }

    public function validateIncludedFile(Request $request): string
    {
        $controllerMethodPath = $request->input('path');
        list($controller, $method) = explode('@', $controllerMethodPath);

        if (empty($method) || !class_exists($controller) || !method_exists($controller, $method)) {
            return false;
        }

        return $controllerMethodPath;
    }

    public function uploadImages(Request $request, array $data): array
    {
        foreach ($request->files as $key => $file) {
            $filePath = $request->file($key)->store('public/blocks');

            $data[$key] = env('APP_URL') . Storage::url($filePath);
        }

        return $data;
    }

    public function generatePlaceholders(Request $request): array
    {
        $configKey = preg_replace(
            '/.blade.php/',
            '',
            explode('|', $request->input('type'))
        )[1];

        return array_map(function ($field) {
            return array_key_exists('placeholder', $field) ? $field['placeholder'] : '';
        }, config("page-blocks.$configKey.fields"));
    }
}