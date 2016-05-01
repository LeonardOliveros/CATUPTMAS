<?php

class categoriaController extends Controller {
    private $_modelo;
    
    public function __construct() {
        parent::__construct();
        if (!Session::get('autenticado')) {
            $this->redireccionar();
        }
        $this->_modelo = $this->loadModel('categoria');
    }

    public function index() {
        $this->_view->titulo = 'Listar Categorias';
        $this->_view->setJs(array('dynamic_table_categoria'));
        $this->_view->datos = $this->_modelo->getAll();
        $this->_view->renderizar('index', 'utilidades', 'categorias');
    }

    public function nuevo() {
        $this->_view->titulo = 'Registrar Categoria';

        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;
            
            if (!$this->getTexto('nombre_cat')) {
                $this->_view->_error = 'Debe Introducir el Nombre de la Categoria';
                $this->_view->renderizar('nuevo', 'utilidades', 'categorias');
                exit;
            }

            $this->_modelo->insertarDatos(
                    $this->getPostParam('nombre_cat')
                    );
            echo "<script>alert('Registro Satisfactoriamente...')</script>";
            $this->redireccionar2('categoria/index', 0.1);
        }
        $this->_view->renderizar('nuevo', 'utilidades', 'categorias');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('categoria/index');
        }

        if ($this->_modelo->getOne($id)){
            $this->_view->datos = $this->_modelo->getOne($id);
        } else {
            $this->redireccionar('categoria/index');
        }

        $this->_view->titulo = 'Editar Categoria';

        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;
            
            if (!$this->getTexto('nombre_cat')) {
                $this->_view->_error = 'Debe Introducir el Nombre de la Categoria';
                $this->_view->renderizar('editar', 'utilidades', 'categorias');
                exit;
            }

            $this->_modelo->editarDatos(
                    $id,
                    $this->getPostParam('nombre_cat')
                    );
            echo "<script>alert('Actualizado Satisfactoriamente...')</script>";
            $this->redireccionar2('categoria/index', 0.1);
        }
        $this->_view->renderizar('editar', 'utilidades', 'categorias');
    }

    public function consulta($id) {
        $this->_view->titulo = 'Consultar Categoria';

        if (!$this->filtrarInt($id)) {
            $this->redireccionar('categoria/index');
        }

        if ($this->_modelo->getOne($id)){
            $this->_view->datos = $this->_modelo->getOne($id);
        } else {
            $this->redireccionar('categoria/index');
        }

        $this->_view->renderizar('consulta', 'utilidades', 'categorias');
    }

    public function elimina($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('categoria/index');
        }

        if ($this->_modelo->getOne($id)) {
            $this->_modelo->drop($id);
        }

        $this->redireccionar('categoria/index');
    }
}
