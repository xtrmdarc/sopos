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
            $ifecha = date('Y-m-d H:i:s',strtotime($_POST['ifecha']));
            $ffecha = date('Y-m-d H:i:s',strtotime($_POST['ffecha']));
            $tpag = $_POST['tpag'];
            $stm = $this->conexionn->prepare("SELECT id_ped,id_tpag,pago_efe,pago_tar,fec_ven,desc_td,CONCAT(ser_doc,'-',nro_doc) AS numero,IFNULL(SUM(pago_efe+pago_tar),0) AS total,id_cli FROM v_ventas_con WHERE (fec_ven >= ? AND fec_ven <= ?) AND id_tpag like ? GROUP BY id_ven");
            $stm->execute(array($ifecha,$ffecha,$tpag));
            $c = $stm->fetchAll(PDO::FETCH_OBJ);         
            foreach($c as $k => $d)
            {
                $c[$k]->{'Cliente'} = $this->conexionn->query("SELECT nombre FROM v_clientes WHERE id_cliente = ".$d->id_cli)
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