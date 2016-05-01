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
          <?php if (!$this->resultado):?>
            <a href="<?= BASE_URL?>prestamo/index" class="btn btn-info">Volver al Listado</a>
          <?php else:?>
            <a href="<?= BASE_URL?>prestamo/cancelacion" class="btn btn-info">Cerrar</a>
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
          <caption><h1>Prestamos</h1></caption>
          <thead>
            <tr>
              <th class="text-center">Fecha de Aprobacion</th>
              <th>Monto</th>
              <th>Total Pagado</th>
              <th class="text-center">Estado</th>
              <th class="text-center"></th>
            </tr>
          </thead>
          <tbody>
          <?php for ($i = 0; $i < count($this->resultado); $i++):?>
            <tr>
              <td class="text-center"><?= $this->Fecha($this->resultado[$i]['fecha_aprobacion_pre'])?></td>
              <td class="text-right"><?= $this->Dinero($this->resultado[$i]['monto_pre']); ?></td>
              <td class="text-right"><?= $this->Dinero($this->resultado[$i]['total_pagado']); ?></td>
              <td class="text-center"><?= $this->resultado[$i]['estado_pre']?></td>
              <td class="text-center">
                <a id="btn_cancelacion" href="#myModal" data-id="<?= $this->resultado[$i]['id_pre'];?>" data-capital="<?= ($this->resultado[$i]['monto_pre'] - $this->resultado[$i]['total_pagado']);?>" data-interes="<?= ($this->resultado[$i]['monto_pre'] - $this->resultado[$i]['total_pagado']) * ($this->resultado[$i]['interes_pre'] / 100)?>" data-toggle="modal" data-placement="top" title="Cancelar" class="btn btn-info btn-xs"><span class="fa fa-times"></span></a>
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
  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #7AB5C8">
          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
          <h4 class="modal-title">Abono Parcial al Prestamo</h4>
        </div>
        <div class="modal-body">
          <form id="formAbono" role="form" method="post" action="<?= BASE_URL?>prestamo/abonoPrestamo">
            <input type="hidden" id="id_prestamo" name="id_prestamo" value="" />
            <input type="hidden" id="monto" name="monto" value="" />
            <input type="hidden" id="restante" name="restante" value="" />
            <div  class="form-group">
              <label for="fecha_abono">Fecha del Abono:</label>
              <input type="date" required class="form-control" id="fecha_abono" name="fecha_abono" placeholder="Introduzca la Fecha de Cancelaci&oacite;n" value="<?php if (isset($this->datos["fecha_abono"])): echo $this->datos["fecha_abono"]; else: echo Date('Y-m-d'); endif;?>">
            </div>
            <div  class="form-group">
              <label for="referencia">Referencia:</label>
              <input type="text" required class="form-control" id="referencia" name="referencia" placeholder="Introduzca la Referencia" value="<?php if (isset($this->datos["referencia"])): echo $this->datos["referencia"]; endif;?>">
            </div>
            <div  class="form-group">
              <label for="capital_amortizar">Capital a Amortizar:</label>
              <input type="text" required class="form-control" id="capital_amortizar" name="capital_amortizar" placeholder="Introduzca el Capital a Amortizar" value="<?php if (isset($this->datos["capital_amortizar"])): echo $this->datos["capital_amortizar"]; endif;?>">
            </div>
            <div  class="form-group">
              <label for="interes_amortizar">Interes a Amortizar:</label>
              <input type="text" required class="form-control" id="interes_amortizar" name="interes_amortizar" placeholder="Introduzca el Interes a Amortizar" value="<?php if (isset($this->datos["interes_amortizar"])): echo $this->datos["interes_amortizar"]; endif;?>">
            </div>
            <div class="form-group">
              <label for="forma">Forma de Pago:</label>
              <select name="forma" required id="forma" required class="form-control">
                <option value="">-- Seleccione --</option>
                <option>Deposito</option>
                <option>Cheque</option>
                <option>Transferencia</option>
              </select>
            </div>
            <div class="form-group">
              <label for="banco">Banco:</label>
              <select id="banco" required name="banco" required class="form-control">
                <option value="">-- Seleccione --</option>
                <?php foreach ($this->bancos AS $banco):?>
                <option value="<?= $banco['id_ban']?>"><?= $banco['nombre_ban']?> - <?= $banco['numero_cuenta_ban']?></option>
                <?php endforeach;?>
              </select>
            </div>
            <button class="btn btn-info" type="submit">Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php endif;?>
</div>
<!--
<div class="form-group">
  <label class="col-sm-3 col-sm-3 control-label">C&eacute;dula:</label>
  <div class="col-sm-9">
    <input type="text" autofocus required class="form-control" pattern="<?= $_validationRegex['cedula']?>" title="<?= $_validationTitle['cedula']?>" id="socio_mov" name="socio_mov" placeholder="Introduzca la C&eacute;dula o RIF del Socio" value="<?php if (isset($this->datos["socio_mov"])): echo $this->datos["socio_mov"]; endif;?>">
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 col-sm-3 control-label">Referencia:</label>
  <div class="col-sm-9">
    <input type="text" class="form-control" pattern="<?= $_validationRegex['number']?>" title="<?= $_validationTitle['number']?>" id="referencia_mov" name="referencia_mov" placeholder="Introduzca la Referencia" value="<?php if (isset($this->datos["referencia_mov"])): echo $this->datos["referencia_mov"]; endif;?>">
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 col-sm-3 control-label">Fecha:</label>
  <div class="col-sm-9">
    <input type="date" required class="form-control" id="fecha_mov" name="fecha_mov" placeholder="Introduzca los Nombres" value="<?php if (isset($this->datos["fecha_mov"])): echo $this->datos["fecha_mov"]; endif;?>">
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 col-sm-3 control-label">Tipo de Retiro:</label>
  <div class="col-sm-9">
    <select name="tipo_retiro" required class="form-control">
      <option value="">-- Seleccione --</option>
      <option>Patrono</option>
      <option>Socio</option>
      <option>Voluntario</option>
    </select>
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 col-sm-3 control-label">Forma de Pago:</label>
  <div class="col-sm-9">
    <select name="forma_mov" required class="form-control">
      <option value="">-- Seleccione --</option>
      <option>Deposito</option>
      <option>Cheque</option>
      <option>Transferencia</option>
    </select>
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 col-sm-3 control-label">Banco:</label>
  <div class="col-sm-9">
    <select name="banco_mov" required class="form-control">
      <option value="">-- Seleccione --</option>
      <?php foreach ($this->bancos AS $banco):?>
      <option value="<?= $banco['id_ban']?>"><?= $banco['nombre_ban']?> - <?= $banco['numero_cuenta_ban']?></option>
      <?php endforeach;?>
    </select>
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 col-sm-3 control-label">Monto:</label>
  <div class="col-sm-9">
    <input type="text" class="form-control" pattern="<?= $_validationRegex['realTwo']?>" title="<?= $_validationTitle['realTwo']?>" id="monto_mov" name="monto_mov" placeholder="Introduzca el Monto" value="<?php if (isset($this->datos["monto_mov"])): echo $this->datos["monto_mov"]; endif;?>">
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 col-sm-3 control-label">Nota:</label>
  <div class="col-sm-9">
    <textarea class="form-control" pattern="<?= $_validationRegex['alphanum']?>" title="<?= $_validationTitle['alphanum']?>" id="nota_mov" name="nota_mov" placeholder="Introduzca la Nota"><?php if (isset($this->datos["nota_mov"])): echo $this->datos["nota_mov"]; endif;?></textarea>
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 col-sm-3 control-label">Estado del Movimiento:</label>
  <div class="col-sm-9">
    <select class="form-control" required id="estado_mov" name="estado_mov">
      <option value="">-- Seleccione --</option>
      <option>En Proceso</option>
      <option>Rechazado</option>
      <option>Aceptado</option>
    </select>
  </div>
</div>
-->