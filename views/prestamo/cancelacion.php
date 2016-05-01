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
          <?php for ($i = 0; $i < count($this->prestamos); $i++):?>
            <tr>
              <td class="text-center"><?= $this->Fecha($this->prestamos[$i]['fecha_aprobacion_pre'])?></td>
              <td class="text-right"><?= $this->Dinero($this->prestamos[$i]['monto_pre']); ?></td>
              <td class="text-right"><?= $this->Dinero($this->prestamos[$i]['total_pagado']); ?></td>
              <td class="text-center"><?= $this->prestamos[$i]['estado_pre']?></td>
              <td class="text-center">
                <a id="btn_cancelacion" href="#myModal" data-id="<?= $this->prestamos[$i]['id_pre'];?>" data-capital="<?= ($this->prestamos[$i]['monto_pre'] - $this->prestamos[$i]['total_pagado']);?>" data-interes="<?= ($this->prestamos[$i]['monto_pre'] - $this->prestamos[$i]['total_pagado']) * ($this->prestamos[$i]['interes_pre'] / 100)?>" data-toggle="modal" data-placement="top" title="Cancelar" class="btn btn-info btn-xs"><span class="fa fa-times"></span></a>
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
          <h4 class="modal-title">Cancelaci&oacute;n del Prestamo</h4>
        </div>
        <div class="modal-body">
          <form id="formCancelacion" role="form" method="post" action="<?= BASE_URL?>prestamo/cancelarPrestamo">
            <input type="hidden" id="id_prestamo" name="id_prestamo" value="" />
            <input type="hidden" id="monto" name="monto" value="" />
            <div  class="form-group">
              <label for="fecha_cancelacion">Fecha de Cancelaci&oacute;n:</label>
              <input type="date" required class="form-control" id="fecha_cancelacion" name="fecha_cancelacion" placeholder="Introduzca la Fecha de Cancelaci&oacite;n" value="<?php if (isset($this->datos["fecha_cancelacion"])): echo $this->datos["fecha_cancelacion"]; else: echo Date('Y-m-d'); endif;?>">
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
<!--body wrapper end-->