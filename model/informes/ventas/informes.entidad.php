<?php
    class Informes
    {
        private $min1;
        private $max1;
        public function __GET($k){ return $this->$k; }
        public function __SET($k, $v){ return $this->$k = $v; }
    }
?>