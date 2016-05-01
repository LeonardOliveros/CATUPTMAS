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
$html =
<<< EOT
    <table bgcolor="#ffffff" border="1" cellpadding="2" cellspacing="1" width="100%">
        <tr>
            <td width="35%" height="13" style="text-align: center">
            <font><strong>Socio</strong></font></td>
            <td width="20%" height="13" style="text-align: center">
            <font><strong>Tipo de Movimiento</strong></font></td>
            <td width="15%" height="13" style="text-align: center">
            <font><strong>Monto</strong></font></td>
            <td width="15%" height="13" style="text-align: center">
            <font><strong>Fecha</strong></font></td>
            <td width="15%" height="13" style="text-align: center">
            <font><strong>Estado</strong></font></td>
        </tr>
    </table>
EOT;
        $this->writeHTML($html, true, true, true, false, 'C');
        //$this->Image(ROOT . 'public' . DS . 'img' . DS . 'logotipo.jpg', 180, 6, 30, '', 'JPG', false, 'T', true, 300, '', false, false, false, false, false, true);
    }
    
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('times', 'BI', 8);
        $this->Cell(60, 5, "Fecha de Impresión: ".date("d-m-Y h:i:s A"), false, false, 'C');
        $this->Cell(0, 5, 'Página: '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), false, false, 'R');
    }
}
$this->pdf = new MYPDF('P', 'mm', 'Letter', true, 'UTF-8', false);
$this->pdf->SetMargins(7, 46, 7);
$this->pdf->SetAutoPageBreak(true, 18);
$this->pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$this->pdf->SetFont('times', '', 10);
$this->pdf->AddPage();
$var = '';
$total_retiro_patrono = 0;
$total_retiro_socio = 0;
$total_retiro_voluntario = 0;
$total_deposito_patrono = 0;
$total_deposito_socio = 0;
$total_deposito_voluntario = 0;
$total_pago_prestamo = 0;
foreach ($listado AS $l){
    switch ($l['tipo_mov']) {
        case 'Deposito - Patrono':
            if ($l['estado_mov'] == 'Aceptado'):
                $total_deposito_patrono = $total_deposito_patrono + $l['monto_mov'];
            endif;
            break;
        case 'Deposito - Socio':
            if ($l['estado_mov'] == 'Aceptado'):
                $total_deposito_socio = $total_deposito_socio + $l['monto_mov'];
            endif;
            break;
        case 'Deposito - Voluntario':
            if ($l['estado_mov'] == 'Aceptado'):
                $total_deposito_voluntario = $total_deposito_voluntario + $l['monto_mov'];
            endif;
            break;
        case 'Retiro - Patrono':
            if ($l['estado_mov'] == 'Aceptado'):
                $total_retiro_patrono = $total_retiro_patrono + $l['monto_mov'];
            endif;
            break;
        case 'Retiro - Socio':
            if ($l['estado_mov'] == 'Aceptado'):
                $total_retiro_socio = $total_retiro_socio + $l['monto_mov'];
            endif;
            break;
        case 'Retiro - Voluntario':
            if ($l['estado_mov'] == 'Aceptado'):
                $total_retiro_voluntario = $total_retiro_voluntario + $l['monto_mov'];
            endif;
            break;
        case 'Pago Prestamo':
            if ($l['estado_mov'] == 'Aceptado'):
                $total_pago_prestamo = $total_pago_prestamo + $l['monto_mov'];
            endif;
            break;
    }
    $var.= '
    <tr>
        <td width="35%" height="13" style="text-align: left">' . $view->Cedula($l['cedula_rif_soc']) . ' ' . $l['apellidos_soc']. ' ' . $l['nombres_soc'];
    $var.= '</td>
        <td width="20%" height="13" style="text-align: center">' . $l['tipo_mov'];
        $var.= '</td>
        <td width="15%" height="13" style="text-align: center">' . $view->Dinero($l['monto_mov']);
        $var.= '</td>
        <td width="15%" height="13" style="text-align: center">' . $view->Fecha($l['fecha_mov']);
        $var.= '</td>
        <td width="15%" height="13" style="text-align: center">' . $l['estado_mov'];
        $var.= '</td></tr>';
}
$html =
<<< EOT
<table bgcolor="#ffffff" border="1" cellpadding="2" cellspacing="1" width="100%">
$var
</table>
EOT;
$this->pdf->writeHTML($html, true, true, true, false, 'C');
$this->pdf->Ln();
$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(50, 4, 'Total Depositos Patrono', false, false, 'L');
$this->pdf->SetFont('times', '', 10);
$this->pdf->Cell(50, 4, $view->Dinero($total_deposito_patrono), false, false, 'L');
$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(50, 4, 'Total Retiros Patrono', false, false, 'L');
$this->pdf->SetFont('times', '', 10);
$this->pdf->Cell(50, 4, $view->Dinero($total_retiro_patrono), false, true, 'L');
$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(50, 4, 'Total Ahorros Socio', false, false, 'L');
$this->pdf->SetFont('times', '', 10);
$this->pdf->Cell(50, 4, $view->Dinero($total_deposito_socio), false, false, 'L');
$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(50, 4, 'Total Retiros Socio', false, false, 'L');
$this->pdf->SetFont('times', '', 10);
$this->pdf->Cell(50, 4, $view->Dinero($total_retiro_socio), false, true, 'L');
$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(50, 4, 'Total Ahorros Voluntario', false, false, 'L');
$this->pdf->SetFont('times', '', 10);
$this->pdf->Cell(50, 4, $view->Dinero($total_deposito_voluntario), false, false, 'L');
$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(50, 4, 'Total Retiros Voluntario', false, false, 'L');
$this->pdf->SetFont('times', '', 10);
$this->pdf->Cell(50, 4, $view->Dinero($total_retiro_voluntario), false, true, 'L');
$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(50, 4, 'Total Pagos Prestamos', false, false, 'L');
$this->pdf->SetFont('times', '', 10);
$this->pdf->Cell(50, 4, $view->Dinero($total_pago_prestamo), false, true, 'L');
$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(50, 4, 'Total de Ingresos', false, false, 'L');
$this->pdf->SetFont('times', '', 10);
$this->pdf->Cell(50, 4, $view->Dinero($total_deposito_patrono + $total_deposito_socio + $total_deposito_voluntario + $total_pago_prestamo), false, false, 'L');
$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(50, 4, 'Total de Egresos', false, false, 'L');
$this->pdf->SetFont('times', '', 10);
$this->pdf->Cell(50, 4, $view->Dinero($total_retiro_patrono + $total_retiro_socio + $total_retiro_voluntario), false, true, 'L');
$this->pdf->Ln();
$this->pdf->SetFont('times', 'I', 8);
$this->pdf->Cell(0, 4, 'Nota: En las suma de las cantidades solo se toman en cuenta los movimientos con estado Aceptado', false, false, 'C');
$this->pdf->Output(reporteController::$titulo . ".pdf", 'I');