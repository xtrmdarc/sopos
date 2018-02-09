<?php
require_once 'model/caja/egr_caja.entidad.php';
require_once 'model/caja/egr_caja.model.php';

class ECajaController{
    
    private $model;

    public function __CONSTRUCT(){
        $this->model = new ECajaModel();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/caja/egr_caja.php';
        require_once 'view/footer.php';
    }

    public function Guardar(){
        $alm = new Egreso();
        $alm->__SET('rating', $_REQUEST['rating']);
        $alm->__SET('id_tipo_doc', $_REQUEST['id_tipo_doc']);
        $alm->__SET('fecha_comp', date('Y-m-d',strtotime($_REQUEST['fecha_comp'])));
        $alm->__SET('serie_doc', $_REQUEST['serie_doc']);
        $alm->__SET('num_doc', $_REQUEST['num_doc']);
        $alm->__SET('id_per', $_REQUEST['id_per']);
        $alm->__SET('importe', $_REQUEST['importe']);
        $alm->__SET('motivo', $_REQUEST['motivo']);

           $this->model->Registrar($alm);
           header('Location: lista_caja_egr.php?m=n');
    }

    //ESTADO DE COMPROBANTE
    public function Estado(){
        $alm = new Egreso();
        $alm->__SET('cod_ga',  $_REQUEST['cod_ga']);
        $this->model->Estado($alm);
        header('Location: lista_caja_egr.php?m=a');
    }
}
?> 