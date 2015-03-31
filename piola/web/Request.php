<?php

namespace piola\web
{
    use piola as piola;
    
    final class Request
    {
        private $_method;
        private $_uri;
        private $_version;
        
        private $_acceptedMimeType;
        private $_acceptedEncoding;
        private $_acceptedLenguage;
        private $_authorization;
        private $_connection;
        private $_cookie;
        private $_expect;
        private $_from;
        private $_host;
        private $_ifMatch;
        private $_ifModifiedSince;
        private $_ifNoneMatch;
        private $_ifRange;
        private $_ifUnModifiedSince;
        private $_maxForwards;
        private $_proxyAuthorization;
        private $_queryString;
        private $_range;
        private $_referer;
        private $_te;
        private $_userAgent;
        
        public function getMethod() { return $this->_method; }
        protected function setMethod($method) { $this->_method = $method; }
        
        public function getUri() { return $this->_uri; }
        protected function setUri($uri) { $this->_uri = $uri; }
        
        public function getVersion() { return $this->_version; }
        protected function setVersion($version) { $this->_version = $version; }
        
        public function getAcceptedMimeType() { return $this->_acceptedMimeType; }
        protected function setAcceptedMimeType($acceptedMimeType) { $this->_acceptedMimeType = $acceptedMimeType; }
        
        public function getAcceptedEncoding() { return $this->_acceptedEncoding; }
        protected function setAcceptedEncoding($encoding) { $this->_acceptedEncoding = $encoding; }
        
        public function getAcceptedLenguage() { return $this->_acceptedLenguage; }
        protected function setAcceptedLenguage($lenguage) { $this->_acceptedLenguage = $lenguage; }
        
        public function getCookie() { return $this->_cookie; }
        protected function setCookie($cookie) { $this->_cookie = $cookie; }
        
        public function getConnection() { return $this->_connection; }
        protected function setConnection($connection) { $this->_connection = $connection; }
        
        public function getAuthorization() { return $this->_authorization; }
        protected function setAuthorization($authorization) { $this->_authorization = $authorization; }
        
        public function getHost() { return $this->_host; }
        protected function setHost($host) { $this->_host = $host; }
        
        public function getQueryString() { return $this->_queryString; }
        protected function setQueryString($querytString) { $this->_queryString = $querytString; }
        
        public function getReferer() { return $this->_referer; }
        protected function setReferer($referer) { $this->_referer = $referer; }
        
        public function getUserAgent() { return $this->_userAgent; }
        protected function setUserAgent($userAgent) { $this->_userAgent = $userAgent; }
        
        public function __construct()
        {
            $env = filter_input_array(INPUT_ENV);
            
            $this->setMethod($env["REQUEST_METHOD"]);
            $this->setUri($env["REQUEST_URI"]);
            $this->setVersion($env["SERVER_PROTOCOL"]);
            $this->setAcceptedMimeType($env["HTTP_ACCEPT"]);
            $this->setAcceptedEncoding($env["HTTP_ACCEPT_ENCODING"]);
            $this->setAcceptedLenguage($env["HTTP_ACCEPT_LANGUAGE"]);
            $this->setConnection($env["HTTP_CONNECTION"]);
            $this->setCookie($env["HTTP_COOKIE"]);
            $this->setHost($env["HTTP_HOST"]);
            $this->setQueryString($env["QUERY_STRING"]);
            $this->setReferer($env["HTTP_REFERER"]);
            $this->setUserAgent($env["HTTP_USER_AGENT"]);
        }
        
        public function __toString()
        {
            $sb = new piola\StringBuilder();
            $sb->Append($this->getMethod());
            $sb->Append(" ");
            $sb->Append($this->getUri());
            $sb->Append(" ");
            $sb->AppendLine($this->getVersion());
            $sb->Append("Accept: ");
            $sb->AppendLine($this->getAcceptedMimeType());
            $sb->Append("Accept-Encoding: ");
            $sb->AppendLine($this->getAcceptedEncoding());
            $sb->Append("Accept-Language: ");
            $sb->AppendLine($this->getAcceptedLenguage());
            $sb->Append("Connection: ");
            $sb->AppendLine($this->getConnection());
            $sb->Append("Cookie: ");
            $sb->AppendLine($this->getCookie());
            $sb->Append("Host: ");
            $sb->AppendLine($this->getHost());
            $sb->Append("Referer: ");
            $sb->AppendLine($this->getReferer());
            $sb->Append("User-Agent: ");
            $sb->AppendLine($this->getUserAgent());
                    
            return (string)$sb;
        }
    }
}

?>