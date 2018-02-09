<?php
include_once("model/rest.model.php");
class TableroModel
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

    public function DatosGraf()
    {
        try
        {
            date_default_timezone_set('America/Lima');
            setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
            $fecha = date("Y-m-d");
            $dia = date("w");
            $seis = strtotime ('-1 week' , strtotime($fecha));$seis = date ('Y-m-d', $seis);$cinco = strtotime ('-2 week' , strtotime($fecha));$cinco = date ('Y-m-d', $cinco);$cuatro = strtotime ('-3 week' , strtotime($fecha));$cuatro = date ('Y-m-d', $cuatro);$tres = strtotime ('-4 week' , strtotime($fecha));$tres = date ('Y-m-d', $tres);$dos = strtotime ('-5 week' , strtotime($fecha));$dos = date ('Y-m-d', $dos);$uno = strtotime ('-6 week' , strtotime($fecha));$uno = date ('Y-m-d', $uno);
            $consulta = "call usp_tableroControl( :flag, :codDia, :fecha, :feSei, :feCin, :feCua, :feTre, :feDos, :feUno);";
            $arrayParam =  array(
                ':flag' => 1,
                ':codDia' => $dia,
                ':fecha' => $fecha,
                ':feSei' => $seis,
                ':feCin' => $cinco,
                ':feCua' => $cuatro,
                ':feTre' => $tres,
                ':feDos' => $dos,
                ':feUno' => $uno
            );
            $st = $this->conexionn->prepare($consulta);
            $st->execute($arrayParam);
            $row = $st->fetch(PDO::FETCH_ASSOC);
            $json = json_encode($row);
            echo $json;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function DatosGrls()
    {
        try
        {
            $ifecha = date('Y-m-d H:i:s',strtotime($_POST['ifecha']));
            $ffecha = date('Y-m-d H:i:s',strtotime($_POST['ffecha']));

            $v_total = $this->conexionn->prepare("SELECT IFNULL(SUM(pago_efe),0) AS efe, IFNULL(SUM(pago_tar),0) AS tar, IFNULL(SUM(descu),0) AS des, IFNULL(SUM(total),0) AS total_v FROM v_ventas_con WHERE (fec_ven >= ? AND fec_ven < ?)");
            $v_total->execute(array($ifecha,$ffecha));
            $vt = $v_total->fetch(PDO::FETCH_OBJ); 

            $gas = $this->conexionn->prepare("SELECT IFNULL(SUM(importe),0) AS tgas FROM v_gastosadm WHERE (fecha_re >= ? AND fecha_re < ?) AND estado = 'a'");
            $gas->execute(array($ifecha,$ffecha));
            $g = $gas->fetch(PDO::FETCH_OBJ);

            $mozo = $this->conexionn->prepare("SELECT IFNULL(COUNT(dp.id_pedido),0) AS tped,u.nombres,u.ape_paterno,u.ape_materno FROM tm_detalle_pedido AS dp INNER JOIN tm_pedido_mesa AS pm ON dp.id_pedido = pm.id_pedido INNER JOIN tm_pedido AS p ON dp.id_pedido = p.id_pedido INNER JOIN tm_usuario AS u ON pm.id_mozo = u.id_usu WHERE dp.estado <> 'i' AND p.estado = 'c' AND (p.fecha_pedido >= ? AND p.fecha_pedido < ?) GROUP BY pm.id_mozo ORDER BY tped DESC LIMIT 1");
            $mozo->execute(array($ifecha,$ffecha));
            $m = $mozo->fetch(PDO::FETCH_OBJ);

            $t_ped = $this->conexionn->prepare("SELECT IFNULL(COUNT(dp.id_pedido),0) AS toped FROM tm_detalle_pedido AS dp INNER JOIN tm_pedido AS p ON dp.id_pedido = p.id_pedido WHERE dp.estado <> 'i' AND p.estado = 'c' AND (p.fecha_pedido >= ? AND p.fecha_pedido < ?)");
            $t_ped->execute(array($ifecha,$ffecha));
            $tp = $t_ped->fetch(PDO::FETCH_OBJ);

            $mesas = $this->conexionn->prepare("SELECT IFNULL(COUNT(pm.id_pedido),0) AS total FROM tm_pedido_mesa AS pm INNER JOIN tm_pedido as p ON pm.id_pedido = p.id_pedido WHERE p.estado = 'c' AND (p.fecha_pedido >= ? AND p.fecha_pedido < ?)");
            $mesas->execute(array($ifecha,$ffecha));
            $me = $mesas->fetch(PDO::FETCH_OBJ);

            $v_mesa = $this->conexionn->prepare("SELECT IFNULL(SUM(v.total - v.descu),0) AS total_v FROM v_ventas_con AS v INNER JOIN tm_pedido_mesa AS pm ON v.id_ped = pm.id_pedido WHERE (v.fec_ven >= ? AND v.fec_ven < ?)");
            $v_mesa->execute(array($ifecha,$ffecha));
            $vm = $v_mesa->fetch(PDO::FETCH_OBJ);

            $v_mos = $this->conexionn->prepare("SELECT IFNULL(SUM(v.total - v.descu),0) AS total_v FROM v_ventas_con AS v INNER JOIN tm_pedido_llevar AS pm ON v.id_ped = pm.id_pedido WHERE (v.fec_ven >= ? AND v.fec_ven < ?)");
            $v_mos->execute(array($ifecha,$ffecha));
            $vmo = $v_mos->fetch(PDO::FETCH_OBJ);

            $mostrador = $this->conexionn->prepare("SELECT IFNULL(COUNT(pm.id_pedido),0) AS total FROM tm_pedido_llevar AS pm INNER JOIN tm_pedido as p ON pm.id_pedido = p.id_pedido WHERE p.estado = 'c' AND (p.fecha_pedido >= ? AND p.fecha_pedido < ?)");
            $mostrador->execute(array($ifecha,$ffecha));
            $mo = $mostrador->fetch(PDO::FETCH_OBJ);

            $platos = $this->conexionn->prepare("SELECT vp.nombre_prod,vp.pres_prod,dv.precio,SUM(dv.cantidad) AS cantidad,COUNT(dv.id_venta) AS total FROM tm_detalle_venta AS dv INNER JOIN tm_venta AS v ON dv.id_venta = v.id_venta INNER JOIN v_productos AS vp ON dv.id_prod = vp.id_pres WHERE vp.id_tipo = 1 AND (v.fecha_venta >= ? AND v.fecha_venta <= ?) GROUP BY dv.id_prod ORDER BY total DESC LIMIT 10");
            $platos->execute(array($ifecha,$ffecha));
            $pp = $platos->fetchAll(PDO::FETCH_OBJ);

            $productos = $this->conexionn->prepare("SELECT vp.nombre_prod,vp.pres_prod,dv.precio,SUM(dv.cantidad) AS cantidad,COUNT(dv.id_venta) AS total FROM tm_detalle_venta AS dv INNER JOIN tm_venta AS v ON dv.id_venta = v.id_venta INNER JOIN v_productos AS vp ON dv.id_prod = vp.id_pres WHERE (v.fecha_venta >= ? AND v.fecha_venta <= ?) GROUP BY dv.id_prod ORDER BY total DESC LIMIT 10");
            $productos->execute(array($ifecha,$ffecha));
            $ppp = $productos->fetchAll(PDO::FETCH_OBJ);

            $mesa_a = $this->conexionn->prepare("SELECT COUNT(id_pedido) as total FROM tm_pedido WHERE (fecha_pedido >= ? AND fecha_pedido < ?) AND id_tipo_pedido = 1 AND estado ='i'");
            $mesa_a->execute(array($ifecha,$ffecha));
            $ma = $mesa_a->fetch(PDO::FETCH_OBJ);

            $mos_a = $this->conexionn->prepare("SELECT COUNT(id_pedido) as total FROM tm_pedido WHERE (fecha_pedido >= ? AND fecha_pedido < ?) AND id_tipo_pedido = 2 AND estado ='i'");
            $mos_a->execute(array($ifecha,$ffecha));
            $moa = $mos_a->fetch(PDO::FETCH_OBJ);

            $ing = $this->conexionn->prepare("SELECT IFNULL(SUM(importe),0) AS ting FROM tm_ingresos_adm WHERE (fecha_reg >= ? AND fecha_reg < ?) AND estado = 'a'");
            $ing->execute(array($ifecha,$ffecha));
            $i = $ing->fetch(PDO::FETCH_OBJ);

            $data = array("data1" => $vt,"data2" => $g,"data3" => $m,"data4" => $tp,"data5" => $me,"data6" => $vm,"data7" => $vmo,"data8" => $mo,"data9" => $pp,"data10" => $ppp,"data11" => $ma,"data12" => $moa,"data13" => $i);
            $json = json_encode($data);
            echo $json;  

        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
}