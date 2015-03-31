<?php

namespace piola\db
{
    class CPDOResult extends \PDOStatement
    {
        /**
         *
         * @var CPDOStatement
         */
        protected $_result;
    
        protected function getPDOStatement()
        {
            return $this->_result;
        }
        
        protected function setPDOStatement(\PDOStatement $pdoStatement)
        {
            $this->_result = $pdoStatement;
        }
        
        protected function __construct(\PDOStatement $pdoStatement)
        {
            $this->setPDOStatement($pdoStatement);
        }
        
        public static function Create(\PDOStatement $pdoStatement)
        {
            return new CPDOResult($pdoStatement);
        }
        
        public function fetch($fetch_style = null, $cursor_orientation = \PDO::FETCH_ORI_NEXT, $cursor_offset = 0) 
        {
            return $this->getPDOStatement()->fetch($fetch_style, $cursor_orientation, $cursor_offset);
        }
        
        /**
         * 
         * @param int $fetch_style
         * @param mixed $fetch_argument
         * @param array $ctor_args
         * @return array
         */
        public function fetchAll($fetch_style = \PDO::FETCH_BOTH, $fetch_argument = null, array $ctor_args = array())
        {
            //TODO: Hacer funcionar con los parametros extra.
            
            return $this->getPDOStatement()->fetchAll($fetch_style);
        }
        
        public function fetchColumn($column_number = 0)
        {
            return $this->getPDOStatement()->fetchColumn($column_number);
        }
        
        public function fetchObject($class_name = "stdClass", array $ctor_args = null)
        {
            return $this->getPDOStatement()->fetchObject($class_name, $ctor_args);
        }
        
        public function nextRowset()
        {
            return $this->getPDOStatement()->nextRowset();
        }
        
        public function columnCount()
        {
            return $this->getPDOStatement()->columnCount();
        }
    }
}