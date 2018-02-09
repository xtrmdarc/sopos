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

	public function ListaSalones()
    {
        try
        {
            $stm = $this->conexionn->prepare("SELECT * FROM tm_salon");
            $stm->execute();
            $c = $stm->fetchAll(PDO::FETCH_OBJ);
           	foreach($c as $k => $d)
            {
                $c[$k]->{'Mesas'} = $this->conexionn->query("SELECT COUNT(id_mesa) AS total FROM tm_mesa WHERE id_catg = ".$d->id_catg)
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

    public function ListaMesas()
    {
        try
        {
            $cod = $_POST['cod'];
            $stm = $this->conexionn->prepare("SELECT * FROM tm_mesa WHERE id_catg like ? ORDER BY nro_mesa ASC");
            $stm->execute(array($cod));
            $c = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach($c as $k => $d)
            {
                $c[$k]->{'Salon'} = $this->conexionn->query("SELECT descripcion FROM tm_salon WHERE id_catg = ".$d->id_catg)
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

    public function CSalones($data)
    {
        try 
        {
            $consulta = "call usp_configSalones( :flag, :desc, :est, @a);";
            $arrayParam =  array(
                ':flag' => 1,
                ':desc' => $data['desc_sala'],
                ':est' => $data['est_salon']
            );
            $st = $this->conexionn->prepare($consulta);
            $st->execute($arrayParam);
            while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
                return $row['cod'];
            }
        }
        catch (Exception $e) 
        {
            return false;
        }
    }

    public function USalones($data)
    {
        try 
        {
            $consulta = "call usp_configSalones( :flag, :desc, :est, :idCatg);";
            $arrayParam =  array(
                ':flag' => 2,
                ':desc' => $data['desc_sala'],
                ':est' => $data['est_salon'],
                ':idCatg' => $data['cod_sala']
            );
            $st = $this->conexionn->prepare($consulta);
            $st->execute($arrayParam);
            while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
                return $row['cod'];
            }
        }
        catch (Exception $e) 
        {
            return false;
        }
    }

	public function EliminarS($data)
	{
		try 
		{
			$consulta = "call usp_configSalones( :flag, @a, @b, :idCatg);";
            $arrayParam =  array(
                ':flag' => 3,
                ':idCatg' => $data['cod_salae']
            );
            $st = $this->conexionn->prepare($consulta);
            $st->execute($arrayParam);
            while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
                return $row['cod'];
            }
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function CMesas($data)
    {
        try 
        {
            $consulta = "call usp_configMesas( :flag, :idCatg, :nroMesa, @a);";
            $arrayParam =  array(
                ':flag' => 1,
                ':idCatg' => $data['id_catg'],
                ':nroMesa' => $data['nro_mesa']
            );
            $st = $this->conexionn->prepare($consulta);
            $st->execute($arrayParam);
            while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
                return $row['cod'];
            }
        }
        catch (Exception $e) 
        {
            return false;
        }
    }

    public function UMesas($data)
    {
        try 
        {
            $consulta = "call usp_configMesas( :flag, :idCatg, :nroMesa, :idMesa);";
            $arrayParam =  array(
                ':flag' => 2,
                ':idCatg' => $data['id_catg'],
                ':nroMesa' => $data['nro_mesa'],
                ':idMesa' => $data['cod_mesa']
            );
            $st = $this->conexionn->prepare($consulta);
            $st->execute($arrayParam);
            while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
                return $row['cod'];
            }
        }
        catch (Exception $e) 
        {
            return false;
        }
    }

    public function EliminarM($data)
	{
		try 
		{
			$consulta = "call usp_configMesas( :flag, @a, @b, :idMesa);";
            $arrayParam =  array(
                ':flag' => 3,
                ':idMesa' => $data['cod_mesae']
            );
            $st = $this->conexionn->prepare($consulta);
            $st->execute($arrayParam);
            while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
                return $row['cod'];
            }
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

    public function EstadoM($data)
    {
        try 
        {
            $sql = "UPDATE tm_mesa SET estado = ? WHERE id_mesa = ?";
            $this->conexionn->prepare($sql)->execute(array($data['est_mesa'],$data['codi_mesa']));    
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
}