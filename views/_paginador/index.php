<nav>
    <ul class="pager">
        <?php if ($this->_paginacion['primero']):?>
            <li class="previous"><a href="<?= $link . $this->_paginacion['primero'];?>"><span class="glyphicon glyphicon-fast-backward"></span></a></li>
        <?php else:?>
            <li class="previous disabled"><a href="<?= $link . $this->_paginacion['primero'];?>"><span class="glyphicon glyphicon-fast-backward"></span></a></li>
        <?php endif;?>

        <?php if ($this->_paginacion['anterior']):?>
            <li><a href="<?= $link . $this->_paginacion['anterior'];?>"><span class="glyphicon glyphicon-backward"></span></a></li>
        <?php else:?>
            <li class="disabled"><a href="#"><span class="glyphicon glyphicon-backward"></span></a></li>
        <?php endif;?>

        <?php for ($i = 0; $i < count($this->_paginacion['rango']); $i++):?>
        <?php if ($this->_paginacion['actual'] == $this->_paginacion['rango'][$i]):?>
            <li class="disabled"><a href="#"><?= $this->_paginacion['actual']?></a></li>
        <?php else:?>
            <li>
                <a href="<?= $link . $this->_paginacion['rango'][$i];?>"><?= $this->_paginacion['rango'][$i];?></a>
            </li>
        <?php endif;?>
        <?php endfor;?>

        <?php if ($this->_paginacion['siguiente']):?>
            <li><a href="<?= $link . $this->_paginacion['siguiente'];?>"><span class="glyphicon glyphicon-forward"></span></a></li>
        <?php else:?>
            <li class="disabled"><a href="#"><span class="glyphicon glyphicon-forward"></span></a></li>
        <?php endif;?>


        <?php if ($this->_paginacion['ultimo']):?>
            <li class="next"><a href="<?= $link . $this->_paginacion['ultimo'];?>"><span class="glyphicon glyphicon-fast-forward"></span></a></li>
        <?php else:?>
            <li class="next disabled"><a href="#"><span class="glyphicon glyphicon-fast-forward"></span></a></li>
        <?php endif;?>
    </ul>
</nav>