<?php
require_once 'model/config/tm_caja.model.php';

class ConfigController{
    
    private $model;

    public function __CONSTRUCT(){
        $this->model = new ConfigModel();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/config/rest/tm_caja.php';
        require_once 'view/footer.php';
    }

    public function ListaCajas()
    {
        $this->model->ListaCajas($_POST);
    }

    public function CrudCaja()
    {
        if($_POST['cod_caja'] != ''){
           print_r(json_encode( $this->model->UCaja($_POST)));
        } else{
           print_r(json_encode( $this->model->CCaja($_POST)));
        }
    }

}
?> 