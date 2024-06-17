<?php

namespace Craft;

class Craft implements iCraft {

    protected string $name;
    protected string $description = "";
    protected int $level = 0;
    protected int $underLevel = 1;

    // ассоциативный массив, где ключ - underlevel, значение - level
    protected array $levels = [
        1 => 100,
        2 => 200,
        3 => 500,
        4 => 1000,
        5 => 10000,
    ];

    public function __construct($name){
        $this->name = $name;
    }

    function getName()
    {
        return $this->name;
    }

    function getDescription()
    {
        return $this->description;
    }

    function getLevel()
    {
        return [
            "level" => $this->level,
            "underLevel" => $this->underLevel,
        ];
    }

    public function levelUp(int $experience) {
        $currentExperience = $this->level + $experience;
        foreach ($this->levels AS $underLevel => $level) {
            if ($this->underLevel == $underLevel) {
                if ($currentExperience <= $underLevel) {
                    $this->level = $currentExperience;
                } else {
                    $this->level = $level;
                }
            }
        }
    }

}