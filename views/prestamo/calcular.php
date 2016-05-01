<!--body wrapper start-->
<div class="wrapper">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <form class="form-horizontal adminex-form" method="post">
        <h1 class="text-center"><?= $this->titulo?></h1>
        <br>
        <input type='hidden' name='guardar' value='1'>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Monto:</label>
          <div class="col-sm-9">
              <input type="text" autofocus class="form-control" id="monto_pre" name="monto_pre" placeholder="Introduzca el Monto" value="<?php if (isset($this->datos["monto_pre"])): echo $this->datos["monto_pre"]; endif;?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Plazo:</label>
          <div class="col-sm-9">
            <select name="plazo_pre" class="form-control">
              <option value="">-- Seleccione --</option>
              <option>12</option>
              <option>24</option>
              <option>36</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Tasa de Inter&eacute;s:</label>
          <div class="col-sm-9">
              <input type="text" class="form-control" id="interes_pre" name="interes_pre" placeholder="Introduzca la Tasa de Inter&eacute;s" value="<?php if (isset($this->datos["interes_pre"])): echo $this->datos["interes_pre"]; endif;?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Fecha del Primer Pago:</label>
          <div class="col-sm-9">
              <input type="date" class="form-control" id="fecha_primer_pago_pre" name="fecha_primer_pago_pre" placeholder="Introduzca la Fecha del Primer Pago" value="<?php if (isset($this->datos["fecha_primer_pago_pre"])): echo $this->datos["fecha_primer_pago_pre"]; endif;?>" />
          </div>
        </div>
        <div style="margin: 9px 0 5px;" class="btn-group">
          <button class="btn btn-info" type="submit">Guardar</button>
          <a href="<?= BASE_URL?>prestamo/index" class="btn btn-info">Volver</a>
        </div>
      </form>
    </div>
  </div>
</div>
<!--body wrapper end-->

<?php if (isset($this->resultado) && $this->resultado == true):?>
<table class="table  table-hover general-table">
  <thead>
    <tr>
      <th class="text-center"><strong>Meses</strong></th>
      <th class="text-center"><strong>Cuota</strong></th>
      <th class="text-center"><strong>Interes&eacute;s</strong></th>
      <th class="text-center"><strong>Amortizaci&oacute;n</strong></th>
      <th class="text-center"><strong>Capital Vivo</strong></th>
    </tr>
  </thead>
  <?php
      $prestamo = $this->datos['monto_pre'];
      $interes = $this->datos['interes_pre'] / 100;
      $c = 1 + $interes;
      $a = pow($c, $this->datos['plazo_pre']);
      $a2 = $interes * $a;
      $b = $a - 1;
      $cuota = $prestamo * ($a2 / $b);
      $total1 = 0;
      $total2 = 0;
      $total3 = 0;
  ?>
  <tbody>
    <tr>
        <td class="text-center">N/A</td>
        <td class="text-center">N/A</td>
        <td class="text-center">N/A</td>
        <td class="text-center">N/A</td>
        <td class="text-center"><?= $this->Dinero($prestamo)?></td>
    </tr>
    <?php
    $arreglo_fechas = [];
    for ($i = 1; $i <= $this->datos['plazo_pre']; $i++) {
        $interesCalc = $prestamo * $interes;
        $amortizacion = $cuota - $interesCalc;    
        $saldoPrestamo = $prestamo - $amortizacion;
        $mes = $i -1;
        $siguiente_fecha = strtotime( '+' . $mes . ' month' , strtotime($this->datos['fecha_primer_pago_pre']));
        $siguiente_fecha = date( 'Y-m-d' , $siguiente_fecha);
        array_push($arreglo_fechas, $siguiente_fecha);
    ?>
    <tr>
      <td class="text-center"><?= $this->Fecha($siguiente_fecha)?></td>
      <td class="text-center"><?= $this->Dinero($cuota)?></td>
      <td class="text-center"><?= $this->Dinero($interesCalc)?></td>
      <td class="text-center"><?= $this->Dinero($amortizacion)?></td>
      <td class="text-center"><?= $this->Dinero($saldoPrestamo)?></td>
    </tr>
    <?php 
        $prestamo = $saldoPrestamo;
        $total1 = $total1 + $cuota;
        $total2 = $total2 + $interesCalc;
        $total3 = $total3 + $amortizacion;
    }
    ?>
  </tbody>
  <footer>
    <tr>
      <td class="text-center"><strong>Totales</strong></td>
      <td class="text-center"><?= $this->Dinero($total1)?></td>
      <td class="text-center"><?= $this->Dinero($total2)?></td>
      <td class="text-center"><?= $this->Dinero($total3)?></td>
      <td class="text-center"></td>
    </tr>
  </footer>
</table>
<?php endif;?>
