<?php

namespace app\models\repository;

use piola\patterns as patterns;
use piola\patterns\repository as repository;
use app\models as models;

final class ProductoRepository extends repository\GenericRepository
{
    public function create(patterns\IEntity $entity)
    {
        $this->checkType($entity);

        $this->getPDO()
            ->prepare("CALL InsertarProducto(:nombre, :descripcion, :precio, :hayStock, :largo, :ancho, :espesor)")
            ->bindValue(":nombre", $entity->getNombre(), \PDO::PARAM_STR)
            ->bindValue(":descripcion", $entity->getDescripcion(), \PDO::PARAM_STR)
            ->bindValue(":precio", $entity->getPrecio(), \PDO::PARAM_STR)
            ->bindValue(":hayStock", $entity->getHayStock(), \PDO::PARAM_BOOL)
            ->bindValue(":largo", $entity->getLargo(), \PDO::PARAM_INT)
            ->bindValue(":ancho", $entity->getAncho(), \PDO::PARAM_INT)
            ->bindValue(":espesor", $entity->getEspesor(), \PDO::PARAM_INT)
            ->execute();
    }

    public function getAll()
    {
        $resultado = $this->getPDO()
                ->prepare("CALL ObtenerProductos()")
                ->execute()
                ->fetchAll();

        return parent::transformToEntity($resultado, function($fila)
        {
            $entidad = new model\ProductoModel($fila["IdProducto"],
                    $fila["Nombre"],
                    $fila["Descripcion"],
                    $fila["Precio"],
                    $fila["HayStock"],
                    $fila["Largo"],
                    $fila["Ancho"],
                    $fila["Espesor"]);
            return $entidad;
        });
    }

    public function modify(patterns\IEntity $entity)
    {
        $this->checkType($entity);

        $this->getPDO()
            ->prepare("CALL ActualizarProducto(:identificador, :nombre, :descripcion, :precio, :hayStock, :largo, :ancho, :espesor)")
            ->bindValue(":identificador", $entity->getIdentifier(), \PDO::PARAM_INT)
            ->bindValue(":nombre", $entity->getNombre(), \PDO::PARAM_STR)
            ->bindValue(":descripcion", $entity->getDescripcion(), \PDO::PARAM_STR)
            ->bindValue(":precio", $entity->getPrecio(), \PDO::PARAM_STR)
            ->bindValue(":hayStock", $entity->getHayStock(), \PDO::PARAM_BOOL)
            ->bindValue(":largo", $entity->getLargo(), \PDO::PARAM_INT)
            ->bindValue(":ancho", $entity->getAncho(), \PDO::PARAM_INT)
            ->bindValue(":espesor", $entity->getEspesor(), \PDO::PARAM_INT)
            ->execute();
    }

    public function remove(patterns\IEntity $entity)
    {
        $this->checkType($entity);

        $this->getPDO()
            ->prepare("CALL BorrarProducto(:identificador)")
            ->bindValue(":identificador", $entity->getIdentifier(), \PDO::PARAM_INT)
            ->execute();
    }

    protected function checkType(patterns\IEntity $entity)
    {
        if (!($entity instanceof models\ProductoModel))
        {
            throw new Exception("Tipo incorrecto.");
        }
    }
}