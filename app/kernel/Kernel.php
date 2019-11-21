<?php


class Kernel
{
    public static function run() {
        spl_autoload_register(array("Kernel", "autoload"));
        //require_once ("../../app/kernel/Router.php");
        $route = Router::analyse($_GET);

        //var_dump($route);

        $controller_name = $route["controller"]. "Controller";

        if (class_exists ($controller_name)) {
            $controller = new $controller_name ($route);
            $action = $route["action"];
            $methode = array($controller, $action);
            //var_dump($methode);
            if (is_callable ($methode)) call_user_func ($methode);
        }

    }

    public static function autoload($class) {
        //var_dump($class);

        if(file_exists("../app/kernel/$class.php")) {
            //var_dump("../app/kernel/$class.php");
            require_once("../app/kernel/$class.php");
        }
        else if(file_exists("../app/controller/". $class. ".php")) {
            //var_dump("../app/controller/". $class. ".php");
            require_once("../app/controller/". $class. ".php");
        }
        else if(file_exists("../app/model/$class.php")) {
            require_once("../app/model/$class.php");
            //var_dump("../app/model/$class.php");
        }
    }

}