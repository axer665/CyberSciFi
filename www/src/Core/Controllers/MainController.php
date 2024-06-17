<?php

namespace Core\Controllers;

use Core\Helpers\TokenGenerator;
use Core\Models\Model;
use Core\Views\Viewer;

class MainController {
    public function index(array $arguments): void
    {
        //$testData = (new Model("test"))->getAllData();
        //print_r($testData);
        session_start();
        print_r($_SESSION);
        $headerMenuDialog = "";
        $template = "index";
        if (isset($_SESSION['user']) && $_SESSION['user']){
            $headerMenuLogin = file_get_contents(__DIR__ . "/../Views/Templates/includes/header/menu/login/auth.tpl");
            $mainContent = file_get_contents(__DIR__ . "/../Views/Templates/includes/main/index.tpl");

        } else {
            $headerMenuLogin = file_get_contents(__DIR__ . "/../Views/Templates/includes/header/menu/login/notAuth.tpl");
            $mainContent = file_get_contents(__DIR__ . "/../Views/Templates/includes/main/index.tpl");
        }

        $title = "index title";
        $arguments['title'] = $title;

        $arguments['headerMenuDialog'] = $headerMenuDialog;
        $arguments['headerMenuLogin'] = $headerMenuLogin;

        $arguments['main'] = $mainContent;

        Viewer::getView($template, $arguments);
    }

    public function page(array $arguments): void
    {
        print_r($arguments);
    }

    public function user()
    {
        Viewer::getView("user");
    }

    public function users()
    {
        Viewer::getView("users");
    }

    public function auth()
    {
        Viewer::getView("auth");
    }

    public function registration() {
        Viewer::getView("registration");
    }

}