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
              <option>Individual</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">C&eacute;dula del Socio:</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Introduzca la C&eacute;dula o RIF" value="<?php if (isset($this->datos["cedula"])): echo $this->datos["cedula"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Apellidos:</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Introduzca los Apellidos" value="<?php if (isset($this->datos["apellido"])): echo $this->datos["apellido"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Nombres:</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Introduzca los Nombres" value="<?php if (isset($this->datos["nombre"])): echo $this->datos["nombre"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Departamento:</label>
          <div class="col-sm-9">
            <select class="form-control" id="departamento" name="departamento">
              <option value="">-- General --</option>
              <?php foreach ($this->departamentos AS $departamento):?>
              <option value="<?= $departamento['id_dep']?>"><?= $departamento['nombre_dep']?></option>
              <?php endforeach;?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Banco:</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="banco" name="banco" placeholder="Introduzca el Banco" value="<?php if (isset($this->datos["banco"])): echo $this->datos["banco"]; endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Tipo de Cuenta:</label>
          <div class="col-sm-9">
            <select class="form-control" id="tipo_cuenta" name="tipo_cuenta">
              <option value="">-- General --</option>
              <option>Corriente</option>
              <option>Ahorro</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Estado del Socio:</label>
          <div class="col-sm-9">
            <select class="form-control" id="tipo_cuenta" name="tipo_cuenta">
              <option value="">-- General --</option>
              <option>Corriente</option>
              <option>Ahorro</option>
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
              <th class="text-center">C&eacute;dula</th>
              <th>Apellidos y Nombres</th>
              <th class="text-center">Tel&eacute;fonos</th>
              <th class="text-center">Estado</th>
              <th class="text-center"><a href="<?= BASE_URL?>socio/nuevo" class="btn btn-info">Agregar Nuevo</a></th>
            </tr>
          </thead>
          <tbody>
          <?php for ($i = 0; $i < count($this->listado); $i++):?>
            <tr>
              <td class="text-center"><?= $this->Cedula($this->listado[$i]['cedula_rif_soc']);?></td>
              <td><?= $this->listado[$i]['apellidos_soc']; ?> <?= $this->listado[$i]['nombres_soc']?></td>
              <td class="text-center"><?= $this->Telefono($this->listado[$i]['telefono_soc']); ?> / <?= $this->Telefono($this->listado[$i]['telefono2_soc'])?></td>
              <td class="text-center"><?= $this->listado[$i]['estado_soc']?></td>
              <td class="text-center">
                <a href="<?= BASE_URL?>socio/consultar/<?= $this->listado[$i]['id_soc']?>" data-toggle="tooltip" data-placement="top" title="Consultar" class="btn btn-info btn-xs"><i class="fa fa-search"></i></a>&nbsp;
                <a href="<?= BASE_URL?>socio/editar/<?= $this->listado[$i]['id_soc']?>" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>&nbsp;
                <a href="<?= BASE_URL?>socio/elimina/<?= $this->listado[$i]['id_soc']?>" data-toggle="tooltip" data-placement="top" title="Borrar" class="btn btn-info btn-xs"><i class="fa fa-trash-o"></i></a>
              </td>
            </tr>
          <?php endfor;?>
          </tbody>
          <tfoot>
            <tr>
              <th class="text-center">C&eacute;dula</th>
              <th>Apellidos y Nombres</th>
              <th class="text-center">Tel&eacute;fonos</th>
              <th class="text-center">Estado</th>
              <th class="text-center"><a href="<?= BASE_URL?>socio/nuevo" class="btn btn-info">Agregar Nuevo</a></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  <?php endif;?>
</div>
<script>
    $(document).ready(function() {
        $("#salida").on('change', function() {
            if ($("#salida").val() == 'Individual') {
                $("#nombre").val('');
                $("#apellido").val('');
                $("#departamento").val('');
                $("#banco").val('');
                $("#tipo_cuenta").val('');
                $("#estado").val('');
                $("#nombre").attr('disabled', true);
                $("#apellido").attr('disabled', true);
                $("#departamento").attr('disabled', true);
                $("#banco").attr('disabled', true);
                $("#tipo_cuenta").attr('disabled', true);
                $("#estado").attr('disabled', true);
            } else {
                $("#nombre").val('');
                $("#apellido").val('');
                $("#departamento").val('');
                $("#banco").val('');
                $("#tipo_cuenta").val('');
                $("#estado").val('');
                $("#nombre").attr('disabled', false);
                $("#apellido").attr('disabled', false);
                $("#departamento").attr('disabled', false);
                $("#banco").attr('disabled', false);
                $("#tipo_cuenta").attr('disabled', false);
                $("#estado").attr('disabled', false);
            }
        });
    });
</script>