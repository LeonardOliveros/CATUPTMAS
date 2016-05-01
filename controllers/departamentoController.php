<?php

class departamentoController extends Controller {
    private $_modelo;
    
    public function __construct() {
        parent::__construct();
        if (!Session::get('autenticado')) {
            $this->redireccionar();
        }
        $this->_modelo = $this->loadModel('departamento');
    }

    public function index() {
        $this->_view->titulo = 'Listar Departamentos';
        $this->_view->setJs(array('dynamic_table_departamento'));
        $this->_view->datos = $this->_modelo->getAll();
        $this->_view->renderizar('index', 'utilidades', 'departamentos');
    }

    public function nuevo() {
        $this->_view->titulo = 'Registrar Departamento';

        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;

            if (!$this->getTexto('codigo_dep')) {
                $this->_view->_error = 'Debe Introducir el C&oacute;digo';
                $this->_view->renderizar('nuevo', 'utilidades', 'departamentos');
                exit;
            }
            
            if (!$this->getTexto('nombre_dep')) {
                $this->_view->_error = 'Debe Introducir el Nombre del Departamento';
                $this->_view->renderizar('nuevo', 'utilidades', 'departamentos');
                exit;
            }

            $departamento = $this->_modelo->getNombre($this->getPostParam('nombre_dep'));
            if ($departamento['cant'] > 0) {
                $this->_view->_error = 'Departamento existente en la Base de Datos';
                $this->_view->renderizar('nuevo', 'utilidades', 'departamentos');
                exit;
            }

            $this->_modelo->insertarDatos(
                    $this->getPostParam('codigo_dep'),
                    $this->getPostParam('nombre_dep')
                    );
            echo "<script>alert('Registro Satisfactoriamente...')</script>";
            $this->redireccionar2('departamento/index', 0.5);
        }
        $this->_view->renderizar('nuevo', 'utilidades', 'departamentos');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('departamento/index');
        }

        if ($this->_modelo->getOne($id)){
            $this->_view->datos = $this->_modelo->getOne($id);
        } else {
            $this->redireccionar('departamento/index');
        }

        $this->_view->titulo = 'Editar Departamento';

        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;

            if (!$this->getTexto('codigo_dep')) {
                $this->_view->_error = 'Debe Introducir el C&oacute;digo';
                $this->_view->renderizar('nuevo', 'utilidades', 'departamentos');
                exit;
            }
            
            if (!$this->getTexto('nombre_dep')) {
                $this->_view->_error = 'Debe Introducir el Nombre del Departamento';
                $this->_view->renderizar('editar', 'utilidades', 'departamentos');
                exit;
            }

            $departamento = $this->_modelo->getNombre($this->getPostParam('nombre_dep'));
            if ($departamento['cant'] > 0 && $departamento['id_dep'] != $id) {
                $this->_view->_error = 'Departamento existente en la Base de Datos';
                $this->_view->renderizar('editar', 'utilidades', 'departamentos');
                exit;
            }

            $this->_modelo->editarDatos(
                    $id,
                    $this->getPostParam('codigo_dep'),
                    $this->getPostParam('nombre_dep')
                    );
            echo "<script>alert('Actualizado Satisfactoriamente...')</script>";
            $this->redireccionar2('departamento/index', 0.5);
        }
        $this->_view->renderizar('nuevo', 'utilidades', 'departamentos');
    }

    public function elimina($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar();
        }

        if ($this->_modelo->getOne($id)) {
            $this->_modelo->drop($id);
        }

        $this->redireccionar('departamento/index');
    }
}
