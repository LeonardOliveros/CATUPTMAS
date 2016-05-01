<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title><?php if (isset($this->titulo)): echo $this->titulo; endif;?></title>
        <link rel="icon" type="image/ico" href="<?= $_layoutParams['ruta_img']?>favicon.ico">
        <link href="<?= $_layoutParams['ruta_css']?>bootstrap.css" rel="stylesheet" media="screen">
        <link href="<?= BASE_URL?>views/layout/default/fonts/fontello/fontello.css" rel="stylesheet">
        <?php if(isset($_layoutParams['css']) && count($_layoutParams['css'])):?>
            <?php for($i = 0; $i < count($_layoutParams['css']); $i++):?>
                <link href="<?= $_layoutParams['css'][$i]?>" rel="stylesheet" media="screen">
            <?php endfor;?>
        <?php endif;?>
        <script src="<?= $_layoutParams['ruta_js']?>jquery.min.js" type="text/javascript"></script>
        <script src="<?= $_layoutParams['ruta_js']?>bootstrap.min.js"></script>
        <script src="<?= BASE_URL?>/public/js/moment.js"></script>
        <?php if(isset($_layoutParams['js']) && count($_layoutParams['js'])):?>
            <?php for($i = 0; $i < count($_layoutParams['js']); $i++):?>
                <script src="<?= $_layoutParams['js'][$i];?>" type="text/javascript"></script>
            <?php endfor;?>
        <?php endif;?>
        <script>
            var _root_ = '<?= BASE_URL?>';
            $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
                event.preventDefault(); 
                event.stopPropagation(); 
                $(this).parent().addClass('open');
                var menu = $(this).parent().find("ul");
                var menupos = menu.offset();
                if ((menupos.left + menu.width()) + 30 > $(window).width()) {
                    var newpos = - menu.width();      
                } else {
                    var newpos = $(this).parent().width();
                }
                menu.css({left:newpos });
            });
            
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
        <script>
            $(function () {
                $('[data-toggle="popover"]').popover()
            })
        </script>
        <style>
            .dropdown-submenu{
                position: relative;
            }
            .dropdown-submenu > .dropdown-menu{
                top: 0;
                left: 100%;
                margin-top: -6px;
                margin-left: -1px;
                -webkit-border-radius: 0 6px 6px 6px;
                -moz-border-radius: 0 6px 6px 6px;
                border-radius: 0 6px 6px 6px;
            }
            .dropdown-submenu:hover > .dropdown-menu{
                display: block;
            }
            .dropdown-submenu > a:after{
                display: block;
                content: " ";
                float: right;
                width: 0;
                height: 0;
                border-color: transparent;
                border-style: solid;
                border-width: 5px 0 5px 5px;
                border-left-color: #CCCCCC;
                margin-top: 5px;
                margin-right: -10px;
            }
            .dropdown-submenu:hover > a:after{
                border-left-color: #FFFFFF;
            }
            .dropdown-submenu .pull-left{
                float: none;
            }
            .dropdown-submenu .pull-left > .dropdown-menu{
                left: 10%;
                margin-left: 10px;
                -webkit-border-radius: 6px 0 6px 6px;
                -moz-border-radius: 6px 0 6px 6px;
                border-radius: 6px 0 6px 6px;
            }
            .table-shadow {
                box-shadow: 0px 0px 15px #000;
                border-radius: 25px 25px 0px 0px;
            }
            .btn-custom {
                background: rgba(73,155,234,1);
                background: -moz-radial-gradient(center, ellipse cover, rgba(73,155,234,1) 0%, rgba(32,124,229,1) 100%);
                background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(73,155,234,1)), color-stop(100%, rgba(32,124,229,1)));
                background: -webkit-radial-gradient(center, ellipse cover, rgba(73,155,234,1) 0%, rgba(32,124,229,1) 100%);
                background: -o-radial-gradient(center, ellipse cover, rgba(73,155,234,1) 0%, rgba(32,124,229,1) 100%);
                background: -ms-radial-gradient(center, ellipse cover, rgba(73,155,234,1) 0%, rgba(32,124,229,1) 100%);
                background: radial-gradient(ellipse at center, rgba(73,155,234,1) 0%, rgba(32,124,229,1) 100%);
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#499bea', endColorstr='#207ce5', GradientType=1 );
                color: #FFF;
            }

            .btn-custom:hover {
                color: #FFF;
                opacity: 0.7;
            }
        </style>
        <script>
            $('#navbar').scrollspy();
            $('.dropdown-toggle').dropdown();
        </script>
    </head>
    <!-- Fondo -->
    <body  data-spy="scroll" data-target=".bs-docs-sidebar" style="background-image: url('<?= $_layoutParams['ruta_img'];?>retina_wood.png')">          <div class="container">
        <div class="row">
            <nav class="navbar navbar-default" style=" box-shadow: 0px 5px 25px brown;">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#"><?= APP_NAME?></a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="<?= BASE_URL?>index"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
                            <?php if (Session::get('autenticado')):?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-plus"></i> Registrar <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= BASE_URL?>banco/nuevo"><i class="demo-icon icon-bank">&#xe895;</i> Banco</a></li>
                                    <li><a href="<?= BASE_URL?>departamento/nuevo"><i class="demo-icon icon-building-filled">&#x36;</i> Departamento</a></li>
                                    <li><a href="<?= BASE_URL?>movimiento/nuevo"><i class="demo-icon icon-exchange">&#xe95b;</i> Movimiento</a></li>
                                    <li><a href="<?= BASE_URL?>prestamo/nuevo"><i class="demo-icon icon-money">&#xe8cb;</i> Pr&eacute;stamo</a></li>
                                    <li><a href="<?= BASE_URL?>socio/nuevo"><i class="demo-icon icon-user">&#xe80a;</i> Socio</a></li>
                                    <li><a href="<?= BASE_URL?>evento/nuevo"><i class="glyphicon glyphicon-star"></i> Evento</a></li>
                                    <?php if (Session::get('nivel') == 'admin'):?>
                                    <li><a href="<?= BASE_URL?>registro/index"><i class="demo-icon icon-users">&#x43;</i> Usuario</a></li>
                                    <?php endif;?>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-list"></i> Listar <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= BASE_URL?>banco/index"><i class="demo-icon icon-bank">&#xe895;</i> Bancos</a></li>
                                    <li><a href="<?= BASE_URL?>departamento/index"><i class="demo-icon icon-building-filled">&#x36;</i> Departamentos</a></li>
                                    <li><a href="<?= BASE_URL?>movimiento/index"><i class="demo-icon icon-exchange">&#xe95b;</i> Movimientos</a></li>
                                    <li><a href="<?= BASE_URL?>prestamo/index"><i class="demo-icon icon-money">&#xe8cb;</i> Pr&eacute;stamos</a></li>
                                    <li><a href="<?= BASE_URL?>socio/index"><i class="demo-icon icon-user">&#xe80a;</i> Socios</a></li>
                                    <li><a href="<?= BASE_URL?>evento/index"><i class="glyphicon glyphicon-star"></i> Eventos</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-print"></i> Reportes <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= BASE_URL?>reporte/estado_cuenta"><span class="glyphicon glyphicon-print"></span> Estado de Cuenta</a></li>
                                    <li><a href="<?= BASE_URL?>reporte/socios"><span class="glyphicon glyphicon-print"></span> Socios</a></li>
                                    <li><a href="<?= BASE_URL?>reporte/movimientos"><span class="glyphicon glyphicon-print"></span> Movimientos</a></li>
                                    <li><a href="<?= BASE_URL?>reporte/prestamos"><span class="glyphicon glyphicon-print"></span> Prestamos</a></li>
                                    <li><a href="<?= BASE_URL?>reporte/deudores"><span class="glyphicon glyphicon-print"></span> Deudores</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="demo-icon icon-chart-pie">&#x047;</i> Estad&iacute;sticas <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= BASE_URL?>reporte/estadisticas"><i class="demo-icon icon-chart-pie">&#x047;</i> Prestamos</a></li>
                                    <li><a href="<?= BASE_URL?>reporte/capital"><i class="demo-icon icon-chart-pie">&#x047;</i> Capital</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-option-vertical"></i> Otros <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= BASE_URL?>prestamo/calcularAmortizaciones"><i class="demo-icon icon-money">&#xe8cb;</i> Calcular Amortizaciones</a></li>
                                    <li><a href="<?= BASE_URL?>movimiento/actualizarPagos"><i class="glyphicon glyphicon-refresh"></i> Actualizar Pagos</a></li>
                                </ul>
                            </li>
                        <?php endif;?>
                        </ul>
                        <?php if (Session::get('autenticado')):?>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> Perfil: <?= Session::get('nombre')?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= BASE_URL?>registro/clave/<?= Session::get('id_usuario')?>"><i class="demo-icon icon-key-1">&#xe878;</i> Cambiar Clave</a></li>
                                    <li><a href="<?= BASE_URL?>registro/modificar/<?= Session::get('id_usuario')?>"><i class="glyphicon glyphicon-edit"></i> Modificar Perfil</a></li>
                                    <li><a href="<?= BASE_URL?>registro/lista"><i class="demo-icon icon-users">&#x43;</i> Usuarios</a></li>
                                    <li><a href="<?= BASE_URL?>acl/index"><i class="demo-icon icon-lock-open-alt">&#xe84c;</i> ACL</a></li>

                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?= BASE_URL?>login/cerrar"><i class="demo-icon icon-logout">&#xe8f6;</i> Cerrar Sesi&oacute;n</a></li>
                                </ul>
                            </li>
                        </ul>
                        <?php else:?>
                        <form method="post" action="<?= BASE_URL?>login/index" class="navbar-form navbar-right" role="login">
                            <input type="hidden" name="enviar" value="1" />
                            <div class="form-group input-group">
                                <input type="text" class="form-control" name="usuario" placeholder="Usuario" required autofocus />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            </div>
                            <div class="form-group input-group">
                                <input type="password" class="form-control" name="pass" placeholder="Contraseña" required />
                                <span class="input-group-addon"><i class="demo-icon icon-key-1">&#xe878;</i></span>
                            </div>
                            <button type="submit" class="btn btn-default">Entrar</button>
                        </form>
                        <?php endif;?>
                    </div>
                </div>
            </nav>
        </div>
                <?php if (isset($this->_error)):?>
                    </br>
                    <div class="alert alert-<?php if (isset($this->_class_error)):?><?= $this->_class_error;?><?php else: echo 'info'; endif;?> col-md-6 col-md-offset-3 text-center">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>¡Advertencia!:</strong> <?= $this->_error;?>
                    </div>
                <?php endif;?>
                <div class="col-md-12">
                    </br>
