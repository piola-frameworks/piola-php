<?php

namespace piola\db
{
    final class CPDOStatement extends \PDOStatement
    {
        /**
         *
         * @var \PDOStatement
         */
        protected $_pdoStatement;
        
        /**
         * 
         * @return \PDOStatement
         */
        protected function getPDOStatement()
        {
            return $this->_pdoStatement;
        }

        /**
         * 
         * @param \PDOStatement $pdoStatement
         */
        protected function setPDOStatement(\PDOStatement $pdoStatement)
        {
            $this->_pdoStatement = $pdoStatement;
        }
        
        /**
         * 
         * @param \PDOStatement $pdoStatement
         */
        protected function __construct(\PDOStatement $pdoStatement)
        {
            $this->setPDOStatement($pdoStatement);
        }
        
        /**
         * 
         * @param \PDOStatement $pdoStatement
         * @return \piola\db\CPDOStatement
         */
        public static function Create(\PDOStatement $pdoStatement)
        {
            return new CPDOStatement($pdoStatement);
        }

        /**
         * 
         * @param mixed $parameter
         * @param mixed $value
         * @param int $data_type
         * @return \piola\db\CPDOStatement
         */
        public function bindValue($parameter, $value, $data_type = PDO::PARAM_STR)
        {
            if (!$this->getPDOStatement()->bindValue($parameter, $value, $data_type))
            {
                throw new \InvalidArgumentException("Fallo el enlazamiento.");
            }
            
            return $this;
        }
        
        /**
         * 
         * @param array $input_parameters
         * @return CPDOResult
         * @throws \PDOException
         */
        public function execute(array $input_parameters = null)
        {
            if (!$this->getPDOStatement()->execute($input_parameters))
            {
                throw new \PDOException("Fallo la ejecucion de la consulta.");
            }
            
            return CPDOResult::Create($this->getPDOStatement());
        }
        
        public function rowCount()
        {
            return $this->getPDOStatement()->rowCount();
        }
    }
}

?>