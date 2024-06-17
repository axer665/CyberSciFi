<?php

namespace Races;

use Character\Character;

class Race implements iRace {
     protected string $name;
     protected string $description;
     protected array $items = [];

     public function __construct($name)
     {
         $this->name = $name;
     }

    public function setDescription($description)
     {
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

     public function addItem(Character &$character): void
     {
         $this->items[$character->getName()] = $character;
     }

     public function getItems(): array
     {
         return $this->items;
     }

     public function getItem($name)
     {
         return $this->items[$name];
     }

     public function removeItem($itemName):void
     {
         unset($this->items[$itemName]);
     }
}