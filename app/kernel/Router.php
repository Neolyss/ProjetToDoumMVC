<?php

class Router {
    public static function analyse($request){
        session_start();
        $result = null;
        if(!$request) {
            if(!isset($_SESSION["user"])) { // Si on n'est pas connecté
                $result = array(
                    "controller" => "User",
                    "action" => "connexion",
                    "param" => null);
            }
        }else {
            switch ($request['action']) {
                // USER
                case "login":
                    $result = array(
                        "controller" => "User",
                        "action" => "login",
                        "param" => null);
                    break;
                case "logout": // Pas de vue associé
                    $result = array(
                        "controller" => "User",
                        "action" => "logout",
                        "param" => null);
                    break;
                case "update": // Pas de vue associé
                    $result = array(
                        "controller" => "User",
                        "action" => "update",
                        "param" => $_REQUEST['param']);
                    break;
                case "modify":
                    $result = array(
                        "controller" => "User",
                        "action" => "modify",
                        "param" => null);
                    break;
                case "newList":
                    $result = array(
                        "controller" => "User",
                        "action" => "newList",
                        "param" => null);
                    break;
                case "home":
                    $result = array(
                        "controller" => "User",
                        "action" => "home",
                        "param" => null);
                    break;
                // LIST
                case "addList": // Pas de vue associé
                    $result = array(
                        "controller" => "List",
                        "action" => "addList",
                        "param" => $_REQUEST['param']);
                    break;
                case "List":
                    $result = array(
                        "controller" => "List",
                        "action" => "List",
                        "param" => $_REQUEST['param']);
                    break;
            }
        }
        // Vardump de debug
        //var_dump($result);
        return $result;
    }
}