<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form class="form-horizontal adminex-form" method="post">
                <h1 class="text-center"><?= $this->titulo?></h1>
                <br>
                <input type='hidden' name='guardar' value='1'>
                <div class="form-group">
                    <label class="col-sm-3 col-sm-3 control-label">Evento:</label>
                    <div class="col-sm-9">
                        <input autofocus type="text" class="form-control" id="nombre_eve" name="nombre_eve" placeholder="Nombre del Evento" value="<?php if (isset($this->datos["nombre_eve"])): echo $this->datos["nombre_eve"]; endif;?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-sm-3 control-label">Fecha de Inicio:</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="fecha_inicio_eve" name="fecha_inicio_eve" placeholder="Introduzca la Fecha de Inicio" value="<?php if (isset($this->datos["fecha_inicio_eve"])): echo $this->datos["fecha_inicio_eve"]; endif;?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-sm-3 control-label">Fecha de Cierre:</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="fecha_fin_eve" name="fecha_fin_eve" placeholder="Introduzca la Fecha de Fin" value="<?php if (isset($this->datos["fecha_fin_eve"])): echo $this->datos["fecha_fin_eve"]; endif;?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-sm-3 control-label">Descripcion:</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="descripcion_eve" name="descripcion_eve" placeholder="Introduzca la Descripcion"><?php if (isset($this->datos["descripcion_eve"])): echo $this->datos["descripcion_eve"]; endif;?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-sm-3 control-label">Estado:</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="estado_eve" name="estado_eve">
                            <option value="">-- Seleccione --</option>
                            <option>Activo</option>
                            <option>Inactivo</option>
                        </select>
                    </div>
                </div>
                <div style="margin: 9px 0 5px;" class="btn-group">
                    <button class="btn btn-info" type="submit">Guardar</button>
                    <a href="<?= BASE_URL?>evento/index" class="btn btn-info">Volver</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!--body wrapper end-->
