<?php

namespace Character;

use Craft\Craft;
use Items\Equipment\Equipment;
use Races\Race;

abstract class Character implements iCharacter {

    protected string $name;
    protected string $description = "";
    protected string $sex;
    protected int $age;

    protected Race $race;
    protected array $professions = [];

    protected array $inventory = [];
    protected array $equipment = [
        "head" => null,
        "body" => null,
        "pants" => null,
        "boots" => null,

        "mainWeapon" => null,
        "miniWeapon" => null,
    ];

    public function __construct($name) {
        $this->name = $name;
    }

    public function useEquip(Equipment $equip) {
        $this->equipment[$equip->getTarget()] = $equip;
    }

    public function setDescription(string $description) {
        $this->description = $description;
    }

    public function addProfession(Craft $craft) {
        $this->professions[] = $craft;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getRace(): Race
    {
        return $this->race;
    }

    public function getEquipment():array
    {
        return $this->equipment;
    }
}