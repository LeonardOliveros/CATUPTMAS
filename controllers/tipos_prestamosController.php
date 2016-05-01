<?php

class tipos_prestamosController extends Controller {
    private $_modelo;
    
    public function __construct() {
        parent::__construct();
        if (!Session::get('autenticado')) {
            $this->redireccionar();
        }
        $this->_modelo = $this->loadModel('tipos_prestamos');
    }

    public function index() {
        $this->_view->titulo = 'Listar Tipos de Prestamos';
        $this->_view->setJs(array('dynamic_table_tipo_prestamo'));
        $this->_view->datos = $this->_modelo->getAll();
        $this->_view->renderizar('index', 'utilidades', 'tipos_prestamos');
    }

    public function nuevo() {
        $this->_view->titulo = 'Registrar Tipo de Prestamo';

        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;
            
            if (!$this->getTexto('nombre_tip_pre')) {
                $this->_view->_error = 'Debe Introducir el Nombre del Tipo de Prestamo';
                $this->_view->renderizar('nuevo', 'utilidades', 'tipos_prestamos');
                exit;
            }

            if (!$this->getTexto('interes_tip_pre')) {
                $this->_view->_error = 'Debe Introducir la Tasa de Interes del Tipo de Prestamo';
                $this->_view->renderizar('nuevo', 'utilidades', 'tipos_prestamos');
                exit;
            }

            $this->_modelo->insertarDatos(
                    $this->getPostParam('nombre_tip_pre'),
                    $this->getPostParam('interes_tip_pre')
                    );
            echo "<script>alert('Registro Satisfactoriamente...')</script>";
            $this->redireccionar2('tipos_prestamos/index', 0.1);
        }
        $this->_view->renderizar('nuevo', 'utilidades', 'tipos_prestamos');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('tipos_prestamos/index');
        }

        if ($this->_modelo->getOne($id)){
            $this->_view->datos = $this->_modelo->getOne($id);
        } else {
            $this->redireccionar('tipos_prestamos/index');
        }

        $this->_view->titulo = 'Editar Tipo de Prestamo';

        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;
            
            if (!$this->getTexto('nombre_tip_pre')) {
                $this->_view->_error = 'Debe Introducir el Nombre del Tipo de Prestamo';
                $this->_view->renderizar('editar', 'utilidades', 'tipos_prestamos');
                exit;
            }

            if (!$this->getTexto('interes_tip_pre')) {
                $this->_view->_error = 'Debe Introducir la Tasa de Interes del Tipo de Prestamo';
                $this->_view->renderizar('editar', 'utilidades', 'tipos_prestamos');
                exit;
            }

            $this->_modelo->editarDatos(
                    $id,
                    $this->getPostParam('nombre_tip_pre'),
                    $this->getPostParam('interes_tip_pre')
                    );
            echo "<script>alert('Actualizado Satisfactoriamente...')</script>";
            $this->redireccionar2('tipos_prestamos/index', 0.1);
        }
        $this->_view->renderizar('editar', 'utilidades', 'tipos_prestamos');
    }

    public function elimina($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('tipos_prestamos/index');
        }

        if ($this->_modelo->getOne($id)) {
            $this->_modelo->drop($id);
        }

        $this->redireccionar('tipos_prestamos/index');
    }
}
