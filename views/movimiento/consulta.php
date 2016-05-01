<!--body wrapper start-->
<div class="wrapper">
  <div class="row">
    <div class="col-md-12">
      <h3 class="text-center"><?= $this->titulo?> <a href="<?= BASE_URL?>movimiento/index" class="btn btn-info" style="float: right">Volver al Listado</a></h3>
      <br>
      <div class="col-md-6 col-md-offset-3">
        <dl>
          <dt>Socio:</dt>
          <dd><?= $this->Cedula($this->datos['cedula_rif_soc']);?> - <?= $this->datos['apellidos_soc']?> <?= $this->datos['nombres_soc']?></dd>
          <dt>Referencia:</dt>
          <dd><?= $this->datos['referencia_mov'];?></dd>
          <dt>Fecha:</dt>
          <dd><?= $this->datos['fecha_mov'];?></dd>
          <dt>Tipo de Movimiento:</dt>
          <dd><?= $this->datos['tipo_mov'];?></dd>
          <dt>Forma de Pago:</dt>
          <dd><?= $this->datos['forma_mov'];?></dd>
          <dt>Banco:</dt>
          <dd><?= $this->datos['nombre_ban']?></dd>
          <dt>Monto:</dt>
          <dd><?= $this->Dinero($this->datos['monto_mov']);?></dd>
          <dt>Nota:</dt>
          <dd><?= $this->datos['nota_mov'];?></dd>
          <dt>Estado del Movimiento:</dt>
          <dd><?= $this->datos['estado_mov'];?></dd>
        </dl>
      </div>
    </div>
  </div>
</div>
