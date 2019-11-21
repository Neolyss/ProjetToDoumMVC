<?php


class UserController extends Controller
{

    public function connexion() {
        $this->display();
    }

    public function login() {
        session_start();
        $login = UserModel::getUserConnexion();
        if($login) { // Si l'utilisateur est connecté
            $_SESSION["error"] = "";
            $_SESSION['user'] = $login['Username'];
            header('Location: index.php?action=home'); // Redirection vers la page Home.php
            exit();
        } else // Si l'utilisateur n'est pas connecté
        {
            $_SESSION["error"] = "Erreur lors de la connexion";
            header('Location: index.php'); // Redirection vers la page index.php ( qui équivaut à la page de connexion au niveau du routeur )
            exit();
        }
    }

    public function logout() {
        // On relance la session puis on la détruit pour pouvoir déconnecter l'utilisateur
        session_start();
        session_unset();
        if (!isset($_SESSION)) { // Si on est bien déconnecté
            header('Location: login.php');
            exit();
        } else { // Si on est encore connecté
            header('Location: index.php');
            exit();
        }
    }

    public function home() {
        $data = array(
            'today' => UserModel::getTodayTasks(),
            'late' => UserModel::getLateTasks(),
            'mail' => UserModel::getMail(),
            'list' => UserModel::getListsToDisplay()
        );
        //var_dump($data);
        $this->setData($data);
        $this->display();
    }

    public function modify() {
        $data = array(
            'today' => UserModel::getTodayTasks(),
            'late' => UserModel::getLateTasks(),
            'mail' => UserModel::getMail(),
            'list' => UserModel::getListsToDisplay(),
            'idUser' => UserModel::getUserId()
        );
        //var_dump($data);
        $this->setData($data);
        $this->display();
    }

    public function update() {
        //var_dump($_POST);
        if(UserModel::updateUserInfo($_POST['username'],$_POST['mail'],$_REQUEST['param'])) {
            header("Location: index.php?action=home");
            exit();
        }
        else {
            header("Location: index.php?action=modify");
            exit();
        }
    }

    public function newList() {
        $data = array(
            'today' => UserModel::getTodayTasks(),
            'late' => UserModel::getLateTasks(),
            'mail' => UserModel::getMail(),
            'list' => UserModel::getListsToDisplay(),
            'idUser' => UserModel::getUserId()
        );
        //var_dump($data);
        $this->setData($data);
        $this->display();
    }

}