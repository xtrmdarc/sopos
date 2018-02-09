<?php
require_once 'model/areaprod/areaprod.model.php';

class AreaProdController{
    
    private $model;

    public function __CONSTRUCT(){
        $this->model = new AreaProdModel();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/areaprod/areaprod.php';
        require_once 'view/footer.php';
    }

    public function ListarM(){
        print_r(json_encode($this->model->ListarM()));
    }

    public function ListarMO(){
        print_r(json_encode($this->model->ListarMO()));
    }

    public function ListarDE(){
        print_r(json_encode($this->model->ListarDE()));
    }

    public function Preparacion(){
        print_r(json_encode($this->model->Preparacion($_POST)));
    }

    public function Atendido(){
        print_r(json_encode($this->model->Atendido($_POST)));
    }
}
?> 