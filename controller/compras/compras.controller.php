<?php
require_once 'model/compras/compras.entidad.php';
require_once 'model/compras/compras.model.php';

class CompraController{
    
    private $model;

    public function __CONSTRUCT(){
        $this->model = new CompraModel();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/compras/index.php';
        require_once 'view/footer.php';
    }

    public function Nuevo(){
        require_once 'view/header.php';
        require_once 'view/compras/crear.php';
        require_once 'view/footer.php';
    }

    public function BuscarProv()
    {
        print_r(json_encode($this->model->BuscarProv($_REQUEST['criterio'])));
    }

    public function BuscarIns()
    {
        print_r(json_encode($this->model->BuscarIns($_REQUEST['criterio'])));
    }

    public function GuardarCompra()
    {
        print_r(json_encode($this->model->GuardarCompra($_POST)));
    }

    public function ObtenerDatos()
    {
        $this->model->ObtenerDatos($_POST);
    }

    public function AnularCompra(){
        $row = $this->model->AnularCompra($_REQUEST['cod_compra']);
        if ($row['dup'] == 1){
            header('Location: lista_comp.php?m=c');
        } else {
            header('Location: lista_comp.php?m=e');
        }
    }

    public function NuevoProv()
    {
        print_r(json_encode($this->model->NuevoProv($_POST)));
    }

    public function Detalle()
    {
        print_r(json_encode($this->model->Detalle($_POST)));
    }
}
?> 