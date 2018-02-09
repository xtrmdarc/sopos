<?php
require_once 'model/caja/ing_caja.entidad.php';
require_once 'model/caja/ing_caja.model.php';

class ICajaController{
    
    private $model;

    public function __CONSTRUCT(){
        $this->model = new ICajaModel();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/caja/ing_caja.php';
        require_once 'view/footer.php';
    }

    public function Guardar(){
        $alm = new Ingreso();
        $alm->__SET('importe', $_REQUEST['importe']);
        $alm->__SET('motivo', $_REQUEST['motivo']);
        $this->model->Registrar($alm);
        header('Location: lista_caja_ing.php?m=n');
    }

    //ESTADO DE COMPROBANTE
    public function Estado(){
        $alm = new Ingreso();
        $alm->__SET('cod_ing',  $_REQUEST['cod_ing']);
        $this->model->Estado($alm);
        header('Location: lista_caja_ing.php?m=a');
    }
}
?> 