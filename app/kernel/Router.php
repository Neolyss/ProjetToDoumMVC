<?php

class Router {
    public static function analyse($request){
        session_start();
        $result = null;
        if(!$request) {
            if(!isset($_SESSION["user"])) { // Si on n'est pas connecté
                $result = array(
                    "controller" => "User",
                    "action" => "display",
                    "param" => null);
            }
        }else {
            switch ($request['action']) {
                case "login":
                    $result = array(
                        "controller" => "User",
                        "action" => "login",
                        "param" => null);
                    break;
            }
        }
        return $result;
    }
}