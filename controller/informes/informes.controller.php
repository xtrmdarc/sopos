<?php
require_once 'model/informes/informes.model.php';

class InformeController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model  = new InformeModel();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/informes/index.php';
        require_once 'view/footer.php';
    }
}