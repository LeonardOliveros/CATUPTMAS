<!--body wrapper start-->
<div class="wrapper">
  <div class="row">
    <div class="col-md-12">
      <div class="adv-table">
        <table  class="display table table-bordered table-striped" id="dynamic-table">
          <caption><h1><?= $this->titulo?></h1></caption>
          <thead>
            <tr>
              <th>Socio</th>
              <th>Capital<br>Prestado</th>
              <th>Capital<br>Pagado</th>
              <th>Intereses<br>Pagados</th>
              <th>Total<br>Pagado</th>
              <th class="text-center">Estado</th>
              <th class="text-center"><a href="<?= BASE_URL?>prestamo/nuevo" class="btn btn-info">Agregar Nuevo</a></th>
            </tr>
          </thead>
          <tbody>
          <?php for ($i = 0; $i < count($this->datos); $i++):?>
            <tr>
              <td><?= $this->Cedula($this->datos[$i]['cedula_rif_soc']);?><br><?= $this->datos[$i]['apellidos_soc']; ?> <?= $this->datos[$i]['nombres_soc']?></td>
              <td class="text-right"><?= $this->Dinero($this->datos[$i]['monto_pre']); ?></td>
              <td class="text-right"><?= $this->Dinero($this->datos[$i]['total_capital'])?></td>
              <td class="text-right"><?= $this->Dinero($this->datos[$i]['total_interes'])?></td>
              <td class="text-right"><?= $this->Dinero($this->datos[$i]['total_pagado'])?></td>
              <td class="text-center"><?= $this->datos[$i]['estado_pre']?></td>
              <td class="text-center">
                <a href="<?= BASE_URL?>prestamo/consulta/<?= $this->datos[$i]['id_pre']?>" data-toggle="tooltip" data-placement="top" title="Cambiar Rol" class="btn btn-info btn-xs"><span class="fa fa-search"></span></a>&nbsp;
                <a href="<?= BASE_URL?>prestamo/editar/<?= $this->datos[$i]['id_pre']?>" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></a>&nbsp;
                <a href="<?= BASE_URL?>prestamo/elimina/<?= $this->datos[$i]['id_pre']?>" data-toggle="tooltip" data-placement="top" title="Borrar" class="btn btn-info btn-xs"><span class="fa fa-trash-o"></span></a>
              </td>
            </tr>
            <?php endfor;?>
          </tbody>
          <tfoot>
            <tr>
              <th>Socio</th>
              <th>Capital<br>Prestado</th>
              <th>Capital<br>Pagado</th>
              <th>Intereses<br>Pagados</th>
              <th>Total<br>Pagado</th>
              <th class="text-center">Estado</th>
              <th class="text-center"><a href="<?= BASE_URL?>prestamo/nuevo" class="btn btn-info">Agregar Nuevo</a></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
