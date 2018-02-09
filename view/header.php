<?php
  $du = $_SESSION["datosusuario"];
  $de = $_SESSION["datosempresa"];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema para restaurantes, cevicherias, entre otros</title>
    <link href='assets/img/restepe.ico' rel='shortcut icon' type='image/x-icon'/>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="assets/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" />
    <link href="assets/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
    <link href="assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/stylep.css" rel="stylesheet">
    <link href="assets/css/plugins/select/bootstrap-select.css" rel="stylesheet">
    <link href="assets/css/plugins/formvalidation/formValidation.min.css" rel="stylesheet">
    <link href="assets/css/plugins/wizard/wizard.css" rel="stylesheet">
    <link href="assets/css/plugins/datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="assets/css/plugins/iCheck/skins/all.css" rel="stylesheet" />
    <link href="assets/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">
    <link href="assets/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/plugins/dataTables/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
    <link href="assets/css/plugins/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <script src="assets/js/jquery-2.1.1.js"></script>
</head>

<body class="canvas-menu fixed-nav">
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <a class="close-canvas-menu"><i class="fa fa-times"></i></a>
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="assets/img/usuarios/<?php foreach ($du as $reg) { echo $reg['imagen']; } ?>" width="43" height="43" />
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">
                            	<?php foreach ($du as $reg) { echo $reg['nombres']; } ?>
                            </strong>
                             </span> <span class="text-muted text-xs block">
								<?php foreach ($du as $reg) { echo $reg['desc_r']; } ?>
                             <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="close_session.php">Salir</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>
                    <?php foreach ($du as $reg) { 
                    if($reg['id_rol'] == 1 or $reg['id_rol'] == 2 or $reg['id_rol'] == 4) { ?>
                    <li id="restau">
                        <a href="inicio.php"><i class="fa fa-cutlery"></i> <span class="nav-label">RESTAURANTE</span></a>
                    </li>
                    <?php } if($reg['id_rol'] == 1 or $reg['id_rol'] == 2) { ?>
                    <li id="caja">
                        <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">CAJA</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                        <?php if($reg['id_rol'] == 1) { ?>
                            <li id="c-apc"><a href="lista_caja_aper.php"> Apertura - Cierre</a></li>
                        <?php } ?>
                            <li id="c-ing"><a href="lista_caja_ing.php"> Ingresos</a></li>
                            <li id="c-egr"><a href="lista_caja_egr.php"> Egresos</a></li>
                        </ul>
                    </li>
                    <li id="clientes">
                        <a href="lista_tm_clientes.php"><i class="fa fa-group"></i> <span class="nav-label">CLIENTES</span></a>
                    </li>
                    <li id="compras">
                        <a href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">COMPRAS</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li id="c-compras"><a href="lista_comp.php"> Todas las compras</a></li>
                            <li id="c-proveedores"><a href="lista_comp_prov.php"> Proveedores</a></li>
                        </ul>
                    </li>
                    <li id="creditos">
                        <a href="#"><i class="fa fa-credit-card"></i> <span class="nav-label">CREDITOS</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li id="cr-compras"><a href="lista_creditos_comp.php"> Compras</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                    <?php if($reg['id_rol'] == 1) { ?>
                    <li id="informes">
                        <a href="lista_tm_informes.php"><i class="fa fa-list"></i> <span class="nav-label">INFORMES</span></a>
                    </li>
                    <?php } ?>
                    <?php if($reg['id_rol'] == 3) { ?>
                    <li id="area-p">
                        <a href="lista_area_prod.php"><i class="fa fa-bitbucket"></i> <span class="nav-label"><?php echo $reg['desc_ap'] ?></span></a>
                    </li>
                    <?php } ?>
                    <?php if($reg['id_rol'] == 1) { ?>
                    <li id="config">
                        <a href="lista_tm_otros.php"><i class="fa fa-cogs"></i> <span class="nav-label">AJUSTES</span></a>
                    </li>
                    <?php } ?>
                    <?php if($reg['id_rol'] == 1 or $reg['id_rol'] == 2) { ?>
                    <li id="tablero">
                        <a href="lista_tm_tablero.php"><i class="fa fa-dashboard"></i> <span class="nav-label">TABLERO</span></a>
                    </li>
                    <?php }} ?>
				</ul>
			</div>
		</nav>
		
		<div id="page-wrapper" class="gray-bg" style="min-height: 307px;">
        <div class="row border-bottom">
        <nav id="navbar-c" class="navbar navbar-fixed-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-warning-2 " href="#"><i class="fa fa-bars"></i> </a>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="dateday" id="dateday"></span>
                    <span class="dateday" id="datedays"></span>
                </li>
                <li>
                    <span class="datetime" id="datetime"></span>
                </li>
                <li>
                    <a href="close_session.php">
                        <i class="fa fa-sign-out"></i> Salir
                    </a>
                </li>
            </ul>
        </nav>
        </div>



        