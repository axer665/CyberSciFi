<?php

namespace Character\BattleSquad;

use Character\Character;
use Items\Equipment\Equipment;
use Races\Race;

interface iBattleSquad
{
    public function getName();
    public function addRace(Race $race);
    public function getRaces(): array;
    public function addEquip(Equipment $equip);
    public function getEquip(): array;

    public function addUnit(Character $character);
    public function getUnits(): array;
    public function setLeader(Character $character);
    public function getLeader(): Character;
}