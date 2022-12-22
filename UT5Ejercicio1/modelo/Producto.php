<?php

/**
 * Description of Producto
 *
 * @author ipaslop262
 */
class Producto {

    public $codigo;
    public $nombre_corto;
    public $descripcion;
    public $PVP;
    public $familia;

    public function __construct($row) {
        $this->codigo = $row['cod'];
        $this->nombre_corto = $row['nombre_corto'];
        $this->descripcion = $row['descripcion'];
        $this->PVP = $row['PVP'];
        $this->familia = $row['familia'];
    }

    public function mostrar_nombre(){
        return $this->nombre_corto;
    }
    
    public function getCodigo() {
        return $this->codigo;
    }

    public function getNombre_corto() {
        return $this->nombre_corto;
    }

    public function getPVP() {
        return $this->PVP;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getFamilia() {
        return $this->familia;
    }


}
