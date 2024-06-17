<?php
namespace Core\Controllers;

use Core\Helpers\TokenGenerator;
use Core\Models\Model;

class AuthController
{
    public function auth()
    {
        if ($_POST) {
            $userData = (new Model("users"))->getAllDataWheres([
                "login" => $_POST['name'],
                //"password" => MD5(MD5($_POST['password'])) // если бы мы кодировали пароль двойным MD5
            ]);

            if (count($userData) > 0) {
                if (password_verify($_POST['password'], $userData[0]['password'])) {
                    $token = TokenGenerator::getToken(12);

                    (new Model("users"))->updateData(
                        ['token' => $token],
                        ['id' => $userData[0]['id']]
                    );

                    session_start();
                    setcookie('user_hash', $token, time()+(60*60*24*30));
                    $_SESSION['authorized'] = 1;
                    $_SESSION['user'] = json_encode($userData[0]);
                    //header("Location:/user");
                    //echo $_SESSION['user'];

                    $headerLogin = file_get_contents(__DIR__ . "/../Views/Templates/includes/header/menu/login/auth.tpl");
                    $main = file_get_contents(__DIR__ . "/../Views/Templates/includes/main/user.tpl");

                    $pagesData = [
                        "header" => $headerLogin,
                        "main" => $main,
                        "error" => 0
                    ];

                    $result = json_encode($pagesData);
                    echo $result;

                } else {
                    $pagesData = [
                        "error" => 1
                    ];
                    echo json_encode($pagesData);
                }
            } else {
                $pagesData = [
                    "error" => 2
                ];
                echo json_encode($pagesData);
            }
        } else {
            $pagesData = [
                "error" => 3
            ];
            echo json_encode($pagesData);
        }
    }

    public function logout()
    {
        session_start();
        //unset($_SESSION['authorized']);
        //unset($_SESSION['user']);

        session_unset();
        session_destroy();

        setcookie('user_hash', "");


        $headerLogin = file_get_contents(__DIR__ . "/../Views/Templates/includes/header/menu/login/notAuth.tpl");
        $main = file_get_contents(__DIR__ . "/../Views/Templates/includes/main/login.tpl");

        $pagesData = [
            "header" => $headerLogin,
            "main" => $main,
            "error" => 0
        ];

        echo json_encode($pagesData);
    }
}