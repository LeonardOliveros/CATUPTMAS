<?php

class bancoController extends Controller {
    private $_modelo;
    
    public function __construct() {
        parent::__construct();
        if (!Session::get('autenticado')) {
            $this->redireccionar();
        }
        $this->_modelo = $this->loadModel('banco');
    }

    public function index() {
        $this->_view->titulo = 'Listar Bancos';
        $this->_view->setJs(array('dynamic_table_banco'));
        $this->_view->datos = $this->_modelo->getAll();
        $this->_view->renderizar('index', 'utilidades', 'bancos');
    }

    public function nuevo() {
        $this->_view->titulo = 'Registrar Banco';

        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;

            if (!$this->getTexto('codigo_ban')) {
                $this->_view->_error = 'Debe Introducir el C&oacute;digo del Banco';
                $this->_view->renderizar('nuevo', 'utilidades', 'bancos');
                exit;
            }

            $codigo = $this->_modelo->getCodigo($this->getPostParam('codigo_ban'));
            if ($codigo['cant'] > 0) {
                $this->_view->_error = 'C&oacute;digo existente en la Base de Datos';
                $this->_view->renderizar('nuevo', 'utilidades', 'bancos');
                exit;
            }
            
            if (!$this->getTexto('nombre_ban')) {
                $this->_view->_error = 'Debe Introducir el Nombre del Banco';
                $this->_view->renderizar('nuevo', 'utilidades', 'bancos');
                exit;
            }

            if (!$this->getTexto('numero_cuenta_ban')) {
                $this->_view->_error = 'Debe Introducir la N&uacute;mero de Cuenta';
                $this->_view->renderizar('nuevo', 'utilidades', 'bancos');
                exit;
            }
            $banco = $this->_modelo->getNumeroCuenta($this->getPostParam('numero_cuenta_ban'));
            if ($banco['cant'] > 0) {
                $this->_view->_error = 'N&uacute;mero de Cuenta existente en la Base de Datos';
                $this->_view->renderizar('nuevo', 'utilidades', 'bancos');
                exit;
            }

            if (!$this->getTexto('tipo_cuenta_ban')) {
                $this->_view->_error = 'Debe Seleccionar el Tipo de Cuenta';
                $this->_view->renderizar('nuevo', 'utilidades', 'bancos');
                exit;
            }

            $this->_modelo->insertarDatos(
                    $this->getPostParam('codigo_ban'),
                    $this->getPostParam('nombre_ban'),
                    $this->getPostParam('numero_cuenta_ban'),
                    $this->getPostParam('tipo_cuenta_ban')
                    );
            echo "<script>alert('Registro Satisfactoriamente...')</script>";
            $this->redireccionar2('banco/index', 0.1);
        }
        $this->_view->renderizar('nuevo', 'utilidades', 'bancos');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('banco/index');
        }

        if ($this->_modelo->getOne($id)){
            $this->_view->datos = $this->_modelo->getOne($id);
        } else {
            $this->redireccionar('banco/index');
        }

        $this->_view->titulo = 'Editar Banco';

        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;

            if (!$this->getTexto('codigo_ban')) {
                $this->_view->_error = 'Debe Introducir el C&oacute;digo';
                $this->_view->renderizar('editar', 'utilidades', 'bancos');
                exit;
            }

            $codigo = $this->_modelo->getCodigo($this->getPostParam('codigo_ban'));
            if ($codigo['cant'] > 0 && $id != $codigo['id_ban']) {
                $this->_view->_error = 'C&oacute;digo existente en la Base de Datos';
                $this->_view->renderizar('nuevo', 'utilidades', 'bancos');
                exit;
            }
            
            if (!$this->getTexto('nombre_ban')) {
                $this->_view->_error = 'Debe Introducir el Nombre del Banco';
                $this->_view->renderizar('editar', 'utilidades', 'bancos');
                exit;
            }

            if (!$this->getTexto('numero_cuenta_ban')) {
                $this->_view->_error = 'Debe Introducir la N&uacute;mero de Cuenta Bancaria';
                $this->_view->renderizar('editar', 'utilidades', 'bancos');
                exit;
            }

            $banco = $this->_modelo->getNumeroCuenta($this->getPostParam('numero_cuenta_ban'));
            if ($banco['cant'] > 0 && $banco['id_ban'] != $id) {
                $this->_view->_error = 'N&uacute;mero de Cuenta existente en la Base de Datos';
                $this->_view->renderizar('editar', 'utilidades', 'bancos');
                exit;
            }

            if (!$this->getTexto('tipo_cuenta_ban')) {
                $this->_view->_error = 'Debe Seleccionar el Tipo de Cuenta';
                $this->_view->renderizar('editar', 'utilidades', 'bancos');
                exit;
            }

            $this->_modelo->editarDatos(
                    $id,
                    $this->getPostParam('codigo_ban'),
                    $this->getPostParam('nombre_ban'),
                    $this->getPostParam('numero_cuenta_ban'),
                    $this->getPostParam('tipo_cuenta_ban')
                    );
            echo "<script>alert('Actualizado Satisfactoriamente...')</script>";
            $this->redireccionar2('banco/index', 0.1);
        }
        $this->_view->renderizar('editar', 'utilidades', 'bancos');
    }

    public function elimina($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('banco/index');
        }

        if ($this->_modelo->getOne($id)) {
            $this->_modelo->drop($id);
        }

        $this->redireccionar('banco/index');
    }
}
