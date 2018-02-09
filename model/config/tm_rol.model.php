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

  public function ListarRoles()
  {
      try
      {      
          $stm = $this->conexionn->prepare("SELECT * FROM tm_rol");
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

	public function RRol(Rol $data)
	{
			try
			{
					$consulta = "call usp_configRol( :flag, :desc, @a);";
	        $arrayParam =  array(
	            ':flag' => 1,
	            ':desc' => $data->__GET('descripcion')
	        );
	        $st = $this->conexionn->prepare($consulta);
	        $st->execute($arrayParam);
	        $row = $st->fetch(PDO::FETCH_ASSOC);
	        return $row;
			} 
			catch (Exception $e) 
			{
					die($e->getMessage());
			}
	}

	public function ARol(Rol $data)
	{
			try 
			{
					$consulta = "call usp_configRol( :flag, :desc, :idRol);";
	        $arrayParam =  array(
	            ':flag' => 2,
	            ':desc' => $data->__GET('descripcion'),
	            ':idRol' => $data->__GET('cod_rol')
	        );
	        $st = $this->conexionn->prepare($consulta);
	        $st->execute($arrayParam);
	        $row = $st->fetch(PDO::FETCH_ASSOC);
	        return $row;
			} 
			catch (Exception $e) 
			{
					die($e->getMessage());
			}
	}

	public function Eliminar($cod_rol_e)
	{
			try 
			{
					$consulta = "SELECT count(*) AS total FROM tm_usuario WHERE id_rol = :id_rol";
					$result = $this->conexionn->prepare($consulta);
					$result->bindParam(':id_rol',$cod_rol_e,PDO::PARAM_INT);
					$result->execute();
					if($result->fetchColumn()==0){
							$sql = "DELETE FROM tm_rol WHERE id_rol = ?";
							$this->conexionn->prepare($sql)->execute(array($cod_rol_e));
							header('Location: lista_tm_roles.php');
					}else{
							header('Location: lista_tm_roles.php?m=e');
					}
					$result->closeCursor();
	        $this->conexionn=null;
			} catch (Exception $e) 
			{
					die($e->getMessage());
			}
	}
}