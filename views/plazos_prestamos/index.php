<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="adv-table">
                <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th class="text-center">Meses de Plazo</th>
                            <th class="text-center"><a href="<?= BASE_URL?>plazos_prestamos/nuevo" class="btn btn-info">Agregar Nuevo</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($this->datos); $i++):?>
                        <tr>
                            <td><?= $this->datos[$i]['codigo_pla_pre']?> <?= $this->datos[$i]['nombre_pla_pre']?></td>
                            <td class="text-center"><?= $this->Cantidad($this->datos[$i]['meses_pla_pre'])?></td>
                            <td class="text-center">
                                <a href="<?= BASE_URL?>plazos_prestamos/editar/<?= $this->datos[$i]['id_pla_pre']?>" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></a>&nbsp;
                                <a href="<?= BASE_URL?>plazos_prestamos/elimina/<?= $this->datos[$i]['id_pla_pre']?>" data-toggle="tooltip" data-placement="top" title="Borrar" class="btn btn-info btn-xs"><span class="fa fa-trash-o"></span></a>
                            </td>
                        </tr>
                        <?php endfor;?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th class="text-center">Meses de Plazo</th>
                            <th class="text-center"><a href="<?= BASE_URL?>plazos_prestamos/nuevo" class="btn btn-info">Agregar Nuevo</a></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
