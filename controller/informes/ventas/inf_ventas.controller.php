<?php
require_once 'model/informes/ventas/inf_ventas.model.php';
require_once 'model/informes/ventas/informes.entidad.php';
class InformeController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model  = new InformeModel();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/informes/ventas/inf_ventas.php';
        require_once 'view/footer.php';
    }

    public function Datos()
    {
        $this->model->Datos($_POST);
    }

    public function Detalle()
    {
        print_r(json_encode($this->model->Detalle($_POST)));
    }

    public function ExportExcel(){
        $alm = new Informes();
        $alm->__SET('start', date('Y-m-d',strtotime($_REQUEST['start'])));
        $alm->__SET('end', date('Y-m-d',strtotime($_REQUEST['end'])));
        $alm->__SET('cod_cajas', $_REQUEST['cod_cajas']);
        $alm->__SET('tipo_doc', $_REQUEST['tipo_doc']);
        $_SESSION["min-1"] = $_REQUEST['start'];
        $_SESSION["max-1"] = $_REQUEST['end'];
        $data = $this->model->ExportExcel($alm);
        require_once 'view/informes/ventas/exportar/inf_ventas_xls.php';
    }
}