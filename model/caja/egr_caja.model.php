<?php
include_once("model/rest.model.php");

class ECajaModel
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
            date_default_timezone_set('America/Lima');
            setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
            $fecha = date("Y-m-d");
            $id_usu = $_SESSION["id_usu"];
            $stm = $this->conexionn->prepare("SELECT fecha_re,des_tg,desc_per,motivo,importe,id_ga,estado FROM v_gastosadm WHERE DATE(fecha_re) = ? and id_usu = ?");
            $stm->execute(array($fecha,$id_usu));            
            $c = $stm->fetchAll(PDO::FETCH_OBJ);
            return $c;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function Registrar(Egreso $data)
    {
        try
        {
            date_default_timezone_set('America/Lima');
            setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
            $fecha = date("Y-m-d H:i:s");
            $id_usu = $_SESSION["id_usu"];
            $id_apc = $_SESSION["id_apc"];
            $sql = "INSERT INTO tm_gastos_adm (id_tipo_gasto,id_tipo_doc,id_per,id_usu,id_apc,serie_doc,num_doc,fecha_comp,importe,motivo,fecha_registro) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
            $this->conexionn->prepare($sql)->execute(array(
                $data->__GET('rating'),
                $data->__GET('id_tipo_doc'),
                $data->__GET('id_per'),
                $id_usu,
                $id_apc,
                $data->__GET('serie_doc'),
                $data->__GET('num_doc'),
                $data->__GET('fecha_comp'),
                $data->__GET('importe'),         
                $data->__GET('motivo'),
                $fecha,
                ));
            $this->conexionn=null; 
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }

    //TIPO DE DOCUMENTO
    public function TipoDocumento()
    {   
        try
        {
            $stm = $this->conexionn->prepare("SELECT * FROM tm_tipo_doc");
            $stm->execute();            
            $c = $stm->fetchAll(PDO::FETCH_OBJ);
            return $c;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    //PERSONAL
    public function Personal()
    {   
        try
        {
            $stm = $this->conexionn->prepare("SELECT * FROM tm_usuario");
            $stm->execute();            
            $c = $stm->fetchAll(PDO::FETCH_OBJ);
            return $c;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    //ESTADO DE REGISTRO
    public function Estado(Egreso $data)
    {
        try 
        {
            $sql = "UPDATE tm_gastos_adm SET estado = 'i' WHERE id_ga = ?";
            $this->conexionn->prepare($sql)->execute(array($data->__GET('cod_ga')));
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }
}