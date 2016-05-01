<div class="col-md-12">
    <h2><?php if ($this->mensaje) echo $this->mensaje?></h2>
</div>
<div class="col-md-12">
    <a href="<?php echo BASE_URL;?>index"><i class="glyphicon glyphicon-home" title="Ir al inicio"></i></a> |
    <a href="javascript:history.back(1)"><i class="glyphicon glyphicon-arrow-left" title="Volver a la p&aacute;gina Anterior"></i></a>
    <?php if(@!Session::get('autenticado')):?>
    | <a href="<?php echo BASE_URL;?>login"><i class="glyphicon glyphicon-off" title="Iniciar sesi&oacute;n"></i></a>
    <?php endif; ?>
</div>