<?php
require_once 'model/config/tm_producto.entidad.php';
require_once 'model/config/tm_producto.model.php';

class ConfigController{
    
    private $model;

    public function __CONSTRUCT(){
        $this->model = new ConfigModel();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/config/rest/tm_producto.php';
        require_once 'view/footer.php';
    }

    public function EliminarP(){
        $this->model->EliminarP($_REQUEST['cod_prod_e']);
    }

    public function ListaProd()
    {
        $this->model->ListaProd($_POST);
    }

    public function ListaPres()
    {
        $this->model->ListaPres($_POST);
    }

    public function ListaCatgs()
    {
        $this->model->ListaCatgs($_POST);
    }

    public function ListaIngs()
    {
        $this->model->ListaIngs($_POST);
    }

    public function ComboCatg()
    {
        $this->model->ComboCatg($_POST);
    }

    public function ComboUniMed()
    {
        $this->model->ComboUniMed($_POST);
    }

    public function BuscarIns()
    {
        print_r(json_encode($this->model->BuscarIns($_REQUEST['criterio'])));
    }

    public function GuardarIng()
    {
        print_r(json_encode( $this->model->GuardarIng($_POST)));
    }

    public function UIng()
    {
        print_r(json_encode($this->model->UIng($_POST)));
    }

    public function EIng()
    {
        print_r(json_encode($this->model->EIng($_POST)));
    }

    public function CrudProd()
    {
        if($_POST['cod_prod'] != ''){
           print_r(json_encode($this->model->UProd($_POST)));
        } else{
           print_r(json_encode($this->model->CProd($_POST)));
        }
    }

    public function CrudPres()
    {
        if($_POST['cod_pres'] != ''){
           print_r(json_encode($this->model->UPres($_POST)));
        } else{
           print_r(json_encode($this->model->CPres($_POST)));
        }
    }

    public function CrudCatg()
    {
        if($_POST['cod_catg'] != ''){
           print_r(json_encode($this->model->UCatg($_POST)));
        } else{
           print_r(json_encode($this->model->CCatg($_POST)));
        }
    }
}
?> 