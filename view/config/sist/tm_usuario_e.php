<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2><i class="fa fa-cogs"></i> <a class="a-c" href="lista_tm_otros.php">Ajustes</a></h2>
        <ol class="breadcrumb">
            <li class="active">
                <strong>Sistema</strong>
            </li>
            <li class="active">
                <strong><a href="?c=Config">Usuarios</a></strong>
            </li>
            <li>Edici&oacute;n</li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Usuario</h5>    
            </div>
            <form id="frm-usuario" action="?c=Config&a=RUUsuario" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_usu" value="<?php echo $alm->__GET('id_usu'); ?>" />
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12">
                            <div class="ct-wizard-azzure" id="wizardProfile">
                                <div class="picture-container">
                                    <div class="picture">
                                    <?php if ($alm->__GET('id_usu') != null ) { ?> 
                                      <img src="assets/img/usuarios/<?php echo $alm->__GET('imagen'); ?>" class="picture-src" id="wizardPicturePreview" title=""/>
                                      <input type="hidden" name="imagen" value="<?php echo $alm->__GET('imagen'); ?>" />
                                      <input type="file" name="imagen" id="wizard-picture">
                                      <?php } else { ?>
                                        <img src="assets/img/usuarios/default-avatar.png" class="picture-src" id="wizardPicturePreview" title=""/>
                                        <input type="hidden" name="imagen" value="default-avatar.png" />
                                        <input type="file" name="imagen" id="wizard-picture">
                                      <?php } ?>
                                    </div>      
                                    <h6>Cambiar Imagen</h6>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">DNI</label>
                                    <input type="text" name="dni" value="<?php echo $alm->__GET('dni'); ?>" class="form-control" placeholder="Ingrese dni" autocomplete="off" required="required" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Nombres</label>
                                    <input type="text" name="nombres" value="<?php echo $alm->__GET('nombres'); ?>" class="form-control" placeholder="Ingrese nombres" autocomplete="off" required="required" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Apellido Paterno</label>
                                    <input type="text" name="ape_paterno" value="<?php echo $alm->__GET('ape_paterno'); ?>" class="form-control" placeholder="Ingrese apellido paterno" autocomplete="off" required="required" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Apellido Materno</label>
                                    <input type="text" name="ape_materno" value="<?php echo $alm->__GET('ape_materno'); ?>" class="form-control" placeholder="Ingrese apellido materno" autocomplete="off" required="required" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="email" name="email" id="email" value="<?php echo $alm->__GET('email'); ?>" class="form-control" placeholder="Ingrese email" autocomplete="off" required="required" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">Cargo</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-renren"></i></span>
                                        <select name="id_rol" id="id_rol" class="selectpicker show-tick form-control" data-live-search="true" autocomplete="off" required>
                                        <?php if ($alm->__GET('id_usu') != null ) { ?> 
                                            <option value="<?php echo $alm->__GET('id_rol'); ?>">
                                        <?php echo $alm->__GET('desc_r'); ?>
                                            </option>
                                        <?php } else {
                                            echo '<option value="" selected>Seleccionar</option>';
                                            echo '<optgroup label="Seleccionar">';
                                        } ?>
                                        <optgroup label="Seleccionar">
                                        <?php foreach($this->model->ListarCatgRol() as $r): ?>
                                          <option value="<?php echo $r->id_rol; ?>"><?php echo $r->descripcion; ?></option>
                                        <?php endforeach; ?>
                                        </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12" id="area-p" style="display: none">
                                <div class="form-group">
                                    <label class="control-label">&Aacute;rea de Producci&oacute;n</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-renren"></i></span>
                                        <select name="cod_area" id="cod_area" class="selectpicker show-tick form-control" data-live-search="true" autocomplete="off" required="required">
                                        <?php if ($alm->__GET('id_usu') != null ) { ?> 
                                            <option value="<?php echo $alm->__GET('id_areap'); ?>"><?php echo $alm->__GET('desc_ap'); ?></option>
                                        <?php } else {
                                            echo '<option value="" selected>Seleccionar</option>';
                                            echo '<optgroup label="Seleccionar">';
                                        } ?>
                                        <optgroup label="Seleccionar">
                                        <?php foreach($this->model->ListarAreaP() as $r): ?>
                                          <option value="<?php echo $r->id_areap; ?>"><?php echo $r->nombre; ?></option>
                                        <?php endforeach; ?>
                                        </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">Usuario</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" name="usuario" value="<?php echo $alm->__GET('usuario'); ?>" class="form-control" placeholder="Ingrese usuario" autocomplete="off" required="required" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">Contrase&ntilde;a</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-certificate"></i></span>
                                        <input type="password" name="contrasena" value="<?php echo $alm->__GET('contrasena'); ?>" class="form-control" placeholder="Ingrese contrase&ntilde;a" autocomplete="off" required="required" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ibox-footer">
              <div class="text-right">
                    <a href="?c=Config" class="btn btn-default">Cancelar</a>
                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;Guardar</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

<script src="assets/scripts/config/func_usuario_e.js"></script>
<script src="assets/js/plugins/wizard/jquery.bootstrap.wizard.js" type="text/javascript"></script>
<script src="assets/js/plugins/wizard/wizard.js"></script>
<script src="assets/js/jquery.email-autocomplete.min.js"></script>
<script type="text/javascript">
$(function () {
$("#email").emailautocomplete({
    domains: [
        "gmail.com",
        "yahoo.com",
        "hotmail.com",
        "live.com",
        "facebook.com",
        "outlook.com"
        ]
    });
});
</script>