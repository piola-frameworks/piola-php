<?php

namespace piola\patterns\repository
{
    use piola\patterns as patterns;
    
    interface IRepository extends IReadOnlyRepository
    {
        /**
         * 
         * @param \piola\patterns\IEntity $entity
         * @return int Devuelve el identificador del objeto generado.
         */
        public function create(patterns\IEntity $entity);
        
        /**
         * 
         * @param \piola\patterns\IEntity $entity
         */
        public function remove(patterns\IEntity $entity);
        
        /**
         * 
         * @param \piola\patterns\IEntity $entity
         */
        public function modify(patterns\IEntity $entity);
    }    
}

?>