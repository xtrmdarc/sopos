<?php
require_once 'model/config/tm_insumo.model.php';
class ConfigController{
    
    private $model;

    public function __CONSTRUCT(){
        $this->model = new ConfigModel();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/config/rest/tm_insumo.php';
        require_once 'view/footer.php';
    }

    public function ListaCatgs()
    {
        $this->model->ListaCatgs($_POST);
    }

    public function ListaIns()
    {
        $this->model->ListaIns($_POST);
    }

    public function ComboCatg()
    {
        $this->model->ComboCatg($_POST);
    }

    public function CrudCatg()
    {
        if($_POST['cod_catg'] != ''){
           print_r(json_encode( $this->model->UCatg($_POST)));
        } else{
           print_r(json_encode( $this->model->CCatg($_POST)));
        }
    }

    public function CrudIns()
    {
        if($_POST['cod_ins'] != ''){
           print_r(json_encode( $this->model->UIns($_POST)));
        } else{
           print_r(json_encode( $this->model->CIns($_POST)));
        }
    }
}
?> 