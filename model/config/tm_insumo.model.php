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

    public function ListaCatgs()
    {
        try
        {
            $stm = $this->conexionn->prepare("SELECT * FROM tm_insumo_catg");
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

    public function ListaIns()
    {
        try
        {
            $cod = $_POST['cod'];
            $cat = $_POST['cat'];
            $stm = $this->conexionn->prepare("SELECT * FROM v_insumos WHERE id_ins like ? AND id_catg like ? ORDER BY id_ins DESC");
            $stm->execute(array($cod,$cat));
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

    public function ListarUniMed()
    {
        try
        {      
            $stm = $this->conexionn->prepare("SELECT * FROM tm_tipo_medida");
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

    public function ListarAlmacenes()
    {
        try
        {      
            $stm = $this->conexionn->prepare("SELECT * FROM tm_almacen WHERE estado ='a'");
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

    public function ComboCatg()
    {
        try
        {      
            $stmm = $this->conexionn->prepare("SELECT * FROM tm_insumo_catg");
            $stmm->execute();
            $var = $stmm->fetchAll(PDO::FETCH_ASSOC);
            echo '<select name="cod_catg" id="cod_catg" class="selectpicker show-tick form-control" data-live-search="true" autocomplete="off" title="Seleccionar" data-size="5">';
            foreach($var as $v){
                echo '<option value="'.$v['id_catg'].'">'.$v['descripcion'].'</option>';
            }
            echo " </select>";
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function CCatg($data)
    {
        try 
        {
            $consulta = "call usp_configInsumoCatgs( :flag, :descC, @a);";
            $arrayParam =  array(
                ':flag' => 1,
                ':descC' => $data['nombre_catg']
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

    public function UCatg($data)
    {
        try 
        {
            $consulta = "call usp_configInsumoCatgs( :flag, :descC, :idCatg);";
            $arrayParam =  array(
                ':flag' => 2,
                ':descC' => $data['nombre_catg'],
                ':idCatg' => $data['cod_catg']
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

    public function CIns($data)
    {
        try
        {
            $consulta = "call usp_configInsumo( :flag, :idCatg, :idMed, :cod, :nombre, :stock, @a, @b);";
            $arrayParam =  array(
                ':flag' => 1,
                ':idCatg' => $data['cod_catg'],
                ':idMed' => $data['cod_med'],
                ':cod' => $data['codigo_ins'],
                ':nombre' => $data['nombre_ins'],
                ':stock' => $data['stock_min']
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

    public function UIns($data)
    {
        try 
        {
            $consulta = "call usp_configInsumo( :flag, :idCatg, :idMed, :cod, :nombre, :stock, :estado, :idIns);";
            $arrayParam =  array(
                ':flag' => 2,
                ':idCatg' => $data['cod_catg'],
                ':idMed' => $data['cod_med'],
                ':cod' => $data['codigo_ins'],
                ':nombre' => $data['nombre_ins'],
                ':stock' => $data['stock_min'],
                ':estado' => $data['estado'],
                ':idIns' => $data['cod_ins']
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