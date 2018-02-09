<?php
require_once 'model/tablero/tm_tablero.model.php';

class TableroController{
    
    private $model;

    public function __CONSTRUCT(){
        $this->model = new TableroModel();
    }
    
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/tablero/tm_tablero.php';
        require_once 'view/footer.php';
    }

    public function DatosGrls()
    {
        $this->model->DatosGrls($_POST);
    }

    public function DatosGraf()
    {
        $this->model->DatosGraf($_POST);
    }
}
?> 