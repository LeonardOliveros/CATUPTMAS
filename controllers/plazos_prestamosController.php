<?php

class plazos_prestamosController extends Controller {
    private $_modelo;
    
    public function __construct() {
        parent::__construct();
        if (!Session::get('autenticado')) {
            $this->redireccionar();
        }
        $this->_modelo = $this->loadModel('plazos_prestamos');
    }

    public function index() {
        $this->_view->titulo = 'Listar Plazos de Prestamos';
        $this->_view->setJs(array('dynamic_table_plazo_prestamo'));
        $this->_view->datos = $this->_modelo->getAll();
        $this->_view->renderizar('index', 'utilidades', 'plazos_prestamos');
    }

    public function nuevo() {
        $this->_view->titulo = 'Registrar Plazo de Prestamo';

        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;

            if (!$this->getTexto('codigo_pla_pre')) {
                $this->_view->_error = 'Debe Introducir el C&oacute;digo';
                $this->_view->renderizar('nuevo', 'utilidades', 'plazos_prestamos');
                exit;
            }

            $codigo = $this->_modelo->getCodigo($this->getPostParam('codigo_pla_pre'));
            if ($codigo) {
                $this->_view->_error = 'C&oacute;digo existente en la Base de Datos';
                $this->_view->renderizar('nuevo', 'utilidades', 'plazos_prestamos');
                exit;
            }

            if (!$this->getTexto('nombre_pla_pre')) {
                $this->_view->_error = 'Debe Introducir el Nombre del Plazo del Prestamo';
                $this->_view->renderizar('nuevo', 'utilidades', 'plazos_prestamos');
                exit;
            }

            $nombre = $this->_modelo->getNombre($this->getPostParam('nombre_pla_pre'));
            if ($nombre) {
                $this->_view->_error = 'Nombre existente en la Base de Datos';
                $this->_view->renderizar('nuevo', 'utilidades', 'plazos_prestamos');
                exit;
            }

            if (!$this->getInt('meses_pla_pre')) {
                $this->_view->_error = 'Debe Introducir el Plazo del Prestamo';
                $this->_view->renderizar('nuevo', 'utilidades', 'plazos_prestamos');
                exit;
            }

            $this->_modelo->insertarDatos(
                    $this->getPostParam('codigo_pla_pre'),
                    strtoupper($this->getPostParam('nombre_pla_pre')),
                    $this->getPostParam('meses_pla_pre')
                    );
            echo "<script>alert('Registro Satisfactoriamente...')</script>";
            $this->redireccionar2('plazos_prestamos/index', 0.1);
        }
        $this->_view->renderizar('nuevo', 'utilidades', 'plazos_prestamos');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('plazos_prestamos/index');
        }

        if ($this->_modelo->getOne($id)){
            $this->_view->datos = $this->_modelo->getOne($id);
        } else {
            $this->redireccionar('plazos_prestamos/index');
        }

        $this->_view->titulo = 'Editar Plazo del Prestamo';

        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;

            if (!$this->getTexto('codigo_pla_pre')) {
                $this->_view->_error = 'Debe Introducir el C&oacute;digo';
                $this->_view->renderizar('editar', 'utilidades', 'plazos_prestamos');
                exit;
            }

            $codigo = $this->_modelo->getCodigo($this->getPostParam('codigo_pla_pre'));
            if ($codigo && $codigo['id_pla_pre'] != $id) {
                $this->_view->_error = 'C&oacute;digo existente en la Base de Datos';
                $this->_view->renderizar('editar', 'utilidades', 'plazos_prestamos');
                exit;
            }
            
            if (!$this->getTexto('nombre_pla_pre')) {
                $this->_view->_error = 'Debe Introducir el Nombre del Plazo del Prestamo';
                $this->_view->renderizar('editar', 'utilidades', 'plazos_prestamos');
                exit;
            }

            $nombre = $this->_modelo->getNombre($this->getPostParam('nombre_pla_pre'));
            if ($nombre && $nombre['id_pla_pre'] != $id) {
                $this->_view->_error = 'Nombre existente en la Base de Datos';
                $this->_view->renderizar('editar', 'utilidades', 'plazos_prestamos');
                exit;
            }

            if (!$this->getInt('meses_pla_pre')) {
                $this->_view->_error = 'Debe Introducir el Plazo del Prestamo';
                $this->_view->renderizar('editar', 'utilidades', 'plazos_prestamos');
                exit;
            }

            $this->_modelo->editarDatos(
                    $id,
                    $this->getPostParam('codigo_pla_pre'),
                    strtoupper($this->getPostParam('nombre_pla_pre')),
                    $this->getPostParam('meses_pla_pre')
                    );
            echo "<script>alert('Actualizado Satisfactoriamente...')</script>";
            $this->redireccionar2('plazos_prestamos/index', 0.1);
        }
        $this->_view->renderizar('editar', 'utilidades', 'plazos_prestamos');
    }

    public function elimina($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('plazos_prestamos/index');
        }

        if ($this->_modelo->getOne($id)) {
            $this->_modelo->drop($id);
        }

        $this->redireccionar('plazos_prestamos/index');
    }
}
