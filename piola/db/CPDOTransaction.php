<?php

namespace piola\db
{
    class CPDOTransaction
    {
        /**
         *
         * @var CPDO
         */
        protected $_tranasction;

        protected function getCPDO()
        {
            return $this->_tranasction;
        }
        
        protected function setCPDO(CPDO $cpdo) 
        {
            $this->_tranasction = $cpdo;
        }
        
        protected function __construct(CPDO $cpdo)
        {
            $this->setCPDO($cpdo);
        }

        public static function Create(CPDO $cpdo)
        {
            return new CPDOTransaction($cpdo);
        }
        
        public function beginTransaction()
        {
            if (!$this->getCPDO()->beginTransaction())
            {
                throw new Exception("Hubo un error al empezar la transaccion.");
            }
        }
        
        public function commit()
        {
            if (!$this->getCPDO()->commit()) 
            {
                throw new Exception("Hubo un error al comprometer la transaccion.");
            }
        }
        
        public function inTransaction()
        {
            return $this->getCPDO()->inTransaction();
        }
        
        public function rollBack()
        {
            if (!$this->getCPDO()->rollBack())
            {
                throw new Exception("Hubo un error al revertir la transaccion.");
            }
        }
    }
}

?>