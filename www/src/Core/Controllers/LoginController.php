<?php
namespace Core\Controllers;
use Core\Database\BaseMysql;
use Core\Views\Viewer;

class LoginController
{
    protected $defaultPages = [
        "headerLogin" => "",
        "main" => ""
    ];

    public function index()
    {
        session_start();
        $headerMenuDialog = "";
        $template = "user";
        if (isset($_SESSION['user']) && $_SESSION['user']){
            $headerMenuLogin = file_get_contents(__DIR__ . "/../Views/Templates/includes/header/menu/login/auth.tpl");
            $mainContent = file_get_contents(__DIR__ . "/../Views/Templates/includes/main/user.tpl");
            $arguments['user'] = $_SESSION['user'];
        } else {
            $headerMenuLogin = file_get_contents(__DIR__ . "/../Views/Templates/includes/header/menu/login/notAuth.tpl");
            $mainContent = file_get_contents(__DIR__ . "/../Views/Templates/includes/main/login.tpl");
            $template = "index";
        }

        $title = "index title";
        $arguments['title'] = $title;

        $arguments['headerMenuDialog'] = $headerMenuDialog;
        $arguments['headerMenuLogin'] = $headerMenuLogin;

        $arguments['main'] = $mainContent;

        if (isset($_SESSION['user'])) {
            $user = (json_decode($_SESSION['user']));

            $query = "
            SELECT
                *
            FROm 
                `character`
            WHERE 
                creator_id = {$user->id}
        ";
            $userCharacters = BaseMysql::freeQueryDataback($query);
            //print_r($userCharacters);
            $arguments['userCharacters'] = $userCharacters;
        }

        Viewer::getView($template, $arguments);
    }

    public function getDefaultPages()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']){
            $this->defaultPages["headerLogin"] = file_get_contents(__DIR__ . "/../Views/Templates/includes/header/menu/login/auth.tpl");
            $this->defaultPages["main"] = file_get_contents(__DIR__ . "/../Views/Templates/includes/main/user.tpl");
        } else {
            $this->defaultPages["headerLogin"] = file_get_contents(__DIR__ . "/../Views/Templates/includes/header/menu/login/notAuth.tpl");
            $this->defaultPages["main"] = file_get_contents(__DIR__ . "/../Views/Templates/includes/main/index.tpl");
        }

        $result = [
            "headerLogin" => $this->defaultPages["headerLogin"],
            "headerMenuLogin" => $this->defaultPages["headerLogin"],
            "main" => $this->defaultPages["main"]
        ];

        echo json_encode($result);
    }

    public function login()
    {
        session_start();
        $headerMenu = file_get_contents(__DIR__ . "/../Views/Templates/includes/header/menu/login/notAuth.tpl");
        $footer = file_get_contents(__DIR__ . "/../Views/Templates/includes/footer.tpl");
        $main = file_get_contents(__DIR__ . "/../Views/Templates/includes/main/login.tpl");

        if (isset($_SESSION['user']) && $_SESSION['user']){
            $headerMenu = file_get_contents(__DIR__ . "/../Views/Templates/includes/header/menu/login/auth.tpl");
            $main = file_get_contents(__DIR__ . "/../Views/Templates/includes/main/user.tpl");
        }

        $pagesData = [
            "header" => $headerMenu,
            "main" => $main,
            "other" => "other content",
            "footer" => $footer
        ];

        $result = json_encode($pagesData);
        echo $result;
    }

    public function registration(): void
    {
        session_start();
        $headerMenuLogin = file_get_contents(__DIR__ . "/../Views/Templates/includes/header/menu/login/notAuth.tpl");
        $footer = file_get_contents(__DIR__ . "/../Views/Templates/includes/footer.tpl");
        $main = file_get_contents(__DIR__ . "/../Views/Templates/includes/main/registration.tpl");

        if (isset($_SESSION['user']) && $_SESSION['user']){
            $headerMenuLogin = file_get_contents(__DIR__ . "/../Views/Templates/includes/header/login/user.tpl");
            $main = file_get_contents(__DIR__ . "/../Views/Templates/includes/main/user.tpl");
        }

        $pagesData = [
            "header" => $headerMenuLogin,
            "main" => $main,
            "other" => "other content",
            "footer" => $footer
        ];

        $result = json_encode($pagesData);
        echo $result;
    }

    public function logout(): void
    {

    }

    public function userCommand(): void
    {
        session_start();
        $result = 0;
        if (isset($_SESSION['user'])) {
            $user = (json_decode($_SESSION['user']));

            $query = "
                SELECT
                    *
                FROm 
                    `character`
                WHERE 
                    creator_id = {$user->id}
            ";
            $userCharacters = BaseMysql::freeQueryDataback($query);
            $result = json_encode($userCharacters);
        }
        echo $result;
    }
}