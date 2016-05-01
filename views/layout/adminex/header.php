<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="shortcut icon" type="image/ico" href=" <?= $_layoutParams['ruta_img']?>favicon.ico">
    <title><?php if (isset($this->titulo)): echo $this->titulo; endif;?></title>
    <!--icheck-->
    <link href="<?= $_layoutParams['ruta_js']?>iCheck/skins/minimal/minimal.css" rel="stylesheet">
    <link href="<?= $_layoutParams['ruta_js']?>iCheck/skins/square/square.css" rel="stylesheet">
    <link href="<?= $_layoutParams['ruta_js']?>iCheck/skins/square/red.css" rel="stylesheet">
    <link href="<?= $_layoutParams['ruta_js']?>iCheck/skins/square/blue.css" rel="stylesheet">
    <!--dashboard calendar-->
    <link href="<?= $_layoutParams['ruta_css']?>clndr.css" rel="stylesheet">
    <!--common-->
    <link href="<?= $_layoutParams['ruta_css']?>style.css" rel="stylesheet">
    <link href="<?= $_layoutParams['ruta_css']?>style-responsive.css" rel="stylesheet">
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="<?= $_layoutParams['ruta_js']?>morris-chart/morris.css">
    <?php if(isset($_layoutParams['css']) && count($_layoutParams['css'])):?>
      <?php for($i = 0; $i < count($_layoutParams['css']); $i++):?>
        <link href="<?= $_layoutParams['css'][$i]?>" rel="stylesheet" media="screen">
      <?php endfor;?>
    <?php endif;?>
    <script>
      var _root_ = '<?= BASE_URL?>';
      _layoutParamsImg_ = '<?= $_layoutParams["ruta_img"]?>';
    </script>
  </head>
  <body class="<?php if (Session::get('autenticado')):?>sticky-header<?php else:?>login-body<?php endif;?>">
    <?php if (Session::get('autenticado')):?>
      <section>
        <!-- left side start-->
        <div class="left-side sticky-left-side" tabindex="5000" style="overflow: hidden; outline: none;">
          <!--logo and iconic logo start-->
          <div class="logo text-center" style="padding: 0; margin-top: -8px">
            <h3><?= APP_NAME?></h3>
          </div>
          <!--logo and iconic logo end-->
          <div class="left-side-inner">
            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
              <li class="<?php if ($_layoutParams['item'] == 'inicio'):?>active<?php endif;?>"><a href="<?= BASE_URL?>index"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
              <li class="menu-list <?php if ($_layoutParams['item'] == 'socios'):?>active<?php endif;?>"><a href="#"><i class="fa fa-users"></i> <span>Socios</span></a>
                <ul class="sub-menu-list">
                  <li class="<?php if ($_layoutParams['item2'] == 'listar_socios'):?>active<?php endif;?>"><a href="<?= BASE_URL?>socio/index"> Socios</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'nuevo_socio'):?>active<?php endif;?>"><a href="<?= BASE_URL?>socio/nuevo"> Datos del Socio</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'codigo_socio'):?>active<?php endif;?>"><a href="<?= BASE_URL?>socio/codigo"> Asignacion de Codigo</a></li>
                  <!--<li class="<?php if ($_layoutParams['item2'] == 'nuevo_socio'):?>active<?php endif;?>"><a href="<?= BASE_URL?>socio/nuevo"> Registrar</a></li>-->
                </ul>
              </li>
              <li class="menu-list <?php if ($_layoutParams['item'] == 'ahorros'):?>active<?php endif;?>"><a href="#"><i class="fa fa-money"></i> <span>Ahorros</span></a>
                <ul class="sub-menu-list">
                  <li class="<?php if ($_layoutParams['item2'] == 'listar_ahorros'):?>active<?php endif;?>"><a href="<?= BASE_URL?>movimiento/index"> Movimientos</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'actualizarGeneral'):?>active<?php endif;?>"><a href="<?= BASE_URL?>movimiento/actualizarPagosGeneral"> Actualizacion de Ahorros en General</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'actualizarIndividual'):?>active<?php endif;?>"><a href="<?= BASE_URL?>movimiento/actualizarPagosIndividual"> Actualizacion de Ahorros Por Individual</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'nuevo_retiro'):?>active<?php endif;?>"><a href="<?= BASE_URL?>movimiento/nuevo_retiro"> Retiros de Ahorros</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'cargos_creditos'):?>active<?php endif;?>"><a href="<?= BASE_URL?>movimiento/index"> Cargos y Creditos de Haberes</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'ahorros_individual'):?>active<?php endif;?>"><a href="<?= BASE_URL?>movimiento/consulta_individual"> Consulta Individual de Ahorros</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'ahorros_general'):?>active<?php endif;?>"><a href="<?= BASE_URL?>movimiento/index"> Consulta General de Ahorros</a></li>
                </ul>
              </li>
              <li class="menu-list <?php if ($_layoutParams['item'] == 'prestamos'):?>active<?php endif;?>"><a href="#"><i class="fa fa-credit-card"></i> <span>Prestamos</span></a>
                <ul class="sub-menu-list">
                  <li class="<?php if ($_layoutParams['item2'] == 'listar_prestamos'):?>active<?php endif;?>"><a href="<?= BASE_URL?>prestamo/index"> Prestamos</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'solicitud_prestamo'):?>active<?php endif;?>"><a href="<?= BASE_URL?>prestamo/solicitud"> Solicitud de Prestamo</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'otorgamiento_prestamo'):?>active<?php endif;?>"><a href="<?= BASE_URL?>prestamo/otorgamiento"> Otorgamiento del Prestamo</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'consulta_amortizacion'):?>active<?php endif;?>"><a href="<?= BASE_URL?>prestamo/consulta_amortizacion"> Consulta de Amortizacion</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'cancelacion_prestamo'):?>active<?php endif;?>"><a href="<?= BASE_URL?>prestamo/cancelacion"> Cancelacion del Prestamo</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'abonos_parciales'):?>active<?php endif;?>"><a href="<?= BASE_URL?>prestamo/abonos_parciales"> Abonos Parciales del Prestamo</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'consulta_individual'):?>active<?php endif;?>"><a href="<?= BASE_URL?>prestamo/consulta_individual"> Consulta Individual del Prestamo</a></li>
                </ul>
              </li>
              <li class="menu-list <?php if ($_layoutParams['item'] == 'reportes'):?>active<?php endif;?>"><a href="#"><i class="fa fa-print"></i> <span>Reportes</span></a>
                <ul class="sub-menu-list">
                  <li class="<?php if ($_layoutParams['item2'] == 'reporte'):?>active<?php endif;?>"><a href="<?= BASE_URL?>"> Consulta General de Socios</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'reporte'):?>active<?php endif;?>"><a href="<?= BASE_URL?>"> Consulta Individual por Socios</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'reporte'):?>active<?php endif;?>"><a href="<?= BASE_URL?>"> Estados de Cuentas del Socio</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'reporte'):?>active<?php endif;?>"><a href="<?= BASE_URL?>"> Informacion de Ahorros</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'reporte'):?>active<?php endif;?>"><a href="<?= BASE_URL?>"> Ahorros Voluntarios</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'reporte'):?>active<?php endif;?>"><a href="<?= BASE_URL?>"> Retiros del Socio</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'reporte'):?>active<?php endif;?>"><a href="<?= BASE_URL?>"> Prestamos y Creditos Otorgados en el Mes</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'reporte'):?>active<?php endif;?>"><a href="<?= BASE_URL?>"> Prestamos y Creditos Otorgados en el Año</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'reporte'):?>active<?php endif;?>"><a href="<?= BASE_URL?>"> Prestamos del Socio</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'reporte'):?>active<?php endif;?>"><a href="<?= BASE_URL?>"> Tabla de Amortizacion</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'reporte'):?>active<?php endif;?>"><a href="<?= BASE_URL?>"> Deudas del Patrono</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'reporte'):?>active<?php endif;?>"><a href="<?= BASE_URL?>"> Prestamos del Socio</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'reporte'):?>active<?php endif;?>"><a href="<?= BASE_URL?>"> Socios que Finalizan el Prestamo</a></li>
                </ul>
              </li>
              <li class="menu-list <?php if ($_layoutParams['item'] == 'estadisticas'):?>active<?php endif;?>"><a href="#"><i class="fa fa-bar-chart-o"></i> <span>Estadisticas</span></a>
                <ul class="sub-menu-list">
                  <li class="<?php if ($_layoutParams['item2'] == 'prestamos'):?>active<?php endif;?>"><a href="<?= BASE_URL?>reporte/estadisticas"> Prestamos</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'capital'):?>active<?php endif;?>"><a href="<?= BASE_URL?>reporte/capital"> Ganancias y Perdidas</a></li>
                </ul>
              </li>
              <li class="menu-list <?php if ($_layoutParams['item'] == 'informacion'):?>active<?php endif;?>"><a href="#"><i class="fa fa-info"></i> <span>Informacion</span></a>
                <ul class="sub-menu-list">
                  <li class="<?php if ($_layoutParams['item'] == 'requisitos'):?>active<?php endif;?>"><a href="<?= BASE_URL?>socio/requisitos"><i class="fa fa-info"></i> <span>Requisitos de Afiliacion a <?= APP_NAME?></span></a></li>
                  <li class="<?php if ($_layoutParams['item'] == 'requisitos'):?>active<?php endif;?>"><a href="<?= BASE_URL?>socio/requisitos"><i class="fa fa-info"></i> <span>Historia</span></a></li>
                  <li class="<?php if ($_layoutParams['item'] == 'requisitos'):?>active<?php endif;?>"><a href="<?= BASE_URL?>socio/requisitos"><i class="fa fa-info"></i> <span>Mision</span></a></li>
                  <li class="<?php if ($_layoutParams['item'] == 'requisitos'):?>active<?php endif;?>"><a href="<?= BASE_URL?>socio/requisitos"><i class="fa fa-info"></i> <span>Vision</span></a></li>
                  <li class="<?php if ($_layoutParams['item'] == 'requisitos'):?>active<?php endif;?>"><a href="<?= BASE_URL?>socio/requisitos"><i class="fa fa-info"></i> <span>Orden Jerarquico</span></a></li>
                </ul>
              </li>
              <li class="menu-list <?php if ($_layoutParams['item'] == 'utilidades'):?>active<?php endif;?>"><a href="#"><i class="fa fa-cog"></i> <span>Utilidades</span></a>
                <ul class="sub-menu-list">
                  <li class="<?php if ($_layoutParams['item2'] == 'eventos'):?>active<?php endif;?>"><a href="<?= BASE_URL?>evento/index"> Eventos</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'bancos'):?>active<?php endif;?>"><a href="<?= BASE_URL?>banco/index"> Bancos <?= APP_NAME?></a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'departamentos'):?>active<?php endif;?>"><a href="<?= BASE_URL?>departamento/index"> Departamentos</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'categorias'):?>active<?php endif;?>"><a href="<?= BASE_URL?>categoria/index"> Categorias</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'tipos_prestamos'):?>active<?php endif;?>"><a href="<?= BASE_URL?>tipos_prestamos/index"> Tipos de Prestamos</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'plazos_prestamos'):?>active<?php endif;?>"><a href="<?= BASE_URL?>plazos_prestamos/index"> Plazos de Prestamos</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'departamentos'):?>active<?php endif;?>"><a href="<?= BASE_URL?>departamento/index"> Configuracion del Sistema</a></li>
                  <li class="<?php if ($_layoutParams['item2'] == 'departamentos'):?>active<?php endif;?>"><a href="<?= BASE_URL?>departamento/index"> Respaldo de Datos</a></li>
                </ul>
              </li>
            </ul>
            <!--sidebar nav end-->
          </div>
        </div>
        <!-- left side end-->
        <!-- main content start-->
        <div class="main-content">
          <!-- header section start-->
          <div class="header-section">
            <!--toggle button start-->
            <!-- <a class="toggle-btn"><i class="fa fa-bars"></i></a> -->
            <!--toggle button end-->
            <!--notification menu start -->
            <div class="menu-right">
              <ul class="notification-menu">
                <li>
                  <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                    <i class="fa fa-bell-o"></i>
                    <?php if (Session::get('CantidadNoti')):?>
                    <span class="badge"><?= Session::get('CantidadNoti')?></span>
                    <?php endif;?>
                  </a>
                  <div class="dropdown-menu dropdown-menu-head pull-right">
                    <h5 class="title">Notificaciones</h5>
                      <ul class="dropdown-list normal-list" style="max-height: 300px; overflow: auto;">
                        <?php if (Session::get('CantidadNoti') != 0):?>
                        <?php if (Session::get('Vencerse')):?>
                          <li class="new">
                            <span class="label label-info"><?= count(Session::get('Vencerse'))?></span>
                            <span class="name"><strong>Cuotas Por Vencerse:</strong></span>
                          </li>
                          <?php foreach (Session::get('Vencerse') AS $v):?>
                          <li class="new">
                            <a href="#">
                              <span class="label label-danger"><i class="fa fa-clock-o" title="Por Vencerse"></i></span>
                              <span class="name"><?= $this->Cedula($v['cedula'])?> <?= $v['nombres']?></span>
                              <em class="small"><?= $this->Fecha($v['fecha'])?><br>Couta: <?= $this->Dinero($v['cuota'])?></em>
                            </a>
                          </li>
                          <?php endforeach;?>
                        <?php endif;?>
                        <?php if (Session::get('Vencidas')):?>
                          <li class="new">
                            <span class="label label-info"><?= count(Session::get('Vencidas'))?></span>
                            <span class="name"><strong>Cuotas Vencidas:</strong></span>
                          </li>
                          <?php foreach (Session::get('Vencidas') AS $vn):?>
                          <li class="new">
                            <a href="#">
                              <span class="label label-danger"><i class="fa fa-times" title="Vencida"></i></span>
                              <span class="name"><?= $this->Cedula($vn['cedula'])?> <?= $vn['nombres']?></span>
                              <em class="small"><?= $this->Fecha($vn['fecha'])?><br>Couta: <?= $this->Dinero($vn['cuota'])?></em>
                            </a>
                          </li>
                          <?php endforeach;?>
                        <?php endif;?>
                        <?php if (Session::get('Eventos')):?>
                          <li class="new">
                            <span class="label label-info"><?= count(Session::get('Eventos'))?></span>
                            <span class="name"><strong>Eventos:</strong></span>
                          </li>
                          <?php foreach (Session::get('Eventos') AS $e):?>
                          <li class="new">
                            <a href="#">
                              <span class="label label-danger"><i class="fa fa-calendar" title="Evento"></i></span>
                              <span class="name"><?= $e['nombre']?></span>
                              <br>
                              <em class="small">Inicia: <?= $this->Fecha($e['fecha_inicio'])?> - Termina: <?= $this->Fecha($e['fecha_fin'])?><br><?= $e['descripcion']?></em>
                            </a>
                          </li>
                          <?php endforeach;?>
                        <?php endif;?>
                        <?php else:?>
                        <li class="new">
                          <a href="#">
                            <span class="label label-danger"><i class="fa fa-exclamation-triangle"></i></span>
                            <span class="name">No hay notificaciones</span>
                          </a>
                        </li>
                        <?php endif;?>
                      </ul>
                    </div>
                  </li>
                  <li class="<?php if ($_layoutParams['item'] == 'perfil'):?>active<?php endif;?>">
                    <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-user"></i>&nbsp;
                      <?= Session::get('nombre')?>
                      <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                      <li class="<?php if ($_layoutParams['item2'] == 'clave'):?>active<?php endif;?>"><a href="<?= BASE_URL?>registro/clave/<?= Session::get('id_usuario')?>"><i class="fa fa-key"></i>  Cambiar Clave</a></li>
                      <li class="<?php if ($_layoutParams['item2'] == 'modificar'):?>active<?php endif;?>"><a href="<?= BASE_URL?>registro/modificar/<?= Session::get('id_usuario')?>"><i class="fa fa-edit"></i> Modificar Perfil</a></li>
                      <?php if (Session::get('level') == 'Administrador'):?>
                      <li class="<?php if ($_layoutParams['item2'] == 'registrar'):?>active<?php endif;?>"><a href="<?= BASE_URL?>registro/index"><i class="fa fa-plus"></i> Registrar Usuario</a></li>
                      <li class="<?php if ($_layoutParams['item2'] == 'listar_usuarios'):?>active<?php endif;?>"><a href="<?= BASE_URL?>registro/lista"><i class="fa fa-list"></i> Usuarios</a></li>
                      <?php endif;?>
                      <li><a href="<?= BASE_URL?>login/cerrar"><i class="fa fa-sign-out"></i> Cerrar Sesion</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <!--notification menu end -->
            </div>
            <?php endif;?>
            <!-- header section end-->
            <!-- page heading start-->
            <!-- <div class="page-heading">
                <h3>
                    Cambiar Clave
                </h3>
                <ul class="breadcrumb">
                  <li>
                    <a href="#">Inicio</a>
                  </li>
                  <li class="active"> Pagina Actual </li>
                </ul>
            </div> -->
            <!-- page heading end-->
            <!-- messages start -->
            <?php if (isset($this->_error)):?>
            <br>
            <div class="alert alert-<?php if (isset($this->_class_error)):?><?= $this->_class_error;?><?php else: echo 'info'; endif;?> col-md-6 col-md-offset-3 text-center">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>¡Advertencia!:</strong> <?= $this->_error;?>
            </div>
            <?php endif;?>
            <!-- messages end -->
            <!-- page heading start-->
            <!-- <div class="page-heading">
              <h3>
                Dashboard
              </h3>
              <ul class="breadcrumb">
                <li>
                  <a href="#">Dashboard</a>
                </li>
                <li class="active"> My Dashboard </li>
              </ul>
            </div> -->
            <!-- page heading end-->
            <!--body wrapper start-->
            <!-- <div class="wrapper">
              <div class="row">
                <div class="col-md-4">            
                </div>
              </div>
            </div> -->
            <!--body wrapper end-->