<?php
require_once 'model/informes/compras/inf_proveedores.model.php';
class InformeController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model  = new InformeModel();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/informes/compras/inf_proveedores.php';
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
    
    public function DetalleC()
    {
        print_r(json_encode($this->model->DetalleC($_POST)));
    }

    public function Detalle_C()
    {
        print_r(json_encode($this->model->Detalle_C($_POST)));
    }
}