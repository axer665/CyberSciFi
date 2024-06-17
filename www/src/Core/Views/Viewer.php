<?php
    namespace Core\Views;

    class Viewer
    {
        private static $path = __DIR__ . "/Templates/";
        public static function getView($name, array $arguments = [])
        {
            $handle = opendir(self::$path);
            while (false !== ($file = readdir($handle))) {
                /*if ($file != "." && $file != "..") {

                }*/
            }

            $fileName = self::$path . $name . ".tpl";

            if (file_exists($fileName)) {
                require_once($fileName);
            } else {
                print_r("template does not exists");
            }

        }

        public static function getSubView($path, $name, array $arguments = [])
        {
            $viewPath = __DIR__ . "/Templates" . $path;
            $fileName = $viewPath . $name . ".tpl";
            if (file_exists($fileName)) {
                require_once($fileName);
            } else {
                print_r("subview template does not exists");
            }
        }
    }