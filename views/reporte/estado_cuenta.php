<!--body wrapper start-->
<div class="wrapper">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <form class="form-horizontal adminex-form" method="post">
        <h1 class="text-center"><?= $this->titulo?></h1>
        <br>
        <input type='hidden' name='guardar' value='1'>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">De:</label>
          <div class="col-sm-9">
            <select class="form-control" id="salida" name="salida">
                <option>Caja de Ahorro</option>
                <option>Socio</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">C&eacute;dula del Socio:</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Introduzca la C&eacute;dula o RIF del Socio" value="<?php if (isset($this->datos["cedula"])): echo $this->datos["cedula"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Tipo de Movimiento:</label>
          <div class="col-sm-9">
            <select class="form-control" id="tipo" name="tipo">
                <option value="">-- General --</option>
                <option>Deposito - Voluntario</option>
                <option>Retiro - Patrono</option>
                <option>Retiro - Socio</option>
                <option>Retiro - Voluntario</option>
                <option>Pago Prestamo</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Forma de Pago:</label>
          <div class="col-sm-9">
            <select name="forma" class="form-control">
                <option value="">-- General --</option>
                <option>Deposito</option>
                <option>Cheque</option>
                <option>Transferencia</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Hasta la Desde:</label>
          <div class="col-sm-9">
            <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Introduzca la Fecha Desde" value="<?php if (isset($this->datos["fecha"])): echo $this->datos["fecha"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Hasta la Fecha:</label>
          <div class="col-sm-9">
            <input type="date" class="form-control" id="fecha2" name="fecha2" placeholder="Introduzca la Fecha Hasta" value="<?php if (isset($this->datos["fecha2"])): echo $this->datos["fecha2"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Banco:</label>
          <div class="col-sm-9">
            <select name="banco" class="form-control">
                <option value="">-- General --</option>
                <?php foreach ($this->bancos AS $banco):?>
                <option value="<?= $banco['id_ban']?>"><?= $banco['nombre_ban']?> - <?= $banco['numero_cuenta_ban']?></option>
                <?php endforeach;?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Estado del Movimiento:</label>
          <div class="col-sm-9">
            <select class="form-control" id="estado" name="estado">
                <option value="">-- General --</option>
                <option>En Proceso</option>
                <option>Rechazado</option>
                <option>Aceptado</option>
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
</div>
<!--body wrapper end-->
