<?php

class socioController extends Controller {
    private $_modelo;
    private $_mDepartamento;
    private $_mMovimiento;
    private $_mCategoria;
    
    public function __construct() {
        parent::__construct();
        if (!Session::get('autenticado')) {
            $this->redireccionar();
        }
        $this->_modelo = $this->loadModel('socio');
        $this->_mDepartamento = $this->loadModel('departamento');
        $this->_mMovimiento = $this->loadModel('movimiento');
        $this->_mCategoria = $this->loadModel('categoria');
    }

    public function index() {
        $this->_view->titulo = 'Listar Socios';
        $this->_view->datos = $this->_modelo->getAll();
        $this->_view->setJs(array('dynamic_table_socio'));
        $this->_view->renderizar('index', 'socios', 'listar_socios');
    }

    public function nuevo() {
        $this->_view->titulo = 'Registrar Socio';
        $this->_view->setJs(array('nuevo'));
        $this->_view->departamentos = $this->_mDepartamento->getAll();
        $this->_view->categorias = $this->_mCategoria->getAll();

        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;

            if (!$this->getTexto('codigo_soc')) {
                $this->_view->_error = 'Debe Introducir la C&oacute;digo';
                $this->_view->renderizar('nuevo', 'socios', 'nuevo_socio');
                exit;
            }

            if (!$this->getTexto('cedula_rif_soc')) {
                $this->_view->_error = 'Debe Introducir la C&eacute;dula o RIF';
                $this->_view->renderizar('nuevo', 'socios', 'nuevo_socio');
                exit;
            }

            $socio = $this->_modelo->getCedula($this->getPostParam('cedula_rif_soc'));
            if ($socio['cant'] > 0) {
                $this->_view->_error = 'C&eacute;dula del Socio existente en la Base de Datos';
                $this->_view->renderizar('nuevo', 'socios', 'nuevo_socio');
                exit;
            }
            
            if (!$this->getTexto('apellidos_soc')) {
                $this->_view->_error = 'Debe Introducir los Apellidos';
                $this->_view->renderizar('nuevo', 'socios', 'nuevo_socio');
                exit;
            }

            if (!$this->getTexto('nombres_soc')) {
                $this->_view->_error = 'Debe Introducir los Nombres';
                $this->_view->renderizar('nuevo', 'socios', 'nuevo_socio');
                exit;
            }

            if (!$this->getTexto('telefono_soc')) {
                $this->_view->_error = 'Debe Introducir el Tel&eacute;fono';
                $this->_view->renderizar('nuevo', 'socios', 'nuevo_socio');
                exit;
            }

            /*if (!$this->getTexto('telefono2_soc')) {
                $this->_view->_error = 'Debe Introducir Otro Tel&eacute;fono';
                $this->_view->renderizar('nuevo', 'socios', 'nuevo_socio');
                exit;
            }*/

            /*if (!$this->getTexto('direccion_soc')) {
                $this->_view->_error = 'Debe Introducir la Direcci&oacute;n';
                $this->_view->renderizar('nuevo', 'socios', 'nuevo_socio');
                exit;
            }*/

            if (!$this->getTexto('tipo_soc')) {
                $this->_view->_error = 'Debe Seleccionar el Tipo de Socio';
                $this->_view->renderizar('nuevo', 'socios', 'nuevo_socio');
                exit;
            }

            /*if (!$this->getTexto('categoria_soc')) {
                $this->_view->_error = 'Debe Seleccionar la Categoria del Socio';
                $this->_view->renderizar('nuevo', 'socios', 'nuevo_socio');
                exit;
            }*/

            if (!$this->getTexto('departamento_soc')) {
                $this->_view->_error = 'Debe Seleccionar un Departamento';
                $this->_view->renderizar('nuevo', 'socios', 'nuevo_socio');
                exit;
            }

            if (!$this->getFloat('sueldo_soc')) {
                $this->_view->_error = 'Debe Introducir el Sueldo';
                $this->_view->renderizar('nuevo', 'socios', 'nuevo_socio');
                exit;
            }

            if (!$this->getInt('aporte_patrono_soc')) {
                $this->_view->_error = 'Debe Introducir el Porcentaje del Aporte Patrono';
                $this->_view->renderizar('nuevo', 'socios', 'nuevo_socio');
                exit;
            }

            if (!$this->getInt('aporte_socio_soc')) {
                $this->_view->_error = 'Debe Introducir el Porcentaje del Aporte Socio';
                $this->_view->renderizar('nuevo', 'socios', 'nuevo_socio');
                exit;
            }

            if (!$this->getTexto('banco_soc')) {
                $this->_view->_error = 'Debe Introducir el Banco';
                $this->_view->renderizar('nuevo', 'socios', 'nuevo_socio');
                exit;
            }

            if (!$this->getTexto('tipo_cuenta_soc')) {
                $this->_view->_error = 'Debe Seleccionar el Tipo de Cuenta';
                $this->_view->renderizar('nuevo', 'socios', 'nuevo_socio');
                exit;
            }

            if (!$this->getTexto('numero_cuenta_soc')) {
                $this->_view->_error = 'Debe Introducir el N&uacute;mero de Cuenta';
                $this->_view->renderizar('nuevo', 'socios', 'nuevo_socio');
                exit;
            }

            $this->_modelo->insertarDatos(
                    $this->getPostParam('codigo_soc'),
                    $this->getPostParam('cedula_rif_soc'),
                    ucwords($this->getPostParam('apellidos_soc')),
                    ucwords($this->getPostParam('nombres_soc')),
                    $this->getPostParam('telefono_soc'),
                    $this->getPostParam('telefono2_soc'),
                    $this->getPostParam('direccion_soc'),
                    $this->getPostParam('tipo_soc'),
                    $this->getPostParam('categoria_soc'),
                    $this->getPostParam('departamento_soc'),
                    $this->getPostParam('sueldo_soc'),
                    $this->getPostParam('aporte_patrono_soc'),
                    $this->getPostParam('aporte_socio_soc'),
                    ucwords($this->getPostParam('banco_soc')),
                    $this->getPostParam('tipo_cuenta_soc'),
                    $this->getPostParam('numero_cuenta_soc')
                    );
            echo "<script>alert('Registro Satisfactoriamente...')</script>";
            $this->redireccionar2('socio/index', 0.1);
        }
        $this->_view->renderizar('nuevo', 'socios', 'nuevo_socio');
    }

    public function codigo() {
        $this->_view->titulo = 'Asignaci&oacute;n de C&oacute;digo al Socio';
        $this->_view->resultado = false;
        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;

            if (!$this->getTexto('codigo_soc')) {
                $this->_view->_error = 'Debe Introducir el C&oacute;digo del Socio';
                $this->_view->renderizar('codigo', 'socios', 'codigo_socio');
                exit;
            }

            $codigo = $this->_modelo->getCodigo($this->getPostParam('codigo_soc'));
            if (!$codigo) {
                $this->_view->_error = 'No se encontro un socio con el C&oacute;digo ' . $this->getPostParam('codigo_soc') . ' en la Base de Datos';
                $this->_view->renderizar('codigo', 'socios', 'codigo_socio');
                exit;
            }

            $this->_view->resultado = $codigo;
            $this->_view->renderizar('codigo', 'socios', 'codigo_socio');
        }
        $this->_view->renderizar('codigo', 'socios', 'codigo_socio');
    }

    public function cambiarCodigo() {
        $id = $this->getInt('id');
        $codigo = $this->_modelo->getOne($id);
        if (!$codigo) {
            echo "<script>alert('El socio no es Encuentra en la Base de Datos...')</script>";
            $this->redireccionar2('socio/codigo', 0.1);
        }

        if ($codigo['codigo_soc'] == $this->getPostParam('codigo_nuevo')) {
            echo "<script>alert('El Codigo Actual del Socio y el Codigo Nuevo son los mismo, por favor ingrese uno diferente')</script>";
            $this->redireccionar2('socio/codigo', 0.1);
        }

        $codigo2 = $this->_modelo->getCodigo($this->getPostParam('codigo_nuevo'));
        if ($codigo2 && $codigo2['id_soc'] != $id) {
            echo "<script>alert('El Nuevo Codigo ya esta asignado a un Socio en la Base de Datos, Por Favor prueba con otro...')</script>";
            $this->redireccionar2('socio/codigo', 0.1);
        }

        $this->_modelo->cambiarCodigo($id, $this->getPostParam('codigo_nuevo'));
        echo "<script>alert('El Nuevo Codigo ha sido asignado al Socio Satisfactoriamente...')</script>";
        $this->redireccionar2('socio/index', 0.1);
    }

    public function editar($id) {
        $this->_view->titulo = 'Editar Socio';
        $this->_view->departamentos = $this->_mDepartamento->getAll();
        $this->_view->categorias = $this->_mCategoria->getAll();

        if (!$this->filtrarInt($id)) {
            $this->redireccionar('socio/index');
        }

        if ($this->_modelo->getOne($id)){
            $this->_view->datos = $this->_modelo->getOne($id);
        } else {
            $this->redireccionar('socio/index');
        }

        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;

            if (!$this->getTexto('cedula_rif_soc')) {
                $this->_view->_error = 'Debe Introducir la C&eacute;dula del Socio';
                $this->_view->renderizar('editar', 'socios', 'listar_socios');
                exit;
            }
            
            if (!$this->getTexto('apellidos_soc')) {
                $this->_view->_error = 'Debe Introducir los Apellidos';
                $this->_view->renderizar('editar', 'socios', 'listar_socios');
                exit;
            }

            if (!$this->getTexto('nombres_soc')) {
                $this->_view->_error = 'Debe Introducir los Nombres';
                $this->_view->renderizar('editar', 'socios', 'listar_socios');
                exit;
            }

            if (!$this->getTexto('telefono_soc')) {
                $this->_view->_error = 'Debe Introducir el Tel&eacute;fono';
                $this->_view->renderizar('editar', 'socios', 'listar_socios');
                exit;
            }

            /*if (!$this->getTexto('telefono2_soc')) {
                $this->_view->_error = 'Debe Introducir Otro Tel&eacute;fono';
                $this->_view->renderizar('editar', 'socios', 'listar_socios');
                exit;
            }*/

            /*if (!$this->getTexto('direccion_soc')) {
                $this->_view->_error = 'Debe Introducir la Direcci&oacute;n';
                $this->_view->renderizar('editar', 'socios', 'listar_socios');
                exit;
            }*/

            if (!$this->getTexto('tipo_soc')) {
                $this->_view->_error = 'Debe Seleccionar el Tipo de Socio';
                $this->_view->renderizar('editar', 'socios', 'listar_socios');
                exit;
            }

            /*if (!$this->getTexto('categoria_soc')) {
                $this->_view->_error = 'Debe Seleccionar al Categoria del Socio';
                $this->_view->renderizar('editar', 'socios', 'listar_socios');
                exit;
            }*/

            if (!$this->getTexto('departamento_soc')) {
                $this->_view->_error = 'Debe Seleccionar un Departamento';
                $this->_view->renderizar('editar', 'socios', 'listar_socios');
                exit;
            }

            if (!$this->getFloat('sueldo_soc')) {
                $this->_view->_error = 'Debe Introducir el Sueldo';
                $this->_view->renderizar('editar', 'socios', 'listar_socios');
                exit;
            }

            if (!$this->getInt('aporte_patrono_soc')) {
                $this->_view->_error = 'Debe Introducir el Porcentaje del Aporte Patrono';
                $this->_view->renderizar('editar', 'socios', 'listar_socios');
                exit;
            }

            if (!$this->getInt('aporte_socio_soc')) {
                $this->_view->_error = 'Debe Introducir el Porcentaje del Aporte Socio';
                $this->_view->renderizar('editar', 'socios', 'listar_socios');
                exit;
            }

            if (!$this->getTexto('banco_soc')) {
                $this->_view->_error = 'Debe Introducir el Banco';
                $this->_view->renderizar('editar', 'socios', 'listar_socios');
                exit;
            }

            if (!$this->getTexto('tipo_cuenta_soc')) {
                $this->_view->_error = 'Debe Seleccionar el Tipo de Cuenta';
                $this->_view->renderizar('editar', 'socios', 'listar_socios');
                exit;
            }

            if (!$this->getTexto('numero_cuenta_soc')) {
                $this->_view->_error = 'Debe Introducir el N&uacute;mero de Cuenta';
                $this->_view->renderizar('editar', 'socios', 'listar_socios');
                exit;
            }

            $this->_modelo->editarDatos(
                    $id,
                    $this->getPostParam('cedula_rif_soc'),
                    ucwords($this->getPostParam('apellidos_soc')),
                    ucwords($this->getPostParam('nombres_soc')),
                    $this->getPostParam('telefono_soc'),
                    $this->getPostParam('telefono2_soc'),
                    $this->getPostParam('direccion_soc'),
                    $this->getPostParam('tipo_soc'),
                    $this->getPostParam('categoria_soc'),
                    $this->getPostParam('departamento_soc'),
                    $this->getPostParam('sueldo_soc'),
                    $this->getPostParam('aporte_patrono_soc'),
                    $this->getPostParam('aporte_socio_soc'),
                    ucwords($this->getPostParam('banco_soc')),
                    $this->getPostParam('tipo_cuenta_soc'),
                    $this->getPostParam('numero_cuenta_soc')
                    );
            echo "<script>alert('Actualizado satisfactoriamente...')</script>";
            $this->redireccionar2('socio/index', 0.1);
        }
        $this->_view->renderizar('editar', 'socios', 'listar_socios');
    }

    public function consultar($id) {
        $this->_view->departamentos = $this->_mDepartamento->getAll();
        $this->_view->titulo = 'Consultar Socio';
        
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('socio/index');
        }

        if ($this->_modelo->getOne($id)){
            $this->_view->datos = $this->_modelo->getOne($id);
            $ahorros = $this->_mMovimiento->getAhorros($id, 'Aceptado');
            $patrono = 0;
            $socio = 0;
            $voluntario = 0;
            $_patrono = 0;
            $_socio = 0;
            $_voluntario = 0;
            foreach ($ahorros AS $mov) {
                if ($mov['tipo_mov'] == 'Deposito - Patrono') {
                    $patrono = $patrono + $mov['monto_mov'];
                } elseif ($mov['tipo_mov'] == 'Deposito - Socio') {
                    $socio = $socio + $mov['monto_mov'];
                } elseif ($mov['tipo_mov'] == 'Deposito - Voluntario') {
                    $voluntario = $voluntario + $mov['monto_mov'];
                } elseif ($mov['tipo_mov'] == 'Retiro - Patrono') {
                    $_patrono = $_patrono + $mov['monto_mov'];
                } elseif ($mov['tipo_mov'] == 'Retiro - Socio') {
                    $_socio = $_socio + $mov['monto_mov'];
                } elseif ($mov['tipo_mov'] == 'Retiro - Voluntario') {
                    $_voluntario = $_voluntario + $mov['monto_mov'];
                }
            }
            $total_ahorros = $patrono + $socio + $voluntario;
            $total_retiros = $_patrono + $_socio + $_voluntario;
            $total = ($patrono + $socio + $voluntario) - ($_patrono + $_socio + $_voluntario);
            $total_disponible = $total * 0.80;
            $this->_view->ahorros = array("ahorros_patrono" => $patrono, "ahorros_socio" => $socio, "ahorros_voluntarios" => $voluntario, "retiros_patrono" => $_patrono, "retiros_socio" => $_socio, "retiros_voluntarios" => $_voluntario, "total_ahorros" => $total_ahorros, "total_retiros" => $total_retiros, "total" => $total, "total_disponible" => $total_disponible);
        } else {
            $this->redireccionar('socio/index');
        }

        $this->_view->renderizar('consulta', 'socios', 'listar_socios');
    }

    public function elimina($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('socio/index');
        }

        if ($this->_modelo->getOne($id)) {
            $this->_modelo->drop($id);
        }

        $this->redireccionar('socio/index');
    }

    public function requisitos() {
        $this->_view->titulo = 'Requisitos de Inscripcion';
        $this->_view->renderizar('requisitos', 'requisitos');
    }
}
