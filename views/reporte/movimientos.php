<!--body wrapper start-->
<div class="wrapper">
  <?php if (!$this->resultado):?>
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <form class="form-horizontal adminex-form" method="post">
        <h1 class="text-center"><?= $this->titulo?></h1>
        <br>
        <input type='hidden' name='guardar' value='1'>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Generar:</label>
          <div class="col-sm-9">
            <select class="form-control" id="salida" name="salida">
              <option>Listar</option>
              <option>PDF</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">C&eacute;dula:</label>
          <div class="col-sm-9">
            <input type="text" autofocus class="form-control" id="cedula" name="cedula" placeholder="Introduzca la C&eacute;dula o RIF del Socio" value="<?php if (isset($this->datos["cedula"])): echo $this->datos["cedula"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Referencia:</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="referencia" name="referencia" placeholder="Introduzca la Referencia" value="<?php if (isset($this->datos["referencia"])): echo $this->datos["referencia"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Fecha:</label>
          <div class="col-sm-9">
            <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Introduzca los Nombres" value="<?php if (isset($this->datos["fecha"])): echo $this->datos["fecha"]; endif;?>">
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
          <label class="col-sm-3 col-sm-3 control-label">Estado:</label>
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
  <?php else:?>
  <div class="row">
    <div class="col-md-12">
      <div class="adv-table">
        <table  class="display table table-bordered table-striped" id="dynamic-table">
          <caption><h1><?= $this->titulo?></h1></caption>
          <thead>
            <tr>
              <th>Socio</th>
              <th class="text-center">Tipo Movimiento</th>
              <th class="text-center">Monto</th>
              <th class="text-center">Fecha</th>
              <th class="text-center">Estado</th>
              <th class="text-center"><a href="<?= BASE_URL?>movimiento/nuevo" class="btn btn-info">Agregar Nuevo</a></th>
            </tr>
          </thead>
          <tbody>
          <?php for ($i = 0; $i < count($this->listado); $i++):?>
            <tr>
              <td><?= $this->Cedula($this->listado[$i]['cedula_rif_soc']);?> - <?= $this->listado[$i]['apellidos_soc']; ?> <?= $this->listado[$i]['nombres_soc']?></td>
              <td class="text-center"><?= $this->listado[$i]['tipo_mov']; ?></td>
              <td class="text-center"><?= $this->Dinero($this->listado[$i]['monto_mov']); ?></td>
              <td class="text-center"><?= $this->Fecha($this->listado[$i]['fecha_mov']); ?></td>
              <td class="text-center"><?= $this->listado[$i]['estado_mov']?></td>
              <td class="text-center">
                <a href="<?= BASE_URL?>movimiento/consulta/<?= $this->listado[$i]['id_mov']?>" data-toggle="tooltip" data-placement="top" title="Consultar" class="btn btn-info btn-xs"><i class="fa fa-search"></i></a>&nbsp;
                <a href="<?= BASE_URL?>movimiento/editar/<?= $this->listado[$i]['id_mov']?>" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
              </td>
            </tr>
          <?php endfor;?>
          </tbody>
          <tfoot>
            <tr>
              <th>Socio</th>
              <th class="text-center">Tipo Movimiento</th>
              <th class="text-center">Monto</th>
              <th class="text-center">Fecha</th>
              <th class="text-center">Estado</th>
              <th class="text-center"><a href="<?= BASE_URL?>movimiento/nuevo" class="btn btn-info">Agregar Nuevo</a></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  <?php endif;?>
</div>
