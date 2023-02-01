<?php

/**
 * Description of Producto
 *
 * @author ipaslop262
 */
class Producto implements JsonSerializable {

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

    public function getNombre_corto() {
        return $this->nombre_corto;
    }

    public function getPVP() {
        return $this->PVP;
    }

    public function setNombre_corto($nombre_corto): void {
        $this->nombre_corto = $nombre_corto;
    }

    public function setPVP($PVP): void {
        $this->PVP = $PVP;
    }

    
    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getFamilia() {
        return $this->familia;
    }

    public function jsonSerialize(): mixed {
        $array_producto = get_object_vars($this);
        return $array_producto;
    }
}
