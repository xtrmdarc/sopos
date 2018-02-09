<?php
include_once("model/rest.model.php");
class CompraModel
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

    public function GuardarCompra($dato)
    {
        try
        {   
            date_default_timezone_set('America/Lima');
            setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
            $fecha_r = date("Y-m-d H:i:s");
            $igv = $_SESSION["igv"];
            $id_usu = $_SESSION["id_usu"];
            $fecha = date('Y-m-d',strtotime($dato['compra_fecha']));
            
            $sql = "INSERT INTO tm_compra (id_prov,id_tipo_compra,id_tipo_doc,id_usu,fecha_c,hora_c,serie_doc,num_doc,igv,total,descuento,observaciones,fecha_reg) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?);";
            $this->conexionn->prepare($sql)
                ->execute(
                    array(
                        $dato['cod_prov'],
                        $dato['tipo_compra'],
                        $dato['tipo_doc'],
                        $id_usu,
                        $fecha,
                        $dato['compra_hora'],
                        $dato['serie_doc'],
                        $dato['num_doc'],
                        $igv,
                        $dato['monto_total'],
                        $dato['desc_comp'],
                        $dato['observaciones'],
                        $fecha_r
                ));

            /* El ultimo ID que se ha generado */
            $compra_id = $this->conexionn->lastInsertId();

            if($dato['tipo_compra'] == 2){

                $a = $dato['mmcuota'];
                $b = $dato['imcuota'];
                $c = $dato['fmcuota'];

                for($x=0; $x < sizeof($a); ++$x)
                {
                    $sql = "INSERT INTO tm_compra_credito (id_compra,total,interes,fecha) VALUES (?,?,?,?);";
                    $this->conexionn->prepare($sql)->execute(array($compra_id,$a[$x],$b[$x],date('Y-m-d',strtotime($c[$x]))));
                }
            }

            /* Recorremos el detalle para insertar */
            foreach($dato['items'] as $d)
            {
                $sqll = "INSERT INTO tm_compra_detalle (id_compra,id_tp,id_pres,cant,precio) VALUES (?,?,?,?,?)";
                $this->conexionn->prepare($sqll)->execute(array($compra_id,$d['tipo_p'],$d['cod_ins'],$d['cant_ins'],$d['precio_ins']));

                $sql = "INSERT INTO tm_inventario (id_ti,id_ins,id_tipo_ope,id_cv,cant,fecha_r) VALUES (?,?,?,?,?,?)";
                $this->conexionn->prepare($sql)->execute(array($d['tipo_p'],$d['cod_ins'],1,$compra_id,$d['cant_ins'],$fecha_r));
            }

            return true;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
    
    public function Proveedores()
    {
        try
        {      
            $stm = $this->conexionn->prepare("SELECT id_prov,ruc,razon_social FROM tm_proveedor");
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

    public function BuscarProv($criterio)
    {
        try
        {        
            $stm = $this->conexionn->prepare("SELECT id_prov,ruc,razon_social FROM tm_proveedor WHERE estado <> 'i' AND (ruc LIKE '%$criterio%' OR razon_social LIKE '%$criterio%') ORDER BY ruc LIMIT 5");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function BuscarIns($criterio)
    {
        try
        {        
            $stm = $this->conexionn->prepare("SELECT tipo_p,id_ins,cod_ins,nomb_ins,descripcion FROM v_busqins WHERE cod_ins LIKE '%$criterio%' OR nomb_ins LIKE '%$criterio%' ORDER BY nomb_ins LIMIT 5");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function ObtenerDatos()
    {
        try
        {
            $ifecha = date('Y-m-d',strtotime($_POST['ifecha']));
            $ffecha = date('Y-m-d',strtotime($_POST['ffecha']));
            $tdoc = $_POST['tdoc'];
            $cprov = $_POST['cprov'];
            $stm = $this->conexionn->prepare("SELECT * FROM v_compras WHERE (DATE(fecha_c) >= ? AND DATE(fecha_c) <= ?) AND id_tipo_doc like ? AND id_prov like ? GROUP BY id_compra");
            $stm->execute(array($ifecha,$ffecha,$tdoc,$cprov));
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

    public function AnularCompra($cod_compra)
    {
        try 
        {
            $consulta = "call usp_comprasAnular( :flag, :idCom);";
            $arrayParam =  array(
                ':flag' => 1,
                ':idCom' => $cod_compra
            );
            $st = $this->conexionn->prepare($consulta);
            $st->execute($arrayParam);
            $row = $st->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    //NUEVO PROVEEDOR
    public function NuevoProv($data)
    {
        try
        {
            $consulta = "call usp_comprasRegProveedor( :flag, :ruc, :razS, :direc, :telf, :email, :contc, @a);";
            $arrayParam =  array(
                ':flag' => 1,
                ':ruc' => $data['ruc'],
                ':razS' => $data['razon_social'],
                ':direc' => $data['direccion'],
                ':telf' => $data['telefono'],
                ':email' => $data['email'],
                ':contc' => $data['contacto']
            );
            $st = $this->conexionn->prepare($consulta);
            $st->execute($arrayParam);
            while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
                return $row['dup'];
            }
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    public function Detalle()
    {
        try
        {
            $cod = $_POST['cod'];
            $stm = $this->conexionn->prepare("SELECT * FROM tm_compra_detalle WHERE id_compra = ?");
            $stm->execute(array($cod));
            $c = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach($c as $k => $d)
            {
                $c[$k]->{'Pres'} = $this->conexionn->query("SELECT cod_ins,nomb_ins,descripcion FROM v_busqins WHERE tipo_p = ".$d->id_tp."  AND id_ins = ".$d->id_pres)
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