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
            <input type="text" autofocus class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php if (isset($this->datos['nombre'])):?><?php echo $this->datos['nombre']?><?php endif;?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Usuario:</label>
          <div class="col-sm-9">
            <input type="text" readonly class="form-control" id="usuario" name="usuario" placeholder="Usuario" value="<?php if (isset($this->datos['usuario'])):?><?php echo $this->datos['usuario']?><?php endif;?>">
          </div>
        </div>
        <div style="margin: 9px 0 5px;" class="btn-group">
          <button class="btn btn-info" type="submit">Guardar</button>
          <a href="<?= BASE_URL?>registro/lista" class="btn btn-info">Volver</a>
        </div>
      </form>
    </div>
  </div>
</div>
<!--body wrapper end-->
