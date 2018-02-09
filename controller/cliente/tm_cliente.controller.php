<?php
require_once 'model/cliente/tm_cliente.entidad.php';
require_once 'model/cliente/tm_cliente.model.php';

class ClienteController{
    
    private $model;

    public function __CONSTRUCT(){
        $this->model = new ClienteModel();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/cliente/tm_cliente.php';
        require_once 'view/footer.php';
    }

    public function Crud(){
        $alm = new Cliente();
        
        if(isset($_REQUEST['cod_cliente'])){
            $alm = $this->model->Obtener($_REQUEST['cod_cliente']);
        }

        require_once 'view/header.php';
        require_once 'view/cliente/tm_cliente_e.php';
        require_once 'view/footer.php';
    }

    public function RUCliente(){
        $alm = new Cliente();
        $alm->__SET('id_cliente',    $_REQUEST['id_cliente']);
        $alm->__SET('dni',   $_REQUEST['dni']);
        $alm->__SET('ruc',    $_REQUEST['ruc']);
        $alm->__SET('ape_paterno',   $_REQUEST['ape_paterno']);
        $alm->__SET('ape_materno',  $_REQUEST['ape_materno']);
        $alm->__SET('nombres',    $_REQUEST['nombres']);
        $alm->__SET('razon_social',    $_REQUEST['razon_social']);
        $alm->__SET('telefono',    $_REQUEST['telefono']);
        $alm->__SET('fecha_nac',    date('Y-m-d',strtotime($_REQUEST['fecha_nac'])));
        $alm->__SET('correo',    $_REQUEST['correo']);
        $alm->__SET('direccion',    $_REQUEST['direccion']);
        $alm->__SET('estado',    $_REQUEST['estado']);
        if($alm->__GET('id_cliente') != ''){
           $this->model->Actualizar($alm);
           header('Location: lista_tm_clientes.php?m=u');
        } else {
           $row = $this->model->Registrar($alm);
           if ($row['dup'] == 1){
                header('Location: lista_tm_clientes.php?m=d');
            } else {
                header('Location: lista_tm_clientes.php?m=n');
            }
        }
    }

    public function Estado(){
        $alm = new Cliente();
        if ($_REQUEST['estado']=='a' || $_REQUEST['estado']=='i'){
            $alm->__SET('cod_cliente',  $_REQUEST['cod_cliente']);
            $alm->__SET('estado',     $_REQUEST['estado']);
            $this->model->Estado($alm);
            header('Location: lista_tm_clientes.php');
        }else{
            header('Location: lista_tm_clientes.php');
        }
    }

    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['cod_cliente_e']);
    }
}
?> 