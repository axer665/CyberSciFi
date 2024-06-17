<?php

namespace Core;

use Core\Controllers\AuthController;
use Core\Controllers\LoginController;
use Core\Controllers\MainController;
use Core\Controllers\RegisterController;
use Core\Controllers\ApiController;
use Core\Middleware\Middleware;
use Starter\InitData;

class Router {
    private string $url;
    private array $selectedRoute = [
        "path" => "",
        "arguments" => []
    ];


    private array $routes = [
        "/" => [MainController::class, "index"],

        "/auth" => [AuthController::class, "auth"],
        "/registration" => [AuthController::class, "registration"],
        "/logout" => [AuthController::class, "logout"],

        "/user" => [MainController::class, "user", "auth"],
        "/users" => [MainController::class, "users", "auth"],

        "/api/data" => [ApiController::class, "getData"],
        "/api/getRaces" => [ApiController::class, "getRaces"],
        "/category/:cat/product/:pr/data" => [MainController::class, "page"],

        // login pages
        "/login" => [LoginController::class, "index"],
        "/user/command" => [LoginController::class, "userCommand"],

        // registration pages
        "/registration" => [RegisterController::class, "index"],
        "/registration/send" => [RegisterController::class, "analyze"],

        // login API (actions)
        // try return pages views - done!
        "/login/auth" => [LoginController::class, "login"],
        "/login/registration" => [LoginController::class, "registration"],
        "/login/logout" => [LoginController::class, "logout"],

        "/login/getDefaultPages" => [LoginController::class, "getDefaultPages"],
    ];

    public function __construct($url) {
        //if (strpos($url, "&")) {
        if (strpos($url, "?")) {
            $this->url = stristr($url, "?", true);
        } else {
            $this->url = $url;
        }
        $this->checkRoute();
    }

    private function checkRoute(): void
    {
        foreach($this->routes AS $routePath => $routeHandler) {
            if (strripos($routePath, ":") === false) {
                if ($routePath == $this->url) {
                    $this->selectedRoute['path'] = $routePath;
                }
                continue;
            } else {
                preg_replace("/:(.*?)\//", '{[random]}/', $routePath, -1, $count);
                $routeArr = explode("/", $routePath);
                $urlArr = explode("/", $this->url);
                $discrepancies = array_diff_assoc($routeArr, $urlArr);

                if (count($discrepancies) == $count) {
                    $arguments = [];
                    foreach ($discrepancies AS $discrepancyKey => $discrepancy) {
                        $arguments[mb_substr($discrepancy, 1)] = $urlArr[$discrepancyKey];
                    }
                    $this->selectedRoute['path'] = $routePath;
                    $this->selectedRoute['arguments'] = $arguments;
                }
            }
        }
    }

    public function run(): void {
        InitData::start();
        if ($this->selectedRoute['path'] != "") {
            if (method_exists($this->routes[$this->selectedRoute['path']][0], $this->routes[$this->selectedRoute['path']][1])) {
                $route = new $this->routes[$this->selectedRoute['path']][0];
                $funcName = $this->routes[$this->selectedRoute['path']][1];
                if (isset($this->routes[$this->selectedRoute['path']][2])) {
                    $middlewareMethod = $this->routes[$this->selectedRoute['path']][2];
                    Middleware::$route = $route;
                    Middleware::$middlewareMethod();
                }
                $route->$funcName($this->selectedRoute['arguments']);
                //call_user_func([$route, $funcName], $this->selectedRoute['arguments']);
            } else {
                print_r("method not exist");
            }
        } else {
            print_r("404");
        }
    }
}