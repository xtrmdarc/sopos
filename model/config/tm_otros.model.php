<?php
include_once("model/rest.model.php");

class ConfigModel
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

	//RESTAURANTE
	public function ListarSM()
    {
        try
        {      
            $stm = $this->conexionn->prepare("SELECT * FROM v_mesas");
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

    public function ListarCSM()
    {
        try
        {      
            $stm = $this->conexionn->prepare("SELECT * FROM tm_catg_mesa");
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

	//DATOS DE LA EMPRESA
	public function ObtenerDE()
    {
        try
        {      
            $stm = $this->conexionn->prepare("SELECT * FROM tm_datos_empresa");
			$stm->execute();
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Datos();

			$alm->__SET('id', $r->id);
			$alm->__SET('razon_social', $r->razon_social);
			$alm->__SET('abrev_rs', $r->abrev_rs);
            $alm->__SET('ruc', $r->ruc);
			$alm->__SET('direccion', $r->direccion);
            $alm->__SET('telefono', $r->telefono);
            $alm->__SET('logo', $r->logo);
            $alm->__SET('igv', $r->igv);
            $alm->__SET('moneda', $r->moneda);

			return $alm;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function ActualizarDE(Datos $data)
	{
		try 
		{
			$sql = "UPDATE tm_datos_empresa SET 
						razon_social  = ?,
						abrev_rs   = ?,
						ruc   = ?, 
						telefono  = ?,
                        direccion = ?,
                        logo = ?,
                        igv = ?,
                        moneda = ?
				    WHERE id = ?";

			$this->conexionn->prepare($sql)
			     ->execute(
				array(
					$data->__GET('razon_social'),
					$data->__GET('abrev_rs'), 
					$data->__GET('ruc'), 
					$data->__GET('telefono'),
                    $data->__GET('direccion'),
                    $data->__GET('logo'),
                    $data->__GET('igv'),
					$data->__GET('moneda'),
                    $data->__GET('id')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	//TIPO DE DOCUMENTO
    public function ListarTD()
    {
        try
        {      
            $stm = $this->conexionn->prepare("SELECT * FROM tm_tipo_doc");
            $stm->execute();            
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

    public function GuardarTD($data)
	{
		try 
		{
			$sql = "UPDATE tm_tipo_doc SET serie = ?,numero = ? WHERE id_tipo_doc = ?";
			$this->conexionn->prepare($sql)->execute(array($data['serie'],$data['numero'],$data['cod_td']));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	//INDICADORES
    public function ListarI01()
    {
        try
        {      
            $stm = $this->conexionn->prepare("SELECT * FROM tm_margen_venta");
            $stm->execute();            
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

    public function GuardarI01($data)
	{
		try 
		{
			$sql = "UPDATE tm_margen_venta SET margen = ? WHERE id = ?";
			$this->conexionn->prepare($sql)->execute(array($data['m_venta'],$data['cod_ind']));
		} 
        catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}