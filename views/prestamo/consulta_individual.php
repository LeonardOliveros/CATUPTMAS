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
            <input type="text" autofocus required class="form-control" pattern="<?= $_validationRegex['codigoSoc']?>" title="<?= $_validationTitle['codigoSoc']?>" id="codigo_pre" name="codigo_pre" placeholder="Introduzca la C&oacute;digo del Prestamo" value="<?php if (isset($this->datos["codigo_pre"])): echo $this->datos["codigo_pre"]; endif;?>">
          </div>
        </div>
        <div style="margin: 9px 0 5px;" class="btn-group">
          <button class="btn btn-info" type="submit">Buscar</button>
          <a href="<?= BASE_URL?>prestamo/index" class="btn btn-info">Volver al Listado</a>
        </div>
      </form>
    </div>
  </div>
</div>
<!--body wrapper end-->