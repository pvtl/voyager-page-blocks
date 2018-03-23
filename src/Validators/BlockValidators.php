<?php

namespace Pvtl\VoyagerPageBlocks\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlockValidators
{
    public static function validateBlock(Request $request, $block): \Illuminate\Validation\Validator
    {
        $configKey = $block->path;
        $configFields = config("page-blocks.$configKey.fields");
        $validationMessages = array();

        if ($block->type === 'include' && is_null($configFields)) {
            $controllerMethodPath = $request->input('path');
            $validator = Validator::make($request->all(), $validationMessages);

            return $validator->after(function ($validator) use ($controllerMethodPath) {
                if (strpos($controllerMethodPath, '::') === false) {
                    $validator->errors()->add('path', 'You must call your method statically using the "::" separator');
                }

                list($controller, $method) = explode('::', $controllerMethodPath);
                preg_match('/\(.*?\)/', $controllerMethodPath, $parameters);

                if (count($parameters) > 0) {
                    $method = str_replace($parameters[0], '', $method);
                }

                if (empty($method)) {
                    $validator->errors()->add('path', "You must define a method on your included controller");
                }

                if (!class_exists($controller)) {
                    $validator->errors()->add('path', "Could not locate class $controller");
                }

                if (!method_exists($controller, $method)) {
                    $validator->errors()->add('path', "Could not locate method $method in $controller");
                }

                return $validator;
            });
        }

        $validationRules = array_map(function ($field) use ($block, $configKey, &$validationMessages) {
            $required = array_key_exists('required', $field) ? $field['required'] : '';

            // When this field already has data in DB, it doesn't need to be validated against 'required'
            if (array_key_exists('field', $field)) {
                $fieldKey = $field['field'];
                if (!empty($block->data->$fieldKey)) {
                    return '';
                }
            }

            // Replace the attribute field with its display name
            $validationMessages["{$field['field']}.required"] = "The {$field['display_name']} field is required";

            return $required === 1 ? 'required' : '';
        }, $configFields);

        return Validator::make($request->all(), $validationRules, $validationMessages);
    }
}
