<?php

namespace piola
{
    class StringBuilder
    {
        /**
         *
         * @var string 
         */
        private $_string;
        
        /**
         * 
         * @param string $string
         */
        public function __construct($string = "")
        {
            $this->_string = $string;
            
            if ($string === null) {
                $this->_string = "";
            }
        }
        
        /**
         * 
         * @param string $string
         */
        public function Append($string)
        {
            $this->_string .= $string;
        }
        
        /**
         * 
         * @param string $string
         */
        public function AppendLine($string)
        {
            $this->_string .= $string . PHP_EOL;
        }
        
        /**
         * 
         * @return string
         */
        public function __toString()
        {
            return $this->_string;
        }
    }
}

?>