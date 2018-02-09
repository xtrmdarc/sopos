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
			<h5><strong><i class="fa fa-list"></i> Reportes por impuesto</strong></h5>
		</div>
		<div class="ibox-content" style="position: relative; min-height: 30px;">
            <div class="row">
                <form method="post" enctype="multipart/form-data" target="_blank" action="#">
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-r text-center" name="start" id="start" value="<?php echo '01-'.$fechaa; ?>" readonly/>
                                        <span class="input-group-addon">al</span>
                                        <input type="text" class="form-control bg-r text-center" name="end" id="end" value="<?php echo $fecha; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        &nbsp;
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <select name="tipo_doc" id="tipo_doc" class="selectpicker show-tick form-control"  data-live-search="true" autocomplete="off">
                                <option value="%" active>Todos los comprobantes</option>
                                <option value="1">BOLETA</option>
                                <option value="2">FACTURA</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
			<div class="punteo">
                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="no-margins"><strong>Total impuesto</strong></h5>
                        <h1 class="no-margins"><strong id="total_i"></strong></h1>
                    </div>
                </div>
            </div>
			<div class="table-responsive">
                <table id="table" class="table table-hover table-condensed table-striped" width="100%">
                    <thead>
                        <tr> 
                            <th></th>
                            <th></th>
                            <th></th>
                            <th class="cell-right-border"></th>
                            <th class="text-center cell-right-border cell-top-border"><span class="font-normal"><strong>IMPUESTOS</strong></span>
                            </th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>Fecha</th>
                            <th width="15%">Cliente</th>
                            <th>Documento</th>
                            <th class="cell-right-border">Subtotal</th>
                            <th class="text-center cell-right-border cell-bottom-border background-name">IGV</th>
                            <th class="text-right">Total venta</th>
                            <th>Tipo de venta</th>
                            <th class="text-center">Estado</th>
                            <th class="text-right">Opciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
		</div>
	</div>
</div>

<div class="modal inmodal fade" id="detalle" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h5 class="modal-title title-d" style="font-size: 18px">Detalle</h5>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover table-condensed table-striped">
                        <thead>
                            <tr>
                                <th>Cantidad</th>
                                <th>Producto</th>
                                <th>P.U.</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody id="lista_p">
                        
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </form>
        </div>
    </div>
</div>

<script src="assets/scripts/informes/ventas/func-impuestos.js"></script>