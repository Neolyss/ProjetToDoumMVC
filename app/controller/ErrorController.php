<?php


class ErrorController extends Controller
{
    public function error()
    {
        $this->setData($_REQUEST['type']);
        $this->display();
    }

}