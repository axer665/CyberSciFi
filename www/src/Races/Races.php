<?php

namespace Races;

final class Races
{
    private static array $races = [];

    public static function createRace(string $raceName) {
        $race = new Race($raceName);
        self::$races[$raceName] = $race;
    }

    public static function getRaces()
    {
        return self::$races;
    }

    public static function getRace($raceName)
    {
        if (array_key_exists($raceName, self::$races)) {
            return self::$races[$raceName];
        }
    }
}