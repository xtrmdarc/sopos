<?php
    class Cliente
    {
        private $id_cliente;
        private $dni;
        private $ruc;
        private $ape_paterno;
        private $ape_materno;
        private $nombres;
        private $razon_social;
        private $telefono;
        private $fecha_nac;
        private $correo;
        private $direccion;
        private $estado;
        public function __GET($k){ return $this->$k; }
        public function __SET($k, $v){ return $this->$k = $v; }
    }
?>