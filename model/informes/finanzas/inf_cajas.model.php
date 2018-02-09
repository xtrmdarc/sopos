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
            $stm = $this->conexionn->prepare("SELECT * FROM v_caja_aper WHERE DATE(fecha_a) >= ? AND DATE(fecha_a) <= ?");
            $stm->execute(array($ifecha,$ffecha));
            $c = $stm->fetchAll(PDO::FETCH_OBJ);
            $data = array("data" => $c);
            $json = json_encode($data);
            echo $json; 
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function MontoSis($data)
    {
        try
        {
            $fecha_ape = date('Y-m-d H:i:s',strtotime($data['fecha_ape']));
            $fecha_cie = date("Y-m-d H:i:s");
            $stm = $this->conexionn->prepare("SELECT IFNULL(SUM(IF(id_tpag = 1,pago_efe,pago_efe)),0) AS total_i FROM v_ventas_con WHERE estado <> 'i' AND (fec_ven >= ? AND fec_ven <= ?) AND id_apc = ?");
            $stm->execute(array($fecha_ape,$fecha_cie,$data['cod_apc']));            
            $c = $stm->fetch(PDO::FETCH_OBJ);
            $c->{'Datos'} = $this->conexionn->query("SELECT * FROM v_caja_aper WHERE id_apc = {$data['cod_apc']}")
            ->fetch(PDO::FETCH_OBJ);
            $c->{'Ingresos'} = $this->conexionn->query("SELECT IFNULL(SUM(importe),0) AS total_i FROM tm_ingresos_adm WHERE (fecha_reg >= '{$fecha_ape}' AND fecha_reg <= '{$fecha_cie}') AND id_apc = {$data['cod_apc']} AND estado='a'")
            ->fetch(PDO::FETCH_OBJ);
            $c->{'Gastos'} = $this->conexionn->query("SELECT IFNULL(SUM(importe),0) AS total_g FROM v_gastosadm WHERE estado='a' AND (fecha_re >= '{$fecha_ape}' AND fecha_re <= '{$fecha_cie}') AND id_apc = {$data['cod_apc']}")
            ->fetch(PDO::FETCH_OBJ);
            return $c;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
}