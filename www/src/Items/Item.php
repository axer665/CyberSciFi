<?php

namespace Items;

abstract class Item implements iItem {

    protected string $name;
    protected string $description;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function setDescription(string $description) {
        $this->description = $description;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }
}