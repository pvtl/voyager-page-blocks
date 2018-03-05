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

    /**
     * @param $file
     * @return $this
     */
    protected function setViewFile($file)
    {
        $this->viewFile = $file;

        return $this;
    }

    /**
     * @param $key
     * @param $data
     * @return $this
     */
    protected function setViewData($key, $data)
    {
        $this->viewData->{$key} = $data;

        return $this;
    }

    /**
     * @return object
     */
    protected function buildViewComponents()
    {
        return (object)[
            'template' => 'include',
            'data' => $this->viewData,
            'path' => $this->viewFile,
        ];
    }
}