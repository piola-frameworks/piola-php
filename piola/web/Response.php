<?php

namespace piola\web
{
    class Response
    {
        const OK = 200;
        
        private $_date;
        private $_server;
        private $_expires;
        private $_cacheControl;
        private $_pragma;
        private $_contentLenght;
        private $_keepAlive;
        private $_connection;
        private $_contentType;
        
        public function __construct()
        {
            ;
        }
        
        public function __toString()
        {
            ;
        }
    }
}

?>