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

public function ListarUsuarios()
    {
        try
        {      
            $stm = $this->conexionn->prepare("SELECT id_usu,id_rol,ape_paterno,ape_materno,nombres,desc_r,estado FROM v_usuarios");
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

  public function ObtenerUsuario($cod_usu)
	{
		try 
			{
					$stm = $this->conexionn ->prepare("SELECT * FROM v_usuarios WHERE id_usu = ?");
					$stm->execute(array($cod_usu));
					$r = $stm->fetch(PDO::FETCH_OBJ);
					$alm = new Usuario();
					$alm->__SET('id_usu', $r->id_usu);
					$alm->__SET('id_rol', $r->id_rol);
					$alm->__SET('id_areap', $r->id_areap);
					$alm->__SET('dni', $r->dni);
		      $alm->__SET('ape_paterno', $r->ape_paterno);
					$alm->__SET('ape_materno', $r->ape_materno);
		      $alm->__SET('nombres', $r->nombres);
					$alm->__SET('email', $r->email);
					$alm->__SET('usuario', $r->usuario);
					$alm->__SET('contrasena', $r->contrasena);
					$alm->__SET('estado', $r->estado);
					$alm->__SET('imagen', $r->imagen);
					$alm->__SET('desc_r', $r->desc_r);
					$alm->__SET('desc_ap', $r->desc_ap);
					$stm->closeCursor();
		      return $alm;
		      $this->conexionn=null;
			} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function ListarCatgRol()
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

  public function ListarAreaP()
  {
      try
      {      
          $stm = $this->conexionn->prepare("SELECT * FROM tm_area_prod");
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

	public function RegistrarUsuario(Usuario $data)
	{
			try 
			{
					$consulta = "call usp_configUsuario( :flag, :idRol, :idArea, :dni, :apeP, :apeM, :nomb, :email, :usu, :cont, :img, @a);";
	        $arrayParam =  array(
	            ':flag' => 1,
	            ':idRol' => $data->__GET('id_rol'),
	            ':idArea' => $data->__GET('cod_area'),
	            ':dni' => $data->__GET('dni'),
	            ':apeP' => $data->__GET('ape_paterno'),
	            ':apeM' => $data->__GET('ape_materno'),
	            ':nomb' => $data->__GET('nombres'),
	            ':email' => $data->__GET('email'),
	            ':usu' => $data->__GET('usuario'),
	            ':cont' => $data->__GET('contrasena'),
	            ':img' => $data->__GET('imagen')
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

	public function ActualizarUsuario(Usuario $data)
	{
			try 
			{	
					$consulta = "call usp_configUsuario( :flag, :idRol, :idArea, :dni, :apeP, :apeM, :nomb, :email, :usu, :cont, :img, :idUsu);";
	        $arrayParam =  array(
	            ':flag' => 2,
	            ':idRol' => $data->__GET('id_rol'),
	            ':idArea' => $data->__GET('cod_area'),
	            ':dni' => $data->__GET('dni'),
	            ':apeP' => $data->__GET('ape_paterno'),
	            ':apeM' => $data->__GET('ape_materno'),
	            ':nomb' => $data->__GET('nombres'),
	            ':email' => $data->__GET('email'),
	            ':usu' => $data->__GET('usuario'),
	            ':cont' => $data->__GET('contrasena'),
	            ':img' => $data->__GET('imagen'),
	            ':idUsu' => $data->__GET('id_usu'),
	        );
	        $st = $this->conexionn->prepare($consulta);
	        $st->execute($arrayParam);
			} catch (Exception $e) 
			{
				die($e->getMessage());
			}
	}

	public function Estado($data)
	{
		try 
		{
				$sql = "UPDATE tm_usuario SET estado = ? WHERE id_usu = ?";
				$this->conexionn->prepare($sql)->execute(array($data->__GET('estado'),$data->__GET('cod_usu')));
				$this->conexionn=null;     
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($cod_usu_e)
	{
		try 
			{
					$consulta = "SELECT count(*) AS total FROM tm_venta WHERE id_usu = :id_usu";
          $result = $this->conexionn->prepare($consulta);
          $result->bindParam(':id_usu',$cod_usu_e,PDO::PARAM_INT);
          $result->execute();
          if($result->fetchColumn()==0){
						$stm = $this->conexionn->prepare("DELETE FROM tm_usuario WHERE id_usu = ?");          
						$stm->execute(array($cod_usu_e));
						header('Location: lista_tm_usuarios.php');
					} else {
						header('Location: lista_tm_usuarios.php?m=e');
					}
				$result->closeCursor();
	            $this->conexionn=null;
			} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

}