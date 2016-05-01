<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="adv-table">
                <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                        <tr>
                            <th>Evento</th>
                            <th class="text-center">Fecha de Inicio</th>
                            <th class="text-center">Fecha de Fin</th>
                            <th class="text-center">Descripcion</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center"><a href="<?= BASE_URL?>evento/nuevo" class="btn btn-info">Agregar Nuevo</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($this->datos); $i++):?>
                        <tr>
                            <td><?= $this->datos[$i]['nombre_eve']?></td>
                            <td class="text-center"><?= $this->Fecha($this->datos[$i]['fecha_inicio_eve'])?></td>
                            <td class="text-center"><?= $this->Fecha($this->datos[$i]['fecha_fin_eve'])?></td>
                            <td class="text-center"><?= $this->datos[$i]['descripcion_eve']?></td>
                            <td class="text-center"><?= $this->datos[$i]['estado_eve']?></td>
                            <td class="text-center">
                                <a href="<?= BASE_URL?>evento/editar/<?= $this->datos[$i]['id_eve']?>" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></a>&nbsp;
                                <a href="<?= BASE_URL?>evento/elimina/<?= $this->datos[$i]['id_eve']?>" data-toggle="tooltip" data-placement="top" title="Borrar" class="btn btn-info btn-xs"><span class="fa fa-trash-o"></span></a>
                            </td>
                        </tr>
                        <?php endfor;?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Evento</th>
                            <th class="text-center">Fecha de Inicio</th>
                            <th class="text-center">Fecha de Fin</th>
                            <th class="text-center">Descripcion</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center"><a href="<?= BASE_URL?>evento/nuevo" class="btn btn-info">Agregar Nuevo</a></th>
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
            <th class="col-md-3">Evento</th>
            <th class="text-center col-md-2">Fecha de Inicio</th>
            <th class="text-center col-md-2">Fecha de Fin</th>
            <th class="text-center col-md-3">Descripcion</th>
            <th class="text-center col-md-1">Estado</th>
            <th class="text-center col-md-1">Acciones</th>
        </tr>
    </thead>
<?php if (isset($this->datos) && count($this->datos)):?>
    <tbody>
        <?php for($i = 0; $i < count($this->datos); $i++):?>
            <tr>
                <td><?= $this->datos[$i]['nombre_eve'];?></td>
                <td class="text-center"><?= $this->Fecha($this->datos[$i]['fecha_inicio_eve']);?></td>
                <td class="text-center"><?= $this->Fecha($this->datos[$i]['fecha_fin_eve']);?></td>
                <td class="text-center"><?= $this->datos[$i]['descripcion_eve']; ?></td>
                <td class="text-center"><?= $this->datos[$i]['estado_eve']; ?></td>
                <td class="text-center">
                    <a href="<?= BASE_URL?>evento/consulta/<?= $this->datos[$i]['id_eve']?>/true" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;
                    <a href="<?= BASE_URL?>evento/elimina/<?= $this->datos[$i]['id_eve']?>" data-toggle="tooltip" data-placement="top" title="Borrar" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;
                </td>
            </tr>
        <?php endfor;?>
    </tbody>
<?php else:?>
    <tr>
        <td colspan="6" class="text-center warning"><strong>Tabla Vacia...</strong></td>
    </tr>
<?php endif; ?>

</table>

<?php if (isset($this->paginacion)) echo $this->paginacion;?> -->