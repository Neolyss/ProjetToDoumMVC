<?php


class Kernel
{
    public static function run() {
        spl_autoload_register(array("Kernel", "autoload"));
        $route = Router::analyse($_GET);

        $controller_name = $route["controller"]. "Controller";

        if (class_exists ($controller_name)) {
            $controller = new $controller_name ($route);
            $action = $route["action"];
            $methode = array($controller, $action);
            if (is_callable ($methode)) call_user_func ($methode);
        }

    }

    public static function autoload($class) {

        if(file_exists("../app/kernel/$class.php")) {
            require_once("../app/kernel/$class.php");
        }
        else if(file_exists("../app/controller/". $class. ".php")) {
            require_once("../app/controller/". $class. ".php");
        }
        else if(file_exists("../app/model/$class.php")) {
            require_once("../app/model/$class.php");
        }
    }

}