<?php
require_once 'model/config/tm_mesa.entidad.php';
require_once 'model/config/tm_mesa.model.php';

class ConfigController{
    
    private $model;

    public function __CONSTRUCT(){
        $this->model = new ConfigModel();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/config/rest/tm_mesa.php';
        require_once 'view/footer.php';
    }

    public function ListaSalones()
    {
        $this->model->ListaSalones($_POST);
    }

    public function ListaMesas()
    {
        $this->model->ListaMesas($_POST);
    }

    public function CrudSalones()
    {
        if($_POST['cod_sala'] != ''){
           print_r(json_encode( $this->model->USalones($_POST)));
        } else{
           print_r(json_encode( $this->model->CSalones($_POST)));
        }
    }

    public function CrudMesas()
    {
        if($_POST['cod_mesa'] != '' and $_POST['id_catg'] != ''){
           print_r(json_encode( $this->model->UMesas($_POST)));
        } else{
           print_r(json_encode( $this->model->CMesas($_POST)));
        }
    }

    public function EliminarS()
    {
        if($_POST['cod_salae'] != ''){
           print_r(json_encode( $this->model->EliminarS($_POST)));
        } 
    }

    public function EliminarM()
    {
        if($_POST['cod_mesae'] != ''){
           print_r(json_encode( $this->model->EliminarM($_POST)));
        } 
    }

    public function EstadoM()
    {
        if($_POST['codi_mesa'] != ''){
           print_r(json_encode( $this->model->EstadoM($_POST)));
        } 
    }
}

?> 