<?php
include_once("model/rest.model.php");

class ClienteModel
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

	public function Listar()
    {
        try
        {      
            $stm = $this->conexionn->prepare("SELECT * FROM v_clientes WHERE id_cliente <> 1");
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

    public function Obtener($cod_cliente)
	{
		try 
		{
				$stm = $this->conexionn->prepare("SELECT * FROM tm_cliente WHERE id_cliente = ?");
				$stm->execute(array($cod_cliente));
				$r = $stm->fetch(PDO::FETCH_OBJ);
				$alm = new Cliente();
				$alm->__SET('id_cliente', $r->id_cliente);
				$alm->__SET('dni', $r->dni);
	      $alm->__SET('ruc', $r->ruc);
				$alm->__SET('ape_paterno', $r->ape_paterno);
	      $alm->__SET('ape_materno', $r->ape_materno);
				$alm->__SET('nombres', $r->nombres);
				$alm->__SET('razon_social', $r->razon_social);
				$alm->__SET('telefono', $r->telefono);
				$alm->__SET('fecha_nac', date('d-m-Y',strtotime($r->fecha_nac)));
				$alm->__SET('correo', $r->correo);
				$alm->__SET('direccion', $r->direccion);
				$alm->__SET('estado', $r->estado);
				$stm->closeCursor();
        return $alm;
        $this->conexionn=null;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}


    public function Actualizar(Cliente $data)
	{
		try 
		{
				$consulta = "call usp_restRegCliente( :flag, :dni, :ruc, :apeP, :apeM, :nomb, :razS, :telf, :fecN, :correo, :direc, :idCliente);";
			  $arrayParam =  array(
			      ':flag' => 2,
			      ':dni' => $data->__GET('dni'),
			      ':ruc' => $data->__GET('ruc'),
			      ':apeP' => $data->__GET('ape_paterno'),
			      ':apeM' => $data->__GET('ape_materno'),
			      ':nomb' => $data->__GET('nombres'),
			      ':razS' => $data->__GET('razon_social'),
			      ':telf' => $data->__GET('telefono'),
			      ':fecN' => $data->__GET('fecha_nac'),
			      ':correo' => $data->__GET('correo'),
			      ':direc' => $data->__GET('direccion'),
			      ':idCliente' => $data->__GET('id_cliente')
			  );
			  $st = $this->conexionn->prepare($consulta);
			  $st->execute($arrayParam);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Cliente $data)
	{
			try 
			{
					$consulta = "call usp_restRegCliente( :flag, :dni, :ruc, :apeP, :apeM, :nomb, :razS, :telf, :fecN, :correo, :direc, @a);";
				  $arrayParam =  array(
				      ':flag' => 1,
				      ':dni' => $data->__GET('dni'),
				      ':ruc' => $data->__GET('ruc'),
				      ':apeP' => $data->__GET('ape_paterno'),
				      ':apeM' => $data->__GET('ape_materno'),
				      ':nomb' => $data->__GET('nombres'),
				      ':razS' => $data->__GET('razon_social'),
				      ':telf' => $data->__GET('telefono'),
				      ':fecN' => $data->__GET('fecha_nac'),
				      ':correo' => $data->__GET('correo'),
				      ':direc' => $data->__GET('direccion')
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

	public function Estado($data)
	{
		try 
		{
			$sql = "UPDATE tm_cliente SET estado = ? WHERE id_cliente = ?";
			$this->conexionn->prepare($sql)
			     ->execute(array($data->__GET('estado'),$data->__GET('cod_cliente')));
        $this->conexionn=null;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($cod_cliente_e)
	{
		try 
			{
					$consulta = "SELECT count(*) AS total FROM tm_venta WHERE id_cliente = :id_cliente";
	        $result = $this->conexionn->prepare($consulta);
	        $result->bindParam(':id_cliente',$cod_cliente_e,PDO::PARAM_INT);
	        $result->execute();
	        if($result->fetchColumn()==0){
							$stm = $this->conexionn->prepare("DELETE FROM tm_cliente WHERE id_cliente = ?");          
							$stm->execute(array($cod_cliente_e));
							header('Location: lista_tm_clientes.php');
					}else{
							header('Location: lista_tm_clientes.php?m=e');
					}
					$result->closeCursor();
		      $this->conexionn=null;
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
	}

}