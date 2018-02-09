<input type="hidden" id="m" value="<?php echo $_GET['m']; ?>"/>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2><i class="fa fa-cogs"></i> <a class="a-c" href="lista_tm_otros.php">Ajustes</a></h2>
        <ol class="breadcrumb">
            <li>Sistema</li>
            <li class="active">
                <strong>Roles de Usuario</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated bounce">
    <div class="row">
        <div class="col-lg-6">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Roles</h5>
                <div class="ibox-title-buttons pull-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_r"><i class="fa fa-plus-circle"></i> Nuevo Rol</button>
                </div>
            </div>
            <div class="ibox-content">
                <table class="table table-hover table-condensed table-striped dataTables-example" >
                <thead class="lihds">
                <tr>
                    <th>Nombre del Rol</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($this->model->ListarRoles() as $r): ?>
                <tr>
                    <td class="dtdi"><?php echo $r->descripcion; ?></td>
                    <td class="dtdf">
                        <button type="button" class="btn btn-info btn-sm" onclick="editarRol(<?php echo $r->id_rol.',\''. $r->descripcion.'\''; ?>);"><i class="fa fa-pencil"></i></button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="eliminarRol(<?php echo $r->id_rol.',\''. $r->descripcion.'\''; ?>);"><i class="fa fa-trash-o"></i></button>
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

<div class="modal inmodal fade" id="mdl-rol" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated bounceInRight">
        <form id="frm-rol" method="post" enctype="multipart/form-data" action="?c=Config&a=GARol">
        <input type="hidden" name="cod_rol" id="cod_rol">
            <div class="modal-header mh-e">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <i class="fa fa-edit modal-icon"></i>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                    <div class="form-group let">
                        <label class="control-label">Nombre del Rol</label>
                        <input type="text" name="descripcion" id="descripcion_r" class="form-control" placeholder="Ingrese nombre del rol" autocomplete="off" required="required"/>
                    </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="mdl-eliminar-rol" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated bounceInRight">
        <form id="frm-eliminar-rol" method="post" enctype="multipart/form-data" action="?c=Config&a=Eliminar">
        <input type="hidden" name="cod_rol_e" id="cod_rol_e">
            <div class="modal-header mh-p">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                <i class="fa fa-trash-o modal-icon"></i>
            </div>
            <div class="modal-body">
                <div id="mensaje-r"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> Eliminar</button>
            </div>
        </form>
        </div>
    </div>
</div>

<script src="assets/scripts/config/func_rol.js"></script>
<script type="text/javascript">
$(function() {
    $('.dataTables-example').DataTable();
    $('#config').addClass("active");
});
</script>