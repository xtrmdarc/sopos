<?php
    class Egreso
    {
        private $id_ga;
        private $id_tipo_gasto;
        private $id_tipo_doc;
        private $id_per;
        private $id_usu;
        private $nro_comp;
        private $fecha_comp;
        private $importe;
        private $motivo;
        private $fecha_registro;
        private $estado;
        public function __GET($k){ return $this->$k; }
        public function __SET($k, $v){ return $this->$k = $v; }
    }
?>