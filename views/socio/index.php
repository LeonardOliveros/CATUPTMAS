<!--body wrapper start-->
<div class="wrapper">
  <div class="row">
    <div class="col-md-12">
      <div class="adv-table">
        <table  class="display table table-bordered table-striped" id="dynamic-table">
          <caption><h1><?= $this->titulo?></h1></caption>
          <thead>
            <tr>
              <th class="text-center">C&eacute;dula</th>
              <th>Apellidos y Nombres</th>
              <th class="text-center">Tel&eacute;fono(s)</th>
              <th class="text-center">Departamento</th>
              <th class="text-center"><a href="<?= BASE_URL?>socio/nuevo" class="btn btn-info">Agregar Nuevo</a></th>
            </tr>
          </thead>
          <tbody>
          <?php for ($i = 0; $i < count($this->datos); $i++):?>
            <tr>
              <td class="text-center"><?= $this->Cedula($this->datos[$i]['cedula_rif_soc']);?></td>
              <td><?= $this->datos[$i]['apellidos_soc']; ?> <?= $this->datos[$i]['nombres_soc']?></td>
              <td class="text-center"><?= $this->Telefono($this->datos[$i]['telefono_soc']); ?> <?php if ($this->datos[$i]['telefono2_soc'] != ''):?>/ <?= $this->Telefono($this->datos[$i]['telefono2_soc'])?><?php endif;?></td>
              <td class="text-center"><?= $this->datos[$i]['codigo_dep']?> <?= $this->datos[$i]['nombre_dep']?></td>
              <td class="text-center">
                <a href="<?= BASE_URL?>socio/consultar/<?= $this->datos[$i]['id_soc']?>" data-toggle="tooltip" data-placement="top" title="Consultar" class="btn btn-info btn-xs"><i class="fa fa-search"></i></a>&nbsp;
                <a href="<?= BASE_URL?>socio/editar/<?= $this->datos[$i]['id_soc']?>" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>&nbsp;
                <a href="<?= BASE_URL?>socio/elimina/<?= $this->datos[$i]['id_soc']?>" data-toggle="tooltip" data-placement="top" title="Borrar" class="btn btn-info btn-xs"><i class="fa fa-trash-o"></i></a>
              </td>
            </tr>
            <?php endfor;?>
          </tbody>
          <tfoot>
            <tr>
              <th class="text-center">C&eacute;dula</th>
              <th>Apellidos y Nombres</th>
              <th class="text-center">Tel&eacute;fono(s)</th>
              <th class="text-center">Departamento</th>
              <th class="text-center"><a href="<?= BASE_URL?>socio/nuevo" class="btn btn-info">Agregar Nuevo</a></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- <table class="table table-shadow table-striped table-hover">
    <h2><strong><label class="label label-primary"><?= $this->titulo?></label></strong></h2>
    <thead>
        <tr>
            <th class="text-center col-md-2">C&eacute;dula</th>
            <th class="col-md-3">Apellidos y Nombres</th>
            <th class="col-md-3 text-center">Tel&eacute;fonos</th>
            <th class="col-md-2 text-center">Estado</th>
            <th class="text-center col-md-2">Acciones</th>
        </tr>
    </thead>
<?php if (isset($this->datos) && count($this->datos)):?>
    <tbody>
        <?php for($i = 0; $i < count($this->datos); $i++):?>
            <tr>
                <td class="text-center"><?= $this->Cedula($this->datos[$i]['cedula_rif_soc']);?></td>
                <td><?= $this->datos[$i]['apellidos_soc']; ?> <?= $this->datos[$i]['nombres_soc']?></td>
                <td class="text-center"><?= $this->Telefono($this->datos[$i]['telefono_soc']); ?> / <?= $this->Telefono($this->datos[$i]['telefono2_soc'])?></td>
                <td class="text-center"><?= $this->datos[$i]['estado_soc']?></td>
                <td class="text-center">
                    <a href="<?= BASE_URL?>socio/consulta/<?= $this->datos[$i]['id_soc']?>" data-toggle="tooltip" data-placement="top" title="Consultar" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-search"></span></a>&nbsp;
                    <a href="<?= BASE_URL?>socio/consulta/<?= $this->datos[$i]['id_soc']?>/true" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;
                    <a href="<?= BASE_URL?>socio/elimina/<?= $this->datos[$i]['id_soc']?>" data-toggle="tooltip" data-placement="top" title="Borrar" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;
                </td>
            </tr>
        <?php endfor;?>
    </tbody>
<?php else:?>
    <tr>
        <td colspan="5" class="text-center warning"><strong>Tabla Vacia...</strong></td>
    </tr>
<?php endif; ?>

</table>

<?php if (isset($this->paginacion)) echo $this->paginacion;?> -->