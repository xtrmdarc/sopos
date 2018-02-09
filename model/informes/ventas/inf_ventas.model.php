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
            $stm = $this->conexionn->prepare("SELECT v.id_ven,v.id_ped,v.id_tpag,v.pago_efe,v.pago_tar,v.descu,v.total AS stotal,v.fec_ven,v.desc_td,CONCAT(v.ser_doc,'-',v.nro_doc) AS numero,IFNULL(SUM(v.pago_efe+v.pago_tar),0) AS total,v.id_cli,v.igv,v.id_usu,c.desc_caja FROM v_ventas_con AS v INNER JOIN v_caja_aper AS c ON v.id_apc = c.id_apc WHERE (v.fec_ven >= ? AND v.fec_ven <= ?) AND v.id_tped like ? AND v.id_tdoc like ? AND c.id_caja like ? AND v.id_cli like ? GROUP BY v.id_ven");
            $stm->execute(array($ifecha,$ffecha,$_POST['tped'],$_POST['tdoc'],$_POST['icaja'],$_POST['cliente']));
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

    public function Detalle()
    {
        try
        {
            $cod = $_POST['cod'];
            $stm = $this->conexionn->prepare("SELECT id_prod,SUM(cantidad) AS cantidad,precio FROM tm_detalle_venta WHERE id_venta = ? GROUP BY id_prod");
            $stm->execute(array($cod));
            $c = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach($c as $k => $d)
            {
                $c[$k]->{'Producto'} = $this->conexionn->query("SELECT nombre_prod,pres_prod FROM v_productos WHERE id_pres = ".$d->id_prod)
                    ->fetch(PDO::FETCH_OBJ);
            }
            return $c;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function TipoPedido()
    {
        try
        {      
            $stm = $this->conexionn->prepare("SELECT * FROM tm_tipo_pedido");
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

    public function Cajas()
    {
        try
        {      
            $stm = $this->conexionn->prepare("SELECT * FROM tm_caja");
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

    public function Clientes()
    {
        try
        {      
            $stm = $this->conexionn->prepare("SELECT id_cliente,nombre FROM v_clientes");
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

    public function ExportExcel($data)
    {
        try
        {
            $stm = $this->conexionn->prepare("SELECT v.id_ped,v.id_tpag,v.pago_efe,v.pago_tar,v.descu,v.fec_ven,v.desc_td,v.ser_doc,v.nro_doc,IFNULL(SUM(v.pago_efe+v.pago_tar),0) AS total,v.id_cli,v.igv,v.id_usu,c.desc_caja FROM v_ventas_con AS v INNER JOIN v_caja_aper AS c ON v.id_usu = c.id_usu WHERE (DATE(v.fec_ven) >= ? AND DATE(v.fec_ven) <= ?) AND v.id_tdoc like ? AND c.id_caja like ? GROUP BY v.id_ven");
            $stm->execute(array(
                $data->__GET('start'),
                $data->__GET('end'),
                $data->__GET('tipo_doc'),
                $data->__GET('cod_cajas') 
            ));
            $c = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach($c as $k => $d)
            {
                $c[$k]->{'Cliente'} = $this->conexionn->query("SELECT nombre, CONCAT(dni,'',ruc) AS numero FROM v_clientes WHERE id_cliente = ".$d->id_cli)
                    ->fetch(PDO::FETCH_OBJ);
            }
            return $c;    
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
}