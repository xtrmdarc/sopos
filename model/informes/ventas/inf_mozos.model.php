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
            $cmozo = $_POST['cmozo'];
            $stm = $this->conexionn->prepare("SELECT v.fec_ven,v.desc_td,CONCAT(v.ser_doc,'-',v.nro_doc) AS numero,IFNULL(SUM(v.pago_efe+v.pago_tar),0) AS total,v.id_cli,pm.id_mozo FROM v_ventas_con AS v INNER JOIN tm_pedido_mesa AS pm ON v.id_ped = pm.id_pedido WHERE (v.fec_ven >= ? AND v.fec_ven <= ?) AND pm.id_mozo like ? GROUP BY v.id_ven");
            $stm->execute(array($ifecha,$ffecha,$cmozo));
            $c = $stm->fetchAll(PDO::FETCH_OBJ);        
            foreach($c as $k => $d)
            {
                $c[$k]->{'Mozo'} = $this->conexionn->query("SELECT CONCAT(nombres,' ',ape_paterno,' ',ape_materno) AS nombre FROM v_usuarios WHERE id_usu = ".$d->id_mozo)
                    ->fetch(PDO::FETCH_OBJ);

                $c[$k]->{'Cliente'} = $this->conexionn->query("SELECT nombre FROM v_clientes WHERE id_cliente = ".$d->id_cli)
                    ->fetch(PDO::FETCH_OBJ);
            }
            $stmm = $this->conexionn->prepare("SELECT COUNT(v.id_ven) AS cantidad, IFNULL(SUM(v.pago_efe+v.pago_tar),0) AS total FROM v_ventas_con AS v INNER JOIN tm_pedido_mesa AS pm ON v.id_ped = pm.id_pedido WHERE v.fec_ven >= ? AND v.fec_ven <= ? AND pm.id_mozo like ?");
            $stmm->execute(array($ifecha,$ffecha,$cmozo));
            $a = $stmm->fetch(PDO::FETCH_OBJ);
            $data = array("dato" => $a,"data" => $c);
            $json = json_encode($data);
            echo $json;  
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function Mozos()
    {
        try
        {      
            $stm = $this->conexionn->prepare("SELECT id_usu,CONCAT(nombres,' ',ape_paterno,' ',ape_materno) AS nombre FROM v_usuarios WHERE id_rol = 4");
            $stm->execute();            
            $c = $stm->fetchAll(PDO::FETCH_OBJ);
            $stm->closeCursor();
            return $c;
            $this->conexionn=null;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
}