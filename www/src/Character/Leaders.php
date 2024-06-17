<?php

namespace Character;
use Races\Race;

final class Leaders
{
    //private static $instance;
    private static $races = [];

    private function __construct()
    {
        // Прячем конструктор
    }

    public static function addRace(Race $race)
    {
        if (!array_key_exists($race->getName(), self::$races)) {
            self::$races[][$race->getName()] = null;
        }
    }

    public static function setRaceLeader(Race $race, Character $character)
    {
        // если еще нет такой расы, то заносим ее в массив и затем добавляем лидера
        if (!array_key_exists($race->getName(), self::$races)) {
            self::addRace($race);
            self::$races[$race->getName()] = $character;
        } else {
            if (!self::$races[$race->getName()]) {
                self::$races[$race->getName()] = $character;
            }
        }
    }

    public static function getLeaders() {
        return self::$races;
    }

    /*public static function getInstance(): Leader
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }*/

    private function __clone()
    {
        // Отключаем клонирование
    }

    public function __wakeup()
    {
        // Отключаем десериализацию
    }
}