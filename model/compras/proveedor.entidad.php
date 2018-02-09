<?php
    class Proveedor
    {
        private $id_prov;
        private $ruc;
        private $razon_social;
        private $direccion;
        private $telefono;
        private $email;
        private $contacto;
        private $estado;
        public function __GET($k){ return $this->$k; }
        public function __SET($k, $v){ return $this->$k = $v; }
    }
?>