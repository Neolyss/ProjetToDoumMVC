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
        }
        return $result;
    }
}