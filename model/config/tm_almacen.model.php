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

    public function ListaAlmacenes()
    {
        try
        {
            $stm = $this->conexionn->prepare("SELECT * FROM tm_almacen");
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

    public function CAlmacen($data)
    {
        try
        {
            $consulta = "call usp_configAlmacenes( :flag, :nombre, :estado, @a);";
            $arrayParam =  array(
                ':flag' => 1,
                ':nombre' => $data['nomb_alm'],
                ':estado' => $data['estado_alm']
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

    public function UAlmacen($data)
    {
        try 
        {
            $consulta = "call usp_configAlmacenes( :flag, :nombre, :estado, :idAlm);";
            $arrayParam =  array(
                ':flag' => 2,
                ':nombre' => $data['nomb_alm'],
                ':estado' => $data['estado_alm'],
                ':idAlm' => $data['cod_alm']
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

    public function ListaAreasP()
    {
        try
        {
            $cod = $_POST['codigo'];
            $stm = $this->conexionn->prepare("SELECT * FROM tm_area_prod WHERE id_areap like ?");
            $stm->execute(array($cod));
            $c = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach($c as $k => $d)
            {
                $c[$k]->{'Almacen'} = $this->conexionn->query("SELECT nombre FROM tm_almacen WHERE id_alm = ".$d->id_alm)
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

    public function CAreasP($data)
    {
        try
        {
            $consulta = "call usp_configAreasProd( :flag, :idAlm, :nombre, :estado, @a);";
            $arrayParam =  array(
                ':flag' => 1,
                ':idAlm' => $data['cod_alma'],
                ':nombre' => $data['nomb_area'],
                ':estado' => $data['estado_area']
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

    public function UAreasP($data)
    {
        try 
        {
            $consulta = "call usp_configAreasProd( :flag, :idAlm, :nombre, :estado, :idArea);";
            $arrayParam =  array(
                ':flag' => 2,
                ':idAlm' => $data['cod_alma'],
                ':nombre' => $data['nomb_area'],
                ':estado' => $data['estado_area'],
                ':idArea' => $data['cod_area']
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

    public function ComboAlm()
    {
        try
        {      
            $stm = $this->conexionn->prepare("SELECT * FROM tm_almacen WHERE estado = 'a'");
            $stm->execute();
            $var = $stm->fetchAll(PDO::FETCH_ASSOC);
            echo '<select name="cod_alma" id="cod_alma" class="selectpicker show-tick form-control" data-live-search="true" autocomplete="off" title="Seleccionar" data-size="5">';
            foreach($var as $v){
                echo '<option value="'.$v['id_alm'].'">'.$v['nombre'].'</option>';
            }
            echo " </select>";
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
}