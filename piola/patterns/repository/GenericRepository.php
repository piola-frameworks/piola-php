<?php

namespace piola\patterns\repository;

use piola\db as db;
use piola\patterns as patterns;

abstract class GenericRepository implements IRepository
{
    /**
     *
     * @var db\CPDO
     */
    private $_pdo;

    /**
     * 
     * @return db\CPDO
     */
    public function getPDO()
    {
        return $this->_pdo;
    }

    /**
     * 
     * @param db\CPDO $pdo
     */
    protected function setPDO(db\CPDO $pdo)
    {
        $this->_pdo = $pdo;
    }

    /**
     * 
     * @param db\CPDO $pdo
     */
    public function __construct()
    {
        $pdo = new db\CPDO("localhost", "testuser", "testpassword", "test");
        $this->setPDO($pdo);
    }

    /**
     * 
     * @param \Closure $function
     * @return array
     */
    public function filterBy(\Closure $function)
    {
        $retorno = array();
        $entidades = $this->getAll();
        foreach ($entidades as $entidad)
        {
            if ($function($entidad))
            {
                array_push($retorno, $entidad);
            }
        }
        return $retorno;
    }

    /**
     * 
     * @param \Closure $function
     * @return \app\model\ProductoModel
     */
    public function getBy(\Closure $function)
    {
        $entidades = $this->filterBy($function);
        return count($entidades) > 0 ? $entidades[0] : null;
    }

    /**
     * 
     * @param int $id
     * @return \app\model\ProductoModel
     */
    public function getById($id)
    {
        return $this->getBy(function(patterns\IEntity $entidad) use ($id) 
        { 
            return $entidad->getIdentifier() == $id;
        });
    }

    /**
     * 
     * @param array $filas
     * @param \Closure $function
     * @return array
     */
    protected function transformToEntity(array $filas, \Closure $function)
    {
        $retorno = array();
        foreach ($filas as $fila)
        {
            array_push($retorno, $function($fila));
        }
        return $retorno;
    }

    /**
     * 
     * @param patterns\IEntity $type Description
     */
    abstract protected function checkType(patterns\IEntity $type);
}