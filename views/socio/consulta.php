<!--body wrapper start-->
<div class="wrapper">
  <div class="row">
    <div class="col-md-12">
      <h3 class="text-center"><?= $this->titulo?> <a href="<?= BASE_URL?>socio/index" class="btn btn-info" style="float: right">Volver al Listado</a></h3>
      <br>
      <div class="col-md-3 col-md-offset-1">
        <dl>
          <dt>C&oacute;digo:</dt>
          <dd><?= $this->datos['codigo_soc'];?></dd>
          <dt>C&eacute;dula:</dt>
          <dd><?= $this->Cedula($this->datos['cedula_rif_soc']);?></dd>
          <dt>Apellidos:</dt>
          <dd><?= $this->datos['apellidos_soc'];?></dd>
          <dt>Nombres:</dt>
          <dd><?= $this->datos['nombres_soc'];?></dd>
          <dt>Tel&eacute;fono:</dt>
          <dd><?= $this->Telefono($this->datos['telefono_soc']);?></dd>
          <?php if ($this->datos['telefono2_soc'] != ''):?>
          <dt>Otro Tel&eacute;fono:</dt>
          <dd><?= $this->Telefono($this->datos['telefono2_soc']);?></dd>
          <?php endif;?>
        </dl>
      </div>
      <div class="col-md-3">
        <dl>
          <?php if ($this->datos['direccion_soc'] != ''):?>
          <dt>Direcci&oacute;n:</dt>
          <dd><?= $this->datos['direccion_soc'];?></dd>
          <?php endif;?>
          <dt>Tipo:</dt>
          <dd><?= $this->datos['tipo_soc'];?></dd>
          <dt>Categoria:</dt>
          <dd><?= $this->datos['nombre_cat'];?></dd>
          <dt>Departamento:</dt>
          <dd><?= $this->datos['codigo_dep']?> <?= $this->datos['nombre_dep'];?></dd>
          <dt>Sueldo:</dt>
          <dd><?= $this->Dinero($this->datos['sueldo_soc']);?></dd>
        </dl>
      </div>
      <div class="col-md-3">
        <dl>
          <dt>Aporte Patrono:</dt>
          <dd><?= $this->Dinero($this->datos['aporte_patrono_soc']);?> ~ 10 % del Sueldo</dd>
          <dt>Aporte Socio:</dt>
          <dd><?= $this->Dinero($this->datos['aporte_socio_soc']);?> ~ 10 % del Sueldo</dd>
          <dt>Banco <small>(Socio)</small>:</dt>
          <dd><?= $this->datos['banco_soc']?></dd>
          <dt>Tipo de Cuenta Bancaria:</dt>
          <dd><?= $this->datos['tipo_cuenta_soc']?></dd>
          <dt>N&uacute;mero de Cuenta:</dt>
          <dd><?= $this->datos['numero_cuenta_soc']?></dd>
        </dl>
      </div>
    </div>
  </div>
  <div class="row">
    <h3 class="text-center">Informaci&oacute;n de Haberes</h3>
    <div class="col-md-4 col-md-offset-2">
      <dl>
        <dt>Ahorros Acumulados Socio:</dt>
        <dd><?= $this->Dinero($this->ahorros['ahorros_socio']); ?></dd>
        <dt>Ahorros Acumulados Patrono:</dt>
        <dd><?= $this->Dinero($this->ahorros['ahorros_patrono']); ?></dd>
        <dt>Ahorros Acumulados Voluntarios:</dt>
        <dd><?= $this->Dinero($this->ahorros['ahorros_voluntarios']); ?></dd>
        <dt>Total de Ahorros Acumulados:</dt>
        <dd><?= $this->Dinero($this->ahorros['total_ahorros']); ?></dd>
        <dt>Total General de Ahorros Acumulados:</dt>
        <dd><?= $this->Dinero($this->ahorros['total']); ?></dd>
      </dl>
    </div>
    <div class="col-md-4">
      <dl>
        <dt>Retiros Acumulados Socio:</dt>
        <dd><?= $this->Dinero($this->ahorros['retiros_socio']); ?></dd>
        <dt>Retiros Acumulados Patrono:</dt>
        <dd><?= $this->Dinero($this->ahorros['retiros_patrono']); ?></dd>
        <dt>Retiros Acumulados Voluntarios:</dt>
        <dd><?= $this->Dinero($this->ahorros['retiros_voluntarios']); ?></dd>
        <dt>Total de Retiros Acumulados:</dt>
        <dd><?= $this->Dinero($this->ahorros['total_retiros']); ?></dd>
        <dt>Disponible <?= DISPONIBILIDAD * 100?> % de Ahorros Acumulados:</dt>
        <dd><?= $this->Dinero($this->ahorros['total_disponible']); ?></dd>
      </dl>
    </div>
  </div>
</div>