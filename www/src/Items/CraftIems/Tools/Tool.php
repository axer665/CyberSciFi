<?php

namespace Items\CraftItems\Tools;

use Items\Item;

abstract class Tool extends Item {

    protected array $professions = [];

    public function __construct(string $name)
    {
        parent::__construct($name);
    }

    public function addProfessy(string $professy) {
        array_push($this->professions, $professy);
    }

}