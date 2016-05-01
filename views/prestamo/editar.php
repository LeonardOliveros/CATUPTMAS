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
            <input type="text" autofocus class="form-control" id="socio_pre" name="socio_pre" placeholder="Introduzca la C&eacute;dula o RIF del Socio" value="<?php if (isset($this->datos["socio_pre"])): echo $this->datos["socio_pre"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Monto:</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="monto_pre" name="monto_pre" placeholder="Introduzca el Monto" value="<?php if (isset($this->datos["monto_pre"])): echo $this->datos["monto_pre"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Plazo del Prestamo:</label>
          <div class="col-sm-9">
            <select name="plazo_pre" class="form-control">
                <option value="">-- Seleccione --</option>
                <option <?php if ($this->datos['plazo_pre'] == 12):?>selected<?php endif;?>>12</option>
                <option <?php if ($this->datos['plazo_pre'] == 24):?>selected<?php endif;?>>24</option>
                <option <?php if ($this->datos['plazo_pre'] == 36):?>selected<?php endif;?>>36</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Tasa de Inter&eacute;s:</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="interes_pre" name="interes_pre" placeholder="Introduzca la Tasa de Inter&eacute;s" value="<?php if (isset($this->datos["interes_pre"])): echo $this->datos["interes_pre"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Fecha de la Solicitud:</label>
          <div class="col-sm-9">
            <input type="date" class="form-control" id="fecha_solicitud_pre" name="fecha_solicitud_pre" placeholder="Introduzca la Fecha de Solicitud" value="<?php if (isset($this->datos["fecha_solicitud_pre"])): echo $this->datos["fecha_solicitud_pre"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Fecha de Aprobaci&oacute;n:</label>
          <div class="col-sm-9">
            <input type="date" class="form-control" id="fecha_aprobacion_pre" name="fecha_aprobacion_pre" placeholder="Introduzca la Fecha de Aprobaci&oacute;n" value="<?php if (isset($this->datos["fecha_aprobacion_pre"])): echo $this->datos["fecha_aprobacion_pre"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Fecha del Primer Pago:</label>
          <div class="col-sm-9">
            <input type="date" class="form-control" id="fecha_primer_pago_pre" name="fecha_primer_pago_pre" placeholder="Introduzca la Fecha de Aprobaci&oacute;n" value="<?php if (isset($this->datos["fecha_primer_pago_pre"])): echo $this->datos["fecha_primer_pago_pre"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Tipo de Prestamo:</label>
          <div class="col-sm-9">
            <select class="form-control" id="tipo_prestamo_pre" name="tipo_prestamo_pre">
                <option value="">-- Seleccione --</option>
                <option <?php if ($this->datos['tipo_prestamo_pre'] == 'Normal'):?>selected<?php endif;?>>Normal</option>
                <option <?php if ($this->datos['tipo_prestamo_pre'] == 'Especial'):?>selected<?php endif;?>>Especial</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Estado del Prestamo:</label>
          <div class="col-sm-9">
            <select class="form-control" id="estado_pre" name="estado_pre">
                <option value="">-- Seleccione --</option>
                <option <?php if ($this->datos['estado_pre'] == 'En Proceso'):?>selected<?php endif;?>>En Proceso</option>
                <option <?php if ($this->datos['estado_pre'] == 'Activo'):?>selected<?php endif;?>>Activo</option>
                <option <?php if ($this->datos['estado_pre'] == 'Rechazado'):?>selected<?php endif;?>>Rechazado</option>
                <option <?php if ($this->datos['estado_pre'] == 'Finalizado'):?>selected<?php endif;?>>Finalizado</option>
            </select>
          </div>
        </div>
        <div style="margin: 9px 0 5px;" class="btn-group">
          <button class="btn btn-info" type="submit">Guardar</button>
          <a href="<?= BASE_URL?>prestamo/index" class="btn btn-info">Volver al Listado</a>
        </div>
      </form>
    </div>
  </div>
</div>
<!--body wrapper end-->