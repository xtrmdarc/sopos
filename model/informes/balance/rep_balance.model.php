<?php
include_once("model/rest.model.php");

class ReporteModel
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

    public function Listar_TP()
    {
        try
        {
            date_default_timezone_set('America/Lima');
            setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
            $fecha = date("Y-m-d");
            $stm = $this->conexionn->prepare("SELECT id_tipo_pago,pago_efe,pago_tar FROM v_ventas_con WHERE estado <> 'i' AND (DATE(fecha_venta) >= ? AND DATE(fecha_venta) <= ?)");
            $stm->execute(array(
                    $fecha,
                    $fecha
                ));            
            $c = $stm->fetchAll(PDO::FETCH_OBJ);
            return $c;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function ListarGA()
    {
        try
        {
            date_default_timezone_set('America/Lima');
            setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
            $fecha = date("Y-m-d");
            $stm = $this->conexionn->prepare("SELECT importe FROM v_gastosadm WHERE estado='a' AND (DATE(fecha_re) >= ? AND DATE(fecha_re) <= ?)");
            $stm->execute(array(
                    $fecha,
                    $fecha
                ));             
            $c = $stm->fetchAll(PDO::FETCH_OBJ);
            return $c;
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
            $efe = $this->conexionn->prepare("SELECT IFNULL(SUM(IF(id_tipo_pago=1,pago_efe,pago_efe)),0) AS total FROM v_ventas_con WHERE estado <> 'i' AND (id_tipo_pago = 1 OR id_tipo_pago = 3) AND DATE(fecha_venta) >= ? AND DATE(fecha_venta) <= ?");
            $efe->execute(array($ifecha,$ffecha));
            $e = $efe->fetch(PDO::FETCH_OBJ);

            $tar = $this->conexionn->prepare("SELECT IFNULL(SUM(pago_tar),0) as total FROM v_ventas_con WHERE estado <> 'i' AND DATE(fecha_venta) >= ? AND DATE(fecha_venta) <= ?");
            $tar->execute(array($ifecha,$ffecha));
            $t = $tar->fetch(PDO::FETCH_OBJ);

            $ga = $this->conexionn->prepare("SELECT IFNULL(SUM(importe),0) as total FROM v_gastosadm WHERE estado='a' AND DATE(fecha_re) >= ? AND DATE(fecha_re) <= ?");
            $ga->execute(array($ifecha,$ffecha));
            $g = $ga->fetch(PDO::FETCH_OBJ);

            $data = array(0 => $e->total,
                  1 => $t->total,
                  2 => $g->total);
            $json = json_encode($data);
            echo $json;  
      
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
}