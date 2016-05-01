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
            <input autofocus type="text" required class="form-control" pattern="<?= $_validationRegex['codigoNum']?>" title="<?= $_validationTitle['codigoNum']?>" id="codigo_ban" name="codigo_ban" placeholder="Introduzca el C&oacute;digo" value="<?php if (isset($this->datos["codigo_ban"])): echo $this->datos["codigo_ban"]; endif;?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Banco</label>
          <div class="col-sm-9">
            <input type="text" required class="form-control" pattern="<?= $_validationRegex['text']?>" title="<?= $_validationTitle['text']?>" id="nombre_ban" name="nombre_ban" placeholder="Introduzca el Nombre del Banco" value="<?php if (isset($this->datos["nombre_ban"])): echo $this->datos["nombre_ban"]; endif;?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">N&uacute;mero de Cuenta<br><small>(Caja de Ahorro)</small></label>
          <div class="col-sm-9">
            <input type="text" required class="form-control" pattern="<?= $_validationRegex['account_bank']?>" title="<?= $_validationTitle['account_bank']?>" id="numero_cuenta_ban" name="numero_cuenta_ban" placeholder="Introduzca el N&uacute;mero de Cuenta" value="<?php if (isset($this->datos["numero_cuenta_ban"])): echo $this->datos["numero_cuenta_ban"]; endif;?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Tipo de Cuenta</label>
          <div class="col-sm-9">
            <select class="form-control" required id="tipo_cuenta_ban" name="tipo_cuenta_ban">
                <option value="">-- Seleccione --</option>
                <option <?php if ($this->datos['tipo_cuenta_ban'] == 'Corriente'):?>selected<?php endif;?>>Corriente</option>
                <option <?php if ($this->datos['tipo_cuenta_ban'] == 'Ahorro'):?>selected<?php endif;?>>Ahorro</option>
            </select>
          </div>
        </div>
        <div style="margin: 9px 0 5px;" class="btn-group">
          <button class="btn btn-info" type="submit">Guardar</button>
          <a href="<?= BASE_URL?>banco/index" class="btn btn-info">Volver</a>
        </div>
      </form>
    </div>
  </div>
</div>
<!--body wrapper end-->
