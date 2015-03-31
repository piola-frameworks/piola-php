<?php

namespace piola
{
    /**
     * Description of OutputBufferStatus
     *
     * @author Pablo
     */
    final class OutputBufferStatus
    {
        /**
         *
         * @var int Tamaño del segmento
         */
        private $_chunkSize;
        /**
         *
         * @var int 
         */
        private $_size;
        /**
         *
         * @var int Tamaño del bloque
         */
        private $_blockSize;
        /**
         *
         * @var int Nivel de anidamiento de la salida
         */
        private $_level;
        /**
         *
         * @var int 
         */
        private $_type;
        /**
         *
         * @var int 
         */
        private $_status;
        /**
         *
         * @var string Nombre del gestor de salida activo
         */
        private $_name;
        /**
         *
         * @var bool Bandera de borrado
         */
        private $_forDelete;
        
        public function getChunkSize() { return $this->_chunkSize; }
        private function setChunkSize($chunkSize) { $this->_chunkSize = $chunkSize; }
        
        public function getSize() { return $this->_size; }
        private function setSize($size) { $this->_size = $size; }
        
        public function getBlockSize() { return $this->_blockSize; }
        private function setBlockSize($blockSize) { $this->_blockSize = $blockSize; }
        
        public function getLevel() { return $this->_level; }
        private function setLevel($level) { $this->_level = $level; }
        
        public function getType() { return $this->_type; }
        private function setType($type) { $this->_type = $type; }
        
        public function getStatus() { return $this->_status; }
        private function setStatus($status) { $this->_status = $status; }
        
        public function getName() { return $this->_name; }
        private function setName($name) { $this->_name = $name; }
        
        public function isForDelete() { return $this->_forDelete; }
        private function setForDelete($forDelete) { $this->_forDelete = $forDelete; }
        
        private function __construct($level, $type, $status, $name, $forDelete, $chuckSize = 0, $size = 0, $blockSize = 0)
        {
            $this->setLevel($level);
            $this->setType($type);
            $this->setStatus($status);
            $this->setName($name);
            $this->setForDelete($forDelete);
            
            $this->setChunkSize($chuckSize);
            $this->setSize($size);
            $this->setBlockSize($blockSize);
        }
        
        /**
         * 
         * @param int $level
         * @param int $type
         * @param int $status
         * @param string $name
         * @param bool $forDelete
         * @param int $chuckSize
         * @param int $size
         * @param int $blockSize
         * @return \piola\OutputBufferStatus
         */
        public static function Create($level, $type, $status, $name, $forDelete, $chuckSize = 0, $size = 0, $blockSize = 0)
        {
            return new OutputBufferStatus($level, $type, $status, $name, $forDelete, $chuckSize, $size, $blockSize);
        }
    }
}

?>