<?php

class reporteController extends Controller {

    private $_modelo;
    private $_mBanco;
    private $_mDepartamento;
    private $_mEvento;
    private $_mMovimiento;
    private $_mPrestamo;
    private $_mSocio;
    public static $titulo;
    public static $socio;
    public static $fechas;
    public static $datos;
    public static $view;

    public function __construct() {
        parent::__construct();
        if (!Session::get('autenticado')) {
            $this->redireccionar('login/index');
        }
        $this->getLibrary('tcpdf/tcpdf');
        $this->pdf = new TCPDF("P", "mm", "Letter", true, 'UTF-8', false);  
        $this->pdf->SetDisplayMode('real', 'default');
        $this->_modelo = $this->loadModel('reporte');
        $this->_mBanco = $this->loadModel('banco');
        $this->_mDepartamento = $this->loadModel('departamento');
        $this->_mEvento = $this->loadModel('evento');
        $this->_mMovimiento = $this->loadModel('movimiento');
        $this->_mPrestamo = $this->loadModel('prestamo');
        $this->_mSocio = $this->loadModel('socio');
    }

    public function index() {
        $this->redireccionar();
    }

    public function estadisticas() {
        $this->_view->titulo = 'Estadisticas';
        $this->_view->resultado = false;
        $this->_view->setJs(array('loader', 'jsapi'));
        if ($this->getInt('guardar') == 1) {
            $this->_view->resultado = true;
            if ($this->getTexto('plazo') == '') {
                $this->_view->graficaPlazo = true;
                $listadoPlazo = $this->_modelo->getPrestamosGraficas(
                        $this->getTexto('plazo'),
                        $this->getTexto('fecha_solicitud_desde'),
                        $this->getTexto('fecha_solicitud_hasta'),
                        $this->getTexto('fecha_aprobacion_desde'),
                        $this->getTexto('fecha_aprobacion_hasta'),
                        $this->getTexto('fecha_primer_pago_desde'),
                        $this->getTexto('fecha_primer_pago_hasta'),
                        $this->getTexto('tipo_prestamo'),
                        $this->getTexto('estado'),
                        'GROUP BY p.plazo_pre'
                        );
                $this->_view->listadoPlazo = $listadoPlazo;
            }
            if ($this->getTexto('tipo_prestamo') == '') {
                $this->_view->graficaTipo = true;
                $listadoTipo = $this->_modelo->getPrestamosGraficas(
                        $this->getTexto('plazo'),
                        $this->getTexto('fecha_solicitud_desde'),
                        $this->getTexto('fecha_solicitud_hasta'),
                        $this->getTexto('fecha_aprobacion_desde'),
                        $this->getTexto('fecha_aprobacion_hasta'),
                        $this->getTexto('fecha_primer_pago_desde'),
                        $this->getTexto('fecha_primer_pago_hasta'),
                        $this->getTexto('tipo_prestamo'),
                        $this->getTexto('estado'),
                        'GROUP BY p.tipo_prestamo_pre'
                        );
                $this->_view->listadoTipo = $listadoTipo;
            }
            if ($this->getTexto('ao') == 'Si') {
                $this->_view->graficaAo = true;
                $listadoAo = $this->_modelo->getPrestamosAo(
                        $this->getTexto('plazo'),
                        $this->getTexto('fecha_solicitud_desde'),
                        $this->getTexto('fecha_solicitud_hasta'),
                        $this->getTexto('fecha_aprobacion_desde'),
                        $this->getTexto('fecha_aprobacion_hasta'),
                        $this->getTexto('fecha_primer_pago_desde'),
                        $this->getTexto('fecha_primer_pago_hasta'),
                        $this->getTexto('tipo_prestamo'),
                        $this->getTexto('estado'),
                        "GROUP BY YEAR(" . $this->getTexto('ao_fecha') . ")",
                        "YEAR(" . $this->getTexto('ao_fecha') . ") AS ao, "
                        );
                $this->_view->listadoAo = $listadoAo;
            }
            $listadoGeneral = $this->_modelo->getPrestamosGraficas(
                    $this->getTexto('plazo'),
                    $this->getTexto('fecha_solicitud_desde'),
                    $this->getTexto('fecha_solicitud_hasta'),
                    $this->getTexto('fecha_aprobacion_desde'),
                    $this->getTexto('fecha_aprobacion_hasta'),
                    $this->getTexto('fecha_primer_pago_desde'),
                    $this->getTexto('fecha_primer_pago_hasta'),
                    $this->getTexto('tipo_prestamo'),
                    $this->getTexto('estado'),
                    'GROUP BY p.estado_pre',
                    true
                    );
            $this->_view->listadoGeneral = $listadoGeneral;
            $this->_view->datos = $_POST;
            $this->_view->renderizar('graficas', 'reporte');
        }
        $this->_view->renderizar('graficas', 'estadisticas', 'prestamos');
    }

    public function capital() {
        $this->_view->titulo = 'Estadisticas';
        $this->_view->resultado = false;
        $this->_view->setJs(array('loader', 'jsapi'));
        if ($this->getInt('guardar') == 1) {
            $this->_view->resultado = true;
            $this->_view->datos = $_POST;
            $listadoTipo = $this->_modelo->getMovimientosGrafica(
                    $this->getTexto('cedula'),
                    $this->getTexto('fecha_desde'),
                    $this->getTexto('fecha_hasta'),
                    $this->getTexto('forma'),
                    $this->getTexto('banco'),
                    $this->getTexto('estado'),
                    'GROUP BY m.tipo_mov'
                    );
            $this->_view->listadoTipo = $listadoTipo;
            $this->_view->renderizar('capital', 'reportes', 'capital');
        }
        $this->_view->renderizar('capital', 'estadisticas', 'capital');
    }

    public function socios() {
        $this->_view->titulo = 'Buscar Socios';
        $this->_view->resultado = false;
        $this->_view->departamentos = $this->_mDepartamento->getAll();
        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;
            $view = $this->_view;
            switch ($this->getTexto('salida')) {
                case 'PDF':
                    static::$titulo = 'Listado de Socios';
                    $listado = $this->_modelo->getSocios(
                        $this->getTexto('cedula'),
                        $this->getTexto('apellido'),
                        $this->getTexto('nombre'),
                        $this->getTexto('departamento'),
                        $this->getTexto('banco'),
                        $this->getTexto('tipo_cuenta'),
                        $this->getTexto('estado')
                        );
                    require_once ROOT . 'views' . DS . 'reporte' . DS . 'reporte_socios.php';
                    break;
                case 'Listar':
                    $listado = $this->_modelo->getSocios(
                        $this->getTexto('cedula'),
                        $this->getTexto('apellido'),
                        $this->getTexto('nombre'),
                        $this->getTexto('departamento'),
                        $this->getTexto('banco'),
                        $this->getTexto('tipo_cuenta'),
                        $this->getTexto('estado')
                        );
                    $this->_view->titulo = 'Resultados de la Busqueda';
                    $this->_view->resultado = true;
                    $this->_view->listado = $listado;
                    $this->_view->renderizar('socios', 'reportes', 'socios');
                    break;
                case 'Individual':
                    static::$titulo = 'Datos del Socio';
                    if (!$this->getTexto('cedula')){
                        $this->_view->_error = 'Debe Introducir la C&eacute;dula';
                        $this->_view->renderizar('socios', 'reportes', 'socios');
                        exit;
                    }
                    $datos = $this->_modelo->getSocio($this->getTexto('cedula'));
                    $ahorros = $this->_mMovimiento->getAhorros($datos['id_soc'], 'Aceptado');
                    $prestamos = $this->_modelo->getPrestamosSocio($datos['id_soc']);
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
                    $ahorro_patrono = $patrono - $_patrono;
                    $ahorro_socio = $socio - $_socio;
                    $ahorro_voluntario = $voluntario - $_voluntario;
                    $total = $ahorro_patrono + $ahorro_socio + $ahorro_voluntario;
                    $total_disponible = $total * 0.80;
                    $ahorros = array("ahorros_patrono" => $ahorro_patrono, "ahorros_socio" => $ahorro_socio, "ahorros_voluntarios" => $ahorro_voluntario, "total_ahorros" => $total, "total_disponible" => $total_disponible);
                    require_once ROOT . 'views' . DS . 'reporte' . DS . 'reporte_socio.php';
                    break;
             }
        }
        $this->_view->renderizar('socios', 'reportes', 'socios');
    }

    public function prestamos() {
        $this->_view->titulo = 'Buscar Prestamos';
        $this->_view->resultado = false;
        $this->_view->departamentos = $this->_mDepartamento->getAll();
        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;
            $view = $this->_view;
            switch ($this->getTexto('salida')) {
                case 'PDF':
                    static::$titulo = 'Listado de Prestamos';
                    $listado = $this->_modelo->getPrestamos(
                        $this->getTexto('cedula'),
                        $this->getTexto('plazo'),
                        $this->getTexto('interes'),
                        $this->getTexto('fecha_solicitud'),
                        $this->getTexto('fecha_aprobacion'),
                        $this->getTexto('fecha_primer_pago'),
                        $this->getTexto('tipo_prestamo'),
                        $this->getTexto('estado')
                        );
                    require_once ROOT . 'views' . DS . 'reporte' . DS . 'reporte_prestamos.php';
                    break;
                case 'Listar':
                    $listado = $this->_modelo->getPrestamos(
                        $this->getTexto('cedula'),
                        $this->getTexto('plazo'),
                        $this->getTexto('interes'),
                        $this->getTexto('fecha_solicitud'),
                        $this->getTexto('fecha_aprobacion'),
                        $this->getTexto('fecha_primer_pago'),
                        $this->getTexto('tipo_prestamo'),
                        $this->getTexto('estado')
                        );
                    $this->_view->titulo = 'Resultados de la Busqueda';
                    $this->_view->resultado = true;
                    $this->_view->listado = $listado;
                    $this->_view->renderizar('prestamos', 'reportes', 'prestamos');
                    break;
                case 'Individual':
                    static::$titulo = 'Datos del Prestamo';
                    if (!$this->getTexto('cedula')){
                        $this->_view->_error = 'Debe Introducir la C&eacute;dula';
                        $this->_view->renderizar('prestamos', 'reportes', 'prestamos');
                        exit;
                    }
                    $listado = $this->_modelo->getPrestamos(
                        $this->getTexto('cedula'),
                        $this->getTexto('plazo'),
                        $this->getTexto('interes'),
                        $this->getTexto('fecha_solicitud'),
                        $this->getTexto('fecha_aprobacion'),
                        $this->getTexto('fecha_primer_pago'),
                        $this->getTexto('tipo_prestamo'),
                        $this->getTexto('estado')
                        );
                    $this->_view->titulo = 'Resultados de la Busqueda';
                    $this->_view->resultado = true;
                    $this->_view->listado = $listado;
                    $this->_view->renderizar('prestamos', 'reportes', 'prestamos');
                    break;
             }
        }
        $this->_view->renderizar('prestamos', 'reportes', 'prestamos');
    }

    public function prestamo($id) {
        $datos = $this->_modelo->getPrestamo($id);
        $cuotas = $this->_mPrestamo->getCuotas($id);
        $pagos = $this->_mPrestamo->getPagosPrestamo($id);
        $view = $this->_view;
        require_once ROOT . 'views' . DS . 'reporte' . DS . 'reporte_prestamo.php';
    }

    public function movimientos() {
        $this->_view->titulo = 'Buscar Movimientos';
        $this->_view->bancos = $this->_mBanco->getAll();
        $this->_view->resultado = false;
        if ($this->getInt('guardar') == 1) {
            $view = $this->_view;
            switch ($this->getTexto('salida')) {
                case 'PDF':
                    static::$titulo = 'Listado de Movimientos';
                    $listado = $this->_modelo->getMovimientosSoc(
                        $this->getTexto('cedula'),
                        $this->getTexto('referencia'),
                        $this->getTexto('fecha'),
                        $this->getTexto('tipo'),
                        $this->getTexto('forma'),
                        $this->getTexto('banco'),
                        $this->getTexto('estado')
                        );
                    require_once ROOT . 'views' . DS . 'reporte' . DS . 'reporte_movimientos.php';
                    break;
                case 'Listar':
                    $listado = $this->_modelo->getMovimientosSoc(
                        $this->getTexto('cedula'),
                        $this->getTexto('referencia'),
                        $this->getTexto('fecha'),
                        $this->getTexto('tipo'),
                        $this->getTexto('forma'),
                        $this->getTexto('banco'),
                        $this->getTexto('estado')
                        );
                    $this->_view->titulo = 'Resultados de la Busqueda';
                    $this->_view->resultado = true;
                    $this->_view->listado = $listado;
                    $this->_view->renderizar('movimientos', 'reportes', 'movimientos');
                    break;
             }
        }
        $this->_view->renderizar('movimientos', 'reportes', 'movimientos');
    }

    public function estado_cuenta() {
        $this->_view->titulo = 'Reporte Estado de Cuenta';
        $this->_view->bancos = $this->_mBanco->getAll();
        if ($this->getInt('guardar') == 1) {
            $view = $this->_view;
            switch ($this->getTexto('salida')) {
                case 'Caja de Ahorro':
                    if (!$this->getTexto('fecha')) {
                        $this->_view->_error = 'Debe Introducir la Fecha Desde';
                        $this->_view->renderizar('estado_cuenta', 'reportes', 'estado_cuenta');
                        exit;
                    }
                    if (!$this->getTexto('fecha2')) {
                        $this->_view->_error = 'Debe Introducir la Fecha Hasta';
                        $this->_view->renderizar('estado_cuenta', 'reportes', 'estado_cuenta');
                        exit;
                    }
                    if ($this->getTexto('fecha') == $this->getTexto('fecha2')) {
                        $this->_view->_error = 'Las fechas deben ser diferentes de una de otra';
                        $this->_view->renderizar('estado_cuenta', 'reportes', 'estado_cuenta');
                        exit;
                    }
                    if (time($this->getTexto('fecha')) > time($this->getTexto('fecha2'))) {
                        $this->_view->_error = 'La fecha desde es mayor a la fecha hasta';
                        $this->_view->renderizar('estado_cuenta', 'reportes', 'estado_cuenta');
                        exit;
                    }
                    if (time($this->getTexto('fecha2')) < time($this->getTexto('fecha'))) {
                        $this->_view->_error = 'La fecha hasta es menor a la fecha desde';
                        $this->_view->renderizar('estado_cuenta', 'reportes', 'estado_cuenta');
                        exit;
                    }
                    static::$titulo = 'Estado de Cuenta';
                    static::$fechas = 'Desde: ' . $this->_view->Fecha($this->getTexto('fecha')) . ' Hasta: ' . $this->_view->Fecha($this->getTexto('fecha2'));
                    $listado = $this->_modelo->getEstadoCuenta(
                        $this->getTexto('cedula'),
                        $this->getTexto('fecha'),
                        $this->getTexto('fecha2'),
                        $this->getTexto('tipo'),
                        $this->getTexto('forma'),
                        $this->getTexto('banco'),
                        $this->getTexto('estado')
                        );
                    require_once ROOT . 'views' . DS . 'reporte' . DS . 'reporte_estado_cuenta2.php';
                    break;
                case 'Socio':
                    if (!$this->getTexto('cedula')) {
                        $this->_view->_error = 'Debe Introducir la C&eacute;dula';
                        $this->_view->renderizar('estado_cuenta', 'reportes', 'estado_cuenta');
                        exit;
                    }
                    if (!$this->getTexto('fecha')) {
                        $this->_view->_error = 'Debe Introducir la Fecha Desde';
                        $this->_view->renderizar('estado_cuenta', 'reportes', 'estado_cuenta');
                        exit;
                    }
                    if (!$this->getTexto('fecha2')) {
                        $this->_view->_error = 'Debe Introducir la Fecha Hasta';
                        $this->_view->renderizar('estado_cuenta', 'reportes', 'estado_cuenta');
                        exit;
                    }
                    if ($this->getTexto('fecha') == $this->getTexto('fecha2')) {
                        $this->_view->_error = 'Las fechas deben ser diferentes de una de otra';
                        $this->_view->renderizar('estado_cuenta', 'reportes', 'estado_cuenta');
                        exit;
                    }
                    if (time($this->getTexto('fecha')) > time($this->getTexto('fecha2'))) {
                        $this->_view->_error = 'La fecha desde es mayor a la fecha hasta';
                        $this->_view->renderizar('estado_cuenta', 'reportes', 'estado_cuenta');
                        exit;
                    }
                    if (time($this->getTexto('fecha2')) < time($this->getTexto('fecha'))) {
                        $this->_view->_error = 'La fecha hasta es menor a la fecha desde';
                        $this->_view->renderizar('estado_cuenta', 'reportes', 'estado_cuenta');
                        exit;
                    }
                    $socio = $this->_mSocio->getCedula($this->getTexto('cedula'));
                    static::$socio = $this->_view->Cedula($socio['cedula_rif_soc']) . ' - ' . $socio['apellidos_soc'] . ' ' . $socio['nombres_soc'];
                    static::$titulo = 'Estado de Cuenta del Socio: ';
                    static::$fechas = 'Desde: ' . $this->_view->Fecha($this->getTexto('fecha')) . ' Hasta: ' . $this->_view->Fecha($this->getTexto('fecha2'));
                    $listado = $this->_modelo->getEstadoCuenta(
                        $this->getTexto('cedula'),
                        $this->getTexto('fecha'),
                        $this->getTexto('fecha2'),
                        $this->getTexto('tipo'),
                        $this->getTexto('forma'),
                        $this->getTexto('banco'),
                        $this->getTexto('estado')
                        );
                    require_once ROOT . 'views' . DS . 'reporte' . DS . 'reporte_estado_cuenta.php';
                    break;
             }
        }
        $this->_view->renderizar('estado_cuenta', 'reportes', 'estado_cuenta');
    }

    public function deudores() {
        $view = $this->_view;
        static::$titulo = 'Listado de Deudores';
        $listado = $this->_modelo->getDeudores();
        require_once ROOT . 'views' . DS . 'reporte' . DS . 'deudores.php';
    }
}
