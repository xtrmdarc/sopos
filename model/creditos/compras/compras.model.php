<?php
include_once("model/rest.model.php");
class CreditoModel
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

  	public function Datos()
    {
        try
        {
            $cprov = $_POST['cprov'];
            $stm = $this->conexionn->prepare("SELECT cc.id_credito,cc.id_compra,cc.total,cc.interes,cc.fecha,vc.id_prov,CONCAT(vc.serie_doc,' - ',vc.num_doc) AS numero,vc.desc_td,desc_prov FROM tm_compra_credito AS cc INNER JOIN v_compras AS vc ON cc.id_compra = vc.id_compra WHERE vc.id_prov like ? AND cc.estado = 'p' AND vc.estado = 'a' ORDER BY cc.fecha ASC");
            $stm->execute(array($cprov));
            $c = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach($c as $k => $d)
            {
                $c[$k]->{'Amortizado'} = $this->conexionn->query("SELECT IFNULL(SUM(importe),0) AS total FROM tm_credito_detalle WHERE id_credito = ".$d->id_credito)
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

    public function DatosP()
    {
        try
        {
            $cod = $_POST['cod'];
            $stm = $this->conexionn->prepare("SELECT cc.fecha,vc.desc_prov FROM tm_compra_credito AS cc INNER JOIN v_compras AS vc ON cc.id_compra = vc.id_compra WHERE cc.id_credito like ? AND cc.estado = 'p'");
            $stm->execute(array($cod));
            $c = $stm->fetch(PDO::FETCH_OBJ);
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
            $stm = $this->conexionn->prepare("SELECT * FROM tm_credito_detalle WHERE id_credito = ?");
            $stm->execute(array($cod));
            $c = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach($c as $k => $d)
            {
                $c[$k]->{'Usuario'} = $this->conexionn->query("SELECT CONCAT(ape_paterno,' ',ape_materno,' ',nombres) AS nombre FROM v_usuarios WHERE id_usu = ".$d->id_usu)
                    ->fetch(PDO::FETCH_OBJ);
            }
            return $c;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function PagarCuota(Cuota $data)
    {
        try 
        {
            date_default_timezone_set('America/Lima');
            setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
            $fecha = date("Y-m-d H:i:s");
            $id_usu = $_SESSION["id_usu"];
            $id_apc = $_SESSION["id_apc"];
            $consulta = "call usp_comprasCreditoCuotas( :flag, :idCre, :idUsu, :idApc, :imp, :fecha, :egCaja, :montC, :amorC, :totalC);";
            $arrayParam =  array(
                ':flag' => 1,
                ':idCre' =>  $data->__GET('cod_cuota'),
                ':idUsu' =>  $id_usu,
                ':idApc' => $id_apc,
                ':imp' =>  $data->__GET('pago_cuo'),
                ':fecha' =>  $fecha,
                ':egCaja' =>  $data->__GET('egre_caja'),
                ':montC' => $data->__GET('monto_ec'),
                ':amorC' => $data->__GET('amort_cuota'),
                ':totalC' => $data->__GET('total_cuota')
            );
            $st = $this->conexionn->prepare($consulta);
            $st->execute($arrayParam);
            header('Location: lista_creditos_comp.php');
        }
        catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
}