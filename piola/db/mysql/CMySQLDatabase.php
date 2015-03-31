<?php

namespace piola\db\mysql
{    
    final class CMySQLDatabase implements core\IDatabase
    {
        private static $_instance;
        private $_pdoExtended;
        
        private static $servidor = 'localhost';
        private static $usuario = 'apuntec';
        private static $contrasena = 'c3n7r0357ud14n735';
        private static $basedato = 'ceit';
        
        private $_lastError = '00000';
        
        public function __construct()
        {
            $this->_pdoExtended = new CPDOExtended(CPDO::DB_MYSQL, self::$servidor, self::$usuario, self::$contrasena, self::$basedato);
            $this->_pdoExtended->setAttribute(CPDO::MYSQL_ATTR_COMPRESS, true);
            $this->_pdoExtended->setAttribute(CPDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        }

        public function __clone()
        {
            throw new RuntimeException("Metodo no desarrollado.");
        }
        
        public function __wakeup()
        {
            throw new RuntimeException("Metodo no desarrollado.");
        }
        
        public static function getInstance()
        {
            if(!self::$_instance instanceof self)
            {
                self::$_instance = new self();
            }
            
            return self::$_instance;
        }

        public function DoNonQuery(array $sp, array $params = array(), $trans = false)
        {
            try
            {
                if(!$this->_pdoExtended->inTransaction())
                {
                    $this->_pdoExtended->beginTransaction();
                }
                
                $rowCount = 0;
                foreach ($sp as $index => $sp_name)
                {
                    $sentencia = $this->_pdoExtended->prepare("CALL " . $sp_name . self::GenerateParenthesis($params[$index]));
                    foreach ($params[$index] as $key => $value)
                    {
                        $sentencia->bindValue($key, $this->DoParameterTreatment($value), self::GetParameterType($value));
                    }
                    
                    //echo '<pre>' . $sentencia->debugDumpParams() . '</pre>';
                    if($sentencia->execute() !== false)
                    {
                        $this->_lastError = $sentencia->errorCode();
                    }
                    else
                    {
                        if($sentencia->errorCode() == $this->_lastError)
                        {
                            trigger_error("PDO Error: Hay un error en los parametros o en la conexion contra la base de datos.", E_USER_ERROR);
                        }
                        else
                        {
                            $this->_lastError = $sentencia->errorCode();
                            trigger_error("PDO Error: " . $sentencia->errorCode(), E_USER_ERROR);
                        }
                    }
                    
                    $rowCount += $sentencia->rowCount();
                }
                
                if($trans || $this->_pdoExtended->inTransaction())
                {
                    $this->_pdoExtended->commit();
                }
                
                return $rowCount;
            }
            catch (Exception $ex)
            {
                if($trans || $this->_pdoExtended->inTransaction())
                {
                    $this->_pdoExtended->rollBack();
                }
                
                throw $ex;
            }
        }

        public function DoQuery($sp, array $params = array())
        {
            try
            {
                $sentencia = $this->_pdoExtended->prepare("CALL " . $sp . self::GenerateParenthesis($params));

                if(!empty($params))
                {
                    foreach($params as $key => $value)
                    {
                        $sentencia->bindValue($key, $this->DoParameterTreatment($value), self::GetParameterType($value));
                    }
                }
                
                //echo '<pre>' . $sentencia->debugDumpParams() . '</pre>';
                if($sentencia->execute() !== false)
                {
                    $this->_lastError = $sentencia->errorCode();
                }
                else
                {
                    if($sentencia->errorCode() == $this->_lastError)
                    {
                        trigger_error("PDO Error: Hay un error en los parametros o en la conexion contra la base de datos.", E_USER_ERROR);
                    }
                    else
                    {
                        $this->_lastError = $sentencia->errorCode();
                        trigger_error("PDO Error: " . $sentencia->errorCode(), E_USER_ERROR);
                    }
                }
                
                return $sentencia->fetchAll();
            }
            catch (Exception $ex)
            {
                throw $ex;
            }
        }

        public function DoScalar(array $sp, array $params = array(), $trans = false)
        {
            $lastId = 0;
            
            try
            {
                if(!$this->_pdoExtended->inTransaction())
                {
                    $this->_pdoExtended->beginTransaction();
                }
                
                foreach ($sp as $index => $sp_name)
                {
                    $sentencia = $this->_pdoExtended->prepare("CALL " . $sp_name . self::GenerateParenthesis($params[$index]));
                    foreach($params[$index] as $key => $value)
                    {
                        //echo 'key = (' . print_r($key, true) . ') value = (' . print_r($this->DoParameterTreatment($value), true) . ') type = (' . self::GetParameterType($value) . ')<br />';
                        $sentencia->bindValue($key, $this->DoParameterTreatment($value), self::GetParameterType($value));
                    }
                    
                    //echo '<pre>' . $sentencia->debugDumpParams() . '</pre>';
                    if($sentencia->execute() !== false)
                    {
                        $this->_lastError = $sentencia->errorCode();
                    }
                    else
                    {
                        if($sentencia->errorCode() == $this->_lastError)
                        {
                            trigger_error("PDO Error: Hay un error en los parametros o en la conexion contra la base de datos.", E_USER_ERROR);
                        }
                        else
                        {
                            $this->_lastError = $sentencia->errorCode();
                            trigger_error("PDO Error: " . $sentencia->errorCode(), E_USER_ERROR);
                        }
                    }
                }
                
                // busco la ultima clave. no funciona a traves de pdo::lastinsertedid()
                $sentencia = $this->_pdoExtended->prepare("SELECT LAST_INSERT_ID();");
                if($sentencia->execute() !== false)
                {
                    $this->_lastError = $sentencia->errorCode();
                }
                else
                {
                    if($sentencia->errorCode() == $this->_lastError)
                    {
                        trigger_error("PDO Error: Hay un error en los parametros o en la conexion contra la base de datos.", E_USER_ERROR);
                    }
                    else
                    {
                        $this->_lastError = $sentencia->errorCode();
                        trigger_error("PDO Error: " . $sentencia->errorCode(), E_USER_ERROR);
                    }
                }
                
                // por que solo debe devovler 1 fila.
                if($sentencia->rowCount() == 1)
                {
                    $row = $sentencia->fetchAll(CPDO::FETCH_ASSOC);
                    $lastId = $row[0]['LAST_INSERT_ID()'];
                }
                else
                {
                    trigger_error("Hubo un error en la obtencion el Id", E_USER_ERROR);
                }
                
                if($trans || $this->_pdoExtended->inTransaction())
                {
                    $this->_pdoExtended->commit();
                }
                
                return $lastId;
            }
            catch (Exception $ex)
            {
                if($trans || $this->_pdoExtended->inTransaction())
                {
                    $this->_pdoExtended->rollBack();
                }
                
                throw $ex;
            }
        }
        
        private static function GenerateParenthesis(array $params = array())
        {
            $parenthesis = "";
                
            if(!empty($params))
            {
                $parenthesis = "(";
                $keys = array_keys($params);

                for($index = 0; $index < count($params); $index++)
                {
                    if($index < count($params) - 1)
                    {
                        $parenthesis .= $keys[$index] . ", ";
                    }
                    else
                    {
                        $parenthesis .= $keys[$index];
                    }
                }

                $parenthesis .= ")";
            }
            
            return $parenthesis;
        }
        
        private static function GetParameterType($parameter)
        {
            if(is_array($parameter))
            {
                trigger_error("Por que el parametro es un array?", E_USER_ERROR);
            }
            
            if(is_bool($parameter))
            {
                return CPDO::PARAM_INT;
            }
            else if(is_null($parameter))
            {
                return CPDO::PARAM_NULL;
            }
            else if(is_int($parameter))
            {
                return CPDO::PARAM_INT;
            }
            else if(is_string($parameter))
            {
                return CPDO::PARAM_STR;
            }
            else if(is_float($parameter))
            {
                return CPDO::PARAM_STR;
            }
            else if(is_object($parameter))
            {
                return CPDO::PARAM_LOB;
            }
            else
            {
                // TODO: fijarse el tipo correcto a regresar.
                return CPDO::PARAM_STR;
            }
        }
        
        private function DoParameterTreatment($parameter)
        {
            if(is_array($parameter))
            {
                trigger_error("Por que el parametro del query es un array?", E_USER_ERROR);
            }
            
            if(is_null($parameter))
            {
                return "NULL";
            }
            else if(is_bool($parameter))
            {
                return $parameter ? 1 : 0;
            }
            else
            {
                return $parameter;
            }
        }
    }
}

?>