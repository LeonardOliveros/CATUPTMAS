<!--body wrapper start-->
<div class="wrapper">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <form class="form-horizontal adminex-form" method="post">
        <h1 class="text-center"><?= $this->titulo?></h1>
        <br>
        <input type='hidden' name='guardar' value='1'>
        <div class="form-group">
          <label class="col-sm-3 col-sm-3 control-label">Rol:</label>
          <div class="col-sm-9">
            <select id="rol" class="form-control" name="role">
                <?php foreach ($this->roles as $r):?>
                <option value="<?= $r['id_rol']?>" <?php if ($this->datos['role'] == $r['id_rol']):?>selected<?php endif;?>><?= $r['rol']?></option>
                <?php endforeach;?>
            </select>
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
