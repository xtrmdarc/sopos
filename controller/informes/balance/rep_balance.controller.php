<?php
require_once 'model/reportes/balance/rep_balance.model.php';
require_once 'model/reportes/balance/rep_balance.entidad.php';

class ReporteController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model  = new ReporteModel();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/reportes/balance/index.php';
        require_once 'view/footer.php';
    }

    public function Datos()
    {
        $this->model->Datos($_POST);
    }
}