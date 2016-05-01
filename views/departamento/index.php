<!--body wrapper start-->
<div class="wrapper">
  <div class="row">
    <div class="col-md-12">
      <div class="adv-table">
        <table  class="display table table-bordered table-striped" id="dynamic-table">
          <caption><h1><?= $this->titulo?></h1></caption>
          <thead>
            <tr>
              <th>Departamento</th>
              <th class="text-center"><a href="<?= BASE_URL?>departamento/nuevo" class="btn btn-info">Agregar Nuevo</a></th>
            </tr>
          </thead>
          <tbody>
            <?php for ($i = 0; $i < count($this->datos); $i++):?>
            <tr>
              <td><?= $this->datos[$i]['codigo_dep']?> <?= $this->datos[$i]['nombre_dep']?></td>
              <td class="text-center">
                <a href="<?= BASE_URL?>departamento/editar/<?= $this->datos[$i]['id_dep']?>" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></a>&nbsp;
                <a href="<?= BASE_URL?>departamento/elimina/<?= $this->datos[$i]['id_dep']?>" data-toggle="tooltip" data-placement="top" title="Borrar" class="btn btn-info btn-xs"><span class="fa fa-trash-o"></span></a>
              </td>
            </tr>
            <?php endfor;?>
          </tbody>
          <tfoot>
            <tr>
              <th>Departamento</th>
              <th class="text-center"><a href="<?= BASE_URL?>departamento/nuevo" class="btn btn-info">Agregar Nuevo</a></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
