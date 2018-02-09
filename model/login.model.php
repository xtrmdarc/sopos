<?php
include_once("rest.model.php");

class Usuarios {

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

public function Login($usuario, $pass, $rol)
{
	try
	{
			$stm = $this->conexionn->prepare("SELECT * FROM tm_usuario WHERE usuario = ? AND contrasena = ? AND id_rol = ? AND estado='a'");
			$stm->execute(array($usuario, $pass, $rol));
			if ($stm){		
				$hay_datos=0;
				while ($row = $stm->fetchAll(PDO::FETCH_OBJ)){
					$hay_datos=1;
				}
				return $hay_datos;
			}
			$stm->closeCursor();
			$this->conexionn=null;
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}

public function AperCaja($usuario,$caja,$turno)
{
	try
	{
		$stm = $this->conexionn->prepare("SELECT au.usuario FROM tm_usuario AS au INNER JOIN tm_aper_cierre AS ta ON au.id_usu = ta.id_usu WHERE au.usuario = ? AND ta.id_caja = ? AND ta.id_turno = ? AND ta.estado = 'a'");
		$stm->execute(array($usuario,$caja,$turno));
		if ($stm){		
			$hay_datos=0;
			while ($row = $stm->fetchAll(PDO::FETCH_OBJ)){
				$hay_datos=1;
			}
			return $hay_datos;
		}
		$stm->closeCursor();
		$this->conexionn=null;
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}

public function DatosUsuario($usuario)
{
	try
	{
		$stm = $this->conexionn->prepare("SELECT * FROM v_usuarios WHERE usuario = ?");
		$stm->execute(array($usuario));
		$resultado = $stm->fetchAll(PDO::FETCH_ASSOC);
		$stm->closeCursor();
		return $resultado;
		$this->conexionn=null;
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}

public function DatosCaja($usuario,$caja,$turno)
{
	try
	{
		$stm = $this->conexionn->prepare("SELECT vc.id_apc,vc.id_caja,vc.id_turno,vc.desc_caja,vc.desc_turno FROM v_caja_aper AS vc INNER JOIN tm_usuario AS au ON vc.id_usu = au.id_usu WHERE au.usuario = ? AND vc.id_caja = ? AND vc.id_turno = ? AND vc.estado = 'a'");
		$stm->execute(array($usuario,$caja,$turno));
		$resultado = $stm->fetchAll(PDO::FETCH_ASSOC);
		$stm->closeCursor();
		return $resultado;
		$this->conexionn=null;
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
}

public function DatosEmpresa()
{
    try
    {      
        $stm = $this->conexionn->prepare("SELECT * FROM tm_datos_empresa");
        $stm->execute();       
        $c = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        return $c;
        $this->conexionn=null;
    }
    catch(Exception $e)
    {
        die($e->getMessage());
    }
}

public function Caja()
    {
        try
        {    
            $stm = $this->conexionn->prepare("SELECT * FROM tm_caja WHERE estado = 'a'");
            $stm->execute();            
            $c = $stm->fetchAll(PDO::FETCH_OBJ);
            return $c;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

}

?>