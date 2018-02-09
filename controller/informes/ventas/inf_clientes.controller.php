<?php
require_once 'model/informes/ventas/inf_clientes.model.php';
class InformeController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model  = new InformeModel();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/informes/ventas/inf_clientes.php';
        require_once 'view/footer.php';
    }

    public function Datos()
    {
        $this->model->Datos($_POST);
    }

    public function Detalle()
    {
        print_r(json_encode($this->model->Detalle($_POST)));
    }
}