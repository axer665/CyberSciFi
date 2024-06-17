<?php
namespace Core\Controllers;
use Races\Races;

class ApiController
{
    public function getData(): void
    {
        $data = file_get_contents(MAIN . "/data.json");
        $data = json_encode($data);
        echo $data;
    }

    public function getRaces(): void
    {
        print_r(json_encode(Races::getRaces()));
    }

    public function getCharacters(): array
    {

    }
}

