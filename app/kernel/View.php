<?php


class View
{
    private $route;
    private $data;

    public function __construct($route)
    {
        $this->route=$route;
        $this->data=null;
    }

    public function display()
    {
        $vue = "../app/view/".$this->route['controller']."/".$this->route['action'].".php";
        if (file_exists ($vue)) {
            include ($vue);
        }
    }

    /**
     * @return mixed
     */
    public function setData($data)
    {
        return $this->data=$data;
    }

    /**
     * @return null
     */
    public function getData()
    {
        return $this->data;
    }

}