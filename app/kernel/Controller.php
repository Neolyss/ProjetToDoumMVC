<?php


class Controller
{
    protected $route;
    protected $vue;

    public function __construct($route)
    {
        $this->route = $route;
        //var_dump($route);
        $this->vue = new View($route);
    }

    /**
     * @return View
     */
    public function getVue()
    {
        return $this->vue;
    }

    public function display() {
        $this->getVue()->display();
    }

    public function setData($data) {
        $this->getVue()->setData($data);
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->getVue()->getData();
    }

}