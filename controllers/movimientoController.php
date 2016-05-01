<?php

class movimientoController extends Controller {
    private $_modelo;
    private $_mBanco;
    private $_mDepartamento;
    private $_mSocio;
    private $_mPrestamo;
    
    public function __construct() {
        parent::__construct();
        if (!Session::get('autenticado')) {
            $this->redireccionar();
        }
        $this->_modelo = $this->loadModel('movimiento');
        $this->_mBanco = $this->loadModel('banco');
        $this->_mDepartamento = $this->loadModel('departamento');
        $this->_mSocio = $this->loadModel('socio');
        $this->_mPrestamo = $this->loadModel('prestamo');
    }

    public function index() {
        $this->_view->titulo = 'Listar Movimientos';
        $this->_view->datos = $this->_modelo->getAll();
        $this->_view->setJs(array('dynamic_table_movimiento'));
        $this->_view->renderizar('index', 'ahorros', 'listar_ahorros');
    }

    public function nuevo_retiro() {
        $this->_view->titulo = 'Retiros de Ahorros';
        $this->_view->bancos = $this->_mBanco->getAll();

        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;

            if (!$this->getTexto('socio_mov')) {
                $this->_view->_error = 'Debe Introducir la C&eacute;dula o RIF del Socio';
                $this->_view->renderizar('nuevo_retiro', 'ahorros', 'nuevo_retiro');
                exit;
            }

            $socio = $this->_modelo->getSocio($this->getPostParam('socio_mov'));
            if ($socio['cant'] == 0) {
                $this->_view->_error = 'Socio no encontrado en la Base de Datos';
                $this->_view->renderizar('nuevo_retiro', 'ahorros', 'nuevo_retiro');
                exit;
            }
            
            if (!$this->getTexto('referencia_mov')) {
                $this->_view->_error = 'Debe Introducir la Referencia';
                $this->_view->renderizar('nuevo_retiro', 'ahorros', 'nuevo_retiro');
                exit;
            }

            if (!$this->getTexto('fecha_mov')) {
                $this->_view->_error = 'Debe Introducir la Fecha';
                $this->_view->renderizar('nuevo_retiro', 'ahorros', 'nuevo_retiro');
                exit;
            }

            if (!$this->getTexto('tipo_retiro')) {
                $this->_view->_error = 'Debe Seleccionar el Tipo de Retiro';
                $this->_view->renderizar('nuevo_retiro', 'ahorros', 'nuevo_retiro');
                exit;
            }

            if (!$this->getTexto('forma_mov')) {
                $this->_view->_error = 'Debe Seleccionar la Forma del Retiro';
                $this->_view->renderizar('nuevo_retiro', 'ahorros', 'nuevo_retiro');
                exit;
            }

            if (!$this->getFloat('monto_mov')) {
                $this->_view->_error = 'Debe Introducir el Monto';
                $this->_view->renderizar('nuevo_retiro', 'ahorros', 'nuevo_retiro');
                exit;
            }

            if (!$this->getTexto('banco_mov')) {
                $this->_view->_error = 'Debe Seleccionar un Banco';
                $this->_view->renderizar('nuevo_retiro', 'ahorros', 'nuevo_retiro');
            }
                
            $monto_banco = $this->_mBanco->getOne($this->getInt('banco_mov'));
            if ($this->getFloat('monto_mov') > $monto_banco['monto_ban']) {
                $this->_view->_error = 'El monto a retirar es mayor al disponible en la cuenta bancaria seleccionada: ' . $monto_banco['nombre_ban'] . ', Saldo Disponible: ' . $this->_view->Dinero($monto_banco['monto_ban']);
                $this->_view->renderizar('nuevo_retiro', 'ahorros', 'nuevo_retiro');
                exit;
            }

            if (!$this->getTexto('estado_mov')) {
                $this->_view->_error = 'Debe Seleccionar el Estado del Retiro';
                $this->_view->renderizar('nuevo_retiro', 'ahorros', 'nuevo_retiro');
                exit;
            }

            $this->_modelo->insertarDatos(
                $socio['id_soc'],
                $this->getPostParam('referencia_mov'),
                $this->getPostParam('fecha_mov'),
                'Retiro - ' . $this->getPostParam('tipo_retiro'),
                $this->getPostParam('forma_mov'),
                $this->getPostParam('monto_mov'),
                $this->getPostParam('nota_mov'),
                $this->getPostParam('banco_mov'),
                $this->getPostParam('estado_mov')
            );

            if ($this->getTexto('estado_mov') == 'Aceptado') {
                $this->_mBanco->restarActivos($this->getInt('banco_mov'), $this->getFloat('monto_mov'));
            }

            echo "<script>alert('Registro Satisfactoriamente...')</script>";
            $this->redireccionar2('movimiento/index', 0.1);
        }
        $this->_view->renderizar('nuevo_retiro', 'ahorros', 'nuevo_retiro');
    }

    public function actualizarPagosGeneral() {
        $this->_view->titulo = 'Actualizacion de Ahorros en General';
        $this->_view->departamentos = $this->_mDepartamento->getAll('Activo');
        if ($this->getInt('guardar') == 1) {
            $this->_view->form = $_POST;
            if (!$this->getTexto('tipo_actualizacion')) {
                $this->_view->_error = 'Debe Seleccionar el Tipo de Actualizacion';
                $this->_view->renderizar('actualizar2', 'ahorros', 'actualizarGeneral');
                exit;
            }

            if (!$this->getTexto('fecha')) {
                $this->_view->_error = 'Debe Introducir la Fecha';
                $this->_view->renderizar('actualizar2', 'ahorros', 'actualizarGeneral');
                exit;
            }

            if ($this->getInt('departamento') != '') {
                $this->_view->datos = $this->_mSocio->getSociosDepartamento($this->getInt('departamento'));
            } else {
                $this->_view->datos = $this->_mSocio->getAll();
            }

            $this->_view->resultados = true;
            $this->_view->tipo = $this->getPostParam('tipo_actualizacion');
            $this->_view->fecha = $this->getPostParam('fecha');
            $this->_view->renderizar('actualizar2', 'ahorros', 'actualizarGeneral');
        }
        $this->_view->renderizar('actualizar2', 'ahorros', 'actualizarGeneral');
    }

    public function actualizarPagosIndividual() {
        $this->_view->titulo = 'Actualizacion de Ahorros Individual';
        if ($this->getInt('guardar') == 1) {
            $this->_view->form = $_POST;
            if (!$this->getTexto('tipo_actualizacion')) {
                $this->_view->_error = 'Debe Seleccionar el Tipo de Actualizacion';
                $this->_view->renderizar('actualizar', 'ahorros', 'actualizarIndividual');
                exit;
            }

            if (!$this->getTexto('individual')) {
                $this->_view->_error = 'Debe Introducir la C&eacute;dula del Socio';
                $this->_view->renderizar('actualizar', 'ahorros', 'actualizarIndividual');
                exit;
            }

            if (!$this->getTexto('fecha')) {
                $this->_view->_error = 'Debe Introducir la Fecha';
                $this->_view->renderizar('actualizar', 'ahorros', 'actualizarIndividual');
                exit;
            }

            $this->_view->datos = $this->_mSocio->getCedulaAportes($this->getTexto('individual'));
            $this->_view->resultados = true;
            $this->_view->tipo = $this->getPostParam('tipo_actualizacion');
            $this->_view->fecha = $this->getPostParam('fecha');
            $this->_view->renderizar('actualizar', 'ahorros', 'actualizarIndividual');
        }
        $this->_view->renderizar('actualizar', 'ahorros', 'actualizarIndividual');
    }

    public function registrarActualizacion() {
        for ($i = 1; $i <= $this->getInt('contador'); $i++) {
            $socio = $this->_modelo->getSocio($this->getPostParam($i));
            if ($this->getPostParam('tipo') == 'Patrono') {
                $this->_modelo->insertarDatos(
                        $socio['id_soc'],
                        time(),
                        $this->getPostParam('fecha'),
                        'Deposito - Patrono',
                        'Nomina',
                        $this->getPostParam('aporte_patrono_' . $i),
                        'Movimiento realizado automaticamente',
                        1,
                        'Aceptado'
                        );
                $this->_mBanco->sumarActivos(1, $this->getPostParam('aporte_patrono_' . $i));
            } elseif ($this->getPostParam('tipo') == 'Socio') {
                $this->_modelo->insertarDatos(
                        $socio['id_soc'],
                        time(),
                        $this->getPostParam('fecha'),
                        'Deposito - Socio',
                        'Nomina',
                        $this->getPostParam('aporte_socio_' . $i),
                        'Movimiento realizado automaticamente',
                        1,
                        'Aceptado'
                        );
                $this->_mBanco->sumarActivos(1, $this->getPostParam('aporte_socio_' . $i));
            } else {
                $this->_modelo->insertarDatos(
                        $socio['id_soc'],
                        time(),
                        $this->getPostParam('fecha'),
                        'Deposito - Patrono',
                        'Nomina',
                        $this->getPostParam('aporte_patrono_' . $i),
                        'Movimiento realizado automaticamente',
                        1,
                        'Aceptado'
                        );
                $this->_modelo->insertarDatos(
                        $socio['id_soc'],
                        time(),
                        $this->getPostParam('fecha'),
                        'Deposito - Socio',
                        'Nomina',
                        $this->getPostParam('aporte_socio_' . $i),
                        'Movimiento realizado automaticamente',
                        1,
                        'Aceptado'
                        );
                $this->_mBanco->sumarActivos(1, $this->getPostParam('aporte_patrono_' . $i));
                $this->_mBanco->sumarActivos(1, $this->getPostParam('aporte_socio_' . $i));
            }
        }
        echo "<script>alert('Registro Satisfactoriamente...')</script>";
        $this->redireccionar2('movimiento/index', 0.1);
    }

    public function consulta_individual() {
        $this->_view->titulo = 'Consulta Individual de Ahorros';
        $this->_view->resultado = false;
        if ($this->getInt('guardar') == 1){
            $this->_view->datos = $_POST;
            if (!$this->getTexto('cedula_rif_soc')) {
                $this->_view->_error = 'Debe Introducir la C&eacute;dula del Socio';
                $this->_view->renderizar('consulta_individual', 'ahorros', 'ahorros_individual');
                exit;
            }

            $cedula = $this->_mSocio->getCedula($this->getPostParam('cedula_rif_soc'));
            if (!$cedula['cant']) {
                $this->_view->_error = 'C&eacute;dula no encontrada en la Base de Datos';
                $this->_view->renderizar('consulta_individual', 'ahorros', 'ahorros_individual');
                exit;
            }

            $ahorros = $this->_modelo->getAhorros($cedula['id_soc'], 'Aceptado');
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
            $total_disponible = $total * (DISPONIBILIDAD);
            $this->_view->ahorros = array("ahorros_patrono" => $patrono, "ahorros_socio" => $socio, "ahorros_voluntarios" => $voluntario, "retiros_patrono" => $_patrono, "retiros_socio" => $_socio, "retiros_voluntarios" => $_voluntario, "total_ahorros" => $total_ahorros, "total_retiros" => $total_retiros, "total" => $total, "total_disponible" => $total_disponible);
            $ahorros = $this->record_sort($ahorros, "fecha_mov", true);
            $this->_view->detalles = $ahorros;
            $this->_view->resultado = true;
            $this->_view->renderizar('consulta_individual', 'ahorros', 'ahorros_individual');
        }

        $this->_view->renderizar('consulta_individual', 'ahorros', 'ahorros_individual');
    }

    public function consulta($id) {
        $this->_view->titulo = 'Consultar Movimiento';

        if (!$this->filtrarInt($id)) {
            $this->redireccionar('movimiento/index');
        }

        if ($this->_modelo->getOne($id)){
            $this->_view->datos = $this->_modelo->getOne($id);
        } else {
            $this->redireccionar('movimiento/index');
        }

        $this->_view->renderizar('consulta', 'ahorros', 'listar_ahorros');
    }

    public function editar($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('movimiento/index');
        }

        if ($this->_modelo->getOne($id)){
            $this->_view->datos = $this->_modelo->getOne($id);
        } else {
            $this->redireccionar('movimiento/index');
        }

        $this->_view->titulo = 'Editar Movimiento';
        $this->_view->bancos = $this->_mBanco->getAll();

        if ($this->getInt('guardar') == 1) {
            if (!$this->getTexto('referencia_mov')) {
                $this->_view->_error = 'Debe Introducir la Referencia';
                $this->_view->renderizar('editar', 'ahorros', 'listar_ahorros');
                exit;
            }

            if (!$this->getTexto('fecha_mov')) {
                $this->_view->_error = 'Debe Introducir la Fecha';
                $this->_view->renderizar('editar', 'ahorros', 'listar_ahorros');
                exit;
            }

            if (!$this->getTexto('tipo_mov')) {
                $this->_view->_error = 'Debe Seleccionar el Tipo de Movimiento';
                $this->_view->renderizar('editar', 'ahorros', 'listar_ahorros');
                exit;
            }

            if (!$this->getTexto('forma_mov')) {
                $this->_view->_error = 'Debe Seleccionar la Forma del Movimiento';
                $this->_view->renderizar('editar', 'ahorros', 'listar_ahorros');
                exit;
            }

            if (!$this->getFloat('monto_mov')) {
                $this->_view->_error = 'Debe Introducir el Monto';
                $this->_view->renderizar('editar', 'ahorros', 'listar_ahorros');
                exit;
            }
            $em = explode(' - ', $this->getTexto('tipo_mov'));
            $monto_banco = $this->_mBanco->getOne($this->getInt('banco_mov'));
            if ($this->getFloat('monto_mov') > $monto_mov['monto_ban'] && $em[0] == 'Retiro') {
                $this->_view->_error = 'El monto a retirar es mayor al disponible en la cuenta del banco: ' . $monto_banco['nombre_ban'];
                $this->_view->renderizar('editar', 'ahorros', 'listar_ahorros');
                exit;
            }

            if (!$this->getTexto('nota_mov')) {
                $this->_view->_error = 'Debe Introducir la Nota';
                $this->_view->renderizar('editar', 'ahorros', 'listar_ahorros');
                exit;
            }

            if (!$this->getTexto('banco_mov')) {
                $this->_view->_error = 'Debe Seleccionar un Banco';
                $this->_view->renderizar('editar', 'ahorros', 'listar_ahorros');
            }

            if (!$this->getTexto('estado_mov')) {
                $this->_view->_error = 'Debe Seleccionar el Estado del Movimiento';
                $this->_view->renderizar('editar', 'ahorros', 'listar_ahorros');
                exit;
            }

            $this->_modelo->editarDatos(
                    $id,
                    $this->getPostParam('referencia_mov'),
                    $this->getPostParam('fecha_mov'),
                    $this->getPostParam('tipo_mov'),
                    $this->getPostParam('forma_mov'),
                    $this->getPostParam('monto_mov'),
                    $this->getPostParam('nota_mov'),
                    $this->getPostParam('banco_mov'),
                    $this->getPostParam('estado_mov')
                    );

            if ($em[0] == 'Retiro' && $this->getTexto('estado_mov') == 'Aceptado') {
                $this->_mBanco->restarActivos($this->getInt('banco_mov'), $this->getFloat('monto_mov'));
                $this->redireccionar('movimiento/index');
            } elseif ($em[0] == 'Deposito' && $this->getTexto('estado_mov') == 'Aceptado') {
                $this->_mBanco->sumarActivos($this->getInt('banco_mov'), $this->getFloat('monto_mov'));
                $this->redireccionar('movimiento/index');
            }
            
            $this->redireccionar('movimiento/index');
        }
        $this->_view->renderizar('editar', 'ahorros', 'listar_ahorros');
    }

    public function elimina($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('movimiento/index');
        }

        if ($this->_modelo->getOne($id)) {
            $this->_modelo->drop($id);
        }

        $this->redireccionar('movimiento/index');
    }

    public function getSocio() {
        $rsocio = $this->_modelo->getSocio($this->getPostParam('cedula'));
        if ($rsocio['cant'] == 0) {
            echo json_encode('');
            return 0;
        }
        $ahorros = $this->_modelo->getAhorros($rsocio['id_soc'], 'Aceptado');
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
        $array['ahorro_patrono'] = $this->_view->Dinero($patrono);
        $array['ahorro_socio'] = $this->_view->Dinero($socio);
        $array['ahorro_voluntario'] = $this->_view->Dinero($voluntario);
        $array['total_ahorros'] = $this->_view->Dinero($patrono + $socio + $voluntario);
        $array['retiro_patrono'] = $this->_view->Dinero($_patrono);
        $array['retiro_socio'] = $this->_view->Dinero($_socio);
        $array['retiro_voluntario'] = $this->_view->Dinero($_voluntario);
        $array['retiro_total'] = $this->_view->Dinero($_patrono + $_socio + $_voluntario);
        $array['total_haberes'] = $this->_view->Dinero(($patrono - $_patrono) + ($socio - $_socio) + ($voluntario - $_voluntario));
        $array['total_disponible'] = $this->_view->Dinero((($patrono - $_patrono) + ($socio - $_socio) + ($voluntario - $_voluntario)) * 0.80);
        $array['socio'] = $rsocio['apellidos_soc'] . ' ' . $rsocio['nombres_soc'];
        echo json_encode($array);
    }
}
