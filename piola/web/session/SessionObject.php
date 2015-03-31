<?php

namespace piola\web\session
{
    class SessionObject
    {
        protected $_id;
        protected $_name;
        protected $_status;
        
        public function getId()
        {
            return $this->_id;
        }
        
        protected function setId($id)
        {
            $this->_id = $id;
        }
        
        public function getName()
        {
            return $this->_name;
        }
        
        protected function setName($name)
        {
            $this->_name = $name;
        }
        
        public function getStatus()
        {
            return $this->_status;
        }
        
        protected function setStatus($status)
        {
            $this->_status = $status;
        }
        
        public function __construct($id, $name)
        {
            $this->setId($id);
            $this->setName($name);
        }
        
        public function __get($key)
        {
            if ($this->existsKey($key))
            {
                $this->{$key} = $this->getValue($key);
            }
            else
            {
                $this->{$key} = NULL;
            }
            
            return $this->{$key};
        }
        
        public function __set($key, $value)
        {
            $this->setValue($key, $value);
            
            $this->{$key} = $value;
        }
        
        protected function existsKey($key)
        {
            return !empty($_SESSION[$key]);
        }
        
        protected function getValue($key)
        {
            return $_SESSION[$key];
        }
        
        protected function setValue($key, $value)
        {
            $_SESSION[$key] = $value;
        } 
        
        public function regenerate($destroy_old = false) 
        {
            session_regenerate_id($destroy_old);
            $this->setId(session_id());
        }
    }
}

?>