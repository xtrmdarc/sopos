<?php
include_once("model/rest.model.php");

class LoginModel
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
}