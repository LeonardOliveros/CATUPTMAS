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
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Monto:</label>
          <div class="col-sm-9">
            <input type="text" required class="form-control" pattern="<?= $_validationRegex['real']?>" title="<?= $_validationTitle['real']?>" id="monto_pre" name="monto_pre" placeholder="Introduzca el Monto" value="<?php if (isset($this->datos["monto_pre"])): echo $this->datos["monto_pre"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Plazo del Prestamo:</label>
          <div class="col-sm-9">
            <select name="plazo_pre" required class="form-control">
                <option value="">-- Seleccione --</option>
                <?php foreach($this->plazos_prestamos AS $pp):?>
                <option value="<?= $pp['id_pla_pre']?>"><?= $pp['nombre_pla_pre']?>, Meses: <?= $this->Cantidad($pp['meses_pla_pre'])?></option>
                <?php endforeach;?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Tipo de Prestamo:</label>
          <div class="col-sm-9">
            <select class="form-control" required id="tipo_prestamo_pre" name="tipo_prestamo_pre">
              <option value="">-- Seleccione --</option>
              <?php foreach($this->tipos_prestamos AS $tp):?>
              <option value="<?= $tp['id_tip_pre']?>"><?= $tp['nombre_tip_pre']?>, Tasa de Interes: <?= $this->Decimal($tp['interes_tip_pre'])?> %</option>
              <?php endforeach;?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Fecha de la Solicitud:</label>
          <div class="col-sm-9">
            <input type="date" required class="form-control" id="fecha_solicitud_pre" name="fecha_solicitud_pre" placeholder="Introduzca la Fecha de Solicitud" value="<?php if (isset($this->datos["fecha_solicitud_pre"])): echo $this->datos["fecha_solicitud_pre"]; endif;?>">
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