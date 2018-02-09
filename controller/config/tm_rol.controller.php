<?php
require_once 'model/config/tm_rol.entidad.php';
require_once 'model/config/tm_rol.model.php';

class ConfigController{
    
    private $model;

    public function __CONSTRUCT(){
        $this->model = new ConfigModel();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/config/sist/tm_rol.php';
        require_once 'view/footer.php';
    }

    public function GARol(){
        $alm = new Rol();
        $alm->__SET('cod_rol', $_REQUEST['cod_rol']);
        $alm->__SET('descripcion', $_REQUEST['descripcion']);
        if($alm->__GET('cod_rol') != ''){
            $row = $this->model->ARol($alm);
            if ($row['dup'] == 0){
                header('Location: lista_tm_roles.php?m=u');
            } else {
                header('Location: lista_tm_roles.php?m=d');
            }
        }
        else{
            $row = $this->model->RRol($alm);
            if ($row['dup'] == 0){
                header('Location: lista_tm_roles.php?m=n');
            } else {
                header('Location: lista_tm_roles.php?m=d');
            }
        }
    }

    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['cod_rol_e']);
    }

}
?> 