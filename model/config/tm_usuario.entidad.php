<?php
    class Usuario
    {
        private $id_usu;
        private $id_rol;
        private $id_areap;
        private $dni;
        private $ape_paterno;
        private $ape_materno;
        private $nombres;
        private $email;
        private $usuario;
        private $contrasena;
        private $estado;
        private $imagen;
        public function __GET($k){ return $this->$k; }
        public function __SET($k, $v){ return $this->$k = $v; }
    }
?>