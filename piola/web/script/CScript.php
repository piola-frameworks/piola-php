<?php

namespace piola\web\script
{
    class CScript
    {
        /**
         *
         * @var string 
         */
        protected $_path;
        /**
         *
         * @var string 
         */
        protected $_debugPath;
        /**
         *
         * @var string 
         */
        protected $_cdnPath;
        /**
         *
         * @var string 
         */
        protected $_cdnDebugPath;
        /**
         *
         * @var bool 
         */
        protected $_cdnSecureConnection;

        /**
         * 
         * @return string
         */
        public function getPath()
        {
            return $this->_path;
        }

        /**
         * 
         * @param string $path
         */
        protected function setPath($path)
        {
            $this->_path = $path;
        }

        /**
         * 
         * @return string
         */
        public function getDebugPath()
        {
            return $this->_debugPath;
        }

        /**
         * 
         * @param string $debugPath
         */
        protected function setDebugPath($debugPath)
        {
            $this->_debugPath = $debugPath;
        }

        /**
         * 
         * @return string
         */
        public function getCDNPath()
        {
            return $this->_cdnPath;
        }

        /**
         * 
         * @param string $cdnPath
         */
        protected function setCDNPath($cdnPath)
        {
            $this->_cdnPath = $cdnPath;
        }

        /**
         * 
         * @return string
         */
        public function getCDNDebugPath()
        {
            return $this->_cdnDebugPath;
        }

        /**
         * 
         * @param string $cdnDebugPath
         */
        protected function setCDNDebugPath($cdnDebugPath)
        {
            $this->_cdnDebugPath = $cdnDebugPath;
        }

        /**
         * 
         * @return bool
         */
        public function isCDNSecureConnection()
        {
            return $this->_cdnSecureConnection;
        }

        /**
         * 
         * @param bool $cdnSecureConnection
         */
        protected function setCDNSecureConnection($cdnSecureConnection)
        {
            $this->_cdnSecureConnection = $cdnSecureConnection;
        }

        /**
         * 
         * @param string $path
         * @param string $cdnPath
         * @param bool $secure
         * @param string $debugPath
         * @param string $cdnDebugPath
         */
        public function __construct($path, $cdnPath = "", $secure = false, $debugPath = "", $cdnDebugPath = "")
        {
            $this->setPath($path);
            $this->setCDNPath($cdnPath);
            $this->setCDNSecureConnection($secure);
            $this->setDebugPath($debugPath);
            $this->setCDNDebugPath($cdnDebugPath);
        }

        public function __toString()
        {
            ;
        }
    }
}

?>