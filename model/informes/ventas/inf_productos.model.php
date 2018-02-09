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
            $stm = $this->conexionn->prepare("SELECT dp.id_prod,SUM(dp.cantidad) AS cantidad,dp.precio,IFNULL((SUM(dp.cantidad)*precio),0) AS total FROM tm_detalle_venta AS dp INNER JOIN tm_venta AS v ON dp.id_venta = v.id_venta WHERE v.fecha_venta >= ? AND v.fecha_venta <= ? GROUP BY dp.id_prod");
            $stm->execute(array($ifecha,$ffecha));
            $c = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach($c as $k => $d)
            {
                $c[$k]->{'Producto'} = $this->conexionn->query("SELECT CONCAT(nombre_prod,' ',pres_prod) AS nombres,desc_c FROM v_productos WHERE id_pres = ".$d->id_prod)
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