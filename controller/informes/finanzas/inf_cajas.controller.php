<?php
require_once 'model/informes/finanzas/inf_cajas.model.php';
class InformeController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model  = new InformeModel();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/informes/finanzas/inf_cajas.php';
        require_once 'view/footer.php';
    }

    public function Datos()
    {
        $this->model->Datos($_POST);
    }

    //MONTO DEL SISTEMA
    public function MontoSis()
    {
        print_r(json_encode($this->model->MontoSis($_POST)));
    }
}