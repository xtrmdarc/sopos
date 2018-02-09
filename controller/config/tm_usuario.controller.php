<?php
require_once 'model/config/tm_usuario.entidad.php';
require_once 'model/config/tm_usuario.model.php';

class ConfigController{
    
    private $model;

    public function __CONSTRUCT(){
        $this->model = new ConfigModel();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/config/sist/tm_usuario.php';
        require_once 'view/footer.php';
    }

    public function CrudUsuario(){
        $alm = new Usuario();
        
        if(isset($_REQUEST['cod_usu'])){
            $alm = $this->model->ObtenerUsuario($_REQUEST['cod_usu']);
        }

        require_once 'view/header.php';
        require_once 'view/config/sist/tm_usuario_e.php';
        require_once 'view/footer.php';
    }

    public function RUUsuario(){

        $alm = new Usuario();
        $alm->__SET('id_usu',    $_REQUEST['id_usu']);
        $alm->__SET('id_rol',   $_REQUEST['id_rol']);
        $alm->__SET('cod_area',   $_REQUEST['cod_area']);
        $alm->__SET('dni',   $_REQUEST['dni']);
        $alm->__SET('ape_paterno',   $_REQUEST['ape_paterno']);
        $alm->__SET('ape_materno',  $_REQUEST['ape_materno']);
        $alm->__SET('nombres',    $_REQUEST['nombres']);
        $alm->__SET('email',    $_REQUEST['email']);
        $alm->__SET('usuario',    $_REQUEST['usuario']);
        $alm->__SET('estado',    $_REQUEST['estado']);
        $alm->__SET('imagen',    $_REQUEST['imagen']);
        $alm->__SET('contrasena',    $_REQUEST['contrasena']);

        if( !empty( $_FILES['imagen']['name'] ) ){
            $imagen = date('ymdhis') . '-' . strtolower($_FILES['imagen']['name']);
            move_uploaded_file ($_FILES['imagen']['tmp_name'], 'assets/img/usuarios/'.$imagen);          
            $alm->__SET('imagen', $imagen);
        }

        if($alm->__GET('id_usu') != ''){
           $this->model->ActualizarUsuario($alm);
           header('Location: lista_tm_usuarios.php?m=u');
        }
        else{
           $row = $this->model->RegistrarUsuario($alm);
           if ($row['dup'] == 0){
                header('Location: lista_tm_usuarios.php?m=n');
            } else {
                header('Location: lista_tm_usuarios.php?m=d');
            }
        }
    }

    public function Estado(){
        $alm = new Usuario();
        if ($_REQUEST['estado']=='a' || $_REQUEST['estado']=='i'){
            $alm->__SET('cod_usu',  $_REQUEST['cod_usu']);
            $alm->__SET('estado',     $_REQUEST['estado']);
            $this->model->Estado($alm);
            header('Location: lista_tm_usuarios.php');
        }else{
            header('Location: lista_tm_usuarios.php');
        }
    }

    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['cod_usu_e']);
    }
}
?> 