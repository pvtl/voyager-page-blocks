<?php

namespace Pvtl\VoyagerPageBlocks;

use Pvtl\VoyagerFrontend\Helpers\ClassEvents;

class Page extends \Pvtl\VoyagerFrontend\Page
{
    // Add relation to page blocks
    public function blocks()
    {
        return $this->hasMany('Pvtl\VoyagerPageBlocks\PageBlock');
    }

    // Get a list of page layouts
    public function getPageLayouts()
    {
        $layouts = array();

        // Get list of layouts from module
        $vendorLayoutsDir = base_path('vendor/pvtl/voyager-frontend/resources/views/layouts');
        if (is_dir($vendorLayoutsDir)) {
            $layouts = scandir($vendorLayoutsDir);
        }

        // Get list of layouts from project
        $projectLayoutsDir = resource_path('views/vendor/voyager-frontend/layouts');
        if (is_dir($projectLayoutsDir)) {
            $layouts = array_merge($layouts, scandir($projectLayoutsDir));
        }

        foreach ($layouts as $i => $layout) {
            // Only include files that are .blade.php files
            if (strpos($layout, '.blade.php') === false) {
                unset($layouts[$i]);
                continue;
            }

            // Strip out .blade.php for DB reference
            $layouts[$i] = str_replace('.blade.php', '', $layout);
        }

        // Remove duplicates
        $layouts = array_unique($layouts);

        // Reset indexes
        $layouts = array_values($layouts);

        // Reset indexes and return
        return $layouts;
    }

    /**
     * Get the indexed data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Include page block data to be "Searchable"
        $pageBlocks = $this->blocks()->get()->map(function ($block) {
            // If it's an included file, return the HTML of this block to be searched
            if ($block->type === 'include') {
                return trim(preg_replace(
                    '/\s+/',
                    ' ',
                    strip_tags(ClassEvents::executeClass($block->path)->render()->html)
                ));
            }

            $blockContent = [];

            foreach ($block->data as $datum) {
                $blockContent[] = strip_tags($datum);
            }

            return $blockContent;
        });

        $array['page_blocks'] = implode(' ', array_flatten($pageBlocks));

        return $array;
    }
}
