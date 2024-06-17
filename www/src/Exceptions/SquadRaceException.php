<?php

namespace Exceptions;

use Character\Character;
use Exception;

class SquadRaceException extends Exception
{
    /**
     * Персонаж который уже есть в команде
     * @var Character
     */
    private Character $character;
    private string $squadName;

    /**
     * @param Character $character
     * @param string $squadName
     */
    public function __construct(string $squadName, Character $character)
    {
        Exception::__construct('В команду ' . $squadName . " не принимают персонажей расы " . $character->getRace()->getName());
        $this->character = $character;
        $this->squadName = $squadName;
    }
}