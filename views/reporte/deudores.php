<?php
ob_end_clean();
class MYPDF extends TCPDF {
    public function Header() {
        $this->Image(ROOT . 'views' . DS . 'layout' . DS . 'default' . DS . 'img' . DS . 'logo.jpeg', 10, 8, 20, 20, 'JPG', false, 'C', true, 300, '', false, false, false, false, false, false);
        $this->SetFont('times', 'B', 8);
        $this->Cell(35, 10, '', false, true, 'L');
        $this->SetFont('times', 'B', 15);
        $this->Cell(35, 10, '', false, false, 'L');
        $this->Cell(0, 4, APP_NAME, false, true, 'C');
        $this->SetFont('times', 'B', 15);
        $this->Cell(35, 10, '', false, false, 'L');
        $this->Cell(0, 4, 'Caja de Ahorro de la Universidad Politecnica Territorial del Norte del Tachira Manuela Saenz', false, true, 'C');
        $this->SetFont('times', 'B', 13);
        $this->Cell(35, 10, '', false, false, 'L');
        $this->Cell(0, 4, reporteController::$titulo, false, true, 'L');
        $this->SetFont('times', '', 8);
        $this->Ln();
$html =
<<< EOT
    <table bgcolor="#ffffff" border="1" cellpadding="2" cellspacing="1" width="100%">
        <tr>
            <td width="25%" height="13" style="text-align: center">
            <font><strong>Socio</strong></font></td>
            <td width="10%" height="13" style="text-align: center">
            <font><strong>Fecha Aprobacion</strong></font></td>
            <td width="15%" height="13" style="text-align: center">
            <font><strong>Monto</strong></font></td>
            <td width="15%" height="13" style="text-align: center">
            <font><strong>Abono Capital</strong></font></td>
            <td width="15%" height="13" style="text-align: center">
            <font><strong>Abono Intereses</strong></font></td>
            <td width="10%" height="13" style="text-align: center">
            <font><strong>Porcentaje</strong></font></td>
            <td width="10%" height="13" style="text-align: center">
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
$this->pdf = new MYPDF('L', 'mm', 'Letter', true, 'UTF-8', false);
$this->pdf->SetMargins(7, 40, 7);
$this->pdf->SetAutoPageBreak(true, 18);
$this->pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$this->pdf->SetFont('times', '', 8);
$this->pdf->AddPage();
$var = '';
$total_monto = 0;
$total_capital = 0;
$total_interes = 0;
foreach ($listado AS $l){
    if ($l['porcentaje'] < 100):
        $total_monto = $total_monto + $l['monto_pre'];
        $total_capital = $total_capital + $l['total_capital'];
        $total_interes = $total_interes + $l['total_interes'];
        $var.= '
        <tr>
            <td width="25%" height="13" style="text-align: left">' . $view->Cedula($l['cedula_rif_soc']) . ' ' . $l['apellidos_soc'] . ' ' . $l['nombres_soc'];
        $var.= '</td>
            <td width="10%" height="13" style="text-align: center">' . $view->Fecha($l['fecha_aprobacion_pre']);
            $var.= '</td>
            <td width="15%" height="13" style="text-align: center">' . $view->Dinero($l['monto_pre']);
            $var.= '</td>
            <td width="15%" height="13" style="text-align: center">' . $view->Dinero($l['total_capital']);
            $var.= '</td>
            <td width="15%" height="13" style="text-align: center">' . $view->Dinero($l['total_interes']);
            $var.= '</td>
            <td width="10%" height="13" style="text-align: center">' . $view->Decimal($l['porcentaje']). ' %';
            $var.= '</td>
            <td width="10%" height="13" style="text-align: center">' . $l['estado_soc'];
            $var.= '</td></tr>';
    endif;
}
$html =
<<< EOT
<table bgcolor="#ffffff" border="1" cellpadding="2" cellspacing="1" width="100%">
$var
</table>
EOT;
$this->pdf->writeHTML($html, true, true, true, false, 'C');
$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(40, 4, 'Total Monto Prestado: ', true, false, 'R');
$this->pdf->SetFont('times', '', 10);
$this->pdf->Cell(40, 4, $view->Dinero($total_monto), true, true, 'L');
$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(40, 4, 'Total Abono Capital: ', true, false, 'R');
$this->pdf->SetFont('times', '', 10);
$this->pdf->Cell(40, 4, $view->Dinero($total_capital), true, true, 'L');
$this->pdf->SetFont('times', 'B', 10);
$this->pdf->Cell(40, 4, 'Total Abono Intereses: ', true, false, 'R');
$this->pdf->SetFont('times', '', 10);
$this->pdf->Cell(40, 4, $view->Dinero($total_interes), true, true, 'L');
$this->pdf->Output(reporteController::$titulo . ".pdf", 'I');