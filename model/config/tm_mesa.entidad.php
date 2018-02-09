<?php
    class Mesas
    {
        private $id_mesa;
        private $id_catg;
        private $nro_mesa;
        private $estado;
        public function __GET($k){ return $this->$k; }
        public function __SET($k, $v){ return $this->$k = $v; }
    }

    class Sala
    {
        private $id_catg;
        private $descripcion;
        public function __GET($k){ return $this->$k; }
        public function __SET($k, $v){ return $this->$k = $v; }
    }
?>