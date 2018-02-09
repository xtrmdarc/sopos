<input type="hidden" id="m" value="<?php echo $_GET['m']; ?>"/>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2><i class="fa fa-cogs"></i> <a class="a-c" href="lista_tm_otros.php">Ajustes</a></h2>
        <ol class="breadcrumb">
            <li class="active">
                <strong>Sistema</strong>
            </li>
            <li>Usuarios</li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated bounce">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5><i class="fa fa-users"></i> Lista de Usuarios</h5>
                <div class="ibox-title-buttons pull-right">
                    <a href="?c=Config&a=CrudUsuario"><button type="button" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Nuevo Usuario</button></a>
                </div>
            </div>
            <div class="ibox-content">
            <div class="table-responsive">
                <table class="table table-hover table-condensed table-striped" id="table" width="100%">
                    <thead>
                        <tr>
                            <th>Nombres</th>
                            <th>Ape.Paterno</th>
                            <th>Ape.Materno</th>
                            <th style="text-align: center">Cargo</th>
                            <th style="text-align: center">Estado</th>
                            <th style="text-align: center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($this->model->ListarUsuarios() as $r): ?>
                        <tr>
                            <td><?php echo $r->nombres; ?></td>
                            <td><?php echo $r->ape_paterno; ?></td>
                            <td><?php echo $r->ape_materno; ?></td>
                            <td style="text-align: center">
                                <?php
                                    if($r->id_rol == 1){
                                        echo '<span class="label label-danger">'.$r->desc_r.'</span>';
                                    } elseif($r->id_rol == 2){
                                        echo '<span class="label label-primary">'.$r->desc_r.'</span>';
                                    } elseif($r->id_rol == 3){
                                        echo '<span class="label label-warning">'.$r->desc_r.'</span>';
                                    } elseif($r->id_rol == 4){
                                        echo '<span class="label label-default">'.$r->desc_r.'</span>';
                                    } else {
                                        echo '<span class="label label-success">'.$r->desc_r.'</span>';
                                    }
                                ?>
                            </td>
                            <td style="text-align: center">
                            <?php
                                if($r->estado == 'a'){
                                    echo '<a onclick="estadoUsuario('.$r->id_usu.');"><span class="label label-primary">ACTIVO</span></a>';
                                }else if($r->estado == 'i'){
                                    echo '<a onclick="estadoUsuario('.$r->id_usu.');"><span class="label label-danger">INACTIVO</span></a>';
                                } 
                            ?>
                            </td>
                            <td style="text-align: right">
                                <a href="?c=Config&a=CrudUsuario&cod_usu=<?php echo $r->id_usu; ?>"
                                <button type="button" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Editar</button></a>
                                <button type="button" class="btn btn-danger btn-xs" onclick="eliminarUsuario(<?php echo $r->id_usu.',\''. $r->nombres.' '.$r->ape_paterno.' '.$r->ape_materno.'\''; ?>);"><i class="fa fa-trash-o"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            </div>
        </div>
    </div>
</div>
</div>

<div class="modal inmodal fade" id="mdl-estado-usu" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated bounceInRight">
        <form id="frm-estado-usu" method="post" enctype="multipart/form-data" action="?c=Config&a=Estado">
        <input type="hidden" name="cod_usu" id="cod_usu">
            <div class="modal-header mh-e">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <i class="fa fa-stack-exchange modal-icon"></i>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                    <div class="form-group">
                        <label class="control-label">Estado</label>
                        <select name="estado" id="estado_usu" class="selectpicker show-tick form-control" data-live-search-style="begins" data-live-search="true" title="Seleccionar" autocomplete="off" required="required">
                            <option value="a">ACTIVO</option>
                            <option value="i">INACTIVO</option>
                        </select>
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

<div class="modal inmodal fade" id="mdl-eliminar-usu" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated bounceInRight">
        <form id="frm-eliminar-usu" method="post" enctype="multipart/form-data" action="?c=Config&a=Eliminar">
        <input type="hidden" name="cod_usu_e" id="cod_usu_e">
            <div class="modal-header mh-p">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <i class="fa fa-trash-o modal-icon"></i>
            </div>
            <div class="modal-body">
                <div id="mensaje-u"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Aceptar</button>
            </div>
        </form>
        </div>
    </div>
</div>

<script src="assets/scripts/config/func_usuario.js"></script>

