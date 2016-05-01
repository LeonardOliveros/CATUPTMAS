<!--body wrapper start-->
<div class="wrapper">
  <?php if (!$this->resultado):?>
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <form class="form-horizontal adminex-form" method="post">
        <h1 class="text-center"><?= $this->titulo?></h1>
        <br>
        <input type='hidden' name='guardar' value='1'>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Generar:</label>
          <div class="col-sm-9">
            <select class="form-control" id="salida" name="salida">
              <option>Listar</option>
              <option>PDF</option>
              <option>Individual</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">C&eacute;dula:</label>
          <div class="col-sm-9">
            <input type="text" autofocus class="form-control" id="cedula" name="cedula" placeholder="Introduzca la C&eacute;dula o RIF del Socio" value="<?php if (isset($this->datos["cedula"])): echo $this->datos["cedula"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Plazo del Prestamo:</label>
          <div class="col-sm-9">
            <select name="plazo" class="form-control">
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
            <input type="text" class="form-control" id="interes" name="interes" placeholder="Introduzca la Tasa de Inter&eacute;s" value="<?php if (isset($this->datos["interes"])): echo $this->datos["interes"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Fecha de Solicitud:</label>
          <div class="col-sm-9">
            <input type="date" class="form-control" id="fecha_solicitud" name="fecha_solicitud" placeholder="Introduzca la Fecha de Solicitud" value="<?php if (isset($this->datos["fecha_solicitud"])): echo $this->datos["fecha_solicitud"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Fecha de Aprobaci&oacute;n:</label>
          <div class="col-sm-9">
            <input type="date" class="form-control" id="fecha_aprobacion" name="fecha_aprobacion" placeholder="Introduzca la Fecha de Aprobaci&oacute;n" value="<?php if (isset($this->datos["fecha_aprobacion"])): echo $this->datos["fecha_aprobacion"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Fecha del Primer Pago:</label>
          <div class="col-sm-9">
            <input type="date" class="form-control" id="fecha_primer_pago" name="fecha_primer_pago" placeholder="Introduzca la Fecha de Aprobaci&oacute;n" value="<?php if (isset($this->datos["fecha_primer_pago"])): echo $this->datos["fecha_primer_pago"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Tipo de Prestamo:</label>
          <div class="col-sm-9">
            <select class="form-control" id="tipo_prestamo" name="tipo_prestamo">
              <option value="">-- Seleccione --</option>
              <option>Normal</option>
              <option>Especial</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Estado del Prestamo:</label>
          <div class="col-sm-9">
            <select class="form-control" id="estado" name="estado">
              <option value="">-- Seleccione --</option>
              <option>En Proceso</option>
              <option>Activo</option>
              <option>Rechazado</option>
              <option>Finalizado</option>
            </select>
          </div>
        </div>
        <div style="margin: 9px 0 5px;" class="btn-group">
          <button class="btn btn-info" type="submit">Generar</button>
          <a href="<?= BASE_URL?>index" class="btn btn-info">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
  <?php else:?>
  <div class="row">
    <div class="col-md-12">
      <div class="adv-table">
        <table  class="display table table-bordered table-striped" id="dynamic-table">
          <caption><h1><?= $this->titulo?></h1></caption>
          <thead>
            <tr>
              <th>Socio</th>
              <th class="text-center">Fecha de Solicitud</th>
              <th class="text-center">Fecha de Aprobaci&acute;.on</th>
              <th class="text-center">Tipo de Prestamo</th>
              <th class="text-center">Monto</th>
              <th class="text-center">Pagado</th>
              <th class="text-center">Estado</th>
              <th class="text-center"><a href="<?= BASE_URL?>prestamo/nuevo" class="btn btn-info">Agregar Nuevo</a></th>
            </tr>
          </thead>
          <tbody>
          <?php for ($i = 0; $i < count($this->listado); $i++):?>
            <tr>
              <td><?= $this->Cedula($this->listado[$i]['cedula_rif_soc']);?></br><?= $this->listado[$i]['apellidos_soc']; ?> <?= $this->listado[$i]['nombres_soc']?></td>
              <td class="text-center"><?= $this->Fecha($this->listado[$i]['fecha_solicitud_pre']); ?></td>
              <td class="text-center"><?= $this->Fecha($this->listado[$i]['fecha_aprobacion_pre']); ?></td>
              <td class="text-center"><?= $this->listado[$i]['tipo_prestamo_pre']; ?></td>
              <td class="text-center"><?= $this->Dinero($this->listado[$i]['monto_pre']); ?></td>
              <td class="text-center"><?= $this->Dinero($this->listado[$i]['total_pagado'])?></td>
              <td class="text-center"><?= $this->listado[$i]['estado_pre']?></td>
              <td class="text-center">
                <a href="<?= BASE_URL?>reporte/prestamo/<?= $this->listado[$i]['id_pre']?>" data-toggle="tooltip" data-placement="top" title="Imprimir" class="btn btn-info btn-xs"><span class="fa fa-print"></span></a>&nbsp;
                <a href="<?= BASE_URL?>prestamo/consulta/<?= $this->listado[$i]['id_pre']?>" data-toggle="tooltip" data-placement="top" title="Consultar" class="btn btn-info btn-xs"><span class="fa fa-search"></span></a>&nbsp;
                <a href="<?= BASE_URL?>prestamo/editar/<?= $this->listado[$i]['id_pre']?>" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></a>&nbsp;
                <a href="<?= BASE_URL?>prestamo/elimina/<?= $this->listado[$i]['id_pre']?>" data-toggle="tooltip" data-placement="top" title="Borrar" class="btn btn-info btn-xs"><span class="fa fa-trash-o"></span></a>
              </td>
            </tr>
          <?php endfor;?>
          </tbody>
          <tfoot>
            <tr>
              <th>Socio</th>
              <th class="text-center">Fecha de Solicitud</th>
              <th class="text-center">Fecha de Aprobaci&oacute;n</th>
              <th class="text-center">Tipo de Prestamo</th>
              <th class="text-center">Monto</th>
              <th class="text-center">Pagado</th>
              <th class="text-center">Estado</th>
              <th class="text-center"><a href="<?= BASE_URL?>prestamo/nuevo" class="btn btn-info">Agregar Nuevo</a></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  <?php endif;?>
</div>
