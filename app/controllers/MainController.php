<?php

namespace miali\controller
{
    use piola\mvc as mvc;
    use piola\web as web;
    use miali\model as model;
    use miali\model\repository as repository;
    use miali\viewmodel as viewmodel;
    
    class MainController extends mvc\AController
    {
        private $_productosRepository;
        
        public function __construct()
        {
            parent::__construct();
            
            $this->_productosRepository = new repository\ProductoRepository();
        }
        
        public function index()
        {
            $resultado = $this->_productosRepository->getAll();
            $viewModel = new viewmodel\MainViewModel();
            $viewModel->title = "algo";
            $viewModel->resultado = $resultado;
            
            return new mvc\CView("index", $viewModel);
        }
        
        public function create()
        {
            $nombre = web\CHttpPostMethod::getValue("txtNombre");
            $descripcion = web\CHttpPostMethod::getValue("txtDescripcion");
            $precio = web\CHttpPostMethod::getValue("txtPrecio");
            $hayStock = web\CHttpPostMethod::getValue("chkHayStock");
            $largo = web\CHttpPostMethod::getValue("txtLargo");
            $ancho = web\CHttpPostMethod::getValue("txtAncho");
            $espesor = web\CHttpPostMethod::getValue("txtEspesor");
            
            $entity = new model\ProductoModel(0, $nombre, $descripcion, $precio, $hayStock, $largo, $ancho, $espesor);
            $this->_productosRepository->create($entity);
            
            return new mvc\CView("productos", __FUNCTION__);
        }

        public function delete($id)
        {
            $entity = $this->_productosRepository->getById($id);
            $this->_productosRepository->remove($entity);
            
            return new mvc\CView("productos", __FUNCTION__);
        }
        
        public function read($id)
        {
            $this->_productosRepository->getById($id);
            
            return new mvc\CView("productos", __FUNCTION__);
        }

        public function update($id)
        {
            $formulario = web\CHttpPostMethod::getValue("frmDatos");
            $identificador = $id;
            $nombre = $formulario[""];
            $descripcion = $formulario[""];
            $precio = $formulario[""];
            $hayStock = $formulario[""];
            $largo = $formulario[""];
            $ancho = $formulario[""];
            $espesor = $formulario[""];
            
            $entity = new model\ProductoModel($identificador, $nombre, $descripcion, $precio, $hayStock, $largo, $ancho, $espesor);
            $this->_productosRepository->modify($entity);
            
            return new mvc\CView("productos", __FUNCTION__);
        }
    }
}

?>