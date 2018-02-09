<?php
include_once("model/rest.model.php");

class InformeModel
{
    private $conexionn;

    public function __CONSTRUCT()
    {
        try
        {
            $this->conexionn = Database::Conectar();
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function Datos()
    {
        try
        {
            $ifecha = date('Y-m-d',strtotime($_POST['ifecha']));
            $ffecha = date('Y-m-d',strtotime($_POST['ffecha']));
            $stm = $this->conexionn->prepare("SELECT * FROM tm_ingresos_adm WHERE DATE(fecha_reg) >= ? AND DATE(fecha_reg) <= ?");
            $stm->execute(array($ifecha,$ffecha));
            $c = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach($c as $k => $d)
            {
                $c[$k]->{'Caja'} = $this->conexionn->query("SELECT desc_caja FROM v_caja_aper WHERE id_apc = ".$d->id_apc)
                    ->fetch(PDO::FETCH_OBJ);
            }
            foreach($c as $k => $d)
            {
                $c[$k]->{'Cajero'} = $this->conexionn->query("SELECT CONCAT(nombres,' ',ape_paterno,' ',ape_materno) AS desc_usu FROM tm_usuario WHERE id_usu = ".$d->id_usu)
                    ->fetch(PDO::FETCH_OBJ);
            }
            $data = array("data" => $c);
            $json = json_encode($data);
            echo $json; 
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
}