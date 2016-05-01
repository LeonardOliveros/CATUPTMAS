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
          <a href="<?= BASE_URL?>prestamo/index" class="btn btn-info">Volver al Listado</a>
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
              <th class="text-center">Fecha de Solicitud</th>
              <th>Monto</th>
              <th class="text-center">Estado</th>
              <th class="text-center"></th>
            </tr>
          </thead>
          <tbody>
          <?php for ($i = 0; $i < count($this->prestamos); $i++):?>
            <tr>
              <td class="text-center"><?= $this->Fecha($this->prestamos[$i]['fecha_solicitud_pre'])?></td>
              <td class="text-right"><?= $this->Dinero($this->prestamos[$i]['monto_pre']); ?></td>
              <td class="text-center"><?= $this->prestamos[$i]['estado_pre']?></td>
              <td class="text-center">
                <a href="<?= BASE_URL?>prestamo/consulta/<?= $this->prestamos[$i]['id_pre']?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Cambiar Rol" class="btn btn-info btn-xs"><span class="fa fa-search"></span></a>&nbsp;
                <a id="btn_otorgamiento" href="#myModal" data-id="<?= $this->prestamos[$i]['id_pre']?>" data-toggle="modal" data-placement="top" title="Cambiar Estado" class="btn btn-info btn-xs"><span class="fa fa-refresh"></span></a>
              </td>
            </tr>
            <?php endfor;?>
          </tbody>
          <tfoot>
            <tr>
              <th class="text-center">Fecha de Solicitud</th>
              <th class="text-center">Monto</th>
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
          <h4 class="modal-title">Cambiar Estado del Prestamo</h4>
        </div>
        <div class="modal-body">
          <form id="formCambiarEstado" role="form" method="post" action="<?= BASE_URL?>prestamo/cambiarEstado">
            <input type="hidden" id="id_prestamo" name="id_prestamo" value="" />
            <div class="form-group">
              <label for="estado_pre">Estado</label>
              <select id="estado_otorgamiento" name="estado_pre" required class="form-control">
                <option value="">-- Seleccione --</option>
                <option value="Activo">Otorgar</option>
                <option value="Rechazado">Rechazar</option>
              </select>
            </div>
            <div id="div_fecha_otorgamiento" class="hidden">
              <div  class="form-group">
                <label for="codigo_pre">C&oacute;digo del Prestamo:</label>
                <input type="text" required class="form-control" pattern="<?= $_validationRegex['codigoSoc']?>" title="<?= $_validationTitle['codigoSoc']?>" id="codigo_pre" name="codigo_pre" placeholder="Introduzca el C&oacute;digo del Prestamo" value="<?php if (isset($this->datos["codigo_pre"])): echo $this->datos["codigo_pre"]; endif;?>">
              </div>
              <div  class="form-group">
                <label for="fecha_aprobacion_pre">Fecha de Otorgamiento</label>
                <input type="date" required class="form-control" id="fecha_aprobacion_pre" name="fecha_aprobacion_pre" placeholder="Introduzca la Fecha de Aprobacion" value="<?php if (isset($this->datos["fecha_aprobacion_pre"])): echo $this->datos["fecha_aprobacion_pre"]; endif;?>">
              </div>
              <div class="form-group">
                <label for="fecha_primer_pago_pre">Fecha del Primer Pago</label>
                <input type="date" required class="form-control" id="fecha_primer_pago_pre" name="fecha_primer_pago_pre" placeholder="Introduzca la Fecha del Primer Pago" value="<?php if (isset($this->datos["fecha_primer_pago_pre"])): echo $this->datos["fecha_primer_pago_pre"]; endif;?>">
              </div>
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