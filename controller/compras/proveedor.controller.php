<?php
require_once 'model/compras/proveedor.entidad.php';
require_once 'model/compras/proveedor.model.php';

class ProveedorController{
    
    private $model;

    public function __CONSTRUCT(){
        $this->model = new ProveedorModel();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/compras/proveedores/index.php';
        require_once 'view/footer.php';
    }

    public function Crud(){
        $alm = new Proveedor();
        if(isset($_REQUEST['cod_prov'])){
            $alm = $this->model->Obtener($_REQUEST['cod_prov']);
        }
        require_once 'view/header.php';
        require_once 'view/compras/proveedores/editar.php';
        require_once 'view/footer.php';
    }

    public function RUProveedor(){
        $alm = new Proveedor();
        $alm->__SET('id_prov',    $_REQUEST['id_prov']);
        $alm->__SET('ruc',    $_REQUEST['ruc']);
        $alm->__SET('razon_social',    $_REQUEST['razon_social']);
        $alm->__SET('direccion',    $_REQUEST['direccion']);
        $alm->__SET('telefono',    $_REQUEST['telefono']);
        $alm->__SET('email',    $_REQUEST['email']);
        $alm->__SET('contacto',    $_REQUEST['contacto']);
        if($alm->__GET('id_prov') != ''){
           $this->model->Actualizar($alm);
           header('Location: lista_comp_prov.php?m=u');
        } else {
           $row = $this->model->Registrar($alm);
           if ($row['dup'] == 1){
                header('Location: lista_comp_prov.php?m=d');
            } else {
                header('Location: lista_comp_prov.php?m=n');
            }
        }
    }

    public function Estado(){
        $alm = new Proveedor();
        if ($_REQUEST['estado']=='a' || $_REQUEST['estado']=='i'){
            $alm->__SET('cod_prov',  $_REQUEST['cod_prov']);
            $alm->__SET('estado',     $_REQUEST['estado']);
            $this->model->Estado($alm);
            header('Location: lista_comp_prov.php');
        }else{
            header('Location: lista_comp_prov.php');
        }
    }
}
?> 