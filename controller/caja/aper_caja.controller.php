<?php
require_once 'model/caja/aper_caja.entidad.php';
require_once 'model/caja/aper_caja.model.php';

class ACajaController{
    
    private $model;

    public function __CONSTRUCT(){
        $this->model = new ACajaModel();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/caja/aper_caja.php';
        require_once 'view/footer.php';
    }

    public function Guardar(){
        $alm = new Caja();
        $alm->__SET('cod_apc', $_REQUEST['cod_apc']);
        $alm->__SET('id_usu', $_REQUEST['id_usu']);
        $alm->__SET('id_caja', $_REQUEST['id_caja']);
        $alm->__SET('id_turno', $_REQUEST['id_turno']);
        $alm->__SET('monto', $_REQUEST['monto']);
        $alm->__SET('monto_sistema', $_REQUEST['monto_sistema']);
        $alm->__SET('fecha_cierre', date('Y-m-d H:i:s',strtotime($_REQUEST['fecha_cierre'])));
        if($alm->__GET('cod_apc') != ''){
           $row = $this->model->Actualizar($alm);
           if ($row['dup'] == 1){
                $_SESSION["apertura"] = 0;
                header('Location: lista_caja_aper.php?m=c');
           } else {
                header('Location: lista_caja_aper.php?m=d');
           }
        }else{
           $row = $this->model->Registrar($alm);
           if ($row['dup'] == 0){
                $du = $_SESSION["datosusuario"];
                foreach ($du as $reg) { 
                    if($reg['id_usu'] == $_REQUEST['id_usu']) {
                        $_SESSION["apertura"] = 1;
                    }
                }
                $_SESSION["id_apc"] = $row['cod'];
                header('Location: lista_caja_aper.php?m=n');
           }else {
                header('Location: lista_caja_aper.php?m=d');
           }
        }
    }

    public function Datos()
    {
        $this->model->Datos($_POST);
    }

    public function MontoSis()
    {
        print_r(json_encode($this->model->MontoSis($_POST)));
    }

    public function MontoSisDet()
    {
        print_r(json_encode($this->model->MontoSisDet($_POST)));
    }
}
?> 