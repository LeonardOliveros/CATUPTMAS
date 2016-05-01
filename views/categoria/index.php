<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="adv-table">
                <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <caption><h1><?= $this->titulo?></h1></caption>
                    <thead>
                        <tr>
                            <th>Categoria</th>
                            <th class="text-center"><a href="<?= BASE_URL?>categoria/nuevo" class="btn btn-info">Agregar Nueva</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($this->datos); $i++):?>
                        <tr>
                            <td><?= $this->datos[$i]['nombre_cat']?></td>
                            <td class="text-center">
                                <a href="<?= BASE_URL?>categoria/editar/<?= $this->datos[$i]['id_cat']?>" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></a>&nbsp;
                                <a href="<?= BASE_URL?>categoria/elimina/<?= $this->datos[$i]['id_cat']?>" data-toggle="tooltip" data-placement="top" title="Borrar" class="btn btn-info btn-xs"><span class="fa fa-trash-o"></span></a>&nbsp;
                            </td>
                        </tr>
                        <?php endfor;?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Categoria</th>
                            <th class="text-center"><a href="<?= BASE_URL?>categoria/nuevo" class="btn btn-info">Agregar Nueva</a></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>