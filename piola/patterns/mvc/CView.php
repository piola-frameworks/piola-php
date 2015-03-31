<?php

namespace piola\mvc
{
    use piola as piola;
    use piola\patterns as patterns;
    
    class CView implements IView
    {
        private $_viewRoute;
        private $_viewModel;
        
        public function getViewRoute()
        {
            return $this->_viewRoute;
        }
        
        public function setViewRoute($viewRoute)
        {
            $this->_viewRoute = $viewRoute;
        }
        
        /**
         * 
         * @return patterns\IViewModel
         */
        public function getViewModel()
        {
            return $this->_viewModel;
        }
        
        /**
         * 
         * @param patterns\IViewModel $viewModel
         */
        public function setViewModel(patterns\IViewModel $viewModel = null)
        {
            $this->_viewModel = $viewModel;
        }
        
        public function __construct($viewRoute = "index", patterns\IViewModel $viewModel = null)
        {
            $this->setViewRoute($viewRoute);
            $this->setViewModel($viewModel);
        }
        
        public function render()
        {
            $filePath = $this->pathResolver();
            $file = new \SplFileObject($filePath);
            
            if (!$file->isReadable())
            {
                throw new \Exception("El archivo no se puede leer.");
            }
            
            extract((array)$this->getViewModel(), EXTR_REFS);
            piola\OutputBuffer::start();
            include_once($filePath);
            echo piola\OutputBuffer::currentContent();
            piola\OutputBuffer::end();
        }
        
        public function redirect($location)
        {
            header("Location: " . $location);
        }
        
        /**
         * 
         * @return string
         */
        private function pathResolver()
        {
            // TODO: hay que cambiar esto. debe buscar automaticamente el directorio.
            return APP_DIR . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . $this->getViewRoute() . ".php";
        }
    }
}

?>