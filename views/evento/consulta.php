<div class="row">
    <h1><span class="label label-primary"><?= $this->titulo?></span></h1>
    <?php if ($this->modificar == true): ?>
        <form action="<?= BASE_URL?>evento/modificar/<?= $this->datos['id_eve']?>" method="post"> 
        <input type="hidden" name="guardar" value="1" />
    <?php endif;?>
    <div class="col-md-4">
        <h4><span class="label label-primary">Evento</span></h4>
        <?php if ($this->modificar == true):?>
        <input type="text" name="nombre_eve" class="form-control" value="<?= $this->datos['nombre_eve']?>" />
        <?php else:?>
        <p><?= $this->datos['nombre_eve']?></p>
        <?php endif;?>
        <h4><span class="label label-primary">Fecha de Inicio</span></h4>
        <?php if ($this->modificar == true):?>
        <input type="date" name="fecha_inicio_eve" class="form-control" value="<?= $this->datos['fecha_inicio_eve']?>" />
        <?php else:?>
        <p><?= $this->datos['fecha_inicio_eve']?></p>
        <?php endif;?>
    </div>
    <div class="col-md-4">
        <h4><span class="label label-primary">Fecha de Fin</span></h4>
        <?php if ($this->modificar == true):?>
        <input type="date" name="fecha_fin_eve" class="form-control" value="<?= $this->datos['fecha_fin_eve']?>" />
        <?php else:?>
        <p><?= $this->datos['fecha_fin_eve']?></p>
        <?php endif;?>
        <h4><span class="label label-primary">Descripcion</span></h4>
        <?php if ($this->modificar == true):?>
        <textarea name="descripcion_eve" class="form-control"><?= $this->datos['descripcion_eve']?></textarea>
        <?php else:?>
        <p><?= $this->datos['descripcion_eve']?></p>
        <?php endif;?>
    </div>
    <div class="col-md-4">
        <h4><span class="label label-primary">Estado</span></h4>
        <?php if ($this->modificar == true):?>
        <select  name="estado_eve" class="form-control">
            <option value="">-- Seleccione --</option>
            <option <?php if ($this->datos['estado_eve'] == 'Activo'):?>selected<?php endif;?>>Activo</option>
            <option <?php if ($this->datos['estado_eve'] == 'Inactivo'):?>selected<?php endif;?>>Inactivo</option>
        </select>
        <?php else:?>
        <p><?= $this->datos['estado_eve']?></p>
        <?php endif;?>
    </div>
    <?php if ($this->modificar == true):?>
    <div class="col-md-12 text-center">
        </br>
        <button type="submit" class="btn btn-primary btn-sm">Aceptar</button>
        <a href="<?= BASE_URL?>" class="btn btn-custom btn-sm">Cancelar</a>
    </div>
    </form>
    <?php endif;?>
</div>
