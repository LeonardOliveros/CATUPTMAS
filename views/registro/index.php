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
            <input type="text" autofocus class="form-control" id="nombre" name="nombre" placeholder="Introduzca el Nombre" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Usuario:</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Introduzca el Usuario" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Rol:</label>
          <div class="col-sm-9">
            <select class="form-control" name="rol" id="rol">
              <option value="">-- Seleccione --</option>
              <?php foreach ($this->roles AS $r):?>
              <option value="<?= $r['id_rol']?>"><?= $r['rol']?></option>
              <?php endforeach;?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Clave:</label>
          <div class="col-sm-9">
            <input type="password" class="form-control" id="pass" name="pass" placeholder="Introduzca la Clave" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Confirmar:</label>
          <div class="col-sm-9">
            <input type="password" class="form-control" id="confirmar" name="confirmar" placeholder="Introduzca la Clave" />
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
