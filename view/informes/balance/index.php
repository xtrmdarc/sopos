<?php
date_default_timezone_set('America/Lima');
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
$fecha = date("d-m-Y");
?>

<?php
    $totale=0;
    $x=0;
    foreach($this->model->Listar_TP() as $r):
        if($r->id_tipo_pago == 1 or $r->id_tipo_pago ==3) { 
        $x = $r->pago_efe;
        $totale = $x + $totale;
    } 
    endforeach; 
?>
<?php
    $totalb=0;
    foreach($this->model->Listar_TP() as $r):
    if($r->id_tipo_pago == 2 or $r->id_tipo_pago ==3) {
        $totalb = $r->pago_tar + $totalb;  
    } 
    endforeach; 
?>
<?php
    $totalg=0;
    foreach($this->model->ListarGA() as $r){
        $totalg = $r->importe + $totalg;
    }
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2></h2>
        <ol class="breadcrumb">
            <li>
                <a href="?c=Reporte">Reportes</a>
            </li>
            <li class="active">
                <strong>Reporte de Balance</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeIn">
<div class="row">
<div class="col-lg-12 m-b-md">
    <div class="tabs-container">
        <ul class="nav nav-tabs right">
            <li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-check"></i>Balance</a></li>
        </ul>
        <div class="tab-content">
            <div id="tab-1" class="tab-pane active">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <br>
                            <div class="row">
                                <form method="post" enctype="multipart/form-data" target="_blank" action="#">
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                        <input id="min-1" name="min-1" type="text" value="<?php echo $fecha; ?>" class="form-control DatePicker" placeholder="Desde" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                        <input id="max-1" name="max-1" type="text" value="<?php echo $fecha; ?>" class="form-control DatePicker" placeholder="Hasta" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4" style="text-align:right;">
                                        <button type="submit" class="btn btn-danger"><strong><i class="fa fa-file-text"></i> PDF</strong></button>
                                        <span style="text-align:right;" id="btn-excel"></span>
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered table-striped">
                                        <thead class="lihdcm">
                                            <tr>
                                                <th>Tipo</th>
                                                <th>Motivo</th>
                                                <th style="text-align: center">Importe</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>INGRESO</td>
                                                <td>Ventas Efectivo</td>
                                                <td style="text-align: center" id="efe">
                                                S/<?php echo number_format($totale, 2); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>INGRESO</td>
                                                <td>Ventas Bancos</td>
                                                <td style="text-align: center" id="tar">
                                                S/<?php echo number_format($totalb, 2); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: right;">Total de Ingresos</td>
                                                <td style="text-align: center;" id="t_i">
                                                S/<?php echo number_format(($totale + $totalb), 2); ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered table-striped">
                                        <thead class="lihdcm">
                                            <tr>
                                                <th>Tipo</th>
                                                <th>Motivo</th>
                                                <th style="text-align: center">Importe</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>EGRESO</td>
                                                <td>Gastos Administrativos</td>
                                                <td style="text-align: center" id="ga">
                                                S/<?php echo number_format($totalg, 2); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered table-striped">
                                        <thead class="lihdcm">
                                            <tr>
                                                <th>Tipo</th>
                                                <th>Motivo</th>
                                                <th style="text-align: center">Importe</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>DIFERENCIA</td>
                                                <td>Ventas Efectivo - Gastos Adm.</td>
                                                <td style="text-align: center" id="dif">
                                                S/<?php echo number_format(($totale-$totalg), 2); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="widget style1 navy-bg">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <i class="fa fa-money fa-5x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <span><strong>EFECTIVO</strong></span>
                                        <h2 class="font-bold"><span id="efe-l">S/<?php echo number_format($totale, 2); ?></span></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="widget style1 lazur-bg">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <i class="fa fa-cc-visa fa-5x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <span><strong>TARJETA</strong></span>
                                        <h2 class="font-bold"><span id="tar-l">S/<?php echo number_format($totalb, 2); ?></span></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="widget style1 red-bg">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <i class="fa fa-minus fa-5x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <span><strong>GASTOS ADMIN.</strong></span>
                                        <h2 class="font-bold"><span id="ga-l">S/<?php echo number_format($totalg, 2); ?></span></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="widget style1 yellow-bg">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <i class="fa fa-money fa-5x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <span><strong>EFECTIVO TOTAL</strong></span>
                                        <h2 class="font-bold"><span id="dif-l">S/<?php echo number_format(($totale-$totalg), 2);; ?></span></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<script src="assets/jquery-ui-1.12.1/jquery-ui.js"></script>
<script src="assets/scripts/reportes/balance/func-balance.js"></script>
<script type="text/javascript">
    $('#reportes').addClass("active");
    $('#r-balance').addClass("active");
</script>
