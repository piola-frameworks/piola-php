<?php

namespace piola
{
    use piola\mvc as mvc;
    
    class Route
    {
        private $_controller;
        private $_action;
        
        public function getController() { return $this->_controller; }
        protected function setController(mvc\IController $controller) { $this->_controller = $controller; }
        
        public function getAction() { return $this->_action; }
        protected function setAction($action) { $this->_action = $action; }
        
        public function __construct($controller = null, $action = "index")
        {
            $this->setController($controller);
            $this->setAction($action);
        }
    }
}

?>