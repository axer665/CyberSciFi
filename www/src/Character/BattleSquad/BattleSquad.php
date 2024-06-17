<?php

namespace Character\BattleSquad;

use Character\Character;
use Exceptions\SquadEquipmentException;
use Exceptions\SquadRaceException;
use Items\Equipment\Equipment;
use Races\Race;
use Exceptions\SquadUnitException;

class BattleSquad implements iBattleSquad
{
    protected string $name;
    protected Character $leader;
    protected array $races = [];
    protected array $equipments = [];

    protected array $units = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function addRace(Race $race)
    {
        if (!in_array($race, $this->races)) {
            $this->races[] = $race;
        }
    }

    public function getRaces(): array
    {
        return $this->races;
    }

    public function addEquip(Equipment $equip)
    {
        if ($this->checkEquip($equip)) {
            $this->equipments[] = $equip;
        }
    }

    public function getEquip(): array
    {
        return $this->equipments;
    }

    private function checkEquip(Equipment $equip): bool
    {
        if (!in_array($equip, $this->equipments)) {
            if (count($this->equipments) > 0) {
                foreach ($this->equipments AS $equipment) {
                    if ($equipment->getTarget() != $equip->getTarget()) {
                        return true;
                    }
                }
            } else {
                return true;
            }
        }
        return false;
    }

    public function addUnit(Character $character)
    {
        try {
            if ($this->checkUnit($character) &&
                $this->checkUserEquipment($character) &&
                $this->checkUserRace($character)
            ){
                $this->units[] = $character;
            }
        } catch (SquadUnitException $e) {
            print_r($e->getMessage());
        } catch (SquadRaceException $e) {
            print_r($e->getMessage());
        } catch (SquadEquipmentException $e) {
            print_r($e->getMessage());
        }
    }

    /**
     * @throws SquadUnitException
     */
    private function checkUnit(Character $character):bool {
        if (!in_array($character, $this->units)) {
            return true;
        } else {
            throw new SquadUnitException($this->name, $character);
        }
    }

    /**
     * @throws SquadRaceException
     */
    private function checkUserRace(Character $character)
    {
        if (in_array($character->getRace(), $this->races)) {
            return true;
        } else {
            throw new SquadRaceException($this->name, $character);
        }
    }

    /**
     * @throws SquadEquipmentException
     */
    private function checkUserEquipment(Character $character)
    {
        $requiredNumber = count($this->equipments);
        $coincidences = 0;
        if ($requiredNumber === 0) {
            return true;
        }
        if ($requiredNumber > 0) {
            foreach ($this->equipments AS $equipment) {
                if (in_array($equipment, $character->getEquipment())) {
                    $coincidences++;
                }
            }
            if ($requiredNumber == $coincidences) {
                return true;
            }
        }

        throw new SquadEquipmentException($character);
    }

    public function getUnits(): array
    {
        return $this->units;
    }

    public function setLeader(Character $character):bool
    {
        try {
            if ($this->checkUserEquipment($character) &&
                $this->checkUserRace($character) &&
                !isset($this->leader)
            ){
                $this->leader = $character;
                return true;
            }
        } catch (SquadUnitException $e) {
            print_r($e->getMessage());
        } catch (SquadRaceException $e) {
            print_r($e->getMessage());
        } catch (SquadEquipmentException $e) {
            print_r($e->getMessage());
        }

        return false;
    }

    public function getLeader(): Character
    {
        return $this->leader;
    }
}