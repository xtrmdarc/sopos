<?php
require_once 'model/informes/inventario/inf_kardex.model.php';
class InformeController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model  = new InformeModel();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/informes/inventario/inf_kardex.php';
        require_once 'view/footer.php';
    }

    public function Datos()
    {
        $this->model->Datos($_POST);
    }

    public function ComboIP()
    {
        $this->model->ComboIP($_POST);
    }
}