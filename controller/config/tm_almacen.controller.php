<?php
require_once 'model/config/tm_almacen.model.php';

class ConfigController{
    
    private $model;

    public function __CONSTRUCT(){
        $this->model = new ConfigModel();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/config/rest/tm_almacen.php';
        require_once 'view/footer.php';
    }

    public function ListaAlmacenes()
    {
        $this->model->ListaAlmacenes($_POST);
    }

    public function CrudAlmacen()
    {
        if($_POST['cod_alm'] != ''){
           print_r(json_encode( $this->model->UAlmacen($_POST)));
        } else{
           print_r(json_encode( $this->model->CAlmacen($_POST)));
        }
    }

    public function ListaAreasP()
    {
        $this->model->ListaAreasP($_POST);
    }

    public function CrudAreaP()
    {
        if($_POST['cod_area'] != ''){
           print_r(json_encode( $this->model->UAreasP($_POST)));
        } else{
           print_r(json_encode( $this->model->CAreasP($_POST)));
        }
    }

    public function ComboAlm()
    {
        $this->model->ComboAlm($_POST);
    }
}
?> 