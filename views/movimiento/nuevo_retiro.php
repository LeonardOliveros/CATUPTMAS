<!--body wrapper start-->
<div class="wrapper">
  <div class="row">
    <div class="col-md-6 col-md-offset-1">
      <form class="form-horizontal adminex-form" method="post">
        <h1 class="text-center"><?= $this->titulo?></h1>
        <br>
        <input type='hidden' name='guardar' value='1'>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">C&eacute;dula:</label>
          <div class="col-sm-9">
            <input type="text" autofocus required class="form-control" pattern="<?= $_validationRegex['cedula']?>" title="<?= $_validationTitle['cedula']?>" id="socio_mov" name="socio_mov" placeholder="Introduzca la C&eacute;dula o RIF del Socio" value="<?php if (isset($this->datos["socio_mov"])): echo $this->datos["socio_mov"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Referencia:</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" pattern="<?= $_validationRegex['number']?>" title="<?= $_validationTitle['number']?>" id="referencia_mov" name="referencia_mov" placeholder="Introduzca la Referencia" value="<?php if (isset($this->datos["referencia_mov"])): echo $this->datos["referencia_mov"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Fecha:</label>
          <div class="col-sm-9">
            <input type="date" required class="form-control" id="fecha_mov" name="fecha_mov" placeholder="Introduzca los Nombres" value="<?php if (isset($this->datos["fecha_mov"])): echo $this->datos["fecha_mov"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Tipo de Retiro:</label>
          <div class="col-sm-9">
            <select name="tipo_retiro" required class="form-control">
              <option value="">-- Seleccione --</option>
              <option>Patrono</option>
              <option>Socio</option>
              <option>Voluntario</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Forma de Pago:</label>
          <div class="col-sm-9">
            <select name="forma_mov" required class="form-control">
              <option value="">-- Seleccione --</option>
              <option>Deposito</option>
              <option>Cheque</option>
              <option>Transferencia</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Banco:</label>
          <div class="col-sm-9">
            <select name="banco_mov" required class="form-control">
              <option value="">-- Seleccione --</option>
              <?php foreach ($this->bancos AS $banco):?>
              <option value="<?= $banco['id_ban']?>"><?= $banco['nombre_ban']?> - <?= $banco['numero_cuenta_ban']?></option>
              <?php endforeach;?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Monto:</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" pattern="<?= $_validationRegex['realTwo']?>" title="<?= $_validationTitle['realTwo']?>" id="monto_mov" name="monto_mov" placeholder="Introduzca el Monto" value="<?php if (isset($this->datos["monto_mov"])): echo $this->datos["monto_mov"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Nota:</label>
          <div class="col-sm-9">
            <textarea class="form-control" pattern="<?= $_validationRegex['alphanum']?>" title="<?= $_validationTitle['alphanum']?>" id="nota_mov" name="nota_mov" placeholder="Introduzca la Nota"><?php if (isset($this->datos["nota_mov"])): echo $this->datos["nota_mov"]; endif;?></textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Estado del Movimiento:</label>
          <div class="col-sm-9">
            <select class="form-control" required id="estado_mov" name="estado_mov">
              <option value="">-- Seleccione --</option>
              <option>En Proceso</option>
              <option>Rechazado</option>
              <option>Aceptado</option>
            </select>
          </div>
        </div>
        <div style="margin: 9px 0 5px;" class="btn-group">
          <button class="btn btn-info" type="submit">Guardar</button>
          <a href="<?= BASE_URL?>movimiento/index" class="btn btn-info">Volver al Listado</a>
        </div>
      </form>
    </div>
    <div id="ahorros" class="col-md-3 hidden">
      <h3 class="text-center">Ahorros Disponibles:</h3>
      <dl>
        <dt>Socio:</dt>
        <dd id="socio"></dd>
        <br>
        <dt>Ahorros Acumulados Socio:</dt>
        <dd id="ahorros_socio">0,00 Bs.</dd>
        <dt>Ahorros Acumulados Patrono:</dt>
        <dd id="ahorros_patrono">0,00 Bs.</dd>
        <dt>Ahorros Acumulados Voluntario:</dt>
        <dd id="ahorros_voluntario">0,00 Bs.</dd>
        <dt>Total de Ahorros Acumulados:</dt>
        <dd id="total_ahorros">0,00 Bs.</dd>
        <br>
        <dt>Retiros Acumulados Socio:</dt>
        <dd id="retiros_socio">0,00 Bs.</dd>
        <dt>Retiros Acumulados Patrono:</dt>
        <dd id="retiros_patrono">0,00 Bs.</dd>
        <dt>Retiros Acumulados Voluntario:</dt>
        <dd id="retiros_voluntario">0,00 Bs.</dd>
        <dt>Total de Retiros Acumulados:</dt>
        <dd id="total_retiros">0,00 Bs.</dd>
        <br>
        <dt>Total General de Ahorros Acumulados:</dt>
        <dd id="total_haberes">0,00 Bs.</dd>
        <dt>Disponible 80% de Ahorros Acumulados:</dt>
        <dd id="total_disponible">0,00 Bs.</dd>
      </dl>
    </div>
    <div id="info_prestamo" class="col-md-3"></div>
  </div>
</div>
