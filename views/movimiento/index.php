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
              <th class="text-center">Tipo de Movimiento</th>
              <th class="text-center">Monto</th>
              <th class="text-center">Fecha</th>
              <th class="text-center">Estado</th>
              <th class="text-center"></th>
            </tr>
          </thead>
          <tbody>
          <?php for ($i = 0; $i < count($this->datos); $i++):?>
            <tr>
              <td><?= $this->Cedula($this->datos[$i]['cedula_rif_soc']);?> - <?= $this->datos[$i]['apellidos_soc']; ?> <?= $this->datos[$i]['nombres_soc']?></td>
              <td class="text-center"><?= $this->datos[$i]['tipo_mov']; ?></td>
              <td class="text-center"><?= $this->Dinero($this->datos[$i]['monto_mov']); ?></td>
              <td class="text-center"><?= $this->Fecha($this->datos[$i]['fecha_mov']); ?></td>
              <td class="text-center"><?= $this->datos[$i]['estado_mov']?></td>
              <td class="text-center">
                <a href="<?= BASE_URL?>movimiento/consulta/<?= $this->datos[$i]['id_mov']?>" data-toggle="tooltip" data-placement="top" title="Consultar" class="btn btn-info btn-xs"><i class="fa fa-search"></i></a>&nbsp;
                <a href="<?= BASE_URL?>movimiento/editar/<?= $this->datos[$i]['id_mov']?>" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
              </td>
            </tr>
            <?php endfor;?>
          </tbody>
          <tfoot>
            <tr>
              <th>Socio</th>
              <th class="text-center">Tipo de Movimiento</th>
              <th class="text-center">Monto</th>
              <th class="text-center">Fecha</th>
              <th class="text-center">Estado</th>
              <th class="text-center"></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
