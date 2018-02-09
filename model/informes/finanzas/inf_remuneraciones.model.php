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
            $stm = $this->conexionn->prepare("SELECT id_usu,DATE(fecha_re) AS fecha_re,des_tg,desc_usu,desc_per,motivo,importe,estado FROM v_gastosadm WHERE id_tg = 3 AND DATE(fecha_re) >= ? AND DATE(fecha_re) <= ?");
            $stm->execute(array($ifecha,$ffecha));
            $c = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach($c as $k => $d)
            {
                $c[$k]->{'Caja'} = $this->conexionn->query("SELECT desc_caja FROM v_caja_aper WHERE id_usu = ".$d->id_usu." AND DATE(fecha_a) = '".$d->fecha_re."'")
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