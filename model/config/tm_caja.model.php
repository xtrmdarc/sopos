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

    public function ListaCajas()
    {
        try
        {
            $stm = $this->conexionn->prepare("SELECT * FROM tm_caja");
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

    public function CCaja($data)
    {
        try
        {
            $consulta = "call usp_configCajas( :flag, :nombre, :estado, @a);";
            $arrayParam =  array(
                ':flag' => 1,
                ':nombre' => $data['nomb_caja'],
                ':estado' => $data['estado_caja']
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

    public function UCaja($data)
    {
        try 
        {
            $consulta = "call usp_configCajas( :flag, :nombre, :estado, :idCaja);";
            $arrayParam =  array(
                ':flag' => 2,
                ':nombre' => $data['nomb_caja'],
                ':estado' => $data['estado_caja'],
                ':idCaja' => $data['cod_caja']
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
}