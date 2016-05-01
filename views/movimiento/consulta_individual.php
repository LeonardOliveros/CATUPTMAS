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
            <input type="text" autofocus required class="form-control" pattern="<?= $_validationRegex['cedula']?>" title="<?= $_validationTitle['cedula']?>" id="cedula_rif_soc" name="cedula_rif_soc" placeholder="Introduzca la C&eacute;dula del Socio" value="<?php if (isset($this->datos["cedula_rif_soc"])): echo $this->datos["cedula_rif_soc"]; endif;?>">
          </div>
        </div>
        <div style="margin: 9px 0 5px;" class="btn-group">
          <button class="btn btn-info" type="submit">Buscar</button>
          <a href="<?= BASE_URL?>prestamo/index" class="btn btn-info">Volver al Listado</a>
        </div>
      </form>
    </div>
  </div>
  <?php if ($this->resultado):?>
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
  <div class="row">
    <div class="col-md-12">
      <div class="adv-table">
        <table  class="display table table-bordered table-striped" id="dynamic-table">
          <caption><h1><?= $this->titulo?></h1></caption>
          <thead>
            <tr>
              <th class="text-center">Tipo de Movimiento</th>
              <th class="text-center">Monto</th>
              <th class="text-center">Fecha</th>
              <th class="text-center">Estado</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $info = 0;
          for ($i = 0; $i < count($this->detalles); $i++):?>
            <?php
            if ($this->detalles[$i]['tipo_mov'] != 'Pago Prestamo'):
            $info++;
            ?>
            <tr>
              <td class="text-center"><?= $this->detalles[$i]['tipo_mov']; ?></td>
              <td class="text-center"><?= $this->Dinero($this->detalles[$i]['monto_mov']); ?></td>
              <td class="text-center"><?= $this->Fecha($this->detalles[$i]['fecha_mov']); ?></td>
              <td class="text-center"><?= $this->detalles[$i]['estado_mov']?></td>
            </tr>
            <?php endif;?>
            <?php endfor;?>
            <?php if (!$info):?>
              <tr>
              <td colspan="4">No hay datos</td>
              </tr>
            <?php endif?>
          </tbody>
          <tfoot>
            <tr>
              <th class="text-center">Tipo de Movimiento</th>
              <th class="text-center">Monto</th>
              <th class="text-center">Fecha</th>
              <th class="text-center">Estado</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  <?php endif;?>
</div>
<!--body wrapper end-->