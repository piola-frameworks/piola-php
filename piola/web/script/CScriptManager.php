<?php

namespace piola\web\script
{
    class CScriptManager
    {
        /**
         *
         * @var array 
         */
        protected $_scripts;

        /**
         * 
         * @param string $name
         * @return Script
         */
        public function __get($name)
        {
            if (array_key_exists($name, $this->_scripts))
            {
                return $this->_scripts[$name];
            }
        }

        /**
         * 
         * @param string $name
         * @param Script $value
         */
        public function __set($name, $value)
        {
            $this->_scripts[$name] = $value;
        }

        /**
         * 
         * @param string $name
         * @return bool
         */
        public function __isset($name)
        {
            return isset($this->_scripts[$name]);
        }

        /**
         * 
         * @param string $name
         */
        public function __unset($name)
        {
            unset($this->_scripts[$name]);
        }

        public function __construct()
        {
            $this->_scripts = array();
        }
    }
}

?>