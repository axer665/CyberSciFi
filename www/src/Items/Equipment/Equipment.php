<?php

namespace Items\Equipment;

use Items\Item;

class Equipment extends Item
{
    protected string $target;

    public function __construct(string $name)
    {
        parent::__construct($name);
    }

    public function getTarget(): string
    {
        return $this->target;
    }
}