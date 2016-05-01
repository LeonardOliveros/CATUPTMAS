<!--body wrapper start-->
<div class="wrapper">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <form class="form-horizontal adminex-form" method="post">
        <h1 class="text-center"><?= $this->titulo?></h1>
        <br>
        <input type='hidden' name='guardar' value='1'>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">C&eacute;dula:</label>
          <div class="col-sm-9">
            <input type="text" autofocus required class="form-control" pattern="<?= $_validationRegex['cedula']?>" title="<?= $_validationTitle['cedula']?>" id="socio_pre" name="socio_pre" placeholder="Introduzca la C&eacute;dula o RIF del Socio" value="<?php if (isset($this->datos["socio_pre"])): echo $this->datos["socio_pre"]; endif;?>">
          </div>
        </div>
        <div style="margin: 9px 0 5px;" class="btn-group">
          <button class="btn btn-info" type="submit">Buscar</button>
          <?php if (!$this->resultado2):?>
            <a href="<?= BASE_URL?>prestamo/index" class="btn btn-info">Volver al Listado</a>
          <?php else:?>
            <a href="<?= BASE_URL?>prestamo/consulta_amortizacion" class="btn btn-info">Cerrar</a>
          <?php endif;?>
        </div>
      </form>
    </div>
  </div>
  <?php if ($this->resultado):?>
  <div class="row">
    <div class="col-md-12">
      <div class="adv-table">
        <table  class="display table table-bordered table-striped">
          <caption><h1>Prestamos por Otorgar</h1></caption>
          <thead>
            <tr>
              <th class="text-center">Fecha de Aprobacion</th>
              <th>Monto</th>
              <th class="text-center">Estado</th>
              <th class="text-center"></th>
            </tr>
          </thead>
          <tbody>
          <?php for ($i = 0; $i < count($this->prestamos); $i++):?>
            <tr>
              <td class="text-center"><?= $this->Fecha($this->prestamos[$i]['fecha_aprobacion_pre'])?></td>
              <td class="text-right"><?= $this->Dinero($this->prestamos[$i]['monto_pre']); ?></td>
              <td class="text-center"><?= $this->prestamos[$i]['estado_pre']?></td>
              <td class="text-center">
                <a href="<?= BASE_URL?>prestamo/consulta_amortizacion/<?= $this->prestamos[$i]['id_pre']?>" data-toggle="tooltip" data-placement="top" title="Consultar" class="btn btn-info btn-xs"><span class="fa fa-search"></span></a>
              </td>
            </tr>
            <?php endfor;?>
          </tbody>
          <tfoot>
            <tr>
              <th class="text-center">Fecha de Solicitud</th>
              <th>Monto</th>
              <th class="text-center">Estado</th>
              <th class="text-center"></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  <?php endif;?>
  <?php if ($this->resultado2):?>
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-12">
          <div class="adv-table">
            <table  class="display table table-bordered table-striped" id="dynamic-table">
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
    </div>
  </div>
  <?php endif;?>
</div>
<!--body wrapper end-->