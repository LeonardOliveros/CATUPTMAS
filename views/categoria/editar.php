<!--body wrapper start-->
<div class="wrapper">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <form class="form-horizontal adminex-form" method="post">
        <h1 class="text-center"><?= $this->titulo?></h1>
        <br>
        <input type='hidden' name='guardar' value='1'>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Categoria</label>
          <div class="col-sm-9">
            <input autofocus type="text" required class="form-control" pattern="<?= $_validationRegex['codigoAlphaNum']?>" title="<?= $_validationTitle['codigoAlphaNum']?>" id="nombre_cat" name="nombre_cat" placeholder="Nombre de la Categoria" value="<?php if (isset($this->datos["nombre_cat"])): echo $this->datos["nombre_cat"]; endif;?>" />
          </div>
        </div>
        <div style="margin: 9px 0 5px;" class="btn-group">
          <button class="btn btn-info" type="submit">Guardar</button>
          <a href="<?= BASE_URL?>categoria/index" class="btn btn-info">Volver</a>
        </div>
      </form>
    </div>
  </div>
</div>
<!--body wrapper end-->
