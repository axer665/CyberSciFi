<?php

namespace Core\Database;

use PDO;

class BaseMysql
{
    //Подключение к базе
    private static function connect()
    {
        $param = array(
            'host' => 'mysql',
            'dbname' => 'cyber_sc',
            'user' => 'root',
            'password' => '132',
            'option' => array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            )
        );
        $dconf = "mysql:host={$param['host']};dbname={$param['dbname']}";
        $link = new PDO($dconf, $param['user'], $param['password'], $param['option']);
        return $link;
    }

    // Получаем массив всех значений
    public static function freeQueryDataback($query)
    {
        $link = self::connect();
        $arrayData = $link->prepare($query);
        $arrayData->execute();
        $arrayData = $arrayData->fetchAll();
        return $arrayData;
    }

    // Получение значения 1 поля
    public static function returnOneField($query)
    {
        $link = self::connect();
        $data = $link->prepare($query);
        $data->execute();
        $data = $data->fetchColumn();
        return $data;
    }

    // Проверки успеха выполнения запроса
    public static function freeQueryFeed($query)
    {
        $link = self::connect();
        $data = $link->prepare($query);
        $result = $data->execute();
        return $result;
    }
}
