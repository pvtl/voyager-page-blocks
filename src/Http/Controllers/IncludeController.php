<?php

namespace Pvtl\VoyagerPageBlocks\Http\Controllers;

class IncludeController
{
    protected $viewFile;

    protected $viewData;

    public function __construct()
    {
        $this->viewData = new \stdClass();
    }

    protected function setViewFile($file)
    {
        $this->viewFile = $file;
    }

    protected function setViewData($key, $data)
    {
        $this->viewData->{$key} = $data;
    }

    protected function buildViewComponents()
    {
        return (object)[
            'template' => 'include',
            'data' => $this->viewData,
            'path' => base_path("resources/$this->viewFile"),
        ];
    }
}