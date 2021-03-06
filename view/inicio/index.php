<input type="hidden" id="cod_ape" value="<?php echo $_SESSION["apertura"]; ?>"/>
<input type="hidden" id="cod_m" value="<?php echo $_GET['Cod']; ?>"/>
<input type="hidden" id="moneda" value="<?php echo $_SESSION["moneda"]; ?>"/>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-6">
        <h2><i class="fa fa-cutlery"></i> <a class="a-c" href="inicio.php">Restarurante</a></h2>
        <ol class="breadcrumb">
            <li class="active">
                <strong>Mesas</strong>
            </li>
            <li class="tooltip-demo">
                <small class="label label-primary" data-original-title="Mesa Libre" data-toggle="tooltip" data-placement="bottom">&nbsp;</small>
                <small class="label label-info" data-original-title="En proceso de pago" data-toggle="tooltip" data-placement="bottom">&nbsp;</small>
                <small class="label label-danger" data-original-title="Mesa Ocupada" data-toggle="tooltip" data-placement="bottom">&nbsp;</small>
            </li>
        </ol>
    </div>
    <?php if($_SESSION["rol_usr"] <> 4) { ?>
    <div class="col-sm-6 tooltip-demo">
        <div class="title-action">
            <a class="btn btn-warning btn-cm" href="#mdl-cambiar-mesa" data-toggle="modal"><i class="fa fa-exchange"></i> Cambiar Mesa</a>
        </div>
    </div>
    <?php } ?>
</div>
<div class="wrapper wrapper-content animated bounce">
<div class="row">
<div class="col-lg-12 m-b-md">
    <?php if($_SESSION["rol_usr"] <> 4) { ?>
    <div class="tabs-container">
        <ul class="nav nav-tabs right">
            <li class="active"><a data-toggle="tab" href="#tabp-1"><i class="fa fa-cubes"></i>Mesas</a></li>
            <li><a data-toggle="tab" href="#tabp-2"><i class="fa fa-columns"></i>Mostrador</a></li>
            <li><a data-toggle="tab" href="#tabp-3"><i class="fa fa-bicycle"></i>Delivery</a></li>
        </ul>
        <div class="tab-content">
            <div id="tabp-1" class="tab-pane active">
                <div class="panel-body">
                    <div class="pull-right"></div>
    <?php } ?>
                    <div class="tabs-container">
                    <ul class="nav nav-tabs right">
                        <?php $cont=1; foreach($this->model->ListarCM() as $p): ?>
                        <li id="tab<?php echo $cont++; ?>"><a data-toggle="tab" href="#tab-<?php echo $p->id_catg; ?>"><i class="fa fa-cube"></i><?php echo $p->descripcion; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="tab-content">
                        <?php $cont=1; $co=0; foreach($this->model->ListarCM() as $c): ?>
                        <div id="tab-<?php echo $c->id_catg; ?>" class="tab-pane tp<?php echo $cont++; ?>">
                            <div class="panel-body">
                                <div class="row" style="text-align: center;">
                                <div class="col-sm-12">
                                    <?php foreach($this->model->ListarMesa() as $r): 
                                    if ($r->id_catg == $c->id_catg AND $r->estado == 'a') { ?>
                                        
                                        <a href="#" onclick="registrarMesa(<?php echo $r->id_mesa.',\''. $r->nro_mesa.'\',\''.$r->desc_m.'\''; ?>);">
                                            <button style="width: 122px" class="btn btn-primary dim btn-large-dim" type="button"><?php echo $r->nro_mesa ?></button>
                                        </a>
                                        
                                    <?php } elseif ($r->id_catg == $c->id_catg AND $r->estado == 'p') { ?>
                                        
                                        <a href="pedido_mesa.php?Cod=<?php echo $r->id_pedido ?>">
                                            <button style="width: 122px" class="btn btn-info dim btn-large-dim" type="button"> <?php echo $r->nro_mesa ?><span class="span-b"><i class="fa fa-clock-o"></i>&nbsp;<input type="hidden" name="hora_pe[]" value="<?php echo $r->fecha_p ?>"/><span id="hora_p<?php echo $co++; ?>"><?php echo $r->fecha_p ?></span>
                                            </span></button>
                                        </a>

                                    <?php } elseif ($r->id_catg == $c->id_catg AND $r->estado == 'i') { ?>
                                        
                                        <a href="pedido_mesa.php?Cod=<?php echo $r->id_pedido ?>">
                                            <button style="width: 122px" class="btn btn-danger dim btn-large-dim" type="button"> <?php echo $r->nro_mesa ?><span class="span-b"><i class="fa fa-clock-o"></i>&nbsp;<input type="hidden" name="hora_pe[]" value="<?php echo $r->fecha_p ?>"/><span id="hora_p<?php echo $co++; ?>"><?php echo $r->fecha_p ?></span>
                                            </span></button>
                                        </a>
                                        
                                    <?php } endforeach; ?>
                                </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
    <?php if($_SESSION["rol_usr"] <> 4) { ?>
                </div>
            </div>
            <div id="tabp-2" class="tab-pane">
                <div class="panel-body">
                <div class="text-right">
                    <button class="btn btn-danger" data-toggle="modal" data-target="#mdl-mostrador"><i class="fa fa-location-arrow"></i>&nbsp;Nuevo Pedido</button>
                </div>
                    <ul class="sortable-list connectList agile-list">
                        <li class="list-group-item lihds">
                            <div class="row">
                                <div class="col-md-1" style="text-align: center;">
                                    <strong>PEDIDO</strong>
                                </div>
                                <div class="col-md-2" style="text-align: center;">
                                    <strong>HORA DE PEDIDO</strong>
                                </div>
                                <div class="col-md-2" style="text-align: center;">
                                    <strong>ESTADO</strong>
                                </div>
                                <div class="col-md-6">
                                    <strong>CLIENTE</strong>
                                </div>
                                <div class="col-md-1">
                                    <strong>TOTAL</strong>
                                </div>
                            </div>
                        </li>
                        <div id="list-mostrador"></div>
                    </ul>
                </div>
            </div>
            <div id="tabp-3" class="tab-pane">
                <div class="panel-body">
                    <div class="text-right">
                        <button class="btn btn-danger" data-toggle="modal" data-target="#mdl-delivery"><i class="fa fa-location-arrow"></i>&nbsp;Nuevo Pedido</button>
                    </div>
                    <div>
                        <h3 class="text-warning"><i class="fa fa-ellipsis-h"></i>&nbsp;EN PREPARACIÓN</h3>
                    </div>
                    <ul class="sortable-list connectList agile-list">
                        <li class="list-group-item lihdo">
                            <div class="row">
                                <div class="col-md-1" style="text-align: center;">
                                    <strong>PEDIDO</strong>
                                </div>
                                <div class="col-md-2" style="text-align: center;">
                                    <strong>HORA DE PEDIDO</strong>
                                </div>
                                <div class="col-md-4">
                                    <strong>DIRECCI&Oacute;N</strong>
                                </div>
                                <div class="col-md-2">
                                    <strong>TEL&Eacute;FONO</strong>
                                </div>
                                <div class="col-md-2">
                                    <strong>CLIENTE</strong>
                                </div>
                                <div class="col-md-1">
                                    <strong>TOTAL</strong>
                                </div>
                            </div>
                        </li>
                        <div id="list-preparacion"></div>
                    </ul>
                    <hr/>
                    <div>
                        <h3 class="text-info"><i class="fa fa-arrow-right"></i>&nbsp;ENVIADOS</h3>
                    </div>
                    <ul class="sortable-list connectList agile-list">
                        <li class="list-group-item lihd">
                            <div class="row">
                                <div class="col-md-1" style="text-align: center;">
                                    <strong>PEDIDO</strong>
                                </div>
                                <div class="col-md-2" style="text-align: center;">
                                    <strong>HORA DE PEDIDO</strong>
                                </div>
                                <div class="col-md-4">
                                    <strong>DIRECCI&Oacute;N</strong>
                                </div>
                                <div class="col-md-2">
                                    <strong>TEL&Eacute;FONO</strong>
                                </div>
                                <div class="col-md-2">
                                    <strong>CLIENTE</strong>
                                </div>
                                <div class="col-md-1">
                                    <strong>TOTAL</strong>
                                </div>
                            </div>
                        </li>
                        <div id="list-enviados"></div>
                    </ul>
                </div>
            </div>
    <?php } ?>
        </div>
    </div>
</div>
</div>
</div>

<div class="modal inmodal fade" id="mdl-mesa" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated bounceInRight">
        <form id="frm-mesa" method="post" enctype="multipart/form-data" action="?c=Inicio&a=RMesa">
        <input type="hidden" name="cod_mesa" id="cod_mesa">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h4 class="modal-title" id="mtm"></h4>
                <small class="font-bold" id="mtp"></small>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Nombre Cliente</label>
                            <input type="text" name="nomb_cliente" class="form-control" placeholder="Ingrese nombre cliente" autocomplete="off" required="required"/>
                        </div>
                    </div>
                    <?php if($_SESSION["rol_usr"] <> 4) { ?>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Nombre Mozo</label>
                            <select name="cod_mozo" id="cod_mozo" class="selectpicker show-tick form-control" data-live-search="true" autocomplete="off" title="Seleccionar Mozo" required="" data-size="5">
                            <?php foreach($this->model->ListarMozos() as $r): ?>
                                <option value="<?php echo $r->id_usu; ?>"><?php echo $r->nombres.' '.$r->ape_paterno.' '.$r->ape_materno; ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Comentario:</label>
                            <textarea name="comentario" class="form-control" placeholder="Ingrese comentario" autocomplete="off" rows="5"> </textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Abrir Mesa</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="mdl-mostrador" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated bounceInRight">
        <form id="frm-mostrador" method="post" enctype="multipart/form-data" action="?c=Inicio&a=RMostrador">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h4 class="modal-title">Nuevo Pedido</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Nombre Cliente</label>
                            <input type="text" name="nomb_cliente" class="form-control" placeholder="Ingrese nombre cliente" autocomplete="off" required="required"/>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Comentario:</label>
                            <textarea name="comentario" class="form-control" placeholder="Ingrese comentario" autocomplete="off" rows="5"> </textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Abrir Pedido</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="mdl-delivery" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
        <form id="frm-delivery" method="post" enctype="multipart/form-data" action="?c=Inicio&a=RDelivery">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h4 class="modal-title">Nuevo Pedido</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">Nombre Cliente</label>
                            <input type="text" name="nombCli" class="form-control" placeholder="Ingrese nombre cliente" autocomplete="off" required="required"/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">Tel&eacute;fono</label>
                            <input type="text" name="telefCli" class="form-control" placeholder="Ingrese tel&eacute;fono" autocomplete="off" required="required"/>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Direcci&oacute;n</label>
                            <input type="text" name="direcCli" class="form-control" placeholder="Ingrese direcci&oacute;n" autocomplete="off" required="required"/>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Comentario:</label>
                            <textarea name="comentario" class="form-control" placeholder="Ingrese comentario" autocomplete="off" rows="5"> </textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Abrir Pedido</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="mdl-cambiar-mesa" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content animated bounceInRight">
        <form id="frm-cambiar-mesa" method="post" enctype="multipart/form-data" action="?c=Inicio&a=CambiarMesa">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h4 class="modal-title"><i class="fa fa-exchange"></i> Cambiar Mesa</h4>
            </div>
            <div class="modal-body">     
                <div class="row">
                    <div class="col-sm-6">
                        <center><label class="control-label">Origen</label></center>
                        <div class="form-group">
                            <label class="control-label">Sal&oacute;n</label>
                            <select name="c_salon" id="cbo-salon-o" class="selectpicker show-tick form-control" data-live-search="true" autocomplete="off">
                            <?php foreach($this->model->ListarCM() as $r): ?>
                                <option value="<?php echo $r->id_catg; ?>"><?php echo $r->descripcion; ?></option>
                            <?php endforeach; ?>                             
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Mesa</label>
                            <select name="c_mesa" id="c_mesa" class="selectpicker show-tick form-control" data-live-search="true" autocomplete="off" title="Seleccionar" required="required" data-size="5">                               
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 b-l-gray-l1">
                        <center><label class="control-label">Destino</label></center>
                        <div class="form-group">
                            <label class="control-label">Sal&oacute;n</label>
                            <select name="co_salon" id="cbo-salon-d" class="selectpicker show-tick form-control" data-live-search="true" autocomplete="off">
                            <?php foreach($this->model->ListarCM() as $r): ?>
                                <option value="<?php echo $r->id_catg; ?>"><?php echo $r->descripcion; ?></option>
                            <?php endforeach; ?>                                   
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Mesa</label>
                            <select name="co_mesa" id="co_mesa" class="selectpicker show-tick form-control" data-live-search="true" autocomplete="off" title="Seleccionar" required="required" data-size="5"></select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Aceptar</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="mdl-detped" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h5 class="modal-title title-d" style="font-size: 18px"></h5>
            </div>
            <form method="post" enctype="multipart/form-data" action="?c=Inicio&a=FinalizarPedido">
                <input type="hidden" name="codPed" id="codPed" value=""/>
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
                            <tbody id="lista_p"></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="text-left">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Finalizar Pedido</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="mdl-validar-apertura" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-transparent text-center p-md"> <i class="fa fa-warning fa-3x text-warning"></i> <h2 class="m-t-none m-b-sm">Advertencia</h2> <p>Para poder realizar esta operaci&oacute;n es necesario Aperturar Caja.</p></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-xs-3">
                        <div class="text-left">
                            <a href="lista_tm_tablero.php" class="btn btn-default">Volver</a>
                        </div>
                    </div>
                    <div class="col-xs-9">
                        <div class="text-right">
                            <a href="lista_caja_aper.php" class="btn btn-primary">Aperturar Caja</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/scripts/inicio/func-inicio.js"></script>
<script type="text/javascript">
$(function() {
    $('#restau').addClass("active");
    $('#tab1').addClass("active");
    $('.tp1').addClass("active");
    $('.scroll_content').slimscroll({
        height: '410px'
    });
});
</script>