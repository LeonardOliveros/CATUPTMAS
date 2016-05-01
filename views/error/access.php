<div class="col-md-12">
    <h2><?php if ($this->mensaje) echo $this->mensaje?></h2>
</div>
<div class="col-md-12">
    <a href="<?php echo BASE_URL;?>index"><span class="glyphicon glyphicon-home" title="Ir al inicio"></span></a> |
    <a href="javascript:history.back(1)"><span class="glyphicon glyphicon-arrow-left" title="Volver a la p&aacute;gina anterior"></span></a>
    <?php if(@!Session::get('autenticado')):?>
    | <a href="<?php echo BASE_URL;?>login"><span class="glyphicon glyphicon-off" title="Iniciar sesi&oacute;n"></span></a>
    <?php endif; ?>
</div>