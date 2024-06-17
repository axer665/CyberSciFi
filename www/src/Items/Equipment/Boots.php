<?php

namespace Items\Equipment;

class Boots extends Equipment
{
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->target = "boots";
    }
}