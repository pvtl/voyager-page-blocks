<?php

namespace Pvtl\VoyagerPageBlocks;


class MockedModel
{
    public function __construct($datem)
    {
        foreach ($datem as $key => $data) {
            $this->$key = $data;
        }
    }

    public function getKey()
    {
        return $this->id;
    }
}
