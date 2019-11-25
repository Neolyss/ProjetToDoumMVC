<?php


class UserController extends Controller
{

    public function connexion() { // Montre la page de connexion
        $this->display();
    }

    public function login() {
        if(UserModel::getUserConnexion()) { // Si l'utilisateur est connecté
            header('Location: index.php?action=home'); // Redirection vers la page Home.php
            exit();
        } else {  // Si l'utilisateur n'est pas connecté
            $_SESSION["error"] = "Erreur lors de la connexion";
            header('Location: index.php'); // Redirection vers la page index.php ( qui équivaut à la page de connexion au niveau du routeur )
            exit();
        }
    }

    public function logout() {
        // On détruit la session pour pouvoir déconnecter l'utilisateur
        session_unset();
        if (!$_SESSION) { // Si on est bien déconnecté
            $_SESSION["error"] = "";
            header('Location: index.php');
            exit();
        } else { // Si on est encore connecté
            $_SESSION["error"] = "Erreur lors de la déconnection";
            header('Location: index.php?action=home');
            exit();
        }
    }

    public function register() { // Montre la page de création de compte
        $this->display();
    }
    
    public function createUser() { // Permet de créer un nouvel utilisateur
        session_start();
        if (isset($_POST['user']) && isset($_POST['pwd']) && isset($_POST['mail'])) { // Si l'utilisateur a rempli tous les champs
            if ($_POST['user'] && $_POST['pwd'] && $_POST['mail']) {
                if (UserModel::checkUsernameTaken($_POST['user'])) { // Si le pseudo est déjà pris par un autre utilisateur
                    $_SESSION['error'] = "Ce nom est déjà pris par un autre utilisateur";
                    header("Location: index.php?action=register");
                    exit();
                } else {
                    if(UserModel::createNewUser($_POST['user'],$_POST['pwd'],$_POST['mail'])) { // Si l'utilisateur est bien créé
                        header("Location: index.php?action=home");
                        exit();
                    } else {  // Sinon si la création a échoué
                        header("Location : index.php?action=register");
                        exit();
                    }
                }
            } else { // On n'a pas renseigné tous les champs
                $_SESSION["error"] = "Veuillez renseigner tous les champs";
                header("Location: index.php?action=register");
                exit();
            }
        }
    }

    public function home() { // Affiche la page d'acceuil
        $data = array(
            'today' => UserModel::getTodayTasks(),
            'late' => UserModel::getLateTasks(),
            'mail' => UserModel::getMail(),
            'list' => UserModel::getListsToDisplay()
        );
        $this->setData($data);
        $this->display();
    }

    public function modify() { // Affiche la page d'accueuil mais avec le formulaire de modification de compte
        $data = array(
            'today' => UserModel::getTodayTasks(),
            'late' => UserModel::getLateTasks(),
            'mail' => UserModel::getMail(),
            'list' => UserModel::getListsToDisplay(),
            'idUser' => UserModel::getUserId()
        );
        $this->setData($data);
        $this->display();
    }

    public function update() { // Permet de mettre à jour le compte
        if(UserModel::updateUserInfo($_POST['username'],$_POST['mail'],$_REQUEST['idUser'])) {
            header("Location: index.php?action=home");
            exit();
        }
        else {
            header("Location: index.php?action=modify");
            exit();
        }
    }

    public function newList() { // Permet d'ajouter un formulaire à l'utilisateur pour créer une liste
        $data = array(
            'today' => UserModel::getTodayTasks(),
            'late' => UserModel::getLateTasks(),
            'mail' => UserModel::getMail(),
            'list' => UserModel::getListsToDisplay(),
            'idUser' => UserModel::getUserId()
        );
        $this->setData($data);
        $this->display();
    }

}