<?php

namespace Starter;

use JetBrains\PhpStorm\Pure;
use Races\Races;
use Character\Leaders;
use Character\DworfFactory;
use Craft\Mining;
use Items\Equipment\Boots;
use Character\BattleSquad\BattleSquad;

class InitData
{
    public function __construct()
    {

    }

    public static function start()
    {
        Races::createRace("Dworf");
        Races::createRace("Vaazh");

        $clothBoots = new Boots("Cloth Boots");

        $thor = DworfFactory::makeDworfMale("Thor");
        $thor->addProfession(new Mining());

        $thor->useEquip($clothBoots);

        //$battleGroup = new BattleSquad("Squad1");
        //$battleGroup->addEquip($clothBoots);
        //$battleGroup->addRace(Races::getRace("Vaazh"));
        //$battleGroup->addRace(Races::getRace("Dworf"));
        //$battleGroup->addUnit($thor);
        //$battleGroup->setLeader($thor);

        //$dworfs = Races::getRace("Dworf");
        //Leaders::addRace($dworfs);
        //Leaders::setRaceLeader($dworfs, $thor);
        //Races::getRace("Dworf")->removeItem("Thor");
        //print_r(Races::getRace("Dworf")->getItem("Thor"));
        //unset($thor);
        //print_r($thor);
        //
    }

    public static function getLeaders()
    {
        return Leaders::getLeaders();
    }

    #[Pure] public static function getRaces()
    {
        return Races::getRaces();
    }
}