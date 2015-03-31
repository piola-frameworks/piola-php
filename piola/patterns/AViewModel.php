<?php

namespace piola\patterns
{
    abstract class AViewModel implements IViewModel
    {
        protected $_data;
                
        public function __get($name)
        {
            if (array_key_exists($name, $this->_data))
            {
                return $this->_data[$name];
            }
            
            return null;
        }
        
        public function __set($name, $value)
        {
            $this->_data[$name] = $value;
        }
        
        public function __isset($name)
        {
            return isset($this->_data[$name]);
        }
        
        public function __unset($name)
        {
            unset($this->_data[$name]);
        }
        
        public function __construct()
        {
            $this->_data = array();
        }
        
        public function getNavegation()
        {
            return array(
                "Productos" => "?controller=productos",
                "Nosotros" => "?controller=principal&action=nosotros",
                "Contactanos" => "?controller=principal&action=contactanos"
            );
        }
    }
}

?>