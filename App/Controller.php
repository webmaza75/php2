<?php

namespace App;

/**
 * Class Controller
 * @package App
 * @property object $view
 */
class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function action($action)
    {
        $methodName = 'action' . $action;
        //$this->beforeAction();
        return $this->$methodName();
    }
}