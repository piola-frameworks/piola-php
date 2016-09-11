<?php

namespace app;

use piola as piola;
use app\controller as controller;

class Routes
{
    private $_routes;

    public function getRoutes()
    {
        return $this->_routes;
    }

    protected function setRoutes(array $routes)
    {
        $this->_routes = $routes;
    }

    public function __set($name, $value)
    {
        $this->_routes[$name] = $value;
    }

    public function __isset($name)
    {
        return isset($this->_routes[$name]);
    }

    public function __unset($name)
    {
        unset($this->_routes[$name]);
    }

    public function __construct()
    {
        $this->setRoutes(array(
            "_root_" => new piola\CRoute(new controller\MainController()),
            "_404_" => new piola\CRoute(new controller\ErrorController(), "404")
        ));
    }
}