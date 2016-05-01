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
            <input type="text" readonly pattern="<?= $_validationRegex['codigoSoc']?>" title="<?= $_validationTitle['codigoSoc']?>" class="form-control" id="codigo_soc" name="codigo_soc" placeholder="Introduzca el C&oacute;digo" value="<?php if (isset($this->datos["codigo_soc"])): echo $this->datos["codigo_soc"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">C&eacute;dula:</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" pattern="<?= $_validationRegex['cedula']?>" title="<?= $_validationTitle['cedula']?>" id="cedula_rif_soc" name="cedula_rif_soc" placeholder="Introduzca la C&eacute;dula o RIF" value="<?php if (isset($this->datos["cedula_rif_soc"])): echo $this->datos["cedula_rif_soc"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Apellidos:</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" pattern="<?= $_validationRegex['text']?>" title="<?= $_validationTitle['text']?>" id="apellidos_soc" name="apellidos_soc" placeholder="Introduzca los Apellidos" value="<?php if (isset($this->datos["apellidos_soc"])): echo $this->datos["apellidos_soc"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Nombres:</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" pattern="<?= $_validationRegex['text']?>" title="<?= $_validationTitle['text']?>" id="nombres_soc" name="nombres_soc" placeholder="Introduzca los Nombres" value="<?php if (isset($this->datos["nombres_soc"])): echo $this->datos["nombres_soc"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Tel&eacute;fono:</label>
          <div class="col-sm-9">
            <input type="tel" class="form-control" pattern="<?= $_validationRegex['phone']?>" title="<?= $_validationTitle['phone']?>" id="telefono_soc" name="telefono_soc" placeholder="Introduzca el Tel&eacute;fono" value="<?php if (isset($this->datos["telefono_soc"])): echo $this->datos["telefono_soc"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Otro Tel&eacute;fono:</label>
          <div class="col-sm-9">
            <input type="tel" class="form-control" pattern="<?= $_validationRegex['phone']?>" title="<?= $_validationTitle['phone']?>" id="telefono2_soc" name="telefono2_soc" placeholder="Introduzca Otro Tel&eacute;fono" value="<?php if (isset($this->datos["telefono2_soc"])): echo $this->datos["telefono2_soc"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Direcci&oacute;n:</label>
          <div class="col-sm-9">
            <textarea class="form-control" pattern="<?= $_validationRegex['alphanum']?>" title="<?= $_validationTitle['alphanum']?>" id="direccion_soc" name="direccion_soc" placeholder="Introduzca la Direcci&oacute;n"><?php if (isset($this->datos["direccion_soc"])): echo $this->datos["direccion_soc"]; endif;?></textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Tipo:</label>
          <div class="col-sm-9">
            <select required class="form-control" id="tipo_soc" name="tipo_soc">
              <option value="">-- Seleccione --</option>
              <option <?php if (isset($this->datos['tipo_soc']) && $this->datos['tipo_soc'] == 'Fijo'):?>selected<?php endif;?>>Fijo</option>
              <option <?php if (isset($this->datos['tipo_soc']) && $this->datos['tipo_soc']== 'Contratado'):?>selected<?php endif;?>>Contratado</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Categoria:</label>
          <div class="col-sm-9">
            <select class="form-control" required id="categoria_soc" name="categoria_soc">
              <option value="">-- Seleccione --</option>
              <?php foreach ($this->categorias AS $categoria):?>
              <option value="<?= $categoria['id_cat']?>" <?php if (isset($this->datos['categoria_soc']) && $categoria['id_cat'] == $this->datos['categoria_soc']):?>selected<?php endif;?>><?= $categoria['nombre_cat']?></option>
              <?php endforeach;?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Departamento:</label>
          <div class="col-sm-9">
            <select class="form-control" id="departamento_soc" name="departamento_soc">
              <option value="">-- Seleccione --</option>
              <?php foreach ($this->departamentos AS $departamento):?>
              <option value="<?= $departamento['id_dep']?>" <?php if ($this->datos['departamento_soc'] == $departamento['id_dep']):?>selected<?php endif;?>><?= $departamento['nombre_dep']?></option>
              <?php endforeach;?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Sueldo:</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" pattern="<?= $_validationRegex['real']?>" title="<?= $_validationTitle['real']?>" id="sueldo_soc" name="sueldo_soc" placeholder="Introduzca el Sueldo" value="<?php if (isset($this->datos["sueldo_soc"])): echo $this->datos["sueldo_soc"]; endif;?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Aporte del Patrono:</label>
          <div class="col-sm-9">
            <input type="text" readonly class="form-control" id="aporte_patrono_soc" name="aporte_patrono_soc" placeholder="Introduzca el Aporte Patrono" value="<?php if (isset($this->datos["aporte_patrono_soc"])): echo $this->datos["aporte_patrono_soc"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Aporte del Socio:</label>
          <div class="col-sm-9">
            <input type="text" readonly class="form-control" id="aporte_socio_soc" name="aporte_socio_soc" placeholder="Introduzca el Aporte Socio" value="<?php if (isset($this->datos["aporte_socio_soc"])): echo $this->datos["aporte_socio_soc"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Banco del Socio:</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" pattern="<?= $_validationRegex['text']?>" title="<?= $_validationTitle['text']?>" id="banco_soc" name="banco_soc" placeholder="Introduzca el Banco" value="<?php if (isset($this->datos["banco_soc"])): echo $this->datos["banco_soc"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Tipo de Cuenta Bancaria:</label>
          <div class="col-sm-9">
            <select class="form-control" id="tipo_cuenta_soc" name="tipo_cuenta_soc">
              <option value="">-- Seleccione --</option>
              <option <?php if ($this->datos['tipo_cuenta_soc'] == 'Corriente'):?>selected<?php endif;?>>Corriente</option>
              <option <?php if ($this->datos['tipo_cuenta_soc'] == 'Ahorro'):?>selected<?php endif;?>>Ahorro</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">N&uacute;mero de la Cuenta Bancaria:</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" pattern="<?= $_validationRegex['account_bank']?>" title="<?= $_validationTitle['account_bank']?>" id="numero_cuenta_soc" name="numero_cuenta_soc" placeholder="Introduzca el N&uacute;mero de Cuenta" value="<?php if (isset($this->datos["numero_cuenta_soc"])): echo $this->datos["numero_cuenta_soc"]; endif;?>">
          </div>
        </div>
        <div style="margin: 9px 0 5px;" class="btn-group">
          <button class="btn btn-info" type="submit">Guardar</button>
          <a href="<?= BASE_URL?>socio/index" class="btn btn-info">Volver al Listado</a>
        </div>
      </form>
    </div>
  </div>
</div>
<!--body wrapper end-->
