<?php

/**
 * Description of Producto
 *
 * @author ipaslop262
 */
class Producto {

    private $codigo;
    private $nombre_corto;
    private $descripcion;
    private $PVP;
    private $familia;

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
