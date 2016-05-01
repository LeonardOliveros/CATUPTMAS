<?php
ob_end_clean();
class MYPDF extends TCPDF {
    public function Header() {
        $this->Image(ROOT . 'views' . DS . 'layout' . DS . 'default' . DS . 'img' . DS . 'logo.jpeg', 10, 8, 20, 18, 'JPG', false, 'C', true, 300, '', false, false, false, false, false, false);
        $this->SetFont('times', 'B', 8);
        $this->Cell(20, 10, '', false, true, 'L');
        $this->SetFont('times', 'B', 15);
        $this->Cell(20, 10, '', false, false, 'L');
        $this->Cell(0, 4, APP_NAME, false, true, 'C');
        $this->SetFont('times', 'B', 15);
        $this->Cell(20, 10, '', false, false, 'L');
        $this->Cell(0, 4, 'Caja de Ahorro de la Universidad Politecnica Territorial', false, true, 'C');
        $this->Cell(20, 10, '', false, false, 'L');
        $this->Cell(0, 4, 'del Norte del Tachira Manuela Saenz', false, true, 'C');
        $this->SetFont('times', 'B', 13);
        $this->Cell(20, 10, '', false, false, 'L');
        $this->Cell(0, 4, reporteController::$titulo, false, true, 'L');
        $this->SetFont('times', '', 8);
        $this->Ln();
    }
    
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('times', 'BI', 8);
        $this->Cell(60, 5, "Fecha de Impresión: ".date("d-m-Y h:i:s A"), false, false, 'C');
        $this->Cell(0, 5, 'Página: '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), false, false, 'R');
    }
}
$this->pdf = new MYPDF('P', 'mm', 'Letter', true, 'UTF-8', false);
$this->pdf->SetMargins(7, 40, 7);
$this->pdf->SetAutoPageBreak(true, 18);
$this->pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$this->pdf->SetFont('times', '', 10);
$this->pdf->AddPage();

$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(30, 6, 'Cédula', true, false, 'C');
$this->pdf->SetFont('times', '', 10);
$this->pdf->Cell(40, 6, $view->Cedula($datos['cedula_rif_soc']), true, false, 'C');
$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(50, 6, 'Apellidos y Nombres', true, false, 'C');
$this->pdf->SetFont('times', '', 10);
$this->pdf->Cell(0, 6, $datos['apellidos_soc'] . ' ' . $datos['nombres_soc'], true, true, 'C');
$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(30, 6, 'Teléfonos', true, false, 'C');
$this->pdf->SetFont('times', '', 10);
$this->pdf->Cell(60, 6, $view->Telefono($datos['telefono_soc']) . ' / ' . $view->Telefono($datos['telefono2_soc']), true, false, 'C');
$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(30, 6, 'Departamento', true, false, 'C');
$this->pdf->SetFont('times', '', 10);
$this->pdf->Cell(0, 6, $datos['nombre_dep'], true, true, 'C');
$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(30, 6, 'Dirección', true, false, 'C');
$this->pdf->SetFont('times', '', 10);
$this->pdf->Cell(0, 6, $datos['direccion_soc'], true, true, 'C');
$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(30, 6, 'Sueldo', true, false, 'C');
$this->pdf->SetFont('times', '', 10);
$this->pdf->Cell(37, 6, $view->Dinero($datos['sueldo_soc']), true, false, 'C');
$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(30, 6, 'Aporte Socio', true, false, 'C');
$this->pdf->SetFont('times', '', 10);
$this->pdf->Cell(37, 6, $view->Dinero(($datos['aporte_socio_soc'] / 100) * $datos['sueldo_soc']), true, false, 'C');
$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(30, 6, 'Aporte Patrono', true, false, 'C');
$this->pdf->SetFont('times', '', 10);
$this->pdf->Cell(0, 6, $view->Dinero(($datos['aporte_patrono_soc'] / 100) * $datos['sueldo_soc']), true, true, 'C');
$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(30, 6, 'Banco', true, false, 'C');
$this->pdf->SetFont('times', '', 10);
$this->pdf->Cell(67, 6, $datos['banco_soc'], true, false, 'C');
$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(37, 6, 'Tipo de Cuenta', true, false, 'C');
$this->pdf->SetFont('times', '', 10);
$this->pdf->Cell(0, 6, $datos['tipo_cuenta_soc'], true, true, 'C');
$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(40, 6, 'Número de Cuenta', true, false, 'C');
$this->pdf->SetFont('times', '', 10);
$this->pdf->Cell(94, 6, $datos['numero_cuenta_soc'], true, false, 'C');
$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(30, 6, 'Estado del Socio', true, false, 'C');
$this->pdf->SetFont('times', '', 10);
$this->pdf->Cell(0, 6, $datos['estado_soc'], true, true, 'C');
$this->pdf->Ln();
$this->pdf->SetFont('times', 'B', 12);
$this->pdf->Cell(0, 6, 'Estado de Cuenta', false, true, 'L');
$this->pdf->Ln();
$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(50, 6, 'Ahorros Voluntarios', true, false, 'C');
$this->pdf->Cell(50, 6, 'Ahorros Socio', true, false, 'C');
$this->pdf->Cell(50, 6, 'Ahorros Patrono', true, false, 'C');
$this->pdf->Cell(0, 6, 'Total de Ahorros', true, true, 'C');
$this->pdf->SetFont('times', '', 10);
$this->pdf->Cell(50, 6, $view->Dinero($ahorros['ahorros_voluntarios']), true, false, 'C');
$this->pdf->Cell(50, 6, $view->Dinero($ahorros['ahorros_socio']), true, false, 'C');
$this->pdf->Cell(50, 6, $view->Dinero($ahorros['ahorros_patrono']), true, false, 'C');
$this->pdf->Cell(0, 6, $view->Dinero($ahorros['total_ahorros']), true, true, 'C');
$this->pdf->Cell(100, 6, '', false, false, 'C');
$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(50, 6, '80% Disponibilidad', true, false, 'C');
$this->pdf->SetFont('times', '', 10);
$this->pdf->Cell(0, 6, $view->Dinero($ahorros['total_disponible']), true, true, 'C');
$this->pdf->Ln();
$this->pdf->SetFont('times', 'B', 12);
$this->pdf->Cell(0, 6, 'Prestamos', false, true, 'L');
$this->pdf->Ln();
$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(20, 4, 'Fecha', true, false, 'C');
$this->pdf->Cell(20, 4, 'Cuotas', true, false, 'C');
$this->pdf->Cell(20, 4, 'Interés', true, false, 'C');
$this->pdf->Cell(39, 4, 'Monto', true, false, 'C');
$this->pdf->Cell(39, 4, 'Total Pagado', true, false, 'C');
$this->pdf->Cell(39, 4, 'Total Deuda', true, false, 'C');
$this->pdf->Cell(25, 4, 'Estado', true, true, 'C');
$deuda_total = 0;
$pagado_total = 0;
$capital_total = 0;
if ($prestamos) {
    foreach ($prestamos AS $p) {
        $this->pdf->SetFont('times', '', 9);
        $this->pdf->Cell(20, 4, $view->Fecha($p['fecha_solicitud_pre']), true, false, 'C');
        $this->pdf->Cell(20, 4, $view->Cantidad($p['plazo_pre']), true, false, 'C');
        $this->pdf->Cell(20, 4, $view->Cantidad($p['interes_pre']) . ' %', true, false, 'C');
        $this->pdf->Cell(39, 4, $view->Dinero($p['monto_pre']), true, false, 'C');
        $this->pdf->Cell(39, 4, $view->Dinero($p['total_pagado']), true, false, 'C');
        $this->pdf->Cell(39, 4, $view->Dinero($p['monto_pre'] - $p['total_pagado']), true, false, 'C');
        $this->pdf->Cell(25, 4, $p['estado_pre'], true, true, 'C');
        if ($p['estado_pre'] == 'Activo') {
            $pagado_total = $pagado_total + $p['total_pagado'];
            $deuda_total = $deuda_total + $p['monto_pre'] - $p['total_pagado'];
            $capital_total = $capital_total + $p['monto_pre'];
        }
    }
} else {
    $this->pdf->SetFont('times', '', 9);
    $this->pdf->Cell(20, 4, 'N/A', true, false, 'C');
    $this->pdf->Cell(20, 4, 'N/A', true, false, 'C');
    $this->pdf->Cell(20, 4, 'N/A', true, false, 'C');
    $this->pdf->Cell(39, 4, $view->Dinero(0), true, false, 'C');
    $this->pdf->Cell(39, 4, $view->Dinero(0), true, false, 'C');
    $this->pdf->Cell(39, 4, $view->Dinero(0), true, false, 'C');
    $this->pdf->Cell(25, 4, 'N/A', true, true, 'C');
}
$this->pdf->Ln();
$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(40, 6, 'Total Pagado', true, false, 'C');
$this->pdf->SetFont('times', '', 10);
if ($capital_total == 0) {
    $resultado = 0;
} else {
    $resultado = ($pagado_total * 100) / $capital_total;
}
$this->pdf->Cell(60, 6, $view->Dinero($pagado_total) . ' ' . $view->Decimal($resultado) . ' %', true, true, 'C');
$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(40, 6, 'Total Deuda', true, false, 'C');
$this->pdf->SetFont('times', '', 10);
$this->pdf->Cell(60, 6, $view->Dinero($deuda_total), true, true, 'C');
$this->pdf->Output(reporteController::$titulo . ".pdf", 'I');