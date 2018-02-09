<input type="hidden" id="m" value="<?php echo $_GET['m']; ?>"/>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2><i class="fa fa-cogs"></i> <a class="a-c" href="lista_tm_otros.php">Ajustes</a></h2>
        <ol class="breadcrumb">
            <li class="active">
                <strong>Sistema</strong>
            </li>
            <li>Datos de la empresa</li>
        </ol>
    </div>
</div>

<form id="frm-datos-empresa" action="?c=Config&a=GuardarDE" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $alm->__GET('id'); ?>" />
<div class="col-lg-8">
<div class="wrapper wrapper-content animated bounce">
    <div class="row">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><i class="fa fa-building"></i> Datos de la empresa</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="ct-wizard-blue" id="wizardProfile">
                           <div class="picture-container">
                                <div class="picture">
                                    <img src="assets/img/<?php echo $alm->__GET('logo'); ?>" class="picture-src" id="wizardPicturePreview" title=""/>
                                    <input type="hidden" name="logo" value="<?php echo $alm->__GET('logo'); ?>" />
                                    <input type="file" name="logo" id="wizard-picture">
                                </div>      
                                <h6>Cambiar Imagen</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">RAZÓN SOCIAL</label>
                                    <input type="text" name="razon_social" value="<?php echo $alm->__GET('razon_social'); ?>" class="form-control" placeholder="Razón Social" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-sm-6">       
                                <div class="form-group">
                                    <label class="control-label">ABREVIATURA</label>
                                    <input type="text" name="abrev_rs" value="<?php echo $alm->__GET('abrev_rs'); ?>" class="form-control" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">IGV:</label>
                                    <div class="input-group">
                                        <input type="text" name="igv" value="<?php echo $alm->__GET('igv'); ?>" class="form-control" placeholder="Ingrese IGV" autocomplete="off" required/>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">RUC:</label>
                                    <input type="text" name="ruc" value="<?php echo $alm->__GET('ruc'); ?>" class="form-control" placeholder="Ingrese RUC" maxlength="11" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">MONEDA:</label>
                                    <input type="text" name="moneda" value="<?php echo $alm->__GET('moneda'); ?>" class="form-control" placeholder="Ingrese Moneda" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">TELÉFONO:</label>
                                    <input type="text" name="telefono" value="<?php echo $alm->__GET('telefono'); ?>" class="form-control" placeholder="Ingrese Teléfono" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                    </div>                       
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label">DIRECCIÓN:</label>
                            <input type="text" name="direccion" value="<?php echo $alm->__GET('direccion'); ?>" class="form-control" placeholder="Ingrese dirección" autocomplete="off" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ibox-footer">
                <div class="text-right">
                    <button class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</form>

<div class="col-lg-4">
<div class="wrapper wrapper-content">
    <div class="panel panel-transparent panel-dashed tip-sales text-center">
        <div class="row">
            <div class="col-sm-8 col-sm-push-2">
                <h2 class="ich m-t-none">Realize cambios</h2>
                <i class="fa fa-long-arrow-left fa-3x"></i>
                <p class="ng-binding">Modifique los datos de su empresa.</p>
            </div>
        </div>
    </div>
</div>
</div>

<script src="assets/scripts/config/func_de.js"></script>
<script type="text/javascript">
    $('#config').addClass("active");
</script>