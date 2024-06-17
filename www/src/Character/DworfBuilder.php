<?php

namespace Character;

use Races\Races;
use Races\Race;

class DworfBuilder
{
    public string $name;
    public string $sex = "male";
    public int $age = 0;
    public Race $race;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->race = Races::getRace("Dworf");
    }

    public function setAge(int $age)
    {
        $this->age = $age;
        return $this;
    }

    public function setSex(string $sex)
    {
        $this->sex = $sex;
        return $this;
    }

    public function build(): Dworf
    {
        return new Dworf($this);
    }
}