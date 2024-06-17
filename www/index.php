<?php

// Сделаем автоматическую загрузку классов
spl_autoload_register(function ($class) {
    include __DIR__ . '/src/' . str_replace('\\', '/', $class) . '.php';
});

define("MAIN", __DIR__);

use Core\Router;

//$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//echo $url;
//https://example.com/category/page?sort=asc

$url = $_SERVER['REQUEST_URI']; // /category/page?sort=asc

$router = new Router($url);
$router->run();