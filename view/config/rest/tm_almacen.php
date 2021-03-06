<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2><i class="fa fa-cogs"></i> <a class="a-c" href="lista_tm_otros.php">Ajustes</a></h2>
        <ol class="breadcrumb">
            <li class="active">
                <strong>Restaurante</strong>
            </li>
            <li>Almacenes y &Aacute;reas de Producci&oacute;n</li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content">
<div class="row">
    <div class="col-lg-6">
        <div class="ibox animated bounce">
            <div class="ibox-title">
                <div class="ibox-title-buttons pull-right">
                    <button type="button" class="btn btn-primary btn-alm"><i class="fa fa-plus-circle"></i> Nuevo Almac&eacute;n</button>
                </div>
                <h5><i class="fa fa-cubes"></i> Almacenes</h5>
            </div>
            <div class="ibox-content">
                <table class="table table-condensed table-striped table-hover" id="table-alm">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th class="text-right">Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="ibox animated bounce">
            <div class="ibox-title">
                <div class="ibox-title-buttons pull-right">
                    <button type="button" class="btn btn-primary btn-area"><i class="fa fa-plus-circle"></i> Nueva &Aacute;rea</button>
                </div>
                <h5><i class="fa fa-list-alt"></i> &Aacute;reas de Producci&oacute;n</h5>
            </div>
            <div class="ibox-content">
                <table class="table table-condensed table-striped table-hover" id="table-area">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Almac&eacute;n</th>
                            <th>Estado</th>
                            <th class="text-right">Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal inmodal fade" id="mdl-almacen" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
    <div class="modal-dialog" style="max-width: 400px;">
        <div class="modal-content animated bounceInRight">
        <form id="frm-almacen" method="post" enctype="multipart/form-data">
        <input type="hidden" name="cod_alm" id="cod_alm">
            <div class="modal-header mh-e">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h4 class="modal-title mt"><strong id="title-alm"></strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Nombre</label>
                            <input type="text" name="nomb_alm" id="nomb_alm" class="form-control" placeholder="Ingrese nombre" autocomplete="off" required="required"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Estado</label>
                            <select name="estado_alm" id="estado_alm" class="selectpicker show-tick form-control"  data-live-search="false" autocomplete="off" required="required">
                                <option value="a">ACTIVO</option>
                                <option value="i">INACTIVO</option>                                
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="mdl-areaprod" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
    <div class="modal-dialog" style="max-width: 400px;">
        <div class="modal-content animated bounceInRight">
        <form id="frm-areaprod" method="post" enctype="multipart/form-data">
        <input type="hidden" name="cod_area" id="cod_area">
            <div class="modal-header mh-e">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <h4 class="modal-title mt"><strong id="title-area"></strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Nombre</label>
                            <input type="text" name="nomb_area" id="nomb_area" class="form-control" placeholder="Ingrese nombre" autocomplete="off" required="required"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Almac&eacute;n</label>
                            <div id="combo_alm"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Estado</label>
                            <select name="estado_area" id="estado_area" class="selectpicker show-tick form-control"  data-live-search="false" autocomplete="off" required="required">
                                <option value="a">ACTIVO</option>
                                <option value="i">INACTIVO</option>                                
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary btn-guardar"><i class="fa fa-save"></i> Guardar</button>
            </div>
        </form>
        </div>
    </div>
</div>

<script src="assets/scripts/config/func_almacenes.js"></script>
<script type="text/javascript">
$(function() {
    $('#config').addClass("active");
});
</script>