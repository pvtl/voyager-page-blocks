<?php

namespace Pvtl\VoyagerPageBlocks;

class Page extends \App\Page
{
    // Add relation to page blocks
    public function blocks()
    {
        return $this->hasMany('Pvtl\VoyagerPageBlocks\PageBlock');
    }
}