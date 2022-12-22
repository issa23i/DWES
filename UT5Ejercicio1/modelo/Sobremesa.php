<?php

/**
 * Description of Sobremesa
 *
 * @author ipaslop262
 */
class Sobremesa {
    public $marca;
    public $modelo;
    public $procesador;
    public $ram;
    public $rom;
    public $extras;
    
    public function __construct($row) {
        parent::__construct($row);
        $this->marca;
        $this->modelo;
        $this->procesador;
        $this->ram;
        $this->rom;
        $this->extras;
    }
    
    public function getMarca() {
        return $this->marca;
    }

    public function getModelo() {
        return $this->modelo;
    }

    public function getProcesador() {
        return $this->procesador;
    }

    public function getRam() {
        return $this->ram;
    }

    public function getRom() {
        return $this->rom;
    }

    public function getExtras() {
        return $this->extras;
    }

}
