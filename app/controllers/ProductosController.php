<?php

namespace miali\controller
{
    use piola\mvc as mvc;
    use piola\web as web;
    use miali\view as view;
    use miali\model as model;
    use miali\model\repository as repository;
    use miali\viewmodel as viewmodel;
    
    final class ProductosController extends mvc\AController
    {
        private $_productosRepository;
        
        public function __construct()
        {
            $this->_productosRepository = new repository\ProductoRepository();
        }
        
        public function index()
        {
            $resultado = $this->_productosRepository->getAll();
            $viewModel = new viewmodel\ProductosIndexViewModel($resultado);
            
            return new mvc\CView("productos/index", $viewModel);
        }
        
        public function create()
        {
            $nombre = web\SPost::getValue("txtNombre");
            $descripcion = web\SPost::getValue("txtDescripcion");
            $precio = web\SPost::getValue("txtPrecio");
            $hayStock = web\SPost::getValue("chkHayStock");
            $largo = web\SPost::getValue("txtLargo");
            $ancho = web\SPost::getValue("txtAncho");
            $espesor = web\SPost::getValue("txtEspesor");
            
            $entity = new model\ProductoModel(0, $nombre, $descripcion, $precio, $hayStock, $largo, $ancho, $espesor);
            $this->_productosRepository->create($entity);
            
            return new view\ProductosView("productos", __METHOD__);
        }

        public function delete($id)
        {
            $entity = $this->_productosRepository->getById($id);
            $this->_productosRepository->remove($entity);
            
            return new view\ProductosView("productos", __METHOD__);
        }
        
        public function read($id)
        {
            $this->_productosRepository->getById($id);
            
            return new view\ProductosView("productos", __METHOD__);
        }

        public function update($id)
        {
            $formulario = web\SPost::getValue("frmDatos");
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
            
            return new view\ProductosView("productos", __METHOD__);
        }
    }
}

?>