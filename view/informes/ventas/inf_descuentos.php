<?php
date_default_timezone_set('America/Lima');
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
$fecha = date("d-m-Y");
$fechaa = date("m-Y");
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2></h2>
    </div>
</div>

<div class="wrapper wrapper-content animated shake">
	<div class="ibox">
		<div class="ibox-title">
			<div class="ibox-title-buttons pull-right">
				<a class="btn btn-warning" ui-sref="informes.ventas" href="lista_tm_informes.php"> <i class="fa fa-arrow-left"></i> Atr&aacute;s </a>
			</div>
			<h5><strong><i class="fa fa-list"></i> Descuentos por ventas</strong></h5>
		</div>
		<div class="ibox-content" style="position: relative; min-height: 30px;">
            <div class="row">
                <form method="post" enctype="multipart/form-data" target="_blank" action="#">
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" class="form-control bg-r text-center" name="start" id="start" value="<?php echo '01-'.$fechaa; ?>" readonly/>
                                        <span class="input-group-addon">al</span>
                                        <input type="text" class="form-control bg-r text-center" name="end" id="end" value="<?php echo $fecha; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
			<div class="punteo">
                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="no-margins"><strong>Total descuento</strong></h5>
                        <h1 class="no-margins"><strong id="total_d"></strong></h1>
                    </div>
                </div>
            </div>
			<div class="table-responsive">
                <table id="table" class="table table-hover table-condensed table-striped" width="100%">
                    <thead>
                        <tr> 
                            <th>Fecha</th>
                            <th>Documento</th>
                            <th>Num.doc.</th>
                            <th class="text-right">Descuento</th>
                            <th class="text-right">Total con descuento</th>
                            <th class="text-right">Total sin descuento</th>
                        </tr>
                    </thead>
                </table>
            </div>
		</div>
	</div>
</div>

<script src="assets/scripts/informes/ventas/func-descuentos.js"></script>