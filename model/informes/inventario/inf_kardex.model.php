<?php
include_once("model/rest.model.php");

class InformeModel
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
            $tipo_ip = $_POST['tipo_ip'];
            $id_ip = $_POST['id_ip'];
            $stm = $this->conexionn->prepare("SELECT * FROM tm_inventario WHERE id_ti = ? AND id_ins = ?");
            $stm->execute(array($tipo_ip,$id_ip));
            $c = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach($c as $k => $d)
            {
                $c[$k]->{'Dato'} = $this->conexionn->query("SELECT descripcion FROM v_busqins WHERE tipo_p = ".$d->id_ti." AND id_ins = ".$d->id_ins)
                    ->fetch(PDO::FETCH_OBJ);

                if($d->id_tipo_ope == 1){
                    $c[$k]->{'Comp'} = $this->conexionn->query("SELECT serie_doc,num_doc,desc_td FROM v_compras WHERE id_compra = ".$d->id_cv)
                    ->fetch(PDO::FETCH_OBJ);
                } else if($d->id_tipo_ope == 2){
                    $c[$k]->{'Comp'} = $this->conexionn->query("SELECT ser_doc,nro_doc,desc_td FROM v_ventas_con WHERE id_ven = ".$d->id_cv)
                    ->fetch(PDO::FETCH_OBJ);
                }

                if($d->id_ti == 1){
                    $c[$k]->{'Almacen'} = $this->conexionn->query("SELECT a.nombre as dato FROM tm_producto  AS p INNER JOIN tm_area_prod AS ap ON p.id_areap = ap.id_areap INNER JOIN tm_almacen AS a ON ap.id_alm = a.id_alm INNER JOIN tm_producto_pres AS pp ON p.id_prod = pp.id_prod INNER JOIN tm_producto_ingr i ON pp.id_pres = i.id_pres WHERE i.id_ins = ".$d->id_ins)
                    ->fetch(PDO::FETCH_OBJ);
                } else if($d->id_ti == 2){
                    $c[$k]->{'Almacen'} = $this->conexionn->query("SELECT a.nombre as dato FROM tm_producto  AS p INNER JOIN tm_area_prod AS ap ON p.id_areap = ap.id_areap INNER JOIN tm_almacen AS a ON ap.id_alm = a.id_alm INNER JOIN tm_producto_pres AS pp ON p.id_prod = pp.id_prod WHERE pp.id_pres = ".$d->id_ins)
                    ->fetch(PDO::FETCH_OBJ);
                }
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

    public function InsProd()
    {
        try
        {    
            $stm = $this->conexionn->prepare("SELECT id_ins,cod_ins,nomb_ins FROM v_busqins");
            $stm->execute();            
            $c = $stm->fetchAll(PDO::FETCH_OBJ);
            return $c;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function ComboIP($data)
    {
        try
        {   
            $stmm = $this->conexionn->prepare("SELECT id_ins,cod_ins,nomb_ins FROM v_busqins WHERE tipo_p = ?");
            $stmm->execute(array($data['cod']));
            $var = $stmm->fetchAll(PDO::FETCH_ASSOC);
            foreach($var as $v){
                echo '<option value="'.$v['id_ins'].'">'.$v['cod_ins'].' - '.$v['nomb_ins'].'</option>';
            }
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
}