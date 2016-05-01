<?php

class indexController extends Controller {

    private $_mEvento;
    private $_mPrestamo;

    public function __construct() {
        parent::__construct();
        $this->_mEvento =$this->loadModel('evento');
        $this->_mPrestamo =$this->loadModel('prestamo');
        $vencidas = $this->_mPrestamo->getCuotasVencidas(date('Y-m-d'));
        if (isset($vencidas) && count($vencidas)) {
            foreach ($vencidas as $v) {
                $this->_mPrestamo->cambiarEstadoCuota($v['id_cuo_pre'], 'Vencida');
            }
        }
        $eventos = $this->_mEvento->getEventosVencidos(date('Y-m-d'));
        if (isset($eventos) && count($eventos)) {
            foreach ($eventos as $e) {
                $this->_mEvento->cambiarEstadoEvento($e['id_eve'], 'Inactivo');
            }
        }
        if (!Session::get('autenticado')) {
            $this->redireccionar('login/index');
        }
    }

    public function index() {
        $this->_view->titulo = 'Inicio';
        $this->_view->eventos = $this->_mEvento->getAll2('Activo');
        $this->_view->vencerse = $this->_mPrestamo->getCuotasPorVencer(date('Y-m-d'));
        $array_cpv = [];
        $array_cv = [];
        $array_e = [];
        $this->_view->total_vencerse = 0;
        $this->_view->total_vencidas = 0;
        Session::destroy('Vencerse');
        Session::destroy('Vencidas');
        Session::destroy('Eventos');
        Session::destroy('CantidadNoti');
        if (isset($this->_view->vencerse) && count($this->_view->vencerse)) {
            foreach ($this->_view->vencerse as $v) {
                $this->_view->total_vencerse = $this->_view->total_vencerse + $v['cuota_cuo_pre'];
                array_push($array_cpv, ['cedula' => $v['cedula_rif_soc'], 'nombres' => $v['apellidos_soc'] . ' ' . $v['nombres_soc'], 'fecha' => $v['fecha_cuo_pre'], 'cuota' => $v['cuota_cuo_pre']]);
            }
            Session::set('Vencerse', $array_cpv);
            Session::set('CantidadNoti', count($array_cpv));
        }
        $this->_view->vencidas = $this->_mPrestamo->getVencidas();
        if (isset($this->_view->vencidas) && count($this->_view->vencidas)) {
            foreach ($this->_view->vencidas as $c) {
                $this->_view->total_vencidas = $this->_view->total_vencidas + $c['cuota_cuo_pre'];
                array_push($array_cv, ['cedula' => $c['cedula_rif_soc'], 'nombres' => $c['apellidos_soc'] . ' ' . $c['nombres_soc'], 'fecha' => $c['fecha_cuo_pre'], 'cuota' => $c['cuota_cuo_pre']]);
            }
            Session::set('Vencidas', $array_cv);
            Session::set('CantidadNoti', Session::get('CantidadNoti') + count($array_cv));
        }
        if (isset($this->_view->eventos) && count($this->_view->eventos)) {
            foreach ($this->_view->eventos as $e) {
                array_push($array_e, ['nombre' => $e['nombre_eve'], 'fecha_inicio' => $e['fecha_inicio_eve'], 'fecha_fin' => $e['fecha_fin_eve'], 'descripcion' => $e['descripcion_eve'], 'estado' => $e['estado_eve']]);
            }
            Session::set('Eventos', $array_e);
            Session::set('CantidadNoti', Session::get('CantidadNoti') + count($array_e));
        }
        $this->_view->renderizar('index', 'inicio');
    }

    public function creditos () {
        $this->_view->titulo = 'Creditos';
        $this->_view->renderizar('creditos', 'utilidades', 'creditos');
    }
}
