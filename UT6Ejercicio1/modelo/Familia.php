<?php

/**
 * Description of Familia
 *
 * @author ipaslop262
 */
class Familia {
    public $cod;
    public $nombre;
    
    public function __construct($row) {
        $this->cod = $row['cod'];
        $this->nombre = $row['nombre'];
    }
    
    public function getCod() {
        return $this->cod;
    }

    public function getNombre() {
        return $this->nombre;
    }


}
