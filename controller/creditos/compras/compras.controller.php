<?php
require_once 'model/creditos/compras/compras.entidad.php';
require_once 'model/creditos/compras/compras.model.php';

class CreditoController{
    
    private $model;

    public function __CONSTRUCT(){
        $this->model = new CreditoModel();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/creditos/compras/index.php';
        require_once 'view/footer.php';
    }

    public function Datos()
    {
        $this->model->Datos($_POST);
    }

    public function DatosP()
    {
        $this->model->DatosP($_POST);
    }

    public function Detalle()
    {
        print_r(json_encode($this->model->Detalle($_POST)));
    }

    public function PagarCuota(){
        $alm = new Cuota();
        $alm->__SET('cod_cuota', $_REQUEST['cod_cuota']);
        $alm->__SET('pago_cuo', $_REQUEST['pago_cuo']);
        $alm->__SET('egre_caja', $_REQUEST['egre_caja']);
        $alm->__SET('monto_ec', $_REQUEST['monto_ec']);
        $alm->__SET('total_cuota', $_REQUEST['total_cuota']);
        $alm->__SET('amort_cuota', $_REQUEST['amort_cuota']);
        $this->model->PagarCuota($alm);
    }
}
?> 