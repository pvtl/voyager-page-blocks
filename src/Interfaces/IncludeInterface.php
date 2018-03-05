<?php

namespace Pvtl\VoyagerPageBlocks\Interfaces;

interface IncludeInterface
{
    /**
     * Inside of buildView() you will declare your view file and the view data that
     * is passed into your view, you will then return the contents of the locally scoped
     * buildViewComponents() which will stitch it all together for you.
     *
     * The setViewFile() method will take your file name minus the .blade.php extension, this
     * file must be included in your core app/resources/views/includes folder.
     *
     * The setViewData() method will take key and data (array/string) parameters which will allow
     * you to call anything you like inside your custom included blade template.
     *
     * @return object
     */
    public function buildView();
}