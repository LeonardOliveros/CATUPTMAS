<!--body wrapper start-->
<div class="wrapper">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <form class="form-horizontal adminex-form" method="post">
        <h1 class="text-center"><?= $this->titulo?></h1>
        <br>
        <input type='hidden' name='guardar' value='1'>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">C&oacute;digo:</label>
          <div class="col-sm-9">
            <input type="text" autofocus pattern="<?= $_validationRegex['codigoSoc']?>" title="<?= $_validationTitle['codigoSoc']?>" class="form-control" id="codigo_soc" name="codigo_soc" placeholder="Introduzca el C&oacute;digo" value="<?php if (isset($this->datos["codigo_soc"])): echo $this->datos["codigo_soc"]; endif;?>">
          </div>
        </div>
        <div style="margin: 9px 0 5px;" class="btn-group">
          <button class="btn btn-info" type="submit">Guardar</button>
          <?php if(!$this->resultado):?>
            <a href="<?= BASE_URL?>socio/index" class="btn btn-info">Volver al Listado</a>
          <?php else:?>
            <a href="<?= BASE_URL?>socio/codigo" class="btn btn-info">Cerrar</a>
          <?php endif;?>
        </div>
      </form>
    </div>
  </div>
  <br>
  <?php if ($this->resultado):?>
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <form class="form-horizontal adminex-form" id="cambiarCodigo" method="post" action="<?= BASE_URL?>socio/cambiarCodigo">
        <input type="hidden" id="id" name="id" value="<?= $this->resultado['id_soc']?>" />
        <h3 class="text-center">Asignar Nuevo C&oacute;digo</h3>
        <br>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Socio:</label>
          <div class="col-sm-9">
            <input type="text" readonly class="form-control" id="socio" name="socio" placeholder="Socio" value="<?php if (isset($this->datos["socio"])): echo $this->datos["socio"]; else: echo $this->Cedula($this->resultado['cedula_rif_soc']) . ' ' . $this->resultado['apellidos_soc'] . ' ' . $this->resultado['nombres_soc']; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">C&oacute;digo Nuevo:</label>
          <div class="col-sm-9">
            <input type="text" required pattern="<?= $_validationRegex['codigoSoc']?>" title="<?= $_validationTitle['codigoSoc']?>" class="form-control" id="codigo_nuevo" name="codigo_nuevo" placeholder="Introduzca el Nuevo C&oacute;digo" value="<?php if (isset($this->datos["codigo_nuevo"])): echo $this->datos["codigo_nuevo"]; endif;?>">
          </div>
        </div>
        <div style="margin: 9px 0 5px;" class="btn-group">
            <button type="submit" class="btn btn-info">Cambiar</button>
        </div>
      </form>
    </div>
  </div>
  <?php endif;?>
</div>
<!--body wrapper end-->
