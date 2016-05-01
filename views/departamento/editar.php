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
                    <input autofocus type="text" required class="form-control" pattern="<?= $_validationRegex['codigoNum']?>" title="<?= $_validationTitle['codigoNum']?>" id="codigo_dep" name="codigo_dep" placeholder="Introduzca el C&oacute;digo" value="<?php if (isset($this->datos["codigo_dep"])): echo $this->datos["codigo_dep"]; endif;?>" />
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-sm-3 control-label">Departamento</label>
                    <div class="col-sm-9">
                        <input required type="text" class="form-control" id="nombre_dep" name="nombre_dep" placeholder="Nombre del Departamento" value="<?php if (isset($this->datos["nombre_dep"])): echo $this->datos["nombre_dep"]; endif;?>">
                    </div>
                </div>
                <div style="margin: 9px 0 5px;" class="btn-group">
                    <button class="btn btn-info" type="submit">Guardar</button>
                    <a href="<?= BASE_URL?>departamento/index" class="btn btn-info">Volver</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!--body wrapper end-->
