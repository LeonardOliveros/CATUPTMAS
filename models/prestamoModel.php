<?php

class prestamoModel extends Model
{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getAll() {
        $var = $this->_db->query("SELECT p.*, s.*, SUM(pp.monto_capital_pag_pre) AS total_capital, SUM(pp.monto_interes_pag_pre) AS total_interes, SUM(pp.monto_total_pag_pre) AS total_pagado, pp.fecha_pag_pre FROM prestamos AS p INNER JOIN socios AS s ON p.socio_pre = s.id_soc LEFT JOIN pagos_prestamo AS pp ON p.id_pre = pp.prestamo_pag_pre GROUP BY p.id_pre");
        return $var->fetchall();
    }

    public function getCuotas($id, $estado = '') {
        $var = $this->_db->query("SELECT * FROM cuotas_prestamos WHERE prestamo_cuo_pre = $id AND estado_cuo_pre LIKE '%$estado%' ORDER BY fecha_cuo_pre");
        return $var->fetchall();
    }

    public function getCuotas2($id, $estado) {
        $var = $this->_db->query("SELECT * FROM cuotas_prestamos WHERE prestamo_cuo_pre = $id AND estado_cuo_pre != '$estado' ORDER BY fecha_cuo_pre");
        return $var->fetchall();
    }

    public function getCuotasPorVencer($date) {
        $var = $this->_db->query("SELECT * FROM cuotas_prestamos INNER JOIN prestamos ON prestamos.id_pre = cuotas_prestamos.prestamo_cuo_pre INNER JOIN socios ON socios.id_soc = prestamos.socio_pre WHERE cuotas_prestamos.estado_cuo_pre = 'Pendiente' AND cuotas_prestamos.fecha_cuo_pre >= '$date' AND cuotas_prestamos.fecha_cuo_pre < ADDDATE('$date', INTERVAL 1 MONTH) ORDER BY cuotas_prestamos.fecha_cuo_pre");
        return $var->fetchall();
    }

    public function getVencidas() {
        $var = $this->_db->query("SELECT * FROM cuotas_prestamos INNER JOIN prestamos ON prestamos.id_pre = cuotas_prestamos.prestamo_cuo_pre INNER JOIN socios ON socios.id_soc = prestamos.socio_pre WHERE cuotas_prestamos.estado_cuo_pre = 'Vencida'");
        return $var->fetchall();
    }

    public function getCuotasVencidas($date) {
        $var = $this->_db->query("SELECT * FROM cuotas_prestamos INNER JOIN prestamos ON prestamos.id_pre = cuotas_prestamos.prestamo_cuo_pre INNER JOIN socios ON socios.id_soc = prestamos.socio_pre WHERE cuotas_prestamos.estado_cuo_pre = 'Pendiente' AND cuotas_prestamos.fecha_cuo_pre < '$date'");
        return $var->fetchall();
    }

    public function cambiarEstadoCuota($id, $estado) {
        $this->_db->query("UPDATE cuotas_prestamos SET estado_cuo_pre = '$estado' WHERE id_cuo_pre = $id");
    }

    public function cambiarEstadoCuotaTodas($prestamo, $estado) {
        $this->_db->query("UPDATE cuotas_prestamos SET estado_cuo_pre = '$estado' WHERE prestamo_cuo_pre = $prestamo");
    }

    public function getOne($id) {
        $var = $this->_db->query("SELECT p.*, s.*, SUM(pp.monto_capital_pag_pre) AS total_capital, SUM(pp.monto_interes_pag_pre) AS total_interes, SUM(pp.monto_total_pag_pre) AS total_pagado, pp.fecha_pag_pre FROM prestamos AS p INNER JOIN socios AS s ON p.socio_pre = s.id_soc LEFT JOIN pagos_prestamo AS pp ON p.id_pre = pp.prestamo_pag_pre WHERE p.id_pre = $id GROUP BY p.id_pre");
        return $var->fetch();
    }

    public function getCodigo($codigo) {
        $var = $this->_db->query("SELECT p.*, s.*, SUM(pp.monto_capital_pag_pre) AS total_capital, SUM(pp.monto_interes_pag_pre) AS total_interes, SUM(pp.monto_total_pag_pre) AS total_pagado, pp.fecha_pag_pre FROM prestamos AS p INNER JOIN socios AS s ON p.socio_pre = s.id_soc LEFT JOIN pagos_prestamo AS pp ON p.id_pre = pp.prestamo_pag_pre WHERE p.codigo_pre = '$codigo' GROUP BY p.id_pre");
        return $var->fetch();
    }
    
    public function insertarDatos($socio, $monto, $plazo, $interes, $fecha_solicitud, $fecha_aprobacion, $fecha_primer_pago, $tipo_prestamo, $estado) {
        $this->_db->query("INSERT INTO prestamos VALUES(NULL, '', '$socio', $monto, $plazo, $interes, '$fecha_solicitud', '$fecha_aprobacion', '$fecha_primer_pago', '$tipo_prestamo', '$estado')");
    }

    public function insertarCuota($prestamo, $numero, $fecha, $cuota, $amortizacion, $interes, $saldoPrestamo, $total4, $total5, $total3, $total2, $total1, $estado) {
        $this->_db->query("INSERT INTO cuotas_prestamos VALUES(NULL, $prestamo, $numero, '$fecha', $cuota, $amortizacion, $interes, $saldoPrestamo, $total4, $total5, $total3, $total2, $total1, '$estado')");
    }

    public function getUlt() {
        $var = $this->_db->query("SELECT MAX(id_pre) AS id FROM prestamos");
        return $var->fetch();
    }

    public function insertarPago($movimiento, $prestamo, $capital, $interes, $total, $fecha) {
        $this->_db->query("INSERT INTO pagos_prestamo VALUES(NULL, '$movimiento', '$prestamo', $capital, $interes, $total, '$fecha')");
    }
    
    public function editarDatos($id, $fecha_aprobacion, $fecha_primer_pago, $estado) {
        $this->_db->query("UPDATE prestamos SET fecha_aprobacion_pre = '$fecha_aprobacion', fecha_primer_pago_pre = '$fecha_primer_pago', estado_pre = '$estado' WHERE id_pre = $id");
    }

    public function cambiarEstado($id, $estado, $codigo = false, $fecha = false, $fecha2 = false) {
        if ($codigo != false && $fecha != false && $fecha2 != false) {
            $this->_db->query("UPDATE prestamos SET codigo_pre = '$codigo', estado_pre = '$estado', fecha_aprobacion_pre = '$fecha', fecha_primer_pago_pre = '$fecha2' WHERE id_pre = $id");
        } else {
            $this->_db->query("UPDATE prestamos SET estado_pre = '$estado' WHERE id_pre = $id");
        }
    }

    public function getPrestamoSoc($socio, $estado = 'Activo') {
        $var = $this->_db->query("SELECT COUNT(*) AS cant, prestamos.* FROM prestamos WHERE socio_pre = '$socio' AND estado_pre = '$estado'");
        return $var->fetch();
    }

    public function getPrestamosSoc($socio, $estado = 'Activo') {
        $var = $this->_db->query("SELECT p.*, s.*, SUM(pp.monto_capital_pag_pre) AS total_pagado FROM prestamos AS p INNER JOIN socios AS s ON p.socio_pre = s.id_soc LEFT JOIN pagos_prestamo AS pp ON p.id_pre = pp.prestamo_pag_pre WHERE socio_pre = '$socio' AND estado_pre = '$estado' GROUP BY p.id_pre");
        return $var->fetchall();
    }

    public function getPagosPrestamo($prestamo) {
        $var = $this->_db->query("SELECT p.*, pp.*, m.* FROM prestamos AS p INNER JOIN pagos_prestamo AS pp ON p.id_pre = pp.prestamo_pag_pre INNER JOIN movimientos AS m ON m.id_mov = pp.movimiento_pag_pre WHERE p.id_pre = $prestamo");
        return $var->fetchall();
    }

    public function getSumarPagosPrestamo($prestamo) {
        $var = $this->_db->query("SELECT p.*, pp.*, SUM(pp.monto_total_pag_pre) AS total_pago, p.monto_pre - SUM(pp.monto_total_pag_pre) AS total_deuda FROM prestamos AS p INNER JOIN pagos_prestamo AS pp ON p.id_pre = pp.prestamo_pag_pre WHERE p.id_pre = $prestamo GROUP BY p.id_pre");
        return $var->fetch();
    }

    public function drop($id) {
        $this->_db->query("DELETE FROM prestamos WHERE id_soc = '$id'");
    }
}
