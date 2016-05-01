<!--body wrapper start-->
<div class="wrapper">
  <div class="row">
    <div class="col-md-12">
      <div class="adv-table">
        <table  class="display table table-bordered table-striped" id="dynamic-table">
          <caption><h1><?= $this->titulo?></h1></caption>
          <thead>
            <tr>
              <th class="text-center">Usuario</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Rol</th>
              <th class="text-center"><a href="<?= BASE_URL?>registro/index" class="btn btn-info">Agregar Nuevo</a></th>
            </tr>
          </thead>
          <tbody>
          <?php for ($i = 0; $i < count($this->datos); $i++):?>
            <tr>
              <td><?= $this->datos[$i]['usuario']?></td>
              <td class="text-center"><?= $this->datos[$i]['nombre']?></td>
              <td class="text-center"><?= $this->datos[$i]['rol']?></td>
              <td class="text-center">
                <a href="<?= BASE_URL?>registro/rol/<?= $this->datos[$i]['id_usuario']?>" data-toggle="tooltip" data-placement="top" title="Cambiar Rol" class="btn btn-info btn-xs <?php if ($this->datos[$i]['id_usuario'] == 1 && Session::get('usuario') == 'admin'):?>disabled<?php endif;?>"><span class="fa fa-lock"></span></a>&nbsp;
                <a href="<?= BASE_URL?>registro/modificar/<?= $this->datos[$i]['id_usuario']?>" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></a>&nbsp;
                <a href="<?= BASE_URL?>registro/elimina/<?= $this->datos[$i]['id_usuario']?>" data-toggle="tooltip" data-placement="top" title="Borrar" class="btn btn-info btn-xs <?php if ($this->datos[$i]['id_usuario'] == 1 && Session::get('usuario') == 'admin'):?>disabled<?php endif;?>"><span class="fa fa-trash-o"></span></a>
              </td>
            </tr>
            <?php endfor;?>
          </tbody>
          <tfoot>
            <tr>
              <th>Usuario</th>
              <th>Nombre</th>
              <th>Rol</th>
              <th class="text-center"><a href="<?= BASE_URL?>registro/index" class="btn btn-info">Agregar Nuevo</a></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
