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
            <input type="text" readonly class="form-control" id="socio_mov" name="socio_mov" placeholder="Introduzca la C&eacute;dula o RIF del Socio" value="<?php if (isset($this->datos["cedula_rif_soc"])): echo $this->datos["cedula_rif_soc"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Referencia:</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="referencia_mov" name="referencia_mov" placeholder="Introduzca la Referencia" value="<?php if (isset($this->datos["referencia_mov"])): echo $this->datos["referencia_mov"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Fecha:</label>
          <div class="col-sm-9">
            <input type="date" class="form-control" id="fecha_mov" name="fecha_mov" placeholder="Introduzca los Nombres" value="<?php if (isset($this->datos["fecha_mov"])): echo $this->datos["fecha_mov"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Tipo de Movimiento:</label>
          <div class="col-sm-9">
            <select class="form-control" id="tipo_mov" name="tipo_mov">
                <option value="">-- Seleccione --</option>
                <option <?php if ($this->datos['tipo_mov'] == 'Deposito - Voluntario'):?>selected<?php endif;?>>Deposito - Voluntario</option>
                <option <?php if ($this->datos['tipo_mov'] == 'Retiro - Patrono'):?>selected<?php endif;?>>Retiro - Patrono</option>
                <option <?php if ($this->datos['tipo_mov'] == 'Retiro - Socio'):?>selected<?php endif;?>>Retiro - Socio</option>
                <option <?php if ($this->datos['tipo_mov'] == 'Retiro - Voluntario'):?>selected<?php endif;?>>Retiro - Voluntario</option>
                <option <?php if ($this->datos['tipo_mov'] == 'Pago Prestamo'):?>selected<?php endif;?>>Pago Prestamo</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Fecha:</label>
          <div class="col-sm-9">
            <input type="date" class="form-control" id="fecha_mov" name="fecha_mov" placeholder="Introduzca los Nombres" value="<?php if (isset($this->datos["fecha_mov"])): echo $this->datos["fecha_mov"]; endif;?>">
          </div>
        </div>
        <div id="div_prestamos" class="form-group hidden">
          <label class="col-sm-3 col-sm-3 control-label">Prestamos del Socio:</label>
          <div class="col-sm-9">
            <select class="form-control" id="prestamos" name="prestamos">
              <option value="">-- Seleccione --</option>
            </select>
          </div>
        </div>
        <div id="div_cuotas_prestamos" class="form-group hidden">
          <label class="col-sm-3 col-sm-3 control-label">Cuotas del Prestamo:</label>
          <div class="col-sm-9">
            <select class="form-control" id="cuotas_prestamos" name="cuotas_prestamos">
              <option value="">-- Seleccione --</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Forma de Pago:</label>
          <div class="col-sm-9">
            <select name="forma_mov" class="form-control">
              <option value="">-- Seleccione --</option>
              <option <?php if ($this->datos['forma_mov'] == 'Deposito'):?>selected<?php endif;?>>Deposito</option>
              <option <?php if ($this->datos['forma_mov'] == 'Cheque'):?>selected<?php endif;?>>Cheque</option>
              <option <?php if ($this->datos['forma_mov'] == 'Transferencia'):?>selected<?php endif;?>>Transferencia</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Banco:</label>
          <div class="col-sm-9">
            <select name="banco_mov" class="form-control">
              <option value="">-- Seleccione --</option>
              <?php foreach ($this->bancos AS $banco):?>
              <option value="<?= $banco['id_ban']?>" <?php if ($this->datos['banco_mov'] == $banco['id_ban']):?>selected<?php endif;?>><?= $banco['nombre_ban']?> - <?= $banco['numero_cuenta_ban']?></option>
              <?php endforeach;?>
            </select>
          </div>
        </div>
        <div id="monto">
          <div class="form-group">
            <label class="col-sm-3 col-sm-3 control-label">Monto:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="monto_mov" name="monto_mov" placeholder="Introduzca el Monto" value="<?php if (isset($this->datos["monto_mov"])): echo $this->datos["monto_mov"]; endif;?>">
            </div>
          </div>
          <br>
        </div>
        <div id="monto_prestamo" class="hidden">
          <div class="form-group">
            <label class="col-sm-3 col-sm-3 control-label">Abono a Capital:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="abono_capital" name="abono_capital" value="0" placeholder="Introduzca el Monto del Abono a Capital" value="<?php if (isset($this->datos["abono_capital"])): echo $this->datos["abono_capital"]; endif;?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 col-sm-3 control-label">Abono a Intereses:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="abono_interes" name="abono_interes" value="0" placeholder="Introduzca el Monto del Abono a Intereses" value="<?php if (isset($this->datos["abono_interes"])): echo $this->datos["abono_interes"]; endif;?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 col-sm-3 control-label">Total del Pago:</label>
            <div class="col-sm-9">
              <input type="text" readonly value="0" class="form-control" id="total" name="total" placeholder="Introduzca el Total" value="<?php if (isset($this->datos["total"])): echo $this->datos["total"]; endif;?>">
            </div>
          </div>
          <br>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Nota:</label>
          <div class="col-sm-9">
            <textarea class="form-control" id="nota_mov" name="nota_mov" placeholder="Introduzca la Nota"><?php if (isset($this->datos["nota_mov"])): echo $this->datos["nota_mov"]; endif;?></textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Estado del Movimiento:</label>
          <div class="col-sm-9">
            <select class="form-control" id="estado_mov" name="estado_mov">
              <option value="">-- Seleccione --</option>
              <option <?php if ($this->datos['estado_mov'] == 'En Proceso'):?>selected<?php endif;?>>En Proceso</option>
              <option <?php if ($this->datos['estado_mov'] == 'Rechazado'):?>selected<?php endif;?>>Rechazado</option>
              <option <?php if ($this->datos['estado_mov'] == 'Aceptado'):?>selected<?php endif;?>>Aceptado</option>
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
