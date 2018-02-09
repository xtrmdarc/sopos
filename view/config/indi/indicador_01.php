<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2><i class="fa fa-cogs"></i> <a class="a-c" href="lista_tm_otros.php">Ajustes</a></h2>
        <ol class="breadcrumb">
            <li>
                Indicadores
            </li>
            <li class="active">
                <strong>M&aacute;rgen de ventas (por d&iacute;a)</strong>
            </li>
        </ol>
    </div>
</div>

<div class="col-lg-6">
<div class="wrapper wrapper-content animated bounce">
    <div class="row">
        <div class="ibox">
            <div class="ibox-title">
                <h5><i class="fa fa-line-chart"></i> M&aacute;rgenes</h5>
            </div>
            <div class="ibox-content">
                <div class="row">&nbsp;</div>
                <table class="table table-hover table-condensed table-striped" id="table">
                    <thead class="thd">
                        <tr>
                            <th>Orden</th>
                            <th>D&iacute;a</th>
                            <th>M&aacute;rgen</th>
                            <th>Acci&oacute;n</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<div class="col-lg-6">
<div class="wrapper wrapper-content">
        <div class="panel panel-transparent panel-dashed tip-sales text-center">
            <div class="row">
                <div class="col-sm-8 col-sm-push-2">
                    <h2 class="ich m-t-none">Selecciona un tipo de m&aacute;rgen</h2>
                    <i class="fa fa-long-arrow-left fa-3x"></i>
                    <p class="ng-binding">Navega por la lista de m&aacute;rgenes y realize cambios..</p></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="mdl-indicador" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated bounceInRight">
        <form id="frm-indicador" method="post" enctype="multipart/form-data">
        <input type="hidden" name="cod_ind" id="cod_ind">
            <div class="modal-header mh-e">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <i class="fa fa-edit modal-icon"></i>
            </div>
            <div class="modal-body">
                <div id="mensaje"></div>
                <br>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                        <label class="control-label">M&aacute;rgen de venta</label>
                            <div class="input-group dec">
                                <span class="input-group-addon">S/.</span>
                                <input type="text" name="m_venta" id="m_venta" class="form-control" placeholder="M&aacute;rgen de venta" autocomplete="off" required="required" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Cerrar</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
            </div>
        </form>
        </div>
    </div>
</div>

<script src="assets/scripts/config/func_ind01.js"></script>
<script type="text/javascript">
    $('#config').addClass("active");
</script>