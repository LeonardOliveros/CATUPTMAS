<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form class="form-horizontal adminex-form" method="post">
                <h1 class="text-center"><?= $this->titulo?></h1>
                <br>
                <input type='hidden' name='guardar' value='1'>
                <div class="form-group">
                    <label class="col-sm-3 col-sm-3 control-label">C&oacute;digo:</label>
                    <div class="col-sm-9">
                        <input autofocus type="text" class="form-control" pattern="<?= $_validationRegex['codigoNum']?>" title="<?= $_validationTitle['codigoNum']?>" id="codigo_pla_pre" name="codigo_pla_pre" placeholder="Debe Introducir el C&oacute;digo" value="<?php if (isset($this->datos["codigo_pla_pre"])): echo $this->datos["codigo_pla_pre"]; endif;?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-sm-3 control-label">Nombre:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nombre_pla_pre" name="nombre_pla_pre" placeholder="Debe Introducir el Nombre del Plazo del Prestamo" value="<?php if (isset($this->datos["nombre_pla_pre"])): echo $this->datos["nombre_pla_pre"]; endif;?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-sm-3 control-label">Meses de Plazo:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="meses_pla_pre" name="meses_pla_pre" placeholder="Introduzca los Meses de Plazo" value="<?php if (isset($this->datos["meses_pla_pre"])): echo $this->datos["meses_pla_pre"]; endif;?>">
                    </div>
                </div>
                <div style="margin: 9px 0 5px;" class="btn-group">
                    <button class="btn btn-info" type="submit">Guardar</button>
                    <a href="<?= BASE_URL?>plazos_prestamos/index" class="btn btn-info">Volver</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!--body wrapper end-->
