<?php

namespace Character;

use Races\Races;

class Dworf extends Character {

    public function __construct(DworfBuilder $builder)
    {
        $this->name = $builder->name;
        $this->sex = $builder->sex;
        $this->age = $builder->age;
        $this->race = $builder->race;

        Races::getRace("Dworf")->addItem($this);
    }
}