<!--body wrapper start-->
<div class="wrapper">
  <div class="row">
    <div class="col-md-12">
      <h3 class="text-center"><?= $this->titulo?> <a href="<?= BASE_URL?>prestamo/index" class="btn btn-info" style="float: right">Volver al Listado</a></h3>
      <br>
      <div class="col-md-3 col-md-offset-1">
        <dl>
          <dt>Socio:</dt>
          <dd><?= $this->Cedula($this->datos['cedula_rif_soc'])?><br><?= $this->datos['apellidos_soc'] . ' ' . $this->datos['nombres_soc'];?></dd>
          <dt>Monto:</dt>
          <dd><?= $this->Dinero($this->datos['monto_pre'])?></dd>
          <dt>Plazo del Prestamo</dt>
          <dd><?= $this->datos['plazo_pre']?> Meses</dd>
          <dt>Tasa de Inter&eacute;s</dt>
          <dd><?= $this->Decimal($this->datos['interes_pre'])?> %</dd>
          <dt>Fecha de la Solicitud</dt>
          <dd><?= $this->Fecha($this->datos['fecha_solicitud_pre'])?></dd>
          <?php if ($this->datos['fecha_aprobacion_pre'] != '0000-00-00'):?>
          <dt>Fecha de Aprobaci&oacute;n</dt>
          <dd><?= $this->Fecha($this->datos['fecha_aprobacion_pre'])?></dd>
          <?php endif;?>
        </dl>
      </div>
      <div class="col-md-3">
          <dl>
            <?php if ($this->datos['fecha_primer_pago_pre'] != '0000-00-00'):?>
            <dt>Fecha del Primer Pago:</dt>
            <dd><?= $this->Fecha($this->datos['fecha_primer_pago_pre'])?></dd>
            <?php endif;?>
            <?php
            if ($this->datos['estado_pre'] != 'En Proceso'):
            $pago_porcentaje = $this->datos["total_capital"] * 100;
            $pago_porcentaje = $pago_porcentaje / $this->datos["monto_pre"];
            ?>
            <dt>Total Pagado Capital:</dt>
            <dd><?= $this->Dinero($this->datos['total_capital'])?> / <?= $this->Decimal($pago_porcentaje)?> %</dd>
            <dt>Total Pagado Intereses:</dt>
            <dd><?= $this->Dinero($this->datos['total_interes'])?></dd>
            <dt>Total Deuda</dt>
            <dd><?= $this->Dinero($this->datos['monto_pre'] - $this->datos['total_capital'])?></dd>
            <dt>Ultimo Pago</dt>
            <dd><?= $this->Fecha($this->datos['fecha_pag_pre'])?></dd>
            <?php endif;?>
            <dt>Estado del Prestamo</dt>
            <dd><?= $this->datos['estado_pre']?></dd>
          </dl>
        </div>
    </div>
  </div>
  <?php if ($this->datos['estado_pre'] != 'En Proceso'):?>
  <?php if ($this->pagos):?>
  <div class="row">
    <div class="col-md-12">
      <table  class="display table table-bordered table-striped">
        <caption><h1>Abonos del Prestamo</h1></caption>
        <thead>
          <tr>
            <th class="text-center"><strong>Fecha del Abono</strong></th>
            <th><strong>Capital Abonado</strong></th>
            <th><strong>Inter&eacute;s Abonado</strong></th>
            <th><strong>Total</strong></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $mc = 0;
          $mi = 0;
          $mt = 0;
          foreach ($this->pagos AS $p):?>
          <tr>
            <td class="text-center"><?= $this->Fecha($p['fecha_pag_pre'])?></td>
            <?php ?>
            <td class="text-right"><?= $this->Decimal($p['monto_capital_pag_pre'])?></td>
            <td class="text-right"><?= $this->Decimal($p['monto_interes_pag_pre'])?></td>
            <td class="text-right"><?= $this->Decimal($p['monto_total_pag_pre'])?></td>
          </tr>
          <?php
          $mc = $mc + $p['monto_capital_pag_pre'];
          $mi = $mi + $p['monto_interes_pag_pre'];
          $mt = $mt + $p['monto_total_pag_pre'];
          endforeach;?>
        </tbody>
        <footer>
          <th class="text-center">Totales</th>
          <th class="text-right"><?= $this->Decimal($mc)?></th>
          <th class="text-right"><?= $this->Decimal($mi)?></th>
          <th class="text-right"><?= $this->Decimal($mt)?></th>
        </footer>
      </table>
    </div>
  </div>
  <?php endif;?>
  <div class="row">
    <div class="col-md-12">
      <div class="adv-table">
        <table  class="display table table-bordered table-striped">
          <caption><h1>Amortizaciones</h1></caption>
          <thead>
            <tr>
              <th class="text-center"><strong>Cuota Nro.</strong></th>
              <th class="text-center"><strong>Fecha de Vencimiento</strong></th>
              <th><strong>Monto de la Cuota</strong></th>
              <th><strong>Capital de la Cuota</strong></th>
              <th><strong>Interes&eacute;s de la Cuota</strong></th>
              <th><strong>Saldo de Capital</strong></th>
              <th><strong>Saldo de Intereses</strong></th>
              <th><strong>Saldo Total</strong></th>
              <th><strong>Capital Pagado</strong></th>
              <th><strong>Intereses Pagados</strong></th>
              <th><strong>Total Pagado</strong></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($this->cuotas AS $c):?>
            <tr>
              <td class="text-center"><?= $this->Cantidad($c['numero_cuo_pre'])?></td>
              <td class="text-center"><?= $this->Fecha($c['fecha_cuo_pre'])?></td>
              <td class="text-right"><?= $this->Decimal($c['cuota_cuo_pre'])?></td>
              <td class="text-right"><?= $this->Decimal($c['capital_cuo_pre'])?></td>
              <td class="text-right"><?= $this->Decimal($c['interes_cuo_pre'])?></td>
              <td class="text-right"><?= $this->Decimal($c['saldo_capital_cuo_pre'])?></td>
              <td class="text-right"><?= $this->Decimal($c['saldo_intereses_cuo_pre'])?></td>
              <td class="text-right"><?= $this->Decimal($c['saldo_total_cuo_pre'])?></td>
              <td class="text-right"><?= $this->Decimal($c['capital_pagado_cuo_pre'])?></td>
              <td class="text-right"><?= $this->Decimal($c['intereses_pagado_cuo_pre'])?></td>
              <td class="text-right"><?= $this->Decimal($c['total_pagado_cuo_pre'])?></td>
            </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
<?php else:?>
  <div class="row">
    <div class="col-md-12 text-center">
      <h4>El Prestamo esta en Proceso de Aprobacion, la siguiente tabla de amortizacion puede variar:</h4>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="adv-table">
        <table  class="display table table-bordered table-striped amortizacion" id="dynamic-table">
          <thead>
            <tr>
              <th class="text-center"><strong>Cuota Nro.</strong></th>
              <th><strong>Monto de la Cuota</strong></th>
              <th><strong>Capital de la Cuota</strong></th>
              <th><strong>Interes&eacute;s de la Cuota</strong></th>
              <th><strong>Saldo de Capital</strong></th>
              <th><strong>Saldo de Intereses</strong></th>
              <th><strong>Saldo Total</strong></th>
              <th><strong>Capital Pagado</strong></th>
              <th><strong>Intereses Pagados</strong></th>
              <th><strong>Total Pagado</strong></th>
            </tr>
          </thead>
          <?php
          $prestamo = $this->datos['monto_pre'];
          $prestamo2 = $this->datos['monto_pre'];
          $interes = $this->datos['interes_pre'] / 1200;
          $c = 1 + $interes;
          $a = pow($c, $this->datos['plazo_pre']);
          $a2 = $interes * $a;
          $b = $a - 1;
          $cuota = $prestamo * ($a2 / $b);
          $total1 = 0;//Total Pagado
          $total2 = 0;//Total Intereses Pagados
          $total3 = 0;//Total Capital Pagado
          $total4 = 0;//Total Restante Intereses
          $total5 = 0;//Total Restante Prestamo
          $total6 = 0;//Total Absoluto de Intereses
          ?>
          <tbody>
            <tr class="hidden">
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"><?= $this->Dinero($prestamo)?></td>
            </tr>
            <?php
            $arreglo_fechas = [];
            //Calcular Interes Total
            for ($j = 1; $j <= $this->datos['plazo_pre']; $j++) {
              $interesCalc2 = $prestamo2 * $interes;
              $amortizacion2 = $cuota - $interesCalc2;    
              $saldoPrestamo2 = $prestamo2 - $amortizacion2;
              $prestamo2 = $saldoPrestamo2;
              $total4 = $total4 + $interesCalc2;
              $total6 = $total6 + $cuota;
            }
            //Calcular Pagos
            for ($i = 1; $i <= $this->datos['plazo_pre']; $i++) {
              $interesCalc = $prestamo * $interes;
              $amortizacion = $cuota - $interesCalc;    
              $saldoPrestamo = $prestamo - $amortizacion;
              $saldoPrestamoInteres = 0;
              $mes = $i;
              $siguiente_fecha = $mes;
              array_push($arreglo_fechas, $siguiente_fecha);
              $prestamo = $saldoPrestamo;
              $total1 = $total1 + $cuota;
              $total2 = $total2 + $interesCalc;
              $total3 = $total3 + $amortizacion;
              $total4 = $total4 - $interesCalc;
              $total5 = $total6 - $total1;
            ?>
            <tr>
              <td class="text-center"><?= $siguiente_fecha?></td>
              <td class="text-right"><?= $this->Decimal($cuota)?></td>
              <td class="text-right"><?= $this->Decimal($amortizacion)?></td>
              <td class="text-right"><?= $this->Decimal($interesCalc)?></td>
              <td class="text-right"><?= $this->Decimal($saldoPrestamo)?></td>
              <td class="text-right"><?= $this->Decimal($total4)?></td>
              <td class="text-right"><?= $this->Decimal($total5)?></td>
              <td class="text-right"><?= $this->Decimal($total3)?></td>
              <td class="text-right"><?= $this->Decimal($total2)?></td>
              <td class="text-right"><?= $this->Decimal($total1)?></td>
            </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php endif;?>
</div>
