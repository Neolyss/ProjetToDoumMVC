<?php


class Controller
{
    protected $route;
    protected $vue;

    public function __construct($route)
    {
        $this->route = $route;
        $this->vue = new View($route);
    }

    /**
     * @return View
     */
    public function getVue()
    {
        return $this->vue;
    }

    // Demande à la vue de s'afficher
    public function display() {
        $this->getVue()->display();
    }

    // Met les données récupérées du controlleur à travers le modèle à la vue
    public function setData($data) {
        $this->getVue()->setData($data);
    }

}