<?php
include_once("model/rest.model.php");

class ACajaModel
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

    public function Datos()
    {
        try
        {
            $stm = $this->conexionn->prepare("SELECT * FROM v_caja_aper WHERE estado <> 'c'");
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

    public function Cajero()
    {
        try
        {    
            $stm = $this->conexionn->prepare("SELECT id_usu,ape_paterno,ape_materno,nombres FROM tm_usuario WHERE (id_rol = 1 OR id_rol = 2) AND estado = 'a'");
            $stm->execute();            
            $c = $stm->fetchAll(PDO::FETCH_OBJ);
            return $c;
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

    public function Turno()
    {
        try
        {    
            $stm = $this->conexionn->prepare("SELECT * FROM tm_turno");
            $stm->execute();            
            $c = $stm->fetchAll(PDO::FETCH_OBJ);
            return $c;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function MontoSis($data)
    {
        try
        {
            $fecha_ape = date('Y-m-d H:i:s',strtotime($data['fecha_ape']));
            $fecha_cie = date('Y-m-d H:i:s',strtotime($data['fecha_cie']));
            $stm = $this->conexionn->prepare("SELECT IFNULL(SUM(IF(id_tpag = 1,pago_efe,pago_efe)),0) AS total_i FROM v_ventas_con WHERE (fec_ven >= ? AND fec_ven <= ?) AND id_apc = ? AND estado <> 'i'");
            $stm->execute(array($fecha_ape,$fecha_cie,$data['cod_apc']));            
            $c = $stm->fetch(PDO::FETCH_OBJ);
            $c->{'Datos'} = $this->conexionn->query("SELECT * FROM v_caja_aper WHERE id_apc = ".$data['cod_apc'])
            ->fetch(PDO::FETCH_OBJ);
            $c->{'Ingresos'} = $this->conexionn->query("SELECT IFNULL(SUM(importe),0) AS total_i FROM tm_ingresos_adm WHERE (fecha_reg >= '{$fecha_ape}' AND fecha_reg <= '{$fecha_cie}') AND id_apc = {$data['cod_apc']} AND estado='a'")
            ->fetch(PDO::FETCH_OBJ);
            $c->{'Gastos'} = $this->conexionn->query("SELECT IFNULL(SUM(importe),0) AS total_g FROM v_gastosadm WHERE (fecha_re >= '{$fecha_ape}' AND fecha_re <= '{$fecha_cie}') AND id_apc = {$data['cod_apc']} AND estado='a'")
            ->fetch(PDO::FETCH_OBJ);
            return $c;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function MontoSisDet($data)
    {
        try
        {    
            date_default_timezone_set('America/Lima');
            setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
            $fecha_ape = date('Y-m-d H:i:s',strtotime($data['fecha_aper']));
            $fecha_cie = date("Y-m-d H:i:s");
            $stm = $this->conexionn->prepare("SELECT IFNULL(SUM(IF(id_tpag = 1,pago_efe,pago_efe)),0) AS total_i FROM v_ventas_con WHERE (fec_ven >= ? AND fec_ven <= ?) AND id_apc = ? AND estado <> 'i'");
            $stm->execute(array($fecha_ape,$fecha_cie,$data['cod_apc']));            
            $c = $stm->fetch(PDO::FETCH_OBJ);
            $c->{'Datos'} = $this->conexionn->query("SELECT * FROM v_caja_aper WHERE id_apc = ".$data['cod_apc'])
            ->fetch(PDO::FETCH_OBJ);
            $c->{'Ingresos'} = $this->conexionn->query("SELECT IFNULL(SUM(importe),0) AS total_i FROM tm_ingresos_adm WHERE (fecha_reg >= '{$fecha_ape}' AND fecha_reg <= '{$fecha_cie}') AND id_apc = {$data['cod_apc']} AND estado='a'")
            ->fetch(PDO::FETCH_OBJ);
            $c->{'Gastos'} = $this->conexionn->query("SELECT IFNULL(SUM(importe),0) AS total_g FROM v_gastosadm WHERE (fecha_re >= '{$fecha_ape}' AND fecha_re <= '{$fecha_cie}') AND id_apc = {$data['cod_apc']} AND estado='a'")
            ->fetch(PDO::FETCH_OBJ);
            return $c;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function Registrar(Caja $data)
    {
        try
        {
            date_default_timezone_set('America/Lima');
            setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
            $fecha = date("Y-m-d H:i:s");
            $consulta = "call usp_cajaAperturar( :flag, :idUsu, :idCaja, :idTurno, :fechaA, :montoA);";
            $arrayParam =  array(
                ':flag' => 1,
                ':idUsu' => $data->__GET('id_usu'),
                ':idCaja' => $data->__GET('id_caja'),
                ':idTurno' => $data->__GET('id_turno'),
                ':fechaA' =>  $fecha,
                ':montoA' => $data->__GET('monto')
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

    public function Actualizar(Caja $data)
    {
        try
        {
            $consulta = "call usp_cajaCerrar( :flag, :idApc, :fechaC, :montoC, :montoS);";
            $arrayParam =  array(
                ':flag' => 1,
                ':idApc' => $data->__GET('cod_apc'),
                ':fechaC' => $data->__GET('fecha_cierre'),
                ':montoC' => $data->__GET('monto'),
                ':montoS' => $data->__GET('monto_sistema')
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
}