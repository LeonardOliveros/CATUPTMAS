<!--body wrapper start-->
<div class="wrapper">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <form class="form-horizontal adminex-form" method="post">
        <h1 class="text-center"><?= $this->titulo?></h1>
        <br>
        <input type='hidden' name='guardar' value='1'>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Clave Actual:</label>
          <div class="col-sm-9">
            <input type="password" required autofocus class="form-control" id="pass" name="pass" placeholder="Clave Actual" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Nueva Clave:</label>
          <div class="col-sm-9">
            <input type="password" required class="form-control" id="clave2" name="clave2" placeholder="Nueva Clave">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Confirmar Clave:</label>
          <div class="col-sm-9">
            <input type="password" required class="form-control" id="clave3" name="clave3" placeholder="Confirmar">
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
