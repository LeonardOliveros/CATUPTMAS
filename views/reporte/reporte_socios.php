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
            <td width="10%" height="13" style="text-align: center">
            <font><strong>C&eacute;dula</strong></font></td>
            <td width="25%" height="13" style="text-align: left">
            <font><strong>Apellidos y Nombres</strong></font></td>
            <td width="15%" height="13" style="text-align: center">
            <font><strong>Tel&eacute;fonos</strong></font></td>
            <td width="25%" height="13" style="text-align: center">
            <font><strong>Direcci&oacute;n</strong></font></td>
            <td width="17%" height="13" style="text-align: center">
            <font><strong>Departamento</strong></font></td>
            <td width="8%" height="13" style="text-align: center">
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
foreach ($listado AS $l){
    $var.= '
    <tr>
        <td width="10%" height="13" style="text-align: center">' . $view->Cedula($l['cedula_rif_soc']);
    $var.= '</td>
        <td width="25%" height="13" style="text-align: left">' . $l['apellidos_soc'] . ' ' . $l['nombres_soc'];
        $var.= '</td>
        <td width="15%" height="13" style="text-align: center">' . $view->Telefono($l['telefono_soc']) . ' / ' . $view->Telefono($l['telefono2_soc']);
        $var.= '</td>
        <td width="25%" height="13" style="text-align: justifed">' . $l['direccion_soc'];
        $var.= '</td>
        <td width="17%" height="13" style="text-align: center">' . $l['nombre_dep'];
        $var.= '</td>
        <td width="8%" height="13" style="text-align: center">' . $l['estado_soc'];
        $var.= '</td></tr>';
}
$html =
<<< EOT
<table bgcolor="#ffffff" border="1" cellpadding="2" cellspacing="1" width="100%">
$var
</table>
EOT;
$this->pdf->writeHTML($html, true, true, true, false, 'C');
$this->pdf->Output(reporteController::$titulo . ".pdf", 'I');