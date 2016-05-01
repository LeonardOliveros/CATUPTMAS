<!--body wrapper start-->
<div class="wrapper">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <form class="form-horizontal adminex-form" method="post">
        <h1 class="text-center"><?= $this->titulo?></h1>
        <br>
        <input type='hidden' name='guardar' value='1'>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Tipo de Pago:</label>
          <div class="col-sm-9">
            <select class="form-control" required id="tipo_actualizacion" name="tipo_actualizacion">
              <option value="">-- Seleccione --</option>
              <option <?php if (isset($this->form['tipo_actualizacion']) && $this->form['tipo_actualizacion'] == 'Todos'):?>selected<?php endif;?>>Todos</option>
              <option <?php if (isset($this->form['tipo_actualizacion']) && $this->form['tipo_actualizacion'] == 'Patrono'):?>selected<?php endif;?>>Patrono</option>
              <option <?php if (isset($this->form['tipo_actualizacion']) && $this->form['tipo_actualizacion'] == 'Socio'):?>selected<?php endif;?>>Socio</option>
            </select>
          </div>
        </div>
        <div id="individual" class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">C&eacute;dula:</label>
          <div class="col-sm-9">
            <input type="text" required class="form-control" pattern="<?= $_validationRegex['cedula']?>" title="<?= $_validationTitle['cedula']?>" placeholder="Introduzca la C&eacute;dula" name="individual" value="<?php if (isset($this->form["individual"])): echo $this->form["individual"]; endif;?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Fecha:</label>
          <div class="col-sm-9">
            <input type="date" required class="form-control" id="fecha" placeholder="Introduzca la Fecha" name="fecha" value="<?php if (isset($this->form["fecha"])): echo $this->form["fecha"]; endif;?>"/>
          </div>
        </div>
        <div style="margin: 9px 0 5px;" class="btn-group">
          <button class="btn btn-info" type="submit">Generar Listado</button>
          <a href="<?= BASE_URL?>movimiento" class="btn btn-info">Volver a Inicio</a>
        </div>
      </form>
    </div>
  </div>
  <?php if (isset($this->resultados) && $this->resultados == true):?>
  <br>
  <div class="row">
    <div class="col-md-12">
      <div class="adv-table">
        <form action="<?= BASE_URL?>movimiento/registrarActualizacion" method="post">
        <table  class="display table table-bordered table-striped" id="dynamic-table">
          <caption><h1><?= $this->titulo?></h1></caption>
          <thead>
            <tr>
              <th class="text-center">C&eacute;dula</th>
              <th>Apellidos y Nombres</th>
              <th class="text-center">Departamentos</th>
              <th class="text-center">Cuota de Socio</th>
              <th class="text-center">Cuota de Patrono</th>
              <th class="text-center">
                <abbr title="Couta de Socio">C.S.</abbr> + <abbr title="Couta de Patrono">C.P.</abbr>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php if ($this->datos && count($this->datos)): ?>
              <input type="hidden" name="tipo" value="<?= $this->tipo?>" />
              <input type="hidden" name="fecha" value="<?= $this->fecha?>" />
              <?php
                $i = 0;
                $total_patrono = 0;
                $total_socio = 0;
              ?>
              <?php foreach($this->datos AS $d):?>
              <?php
                $i++;
                $total_patrono = $total_patrono + $d['aporte_patrono_soc'];
                $total_socio = $total_socio + $d['aporte_socio_soc'];
              ?>
              <tr>
                <td class="text-center"><?= $this->Cedula($d['cedula_rif_soc']);?></td>
                <td><?= $d['apellidos_soc']?> <?= $d['nombres_soc']?></td>
                <td class="text-center"><?= $d['nombre_dep']?></td>
                <input type="hidden" name="<?= $i?>" value="<?= $d['cedula_rif_soc']?>" />
                <td class="text-center"><input type="hidden" name="aporte_socio_<?= $i?>" value="<?= $d['aporte_socio_soc']?>" /><?= $this->Dinero($d['aporte_socio_soc'])?></td>
                <td class="text-center"><input type="hidden" name="aporte_patrono_<?= $i?>" value="<?= $d['aporte_patrono_soc']?>" /><?= $this->Dinero($d['aporte_patrono_soc'])?></td>
                <td class="text-center"><?= $this->Dinero($d['aporte_socio_soc'] + $d['aporte_patrono_soc'])?></td>
              </tr>
              <?php endforeach;?>
              <tr>
                <td colspan="3" class="text-right"><strong>Totales</strong></td>
                <td class="text-center"><?= $this->Dinero($total_socio)?></td>
                <td class="text-center"><?= $this->Dinero($total_patrono)?></td>
                <td class="text-center"><?= $this->Dinero($total_socio + $total_patrono)?></td>
              </tr>
          <?php endif;?>
        </tbody>
        <tfoot>
          <tr>
            <th class="text-center">C&eacute;dula</th>
            <th>Apellidos y Nombres</th>
            <th class="text-center">Departamentos</th>
            <th class="text-center">Cuota Socio</th>
            <th class="text-center">Cuota Patrono</th>
            <th class="text-center">
              <input type="hidden" name="contador" value="<?= $i;?>" />
              <button type="submit" class="btn btn-info">Aceptar</button>
            </th>
          </tr>
        </tfoot>
      </table>
      </form>
      </div>
    </div>
  </div>
<?php endif;?>
</div>
<!--body wrapper end-->