<?php
namespace Core\Middleware;

use Core\Helpers\TokenGenerator;
use Core\Models\Model;

/*
 * Middleware нужен чтобы произвести какие-то действия перед обработкой маршрута
 * Каждый метод должен быть статичен Не предполагается создание экземпляров
 */

class Middleware
{
    // Будем хранить маршрут чтобы вернуть его при успешной авторизации Пока не используем
    public static $route;

    // Прячем конструктор Экземплры не предполагаются
    private function __construct() {

    }

    // Аутентификация пользователя
    public static function auth(): void
    {
        session_start();
        // Проверим авторизован ли пользователь в сессии
        if (isset($_SESSION["user"])) {
            //header("Location:/user");
        // Если не авторизован в сессии то проверим есть ли токен доступа в куках
        } else if (isset($_COOKIE["user_hash"])) {
            // Если в куках есть токен - посмотрим что соответсвует ему в базе
            $userData = (new Model("users"))->getAllDataWheres([
                "token" => $_COOKIE["user_hash"],
            ]);
            // Если в базе есть запись - обновим токен и заполним сессию данными о пользователе из базы
            if (count($userData) > 0) {
                $token = TokenGenerator::getToken(12);
                (new Model("users"))->updateData(
                    ['token' => $token],
                    ['id' => $userData[0]['id']]
                );
                setcookie('user_hash', $token, time()+(60*60*24*30));
                session_start();
                $_SESSION['authorized'] = 1;
                $_SESSION['user'] = json_encode($userData[0]);
            } else {
                // если в базе токена нет - обнуляем куки и сессию и перенаправляем на страницу авторизации
                //unset($_SESSION['authorized']);
                //unset($_SESSION['user']);
                //unset($_COOKIE['user_hash']);
                $_SESSION['authorized'] = "";
                $_SESSION['user'] = "";
                setcookie("user_hash", "", time()+(60*60*24*30));
                header("Location:/auth");
            }
        } else {
            // если в сессии нет данных о пользователе и в куках нет токена доступа - отправляем пользователя на страницу авторизации
            if (isset($_COOKIE['user_hash'])) {
                //unset($_COOKIE['user_hash']);
                $_SESSION['authorized'] = "";
                $_SESSION['user'] = "";
                setcookie("user_hash", "", time()+(60*60*24*30));
            }
            header("Location:/auth");
        }
    }
}