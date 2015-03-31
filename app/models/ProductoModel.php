<?php

namespace miali\model
{
    use piola\patterns as patterns;
    
    class ProductoModel implements patterns\IEntity
    {
        /**
         *
         * @var int Numero identificador
         */
        private $_identificador;
        
        /**
         *
         * @var string Nombre del producto
         */
        private $_nombre;
        
        /**
         *
         * @var string|null Descripcion del producto
         */
        private $_descripcion;
        
        /**
         *
         * @var float Precio por unidad del producto.
         */
        private $_precio;
        
        /**
         *
         * @var bool
         */
        private $_hayStock;
        
        /**
         *
         * @var int 
         */
        private $_largo;
        
        /**
         *
         * @var int 
         */
        private $_ancho;
        
        /**
         *
         * @var int 
         */
        private $_espesor;
        
        public function getIdentifier()
        {
            return $this->_identificador;
        }

        protected function setIdentifier($identifier)
        {
            $this->_identificador = $identifier;
        }
        
        public function getNombre()
        {
            return $this->_nombre;
        }

        protected function setNombre($nombre)
        {
            $this->_nombre = $nombre;
        }
        
        public function getDescripcion()
        {
            return $this->_descripcion;
        }

        protected function setDescripcion($descripcion)
        {
            $this->_descripcion = $descripcion;
        }
        
        public function getPrecio()
        {
            return $this->_precio;
        }

        protected function setPrecio($precio)
        {
            $this->_precio = $precio;
        }
        
        public function getHayStock()
        {
            return $this->_hayStock;
        }

        protected function setHayStock($hayStock)
        {
            $this->_hayStock = $hayStock;
        }
        
        public function getLargo() 
        {
            return $this->_largo;
        }

        protected function setLargo($largo)
        {
            $this->_largo = $largo;
        }
        
        public function getAncho()
        {
            return $this->_ancho;
        }

        protected function setAncho($ancho)
        {
            $this->_ancho = $ancho;
        }
        
        public function getEspesor()
        {
            return $this->_espesor;
        }

        protected function setEspesor($espesor) 
        {
            $this->_espesor = $espesor;
        }
        
        public function __construct($identificador, $nombre, $descripcion = "", $precio = .0, $hayStock = false, $largo = 0, $ancho = 0, $espesor = 0)
        {
            $this->setIdentifier($identificador);
            $this->setNombre($nombre);
            $this->setDescripcion($descripcion);
            $this->setPrecio($precio);
            $this->setHayStock($hayStock);
            $this->setLargo($largo);
            $this->setAncho($ancho);
            $this->setEspesor($espesor);
        }
    }
}

?>