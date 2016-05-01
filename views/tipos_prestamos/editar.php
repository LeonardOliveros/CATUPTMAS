<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form class="form-horizontal adminex-form" method="post">
                <h1 class="text-center"><?= $this->titulo?></h1>
                <br>
                <input type='hidden' name='guardar' value='1'>
                <div class="form-group">
                    <label class="col-sm-3 col-sm-3 control-label">Nombre:</label>
                    <div class="col-sm-9">
                        <input autofocus type="text" class="form-control" id="nombre_tip_pre" name="nombre_tip_pre" placeholder="Nombre del Tipo de Prestamo" value="<?php if (isset($this->datos["nombre_tip_pre"])): echo $this->datos["nombre_tip_pre"]; endif;?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-sm-3 control-label">Tasa de Interes:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="interes_tip_pre" name="interes_tip_pre" placeholder="Introduzca la Tasa de Interes" value="<?php if (isset($this->datos["interes_tip_pre"])): echo $this->datos["interes_tip_pre"]; endif;?>">
                    </div>
                </div>
                <div style="margin: 9px 0 5px;" class="btn-group">
                    <button class="btn btn-info" type="submit">Guardar</button>
                    <a href="<?= BASE_URL?>tipos_prestamos/index" class="btn btn-info">Volver</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!--body wrapper end-->
