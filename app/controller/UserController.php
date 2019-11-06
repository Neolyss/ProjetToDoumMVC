<?php


class UserController extends Controller
{

    public function display() {
        $this->getVue()->display();
    }

    public function login() {
        UserModel::getUserConnexion();
    }

    /**
     * @return View
     */
    public function getVue()
    {
        return $this->vue;
    }
}