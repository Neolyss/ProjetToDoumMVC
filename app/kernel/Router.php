<?php

class Router {
    public static function analyse($request){
        session_start();
        $result = null;
        if(!$request) { // Si la requête est vide
            if(!isset($_SESSION["user"])) { // Si on n'est pas connecté
                $result = array(
                    "controller" => "User",
                    "action" => "connexion",
                    "param" => null
                );
            } else {
                // Redirection vers la page d'accueil
                header("Location: index.php?action=home");
                exit();
            }
        }else if(isset($request['action'])){ // Si une action existe
            switch ($request['action']) {
                // ERROR
                case "error":
                    $result = array(
                        "controller" => "Error",
                        "action" => "error",
                        "type" => $_REQUEST['type']
                    );
                    break;
                // USER
                case "login":
                    $result = array(
                        "controller" => "User",
                        "action" => "login",
                        "param" => null
                    );
                    break;
                case "logout": // Pas de vue associé
                    $result = array(
                        "controller" => "User",
                        "action" => "logout",
                        "param" => null
                    );
                    break;
                case "register":
                    $result = array(
                        "controller" => "User",
                        "action" => "register",
                        "param" => null
                    );
                    break;
                case "createUser":
                    $result = array(
                        "controller" => "User",
                        "action" => "createUser",
                        "param" => null
                    );
                    break;
                case "update": // Pas de vue associé
                    $result = array(
                        "controller" => "User",
                        "action" => "update",
                        "idUser" => $_REQUEST['idUser']
                    );
                    break;
                case "modify":
                    $result = array(
                        "controller" => "User",
                        "action" => "modify",
                        "param" => null
                    );
                    break;
                case "newList":
                    $result = array(
                        "controller" => "User",
                        "action" => "newList",
                        "param" => null
                    );
                    break;
                case "home":
                    $result = array(
                        "controller" => "User",
                        "action" => "home",
                        "param" => null
                    );
                    break;
                // LIST
                case "addList": // Pas de vue associé
                    $result = array(
                        "controller" => "List",
                        "action" => "addList",
                        "idUser" => $_REQUEST['idUser']
                    );
                    break;
                case "showList":
                    $result = array(
                        "controller" => "List",
                        "action" => "showList",
                        "idList" => $_REQUEST['idList']
                    );
                    break;
                case "listArchived":
                    $result = array(
                        "controller" => "List",
                        "action" => "listArchived",
                        "idList" => $_REQUEST['idList']
                    );
                    break;
                case "showTask":
                     $result = array(
                         "controller" => "List",
                         "action" => "showTask",
                         "idList" => $_REQUEST['idList'],
                         "idTask" => $_REQUEST['idTask']
                     );
                     break;
                // TASK
                case "archive": // Pas de vue associé
                $result = array(
                    "controller" => "Task",
                    "action" => "archive",
                    "idTask" => $_REQUEST['idTask'],
                    "idList" => $_REQUEST['idList']
                );
                break;
                case "unarchived": // Pas de vue associé
                    $result = array(
                        "controller" => "Task",
                        "action" => "unarchived",
                        "idTask" => $_REQUEST['idTask'],
                        "idList" => $_REQUEST['idList']
                    );
                    break;
                case "updateTask": // Pas de vue associé
                    $result = array(
                        "controller" => "Task",
                        "action" => "updateTask",
                        "idTask" => $_REQUEST['idTask'],
                        "idList" => $_REQUEST['idList']
                    );
                    break;
                case "newTask":
                    $result = array(
                        "controller" => "Task",
                        "action" => "newTask",
                        "idList" => $_REQUEST['idList']
                    );
                    break;
                case "addTask": // Pas de vue associé
                    $result = array(
                        "controller" => "Task",
                        "action" => "addTask",
                        "idList" => $_REQUEST['idList']
                    );
                    break;
                // RIGHT
                case "right":
                    $result = array(
                        "controller" => "Right",
                        "action" => "right",
                        "idList" => $_REQUEST['idList']
                    );
                    break;
                case "addRight":
                    $result = array(
                        "controller" => "Right",
                        "action" => "addRight",
                        "idList" => $_REQUEST['idList']
                    );
                    break;
                default :
                    header("Location: index.php?action=error&type=404");
                    break;
            }
        } else { // Si rien ne correspond
            header("Location: index.php?action=error&type=404");
            exit();
        }
        return $result;
    }
}