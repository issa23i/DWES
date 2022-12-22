<?php
/**
 * Description of Televisor
 *
 * @author ipaslop262
 */
class Televisor extends Producto {
    public $pulgadas;
    public $panel;
    
    public function __construct($row) {
    parent::__construct($row);
        $this->pulgadas = $row['pulgadas'];
        $this->panel = $row['panel'];
    }
    
    public function getPulgadas() {
        return $this->pulgadas;
    }

    public function getPanel() {
        return $this->panel;
    }

}
