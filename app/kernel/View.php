<?php


class View
{
    private $route;

    public function __construct($route)
    {
        $this->route=$route;
    }

    public function display()
    {
        $vue = "../app/view/".$this->route['controller']."/".$this->route['action'].".php";
        //var_dump($vue);
        if (file_exists ($vue)) {
            include ($vue);
        }
    }

}