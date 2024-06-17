<?php

namespace Exceptions;

use Character\Character;
use Exception;

class SquadEquipmentException extends Exception
{
    /**
     * @param Character $character
     */
    public function __construct(Character $character)
    {
        Exception::__construct("У персонажа " . $character->getName() . " нет подходящей экипировки ");
    }
}