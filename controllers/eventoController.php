<?php

class eventoController extends Controller {
    private $_modelo;
    
    public function __construct() {
        parent::__construct();
        if (!Session::get('autenticado')) {
            $this->redireccionar();
        }
        $this->_modelo = $this->loadModel('evento');
    }

    public function index() {
        $this->_view->titulo = 'Listar Eventos';
        $this->_view->setJs(array('dynamic_table_evento'));
        $this->_view->datos = $this->_modelo->getAll();
        $this->_view->renderizar('index', 'utilidades', 'eventos');
    }

    public function nuevo() {
        $this->_view->titulo = 'Registrar Evento';

        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;
            
            if (!$this->getTexto('nombre_eve')) {
                $this->_view->_error = 'Debe Introducir el Nombre del Evento';
                $this->_view->renderizar('nuevo', 'utilidades', 'eventos');
                exit;
            }

            if (!$this->getTexto('fecha_inicio_eve')) {
                $this->_view->_error = 'Debe Introducir la Fecha de Inicio del Evento';
                $this->_view->renderizar('nuevo', 'utilidades', 'eventos');
                exit;
            }

            if (!$this->getTexto('fecha_fin_eve')) {
                $this->_view->_error = 'Debe Introducir la Fecha Final del Evento';
                $this->_view->renderizar('nuevo', 'utilidades', 'eventos');
                exit;
            }

            if (!$this->getTexto('descripcion_eve')) {
                $this->_view->_error = 'Debe Introducir la Descripcion del Evento';
                $this->_view->renderizar('nuevo', 'utilidades', 'eventos');
                exit;
            }
            
            if (!$this->getTexto('estado_eve')) {
                $this->_view->_error = 'Debe Seleccionar el Estado del Evento';
                $this->_view->renderizar('nuevo', 'utilidades', 'eventos');
                exit;
            }

            $this->_modelo->insertarDatos(
                    $this->getPostParam('nombre_eve'),
                    $this->getPostParam('fecha_inicio_eve'),
                    $this->getPostParam('fecha_fin_eve'),
                    $this->getPostParam('descripcion_eve'),
                    $this->getPostParam('estado_eve')
                    );
            echo "<script>alert('Registro Satisfactoriamente...')</script>";
            $this->redireccionar2('evento/index', 0.1);
        }
        $this->_view->renderizar('nuevo', 'utilidades', 'eventos');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('evento/index');
        }

        if ($this->_modelo->getOne($id)){
            $this->_view->datos = $this->_modelo->getOne($id);
        } else {
            $this->redireccionar('evento/index');
        }

        $this->_view->titulo = 'Editar Evento';

        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;
            
            if (!$this->getTexto('nombre_eve')) {
                $this->_view->_error = 'Debe Introducir el Nombre del Evento';
                $this->_view->renderizar('editar', 'utilidades', 'eventos');
                exit;
            }

            if (!$this->getTexto('fecha_inicio_eve')) {
                $this->_view->_error = 'Debe Introducir la Fecha de Inicio del Evento';
                $this->_view->renderizar('editar', 'utilidades', 'eventos');
                exit;
            }

            if (!$this->getTexto('fecha_fin_eve')) {
                $this->_view->_error = 'Debe Introducir la Fecha Final del Evento';
                $this->_view->renderizar('editar', 'utilidades', 'eventos');
                exit;
            }

            if (!$this->getTexto('descripcion_eve')) {
                $this->_view->_error = 'Debe Introducir la Descripcion del Evento';
                $this->_view->renderizar('editar', 'utilidades', 'eventos');
                exit;
            }
            
            if (!$this->getTexto('estado_eve')) {
                $this->_view->_error = 'Debe Seleccionar el Estado del Evento';
                $this->_view->renderizar('editar', 'utilidades', 'eventos');
                exit;
            }

            $this->_modelo->editarDatos(
                    $id,
                    $this->getPostParam('nombre_eve'),
                    $this->getPostParam('fecha_inicio_eve'),
                    $this->getPostParam('fecha_fin_eve'),
                    $this->getPostParam('descripcion_eve'),
                    $this->getPostParam('estado_eve')
                    );
            echo "<script>alert('Actualizado Satisfactoriamente...')</script>";
            $this->redireccionar2('evento/index', 0.1);
        }
        $this->_view->renderizar('editar', 'utilidades', 'eventos');
    }

    public function consulta($id) {
        $this->_view->titulo = 'Consultar Evento';

        if (!$this->filtrarInt($id)) {
            $this->redireccionar('evento/index');
        }

        if ($this->_modelo->getOne($id)){
            $this->_view->datos = $this->_modelo->getOne($id);
        } else {
            $this->redireccionar('evento/index');
        }

        $this->_view->renderizar('consulta', 'utilidades', 'eventos');
    }

    public function elimina($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('evento/index');
        }

        if ($this->_modelo->getOne($id)) {
            $this->_modelo->drop($id);
        }

        $this->redireccionar('evento/index');
    }
}
