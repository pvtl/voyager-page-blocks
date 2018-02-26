<?php

namespace Pvtl\VoyagerPageBlocks\Traits;

use Illuminate\Support\Facades\Storage;

trait BlockHelper
{
    public function uploadImages(\Illuminate\Http\Request $request, array $data): array
    {
        foreach ($request->files as $key => $file) {
            $filePath = $request->file($key)->store('public/blocks');

            $data[$key] = env('APP_URL') . Storage::url($filePath);
        }

        return $data;
    }

    public function generatePlaceholders(\Illuminate\Http\Request $request): array
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