<?php


class UserController extends Controller
{

    public function display() {
        $this->getVue()->display();
    }

    public function connexion() {
        $this->display();
    }

    public function login() {
        session_start();
        $test = UserModel::getUserConnexion();
        var_dump($test);
        if($test) {
            $_SESSION["error"] = "";
            header('Location: index.php?action=affichage');
            exit();
        } else
        {
            $_SESSION["error"] = "Erreur lors de la connexion";
            header('Location: index.php');
            exit();
        }
        $this->display();
    }

    /**
     * @return View
     */
    public function getVue()
    {
        return $this->vue;
    }
}