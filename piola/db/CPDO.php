<?php

namespace piola\db
{
    use PDO;
    
    final class CPDO extends \PDO
    {
        const DB_MYSQL = "mysql";
        const DB_POSTG = "postgree";
        const DB_ORACL = "oracle";
        const DB_MSSQL = "mssql";
        const DB_SQLIT = "sqlite";
        const DB_INFOR = "informix";
        const DB_IBM = "ibm";
        const DB_ODBC = "odbc";

        protected $_dsn;
        
        public function getDataSourceName()
        {
            return $this->_dsn;
        }
        
        public function setDataSourceName($dsn)
        {
            $this->_dsn = $dsn;
        }
        
        protected $_userName;
        
        public function getUserName()
        {
            return $this->_userName;
        }
        
        public function setUserName($userName)
        {
            $this->_userName = $userName;
        }
        
        protected $_password;
        
        public function getPassword()
        {
            return $this->_password;
        }
        
        public function setPassword($password)
        {
            $this->_password = $password;
        }
        
        protected $opciones = array();
        
        protected $_autoCommit = false;
        
        public function getAutoCommit()
        {
            return $this->_autoCommit;
        }
        
        public function setAutoCommit($autoCommit)
        {
            $this->_autoCommit = $autoCommit;
        }
        
        protected $_preFetch;
        
        public function getPrefetch()
        {
            return $this->_preFetch;
        }
        
        public function setPrefetch($preFetch)
        {
            $this->_preFetch = $preFetch;
        }
        
        protected $_timeOut = 30;
        
        public function getTimeOut()
        {
            return $this->_timeOut;
        }
        
        public function setTimeOut($timeOut)
        {
            $this->_timeOut = $timeOut;
        }
        
        protected $_errorMode = PDO::ERRMODE_EXCEPTION;
        
        public function getErrorMode()
        {
            return $this->_errorMode;
        }
        
        public function setErrorMode($errorMode)
        {
            $this->_errorMode = $errorMode;
        }
        
        protected $_persistent = false;
        
        public function getPersistent()
        {
            return $this->_persistent;
        }
        
        public function setPersistent($errorMode)
        {
            $this->_errorMode = $errorMode;
        }
        
        protected $_serverVersion;
        
        public function getServerVersion()
        {
            return $this->_serverVersion;
        }
        
        protected function setServerVersion($serverVersion)
        {
            $this->_serverVersion = $serverVersion;
        }
        
        protected $_clientVersion;
        
        public function getClientVersion()
        {
            return $this->_clientVersion;
        }
        
        protected function setClientVersion($clientVersion)
        {
            $this->_clientVersion = $clientVersion;
        }
        
        protected $_serverInfo;
        
        public function getServerInfo()
        {
            return $this->_serverInfo;
        }
        
        protected function setServerInfo($serverInfo)
        {
            $this->_serverInfo = $serverInfo;
        }
        
        protected $_connStatus;
        
        public function getConnectionStatus()
        {
            return $this->_connStatus;
        }
        
        protected function setConnectionStatus($connStatus)
        {
            $this->_connStatus = $connStatus;
        }
        
        protected $_emulatePrepare = false;
        
        public function getEmulatePrepare()
        {
            return $this->_emulatePrepare;
        }
        
        public function setEmulatePrepare($emulatePrepare)
        {
            $this->_emulatePrepare = $emulatePrepare;
        }
        
        protected $_defaultFetchMode = PDO::FETCH_ASSOC;
        
        public function getDefaultFetchMode()
        {
            return $this->_defaultFetchMode;
        }
        
        public function setDefaultFetchMode($defaultFetchMode)
        {
            $this->_defaultFetchMode = $defaultFetchMode;
        }

        public function __construct($servidor, $userName, $password, $basedato, $dbtype = CPDO::DB_MYSQL, $options = null)
        {
            $this->setUserName($userName);
            $this->setPassword($password);
            
            // dsn example: 'mysql:host=localhost;dbname=test'
            $this->_dsn = $dbtype . ':host=' . $servidor . ';dbname=' . $basedato;

            if (!isset($options) || empty($options))
            {
                $this->opciones = array(
                    PDO::ATTR_AUTOCOMMIT => 0,
                    PDO::ATTR_TIMEOUT => 3,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_PERSISTENT => false,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                );
            }

            parent::__construct($this->_dsn, $this->_userName, $this->_password, $this->opciones);
        }
        
        /**
         * 
         * @param string $statement
         * @return CPDOResult
         */
        public function query($statement)
        {
            $pdoStatement = parent::query($statement);
            return CPDOResult::Create($pdoStatement);
        }
        
        /**
         * 
         * @param string $statement
         * @param array $driver_options
         * @return CPDOStatement
         */
        public function prepare($statement, array $driver_options = array())
        {
            $pdoStatement = parent::prepare($statement, $driver_options);
            return CPDOStatement::Create($pdoStatement);
        }
    }
}

?>