<?php
require_once 'model/inicio/inicio.model.php';
require_once 'model/inicio/inicio.entidad.php';

class InicioController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model  = new InicioModel();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/inicio/index.php';
        require_once 'view/footer.php';
    }

    /*Registrar mesa*/
    public function RMesa(){        
        $alm = new Mesa();
        $alm->__SET('cod_mesa', $_REQUEST['cod_mesa']);
        $alm->__SET('cod_mozo', $_REQUEST['cod_mozo']);
        $alm->__SET('nomb_cliente', $_REQUEST['nomb_cliente']);
        $alm->__SET('comentario', $_REQUEST['comentario']);
        $row = $this->model->RMesa($alm);
        if ($row['dup'] == 1){
            header('Location: pedido_mesa.php?Cod='.$row['cod']);
        } else {
            header('Location: inicio.php?Cod=d');
        }
    }

    /*Registrar mostrador*/
    public function RMostrador(){
        $alm = new Mostrador();
        $alm->__SET('nomb_cliente', $_REQUEST['nomb_cliente']);
        $alm->__SET('comentario', $_REQUEST['comentario']);
        $row = $this->model->RMostrador($alm);
        header('Location: pedido_mostrador.php?Cod='.$row['cod']);
    }

    /*Registrar delivery*/
    public function RDelivery(){
        $alm = new Delivery();
        $alm->__SET('nombCli', $_REQUEST['nombCli']);
        $alm->__SET('telefCli', $_REQUEST['telefCli']);
        $alm->__SET('direcCli', $_REQUEST['direcCli']);
        $alm->__SET('comentario', $_REQUEST['comentario']);
        $row = $this->model->RDelivery($alm);
        header('Location: pedido_delivery.php?Cod='.$row['cod']);
    }

    public function ValidarEstadoPedido(){
        $val = $this->model->ValidarEstadoPedido($_REQUEST['Cod']);
        if ($val == 1){
            require_once 'view/header.php';
            require_once 'view/inicio/orden.php';
            require_once 'view/footer.php';
        } else {
            header('Location: inicio.php?Cod=f');
        }
    }

    public function RegistrarPedido()
    {
        $val = $this->model->ValidarEstadoPedido($_POST['cod_p']);
        if ($val == 1){
            $this->model->RegistrarPedido( $_POST );
            print_r(json_encode(1));
        } else  {
            print_r(json_encode(2));
            //header('Location: inicio.php?Cod=f');
        }
    }

    public function Desocupar(){
        $alm = new Pedido();
        $alm->__SET('cod_pede',  $_REQUEST['cod_pede']);
        $alm->__SET('cod_tipe',  $_REQUEST['cod_tipe']);
        $this->model->Desocupar($alm);
        header('Location: inicio.php');
    }

    public function CancelarPedido(){
        $alm = new Pedido();
        $cod = $_REQUEST['cod_ped'];
        $alm->__SET('cod_ped',  $_REQUEST['cod_ped']);
        $alm->__SET('cod_pro',  $_REQUEST['cod_pro']);
        $alm->__SET('fec_ped',  $_REQUEST['fec_ped']);
        $this->model->CancelarPedido($alm);
        if($_REQUEST['cod_tipe'] == 1){
            header('Location: pedido_mesa.php?Cod='.$cod.'');
        } elseif($_REQUEST['cod_tipe'] == 2){
            header('Location: pedido_mostrador.php?Cod='.$cod.'');
        } elseif($_REQUEST['cod_tipe'] == 3){
            header('Location: pedido_delivery.php?Cod='.$cod.'');
        }
    }

    public function CambiarMesa(){        
        $alm = new Mesa();
        $alm->__SET('c_mesa', $_REQUEST['c_mesa']);
        $alm->__SET('co_mesa', $_REQUEST['co_mesa']);
        $row = $this->model->CambiarMesa($alm);
        if ($row['dup'] == 1){
            header('Location: inicio.php');
        } else {
            header('Location: inicio.php?Cod=d');
        }
    }

    /*Realizar venta*/
    public function RegistrarVenta(){
        if($_POST['cod_pedido'] != ''){
           print_r(json_encode( $this->model->RegistrarVenta($_POST)));
        }
    }

    public function FinalizarPedido(){
        $alm = new Pedido();
        $alm->__SET('codPed',  $_REQUEST['codPed']);
        $this->model->FinalizarPedido($alm);
        header('Location: inicio.php');
    }

    public function DatosGrles(){
        print_r(json_encode($this->model->DatosGrles($_POST)));
    }
    
    public function listarPedidos(){
        $this->model->listarPedidos($_POST);
    }
    
    public function BuscarProducto()
    {
        print_r(json_encode($this->model->BuscarProducto($_REQUEST['criterio'])));
    }

    public function BuscarCliente()
    {
        print_r(json_encode($this->model->BuscarCliente($_REQUEST['criterio'])));
    }

    public function NuevoCliente()
    {
        print_r(json_encode($this->model->NuevoCliente($_POST)));
    }

    public function ListarDetallePed(){
        print_r(json_encode($this->model->ListarDetallePed($_POST)));
    }

    public function ListarDetalleSubPed(){
        print_r(json_encode($this->model->ListarDetalleSubPed($_POST)));
    }

    public function ListarMostrador(){
        print_r(json_encode($this->model->ListarMostrador($_POST)));
    }

    public function DetalleMostrador()
    {
        print_r(json_encode($this->model->DetalleMostrador($_POST)));
    }

    public function ListarDelivery(){
        print_r(json_encode($this->model->ListarDelivery($_POST)));
    }

    public function DetalleDelivery()
    {
        print_r(json_encode($this->model->DetalleDelivery($_POST)));
    }

    public function ComboMesaOri()
    {
        $this->model->ComboMesaOri($_POST);
    }

    public function ComboMesaDes()
    {
        $this->model->ComboMesaDes($_POST);
    }

    public function listarCategorias(){
        print_r(json_encode($this->model->listarCategorias($_POST)));
    }

    public function listarProductos(){
        print_r(json_encode($this->model->listarProductos($_POST)));
    }

    public function Imprimir(){
        $data = $this->model->ObtenerDatosImp($_REQUEST['Cod']);
        require_once 'view/inicio/imprimir/comp.php';
    }

    public function ImprimirPC(){
        $data = $this->model->ObtenerDatosImpPC($_REQUEST['Cod']);
        require_once 'view/inicio/imprimir/comp_pc.php';
    }

    public function preCuenta(){
        print_r(json_encode( $this->model->preCuenta($_POST)));
    }
}