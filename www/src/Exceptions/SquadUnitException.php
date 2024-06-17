<?php

namespace Exceptions;

use Character\Character;
use Exception;

class SquadUnitException extends Exception
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
        Exception::__construct('В команде ' . $squadName . " уже присутствует персонаж " .$character->getName());
        $this->character = $character;
        $this->squadName = $squadName;
    }
    /**
     * @return Character
     */
    public function getCharacter()
    {
        return $this->character;
    }
}