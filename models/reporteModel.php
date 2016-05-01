<?php

class reporteModel extends Model
{
    
    public function __construct() {
        parent::__construct();
    }

    public function getPrestamosGraficas($plazo, $fecha_solicitud_desde, $fecha_solicitud_hasta, $fecha_aprobacion_desde, $fecha_aprobacion_hasta, $fecha_primer_pago_desde, $fecha_primer_pago_hasta, $tipo_prestamo, $estado, $agrupar = '', $comparacion = false) {
        if ($fecha_solicitud_hasta != '') {
            $fecha_solicitud = "AND p.fecha_solicitud_pre BETWEEN '$fecha_solicitud_desde' AND '$fecha_solicitud_hasta'";
        } else {
            $fecha_solicitud = "AND p.fecha_solicitud_pre LIKE '%$fecha_solicitud_desde%'";
        }
        if ($fecha_aprobacion_hasta != '') {
            $fecha_aprobacion = "AND p.fecha_solicitud_pre BETWEEN '$fecha_aprobacion_desde' AND '$fecha_aprobacion_hasta'";
        } else {
            $fecha_aprobacion = "AND p.fecha_aprobacion_pre LIKE '%$fecha_aprobacion_desde%'";
        }
        if ($fecha_primer_pago_hasta != '') {
            $fecha_primer_pago = "AND p.fecha_primer_pago_pre BETWEEN '$fecha_primer_pago_desde' AND '$fecha_primer_pago_hasta'";
        } else {
            $fecha_primer_pago = "AND p.fecha_primer_pago_pre LIKE '%$fecha_primer_pago_desde%'";
        }
        if ($comparacion) {
            $var = $this->_db->query("SELECT COUNT(*) AS count, SUM(p.monto_pre) AS monto_pre, SUM(pp.monto_capital_pag_pre) AS abono_capital, SUM(pp.monto_interes_pag_pre) AS abono_interes, (SUM(p.monto_pre) - SUM(pp.monto_capital_pag_pre)) AS monto_restante, SUM(pp.monto_total_pag_pre) AS total_pagado FROM prestamos AS p INNER JOIN socios AS s ON p.socio_pre = s.id_soc LEFT JOIN pagos_prestamo AS pp ON p.id_pre = pp.prestamo_pag_pre WHERE p.plazo_pre LIKE '%$plazo%' $fecha_solicitud $fecha_aprobacion $fecha_primer_pago AND p.tipo_prestamo_pre LIKE '%$tipo_prestamo%' AND p.estado_pre LIKE '%$estado%'");
            return $var->fetch();
        } else {
            $var = $this->_db->query("SELECT COUNT(*) AS count, p.*, SUM(p.monto_pre) AS monto_pre, SUM(pp.monto_total_pag_pre) AS total_pagado FROM prestamos AS p INNER JOIN socios AS s ON p.socio_pre = s.id_soc LEFT JOIN pagos_prestamo AS pp ON p.id_pre = pp.prestamo_pag_pre WHERE p.plazo_pre LIKE '%$plazo%' $fecha_solicitud $fecha_aprobacion $fecha_primer_pago AND p.tipo_prestamo_pre LIKE '%$tipo_prestamo%' AND p.estado_pre LIKE '%$estado%' $agrupar");
            return $var->fetchall();
        }
    }

    public function getPrestamosAo($plazo, $fecha_solicitud_desde, $fecha_solicitud_hasta, $fecha_aprobacion_desde, $fecha_aprobacion_hasta, $fecha_primer_pago_desde, $fecha_primer_pago_hasta, $tipo_prestamo, $estado, $agrupar = '', $ao_fecha = '') {
        if ($fecha_solicitud_hasta != '') {
            $fecha_solicitud = "AND p.fecha_solicitud_pre BETWEEN '$fecha_solicitud_desde' AND '$fecha_solicitud_hasta'";
        } else {
            $fecha_solicitud = "AND p.fecha_solicitud_pre LIKE '%$fecha_solicitud_desde%'";
        }
        if ($fecha_aprobacion_hasta != '') {
            $fecha_aprobacion = "AND p.fecha_solicitud_pre BETWEEN '$fecha_aprobacion_desde' AND '$fecha_aprobacion_hasta'";
        } else {
            $fecha_aprobacion = "AND p.fecha_aprobacion_pre LIKE '%$fecha_aprobacion_desde%'";
        }
        if ($fecha_primer_pago_hasta != '') {
            $fecha_primer_pago = "AND p.fecha_primer_pago_pre BETWEEN '$fecha_primer_pago_desde' AND '$fecha_primer_pago_hasta'";
        } else {
            $fecha_primer_pago = "AND p.fecha_primer_pago_pre LIKE '%$fecha_primer_pago_desde%'";
        }
        $var = $this->_db->query("SELECT $ao_fecha COUNT(*) AS count_prestamo, SUM(p.monto_pre) AS monto_pre, SUM(pp.monto_capital_pag_pre) AS abono_capital, SUM(pp.monto_interes_pag_pre) AS abono_interes, (SUM(p.monto_pre) - SUM(pp.monto_capital_pag_pre)) AS monto_restante, SUM(pp.monto_total_pag_pre) AS total_pagado FROM prestamos AS p INNER JOIN socios AS s ON p.socio_pre = s.id_soc LEFT JOIN pagos_prestamo AS pp ON p.id_pre = pp.prestamo_pag_pre WHERE p.plazo_pre LIKE '%$plazo%' $fecha_solicitud $fecha_aprobacion $fecha_primer_pago AND p.tipo_prestamo_pre LIKE '%$tipo_prestamo%' AND p.estado_pre LIKE '%$estado%' $agrupar");
        return $var->fetchall();
    }

    public function getMovimientosGrafica($cedula, $fecha_desde, $fecha_hasta, $forma, $banco, $estado, $agrupar) {
        if ($cedula != '') {
            $cedula = '';
        } else {
            $cedula ="AND s.cedula_rif_soc LIKE '%$cedula%'";
        }
        if ($fecha_hasta != '') {
            $fecha = "AND m.fecha_mov BETWEEN '$fecha_desde' AND '$fecha_hasta'";
        } else {
            $fecha = "AND m.fecha_mov LIKE '%$fecha_desde%'";
        }
        $var = $this->_db->query("SELECT COUNT(*) AS count, SUM(m.monto_mov) AS monto, m.* FROM movimientos AS m INNER JOIN socios AS s ON m.socio_mov = s.id_soc INNER JOIN bancos AS b ON m.banco_mov = b.id_ban WHERE m.forma_mov LIKE '%$forma%' $cedula AND b.id_ban LIKE '%$banco%' AND m.estado_mov LIKE '%$estado%' $fecha $agrupar");
        return $var->fetchall();
    }
    
    public function getSocios($cedula, $apellido, $nombre, $departamento, $banco, $tipo_cuenta, $estado) {
        $var = $this->_db->query("SELECT * FROM socios INNER JOIN departamentos ON departamentos.id_dep = socios.departamento_soc WHERE cedula_rif_soc LIKE '%$cedula%' AND apellidos_soc LIKE '%$apellido%' AND nombres_soc LIKE '%$nombre%' AND departamento_soc LIKE '%$departamento%' AND banco_soc LIKE '%$banco%' AND tipo_cuenta_soc LIKE '%$tipo_cuenta%' AND estado_soc LIKE '%$estado%'");
        return $var->fetchall();
    }

    public function getPrestamosSocio($id) {
        $var = $this->_db->query("SELECT p.*, s.*, SUM(pp.monto_capital_pag_pre) AS total_pagado FROM prestamos AS p INNER JOIN socios AS s ON p.socio_pre = s.id_soc LEFT JOIN pagos_prestamo AS pp ON p.id_pre = pp.prestamo_pag_pre WHERE p.socio_pre = $id GROUP BY p.id_pre");
        return $var->fetchall();
    }

    public function getSocio($cedula) {
        $var = $this->_db->query("SELECT * FROM socios INNER JOIN departamentos ON departamentos.id_dep = socios.departamento_soc WHERE cedula_rif_soc = '$cedula'");
        return $var->fetch();
    }

    public function getMovimientos($id, $mes, $ao) {
        $var = $this->_db->query("SELECT * FROM movimientos AS m INNER JOIN socios AS s ON m.socio_mov = s.id_soc INNER JOIN bancos AS b ON m.banco_mov = b.id_ban WHERE b.id_ban = $id AND MONTH(m.fecha_mov) = $mes AND YEAR(m.fecha_mov) = $ao ORDER BY m.id_mov DESC");
        return $var->fetchall();
    }

    public function getPrestamos($cedula, $plazo, $interes, $fecha_solicitud, $fecha_aprobacion, $fecha_primer_pago, $tipo_prestamo, $estado) {
        $var = $this->_db->query("SELECT p.*, s.*, SUM(pp.monto_total_pag_pre) AS total_pagado FROM prestamos AS p INNER JOIN socios AS s ON p.socio_pre = s.id_soc LEFT JOIN pagos_prestamo AS pp ON p.id_pre = pp.prestamo_pag_pre WHERE s.cedula_rif_soc LIKE '%$cedula%' AND p.plazo_pre LIKE '%$plazo%' AND p.interes_pre LIKE '%$interes%' AND p.fecha_solicitud_pre LIKE '%$fecha_solicitud%' AND p.fecha_aprobacion_pre LIKE '%$fecha_aprobacion%' AND p.fecha_primer_pago_pre LIKE '%$fecha_primer_pago%' AND p.tipo_prestamo_pre LIKE '%$tipo_prestamo%' AND p.estado_pre LIKE '%$estado%' GROUP BY p.id_pre");
        return $var->fetchall();
    }

    public function getPrestamo($id) {
        $var = $this->_db->query("SELECT p.*, s.*, d.*, SUM(pp.monto_total_pag_pre) AS total_pagado FROM prestamos AS p INNER JOIN socios AS s ON p.socio_pre = s.id_soc LEFT JOIN pagos_prestamo AS pp ON p.id_pre = pp.prestamo_pag_pre INNER JOIN departamentos AS d ON d.id_dep = s.departamento_soc WHERE p.id_pre = $id GROUP BY p.id_pre");
        return $var->fetch();
    }

    public function getMovimientosSoc($cedula, $referencia, $fecha, $tipo, $forma, $banco, $estado) {
        $var = $this->_db->query("SELECT * FROM movimientos AS m INNER JOIN socios AS s ON s.id_soc = m.socio_mov WHERE s.cedula_rif_soc LIKE '%$cedula%' AND m.referencia_mov LIKE '%$referencia%' AND m.fecha_mov LIKE '%$fecha%' AND m.tipo_mov LIKE '%$tipo%' AND m.forma_mov LIKE '%$forma%' AND m.banco_mov LIKE '%$banco%' AND m.estado_mov LIKE '%$estado%'");
        return $var->fetchall();
    }

    public function getEstadoCuenta($cedula, $fecha, $fecha2, $tipo, $forma, $banco, $estado) {
        $var = $this->_db->query("SELECT * FROM movimientos AS m INNER JOIN socios AS s ON m.socio_mov = s.id_soc INNER JOIN bancos AS b ON m.banco_mov = b.id_ban WHERE s.cedula_rif_soc LIKE '%$cedula%' AND m.tipo_mov LIKE '%$tipo%' AND m.forma_mov LIKE '%$forma%' AND b.id_ban LIKE '%$banco%' AND m.estado_mov LIKE '%$estado%' AND m.fecha_mov BETWEEN '$fecha' AND '$fecha2' ORDER BY m.fecha_mov DESC");
        return $var->fetchall();
    }

    public function getDeudores() {
        $var = $this->_db->query("SELECT s.*, p.*, pp.*, SUM(pp.monto_capital_pag_pre) AS total_capital, SUM(pp.monto_interes_pag_pre) AS total_interes, SUM(pp.monto_total_pag_pre) AS total_pagado, (SUM(pp.monto_capital_pag_pre) * 100) / p.monto_pre AS porcentaje FROM prestamos AS p INNER JOIN socios AS s ON p.socio_pre = s.id_soc LEFT JOIN pagos_prestamo AS pp ON p.id_pre = pp.prestamo_pag_pre GROUP BY p.id_pre");
        return $var->fetchall();
    }
}
