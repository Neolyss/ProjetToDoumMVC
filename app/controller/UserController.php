<?php


class UserController extends Controller
{

    public function display() {
        $this->getVue()->display();
    }

    /**
     * @return View
     */
    public function getVue()
    {
        return $this->vue;
    }
}