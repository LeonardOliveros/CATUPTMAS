<?php

class prestamoController extends Controller {
    
    private $_modelo;
    private $_mSocio;
    private $_mTiposPrestamos;
    private $_mPlazosPrestamos;
    private $_mBancos;
    private $_mMovimiento;

    public function __construct() {
        parent::__construct();
        if (!Session::get('autenticado')) {
            $this->redireccionar();
        }
        $this->_modelo = $this->loadModel('prestamo');
        $this->_mSocio = $this->loadModel('socio');
        $this->_mTiposPrestamos = $this->loadModel('tipos_prestamos');
        $this->_mPlazosPrestamos = $this->loadModel('plazos_prestamos');
        $this->_mBancos = $this->loadModel('banco');
        $this->_mMovimiento = $this->loadModel('movimiento');
    }

    public function index() {
        $this->_view->titulo = 'Listar Prestamos';
        $this->_view->datos = $this->_modelo->getAll();
        $this->_view->setJs(array('dynamic_table_prestamo'));
        $this->_view->renderizar('index', 'prestamos', 'listar_prestamos');
    }

    public function solicitud() {
        $this->_view->titulo = 'Solicitud de Pr&eacute;stamo';
        $this->_view->tipos_prestamos = $this->_mTiposPrestamos->getAll();
        $this->_view->plazos_prestamos = $this->_mPlazosPrestamos->getAll();

        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;

            if (!$this->getTexto('socio_pre')) {
                $this->_view->_error = 'Debe Introducir la C&eacute;dula o RIF del Socio';
                $this->_view->renderizar('solicitud', 'prestamos', 'solicitud_prestamo');
                exit;
            }

            $socio = $this->_mSocio->getCedula($this->getPostParam('socio_pre'));
            if ($socio['cant'] == 0) {
                $this->_view->_error = 'C&eacute;dula del Socio no encontrada en la Base de Datos';
                $this->_view->renderizar('solicitud', 'prestamos', 'solicitud_prestamo');
                exit;
            }

            $presoc = $this->_modelo->getPrestamoSoc($socio['id_soc']);
            if ($presoc['cant'] > 0) {
                $this->_view->_error = 'El Socio presenta un Pr&eacute;stamo activo en la Base de Datos';
                $this->_view->renderizar('solicitud', 'prestamos', 'solicitud_prestamo');
                exit;
            }
            
            if (!$this->getFloat('monto_pre')) {
                $this->_view->_error = 'Debe Introducir el Monto del Pr&eacute;stamo';
                $this->_view->renderizar('solicitud', 'prestamos', 'solicitud_prestamo');
                exit;
            }

            if (!$this->getInt('plazo_pre')) {
                $this->_view->_error = 'Debe Seleccionar el Plazo del Pr&eacute;stamo';
                $this->_view->renderizar('solicitud', 'prestamos', 'solicitud_prestamo');
                exit;
            }

            if (!$this->getInt('tipo_prestamo_pre')) {
                $this->_view->_error = 'Debe Seleccionar el Tipo de Pr&eacute;stamo';
                $this->_view->renderizar('solicitud', 'prestamos', 'solicitud_prestamo');
                exit;
            }

            if (!$this->getTexto('fecha_solicitud_pre')) {
                $this->_view->_error = 'Debe Introducir la Fecha de Solicitud del Pr&eacute;stamo';
                $this->_view->renderizar('solicitud', 'prestamos', 'solicitud_prestamo');
                exit;
            }

            if ($this->validarFecha($this->getTexto('fecha_solicitud_pre'))) {
                $this->_view->_error = 'La Fecha de Solicitud del Pr&eacute;stamo es superior a la fecha actual </br>' . date('d-m-Y');
                $this->_view->renderizar('solicitud', 'prestamos', 'solicitud_prestamo');
                exit;
            }
            
            $tp = $this->_mTiposPrestamos->getOne($this->getPostParam('tipo_prestamo_pre'));
            $pp = $this->_mPlazosPrestamos->getOne($this->getPostParam('plazo_pre'));
            $this->_modelo->insertarDatos(
                    $socio['id_soc'],
                    $this->getPostParam('monto_pre'),
                    $pp['meses_pla_pre'],
                    $tp['interes_tip_pre'],
                    $this->getPostParam('fecha_solicitud_pre'),
                    '0000-00-00',
                    '0000-00-00',
                    $tp['nombre_tip_pre'],
                    'En Proceso'
                    );
            echo "<script>alert('Registro Satisfactoriamente...')</script>";
            $this->redireccionar2('prestamo/index', 0.1);
        }
        $this->_view->renderizar('solicitud', 'prestamos', 'solicitud_prestamo');
    }

    public function otorgamiento() {
        $this->_view->titulo = 'Otorgamiento del Pr&eacute;stamo';
        $this->_view->resultado = false;
        $this->_view->setJs(array('dynamic_table_prestamo'));

        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;

            if (!$this->getTexto('socio_pre')) {
                $this->_view->_error = 'Debe Introducir la C&eacute;dula o RIF del Socio';
                $this->_view->renderizar('otorgamiento', 'prestamos', 'otorgamiento_prestamo');
                exit;
            }

            $socio = $this->_mSocio->getCedula($this->getPostParam('socio_pre'));
            if ($socio['cant'] == 0) {
                $this->_view->_error = 'C&eacute;dula del Socio no encontrada en la Base de Datos';
                $this->_view->renderizar('otorgamiento', 'prestamos', 'otorgamiento_prestamo');
                exit;
            }

            $presoc = $this->_modelo->getPrestamosSoc($socio['id_soc'], 'En Proceso');
            if (count($presoc) == 0) {
                $this->_view->_error = 'El Socio no presenta Pr&eacute;stamos por Otorgar en la Base de Datos';
                $this->_view->renderizar('otorgamiento', 'prestamos', 'otorgamiento_prestamo');
                exit;
            }

            $this->_view->prestamos = $presoc;
            $this->_view->resultado = true;
            $this->_view->renderizar('otorgamiento', 'prestamos', 'otorgamiento_prestamo');
        }
        $this->_view->renderizar('otorgamiento', 'prestamos', 'otorgamiento_prestamo');
    }

    public function cambiarEstado () {
        if ($this->getPostParam('fecha_aprobacion_pre') != '0000-00-00') {
            $fecha = $this->getPostParam('fecha_aprobacion_pre');
        } else {
            $fecha = '0000-00-00';
        }

        if ($this->getPostParam('fecha_primer_pago_pre') != '0000-00-00') {
            $fecha2 = $this->getPostParam('fecha_primer_pago_pre');
        } else {
            $fecha2 = '0000-00-00';
        }
        $this->_modelo->cambiarEstado($this->getInt('id_prestamo'), $this->getPostParam('estado_pre'), $this->getPostParam('codigo_pre'), $fecha, $fecha2);
        if ($this->getPostParam('estado_pre') == 'Activo') {
            $id = $this->_modelo->getOne($this->getInt('id_prestamo'));
            $prestamo = $id['monto_pre'];
            $prestamo2 = $id['monto_pre'];
            $interes = $id['interes_pre'] / 100;
            $c = 1 + $interes;
            $a = pow($c, $id['plazo_pre']);
            $a2 = $interes * $a;
            $b = $a - 1;
            $cuota = $prestamo * ($a2 / $b);
            $total1 = 0;//Total Pagado
            $total2 = 0;//Total Intereses Pagados
            $total3 = 0;//Total Capital Pagado
            $total4 = 0;//Total Restante Intereses
            $total5 = 0;//Total Restante Prestamo
            $total6 = 0;//Total Absoluto de Intereses
            $arreglo_fechas = [];
            //Calcular Interes Total
            for ($j = 1; $j <= $id['plazo_pre']; $j++) {
              $interesCalc2 = $prestamo2 * $interes;
              $amortizacion2 = $cuota - $interesCalc2;    
              $saldoPrestamo2 = $prestamo2 - $amortizacion2;
              $prestamo2 = $saldoPrestamo2;
              $total4 = $total4 + $interesCalc2;
              $total6 = $total6 + $cuota;
            }
            for ($i = 1; $i <= $id['plazo_pre']; $i++) {  
                $interesCalc = $prestamo * $interes;
                $amortizacion = $cuota - $interesCalc;    
                $saldoPrestamo = $prestamo - $amortizacion;
                $mes = $i;
                $siguiente_fecha = strtotime( '+' . $mes . ' month' , strtotime($id['fecha_primer_pago_pre']));
                $siguiente_fecha = date( 'Y-m-d' , $siguiente_fecha);
                array_push($arreglo_fechas, $siguiente_fecha);
                $prestamo = $saldoPrestamo;
                $total1 = $total1 + $cuota;
                $total2 = $total2 + $interesCalc;
                $total3 = $total3 + $amortizacion;
                $total4 = $total4 - $interesCalc;
                $total5 = $total6 - $total1;

                $this->_modelo->insertarCuota(
                        $id['id_pre'],
                        $i,
                        $siguiente_fecha,
                        round($cuota, 2),
                        round($amortizacion, 2),
                        round($interesCalc, 2),
                        round($saldoPrestamo, 2),
                        round($total4, 2),
                        round($total5, 2),
                        round($total3, 2),
                        round($total2, 2),
                        round($total1, 2),
                        'Pendiente'
                        );
            }
            echo "<script>alert('El Prestamo ha sido Otorgado Satisfactoriamente...')</script>";
            $this->redireccionar2('prestamo/index', 0.1);
        }
        echo "<script>alert('El Prestamo ha sido Rechazado...')</script>";
        $this->redireccionar2('prestamo/index', 0.1);
    }

    public function consulta_amortizacion($id = false) {
        $this->_view->titulo = 'Consulta de Amortizacion';
        $this->_view->resultado = false;
        $this->_view->resultado2 = false;

        if ($id) {
            if ($this->_modelo->getOne($this->filtrarInt($id))) {
                $this->_view->cuotas = $this->_modelo->getCuotas($this->filtrarInt($id));
                $this->_view->resultado = false;
                $this->_view->resultado2 = true;
            }
        }

        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;

            if (!$this->getTexto('socio_pre')) {
                $this->_view->_error = 'Debe Introducir la C&eacute;dula o RIF del Socio';
                $this->_view->renderizar('consulta_amortizacion', 'prestamos', 'consulta_amortizacion');
                exit;
            }

            $socio = $this->_mSocio->getCedula($this->getPostParam('socio_pre'));
            if ($socio['cant'] == 0) {
                $this->_view->_error = 'C&eacute;dula del Socio no encontrada en la Base de Datos';
                $this->_view->renderizar('consulta_amortizacion', 'prestamos', 'consulta_amortizacion');
                exit;
            }

            $presoc = $this->_modelo->getPrestamosSoc($socio['id_soc'], 'Activo');
            if (count($presoc) == 0) {
                $this->_view->_error = 'El Socio no presenta Pr&eacute;stamos Activos en la Base de Datos';
                $this->_view->renderizar('consulta_amortizacion', 'prestamos', 'consulta_amortizacion');
                exit;
            }
            
            $this->_view->prestamos = $presoc;
            $this->_view->resultado = true;
            $this->_view->resultado2 = false;
            $this->_view->renderizar('consulta_amortizacion', 'prestamos', 'consulta_amortizacion');
        }
        $this->_view->renderizar('consulta_amortizacion', 'prestamos', 'consulta_amortizacion');
    }

    public function cancelacion() {
        $this->_view->titulo = 'Cancelaci&oacute;n de Pr&eacute;stamos';
        $this->_view->setJs(array('dynamic_table_prestamo'));
        $this->_view->resultado = false;
        $this->_view->resultado2 = false;
        $this->_view->bancos = $this->_mBancos->getAll();

        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;

            if (!$this->getTexto('socio_pre')) {
                $this->_view->_error = 'Debe Introducir la C&eacute;dula o RIF del Socio';
                $this->_view->renderizar('cancelacion', 'prestamos', 'cancelacion_prestamo');
                exit;
            }

            $socio = $this->_mSocio->getCedula($this->getPostParam('socio_pre'));
            if ($socio['cant'] == 0) {
                $this->_view->_error = 'C&eacute;dula del Socio no encontrada en la Base de Datos';
                $this->_view->renderizar('cancelacion', 'prestamos', 'cancelacion_prestamo');
                exit;
            }

            $presoc = $this->_modelo->getPrestamosSoc($socio['id_soc'], 'Activo');
            if (count($presoc) == 0) {
                $this->_view->_error = 'El Socio no presenta Pr&eacute;stamos Activos en la Base de Datos';
                $this->_view->renderizar('cancelacion', 'prestamos', 'cancelacion_prestamo');
                exit;
            }
            
            $this->_view->prestamos = $presoc;
            $this->_view->resultado = true;
            $this->_view->resultado2 = true;
            $this->_view->renderizar('cancelacion', 'prestamos', 'cancelacion_prestamo');
        }
        $this->_view->renderizar('cancelacion', 'prestamos', 'cancelacion_prestamo');
    }

    public function cancelarPrestamo() {
        $id = $this->getInt('id_prestamo');
        $pre = $this->_modelo->getOne($id);
        $monto = $this->getPostParam('capital_amortizar') + $this->getPostParam('interes_amortizar');
        $this->_mMovimiento->insertarDatos(
            $pre['socio_pre'],
            $this->getPostParam('referencia'),
            $this->getPostParam('fecha_cancelacion'),
            'Pago Prestamo',
            $this->getPostParam('forma'),
            $monto,
            'Cancelacion Total del Prestamo',
            $this->getPostParam('banco'),
            'Aceptado'
            );
        $movimiento = $this->_mMovimiento->getUlt();
        $this->_modelo->insertarPago(
            $movimiento['id'],
            $id,
            $this->getPostParam('capital_amortizar'),
            $this->getPostParam('interes_amortizar'),
            $monto,
            $this->getPostParam('fecha_cancelacion')
            );
        $this->_modelo->cambiarEstadoCuotaTodas($id, 'Pagada');
        $this->_modelo->cambiarEstado($id, 'Finalizado');
        echo "<script>alert('El Prestamo ha sido Cancelado Totalmente Satisfactoriamente...')</script>";
        $this->redireccionar2('prestamo/index', 0.1);
    }

    public function calcularAmortizaciones() {
        $this->_view->titulo = 'Calcular Amortizaciones';
        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;
            
            if (!$this->getFloat('monto_pre')) {
                $this->_view->_error = 'Debe Introducir el Monto del Pr&eacute;stamo';
                $this->_view->renderizar('calcular', 'prestamos', 'calcular');
                exit;
            }

            if (!$this->getTexto('plazo_pre')) {
                $this->_view->_error = 'Debe Seleccionar el Plazo del Pr&eacute;stamo';
                $this->_view->renderizar('calcular', 'prestamos', 'calcular');
                exit;
            }

            if (!$this->getTexto('interes_pre')) {
                $this->_view->_error = 'Debe Seleccionar la Taza de Inter&eacute;s';
                $this->_view->renderizar('calcular', 'prestamos', 'calcular');
                exit;
            }
            
            if (!$this->getTexto('fecha_primer_pago_pre')) {
                $this->_view->_error = 'Debe Introducir la Fecha del Primer Pago';
                $this->_view->renderizar('calcular', 'prestamos', 'calcular');
                exit;
            }
            $this->_view->resultado = true;
            $this->_view->renderizar('calcular', 'prestamos', 'calcular');
        }
        $this->_view->renderizar('calcular', 'prestamos', 'calcular');
    }

    public function abonos_parciales() {
        $this->_view->titulo = 'Abonos Parciales del Prestamo';
        $this->_view->bancos = $this->_mBancos->getAll();
        $this->_view->setJs(array('dynamic_table_prestamo'));
        $this->_view->resultado = false;

        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;
            if (!$this->getTexto('socio_pre')) {
                $this->_view->_error = 'Debe Introducir la C&eacute;dula o RIF del Socio';
                $this->_view->renderizar('abonos_parciales', 'prestamos', 'abonos_parciales');
                exit;
            }

            $socio = $this->_mSocio->getCedula($this->getPostParam('socio_pre'));
            if ($socio['cant'] == 0) {
                $this->_view->_error = 'C&eacute;dula del Socio no encontrada en la Base de Datos';
                $this->_view->renderizar('abonos_parciales', 'prestamos', 'abonos_parciales');
                exit;
            }

            $presoc = $this->_modelo->getPrestamosSoc($socio['id_soc'], 'Activo');
            if (count($presoc) == 0) {
                $this->_view->_error = 'El Socio no presenta Pr&eacute;stamos Activos en la Base de Datos';
                $this->_view->renderizar('abonos_parciales', 'prestamos', 'abonos_parciales');
                exit;
            }
            
            $this->_view->resultado = $presoc;
            $this->_view->renderizar('abonos_parciales', 'prestamos', 'abonos_parciales');
        }
        $this->_view->renderizar('abonos_parciales', 'prestamos', 'abonos_parciales');
    }

    public function abonoPrestamo() {
        $id = $this->getInt('id_prestamo');
        $pre = $this->_modelo->getOne($id);
        $monto = $this->getPostParam('capital_amortizar') + $this->getPostParam('interes_amortizar');
        $this->_mMovimiento->insertarDatos(
            $pre['socio_pre'],
            $this->getPostParam('referencia'),
            $this->getPostParam('fecha_abono'),
            'Pago Prestamo',
            $this->getPostParam('forma'),
            $monto,
            'Abono Parcial del Prestamo',
            $this->getPostParam('banco'),
            'Aceptado'
            );
        $movimiento = $this->_mMovimiento->getUlt();
        $this->_modelo->insertarPago(
            $movimiento['id'],
            $id,
            $this->getPostParam('capital_amortizar'),
            $this->getPostParam('interes_amortizar'),
            $monto,
            $this->getPostParam('fecha_abono')
            );
        $restante = $pre['monto_pre'] - $pre['total_capital'];
        $this->_mBancos->sumarActivos($this->getInt('banco'), $monto);
        if ($this->getPostParam('capital_amortizar') == $restante) {
            $this->_modelo->cambiarEstadoCuotaTodas($id, 'Pagada');
            $this->_modelo->cambiarEstado($id, 'Finalizado');
            echo "<script>alert('Abono Registrado Satisfactoriamente, el Prestamo ha sido cancelado en su totalidad...')</script>";
            $this->redireccionar2('prestamo/index', 0.1);
        }
        echo "<script>alert('Abono Registrado Satisfactoriamente...')</script>";
        $this->redireccionar2('prestamo/index', 0.1);
    }

    public function consulta_individual() {
        $this->_view->titulo = 'Consultar Prestamo';

        if ($this->getInt('guardar') == 1) {
            if (!$this->getTexto('codigo_pre')) {
                $this->_view->_error = 'Debe Introducir el C&oacute;digo del Prestamo';
                $this->_view->renderizar('consulta_individual', 'prestamos', 'consulta_individual');
                exit;
            }

            $codigo = $this->_modelo->getCodigo($this->getTexto('codigo_pre'));
            if (!$codigo) {
                $this->_view->_error = 'C&oacute;digo no encontrado en la Base de Datos';
                $this->_view->renderizar('consulta_individual', 'prestamos', 'consulta_individual');
                exit;
            }

            $this->redireccionar('prestamo/consulta/' . $codigo['id_pre']);
        }
        $this->_view->renderizar('consulta_individual', 'prestamos', 'consulta_individual');
    }

    public function consulta($id) {
        $this->_view->titulo = 'Consultar Prestamo';

        if (!$this->filtrarInt($id)) {
            $this->redireccionar('prestamo/index');
        }

        if ($this->_modelo->getOne($id)){
            $this->_view->datos = $this->_modelo->getOne($id);
            $this->_view->cuotas = $this->_modelo->getCuotas($id);
            $this->_view->pagos = $this->_modelo->getPagosPrestamo($id);
        } else {
            $this->redireccionar('prestamo/index');
        }

        $this->_view->renderizar('consulta', 'prestamos', 'listar_prestamos');
    }

    public function editar($id) {
        $this->_view->titulo = 'Editar Prestamo';
        
        if (!$this->filtrarInt($id)) {
            $this->redireccionar('prestamo/index');
        }

        if ($this->_modelo->getOne($id)){
            $this->_view->datos = $this->_modelo->getOne($id);
            $this->_view->cuotas = $this->_modelo->getCuotas($id);
        } else {
            $this->redireccionar('prestamo/index');
        }

        if ($this->getInt('guardar') == 1) {
            if (!$this->getTexto('estado_pre')) {
                $this->_view->_error = 'Debe Seleccionar el Estado del Prestamo';
                $this->_view->renderizar('editar', 'prestamos', 'listar_prestamos');
                exit;
            }

            if ($this->getTexto('estado_pre') == 'Activo') {
                if (!$this->getTexto('fecha_aprobacion_pre')) {
                    $this->_view->_error = 'Debe Introducir la Fecha de Aprovaci&oacute;n';
                    $this->_view->renderizar('editar', 'prestamos', 'listar_prestamos');
                    exit;
                }
                if ($this->validarFecha($this->getTexto('fecha_aprobacion_pre'))) {
                    $this->_view->_error = 'La Fecha de Aprobaci&oacute;n es superior a la fecha actual </br>' . date('d-m-Y');
                    $this->_view->renderizar('editar', 'prestamos', 'listar_prestamos');
                    exit;
                }
                if (!$this->getTexto('fecha_primer_pago_pre')) {
                    $this->_view->_error = 'Debe Introducir la Fecha del Primer Pago';
                    $this->_view->renderizar('editar', 'prestamos', 'listar_prestamos');
                    exit;
                }
                if ($this->validarFecha($this->getTexto('fecha_primer_pago_pre'), false)) {
                    $this->_view->_error = 'La Fecha del Primer Pago es menor a la fecha actual </br>' . date('d-m-Y');
                    $this->_view->renderizar('editar', 'prestamos', 'listar_prestamos');
                    exit;
                }
                $fecha_aprobacion_pre = $this->getPostParam('fecha_aprobacion_pre');
                $fecha_primer_pago_pre = $this->getPostParam('fecha_primer_pago_pre');
            } else {
                $fecha_aprobacion_pre = '0000-00-00';
                $fecha_primer_pago_pre = '0000-00-00';
            }

            $this->_modelo->editarDatos(
                    $id,
                    $fecha_aprobacion_pre,
                    $fecha_primer_pago_pre,
                    $this->getPostParam('estado_pre')
                    );
            $this->redireccionar('prestamo/index');
        }
        $this->_view->renderizar('editar', 'prestamos', 'listar_prestamos');
    }

    public function elimina($id) {
        if (!$this->filtrarInt($id)) {
            $this->redireccionar();
        }

        if ($this->_modelo->getOne($id)) {
            $this->_modelo->drop($id);
        }

        $this->redireccionar('prestamo/index');
    }

     public function getPrestamos() {
        $socio = $this->_mSocio->getCedula($this->getPostParam('cedula'));
        $prestamos = $this->_modelo->getPrestamosSoc($socio['id_soc']);
        if ($prestamos == null) {
            echo json_encode('');
            return 0;
        }
        echo json_encode($prestamos);
    }

    public function getPagos() {
        $pagos = $this->_modelo->getPagosPrestamo($this->getInt('prestamo'));
        if ($pagos == null) {
            echo json_encode('');
            return 0;
        }
        echo json_encode($pagos);
    }

    public function getCuotasPrestamo() {
        $cuotas = $this->_modelo->getCuotas2($this->getInt('prestamo'), 'Pagada');
        if ($cuotas == null) {
            echo json_encode('');
            return 0;
        }
        echo json_encode($cuotas);
    }
}
