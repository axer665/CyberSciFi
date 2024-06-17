<?php
namespace Core\Controllers;
use Core\Database\BaseMysql;
use Core\Helpers\TokenGenerator;
use Core\Models\Model;
use Core\Views\Viewer;

class RegisterController
{
    protected $defaultPages = [
        "headerLogin" => "",
        "main" => ""
    ];

    public function index()
    {
        session_start();
        $headerMenuDialog = "";
        $template = "index";
        if (isset($_SESSION['user']) && $_SESSION['user']){
            $headerMenuLogin = file_get_contents(__DIR__ . "/../Views/Templates/includes/header/menu/login/auth.tpl");
            $mainContent = file_get_contents(__DIR__ . "/../Views/Templates/includes/main/user.tpl");
            $arguments['user'] = $_SESSION['user'];
            $template = "user";
        } else {
            $headerMenuLogin = file_get_contents(__DIR__ . "/../Views/Templates/includes/header/menu/login/notAuth.tpl");
            $mainContent = file_get_contents(__DIR__ . "/../Views/Templates/includes/main/registration.tpl");
        }

        $title = "registration title";
        $arguments['title'] = $title;

        $arguments['headerMenuDialog'] = $headerMenuDialog;
        $arguments['headerMenuLogin'] = $headerMenuLogin;

        $arguments['main'] = $mainContent;

        if (isset($_SESSION['user']) && $_SESSION['user'] != "null" ) {
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
            $arguments['userCharacters'] = $userCharacters;
        }
        Viewer::getView($template, $arguments);
    }

    public function analyze() {
        if ($_POST) {
            $errors = [];
            if (trim($_POST['login']) == "") {
                $errors[] = "login error";
            }

            if (trim($_POST['email']) == "") {
                $errors[] = "email error";
            }

            if (trim($_POST['password']) == "") {
                $errors[] = "password error";
            }

            if ($_POST['password'] != $_POST['password_confirm']) {
                $errors[] = "error confirm password";
            }

            if (mb_strlen($_POST['login']) < 4 || mb_strlen($_POST['login']) > 50) {
                $errors[] = "login length error";
            }

            if (mb_strlen($_POST['password']) < 3 || mb_strlen($_POST['password']) > 20) {
                $errors[] = "password length error";
            }

            if (!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $_POST['email'])) {
                $errors[] = "email verification error";
            }

            $userName = (new Model("users"))->getAllDataWhere("login", $_POST['login']);

            if (count($userName) > 0) {
                $errors[] = "user login use in DB";
            }

            $userEmail = (new Model("users"))->getAllDataWhere("email", $_POST['email']);

            if (count($userEmail) > 0) {
                $errors[] = "user email use in DB";
            }

            if (empty($errors)) {
                $token = TokenGenerator::getToken(12);
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                (new Model("users"))->insertData([
                    'login' => $_POST['login'],
                    'email' => $_POST['email'],
                    'password' => $password,
                    'token' => $token
                ]);

                $userData = (new Model("users"))->getAllDataWheres([
                    "login" => $_POST['login'],
                    "password" => MD5(MD5($_POST['password']))
                ]);
                print_r($userData);

                session_start();
                setcookie('user_hash', $token, time()+(60*60*24*30));
                $_SESSION['authorized'] = 1;
                $_SESSION['user'] = json_encode($userData[0]);

                $headerLogin = file_get_contents(__DIR__ . "/../Views/Templates/includes/header/menu/login/auth.tpl");
                $main = file_get_contents(__DIR__ . "/../Views/Templates/includes/main/user.tpl");

                $pagesData = [
                    "header" => $headerLogin,
                    "main" => $main,
                ];

                $response = [
                    "success" => true,
                    "pageData" => $pagesData
                ];
                echo json_encode($response);
            } else {
                $response = [
                    "success" => false,
                    "errors" => $errors
                ];
                echo json_encode($response);
            }
        }
    }
}