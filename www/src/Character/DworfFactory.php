<?php

namespace Character;

class DworfFactory {
    public static function makeDworfMale($name): Dworf
    {
        $dworf = (new DworfBuilder($name))
            ->setAge(40)
            ->setSex("male")
            ->build();
        return $dworf;
    }
}