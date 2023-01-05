<?php

/**
 * Description of CESTA_COMPRA
 *
 * @author issa2
 */
class CESTA_COMPRA {
    
    public $cesta;
    
    public static function cargar_cesta(){
        // carga de la sesión
        if(isset($_SESSION['cesta'])){
            $this->cesta = $_SESSION['cesta'];
        // si no existe, la crea y la guarda
        } else {
            $this->cesta = [];
            guardar_cesta($this->cesta);
        }
        return $this->cesta;
    }
    
    public function guardar_cesta($cesta) {
        $_SESSION['cesta'] = $cesta;
    }
    
    public function carga_articulo ($cod, $unidades){
        $this->cargar_cesta();
        // si ya existe el producto en la cesta, suma las unidades
        if(array_key_exists($cod, $this->cesta)){
            $this->cesta[$cod]['unidades'] += $unidades;
        } else {
            $this->cesta[$cod]['unidades']= $unidades;
        }
        $this->guardar_cesta($this->cesta);
    }
    
    public function get_coste(){
        $total = 0;
        // recorrer la cesta para hayar el precio de los productos
        foreach ($this->cargar_cesta() as $cod => $unidades) {
            // el objeto se obtiene con el método obtiene_producto de la clase DB
            $producto = new Product(DB::obtiene_producto($cod));
            // se consulta su precio y se suma al total
            $total += ( ($producto->getPVP()) * $unidades );
        }
        return $total;
    }
    
    public function get_productos() {
        return $this->cargar_cesta();
    }
    
    public function get_familia($cod_pro){
        // el objeto se obtiene con el método obtiene_producto de la clase DB
        $producto = new Product(DB::obtiene_producto($cod));
        return $producto->getFamilia();
    }
    
    public function eliminar_producto($cod){
        // comprobar que el producto existe en la cesta
        if (array_key_exists($cod, $this->cargar_cesta())){
            $unidades = $this->cesta[$cod]['unidades'];
            // si hay una unidad o cero, se elimina el producto
            if ($unidades<=1){
                unset($this->cesta[$cod]);
            } else {
                $this->cesta[$cod]['unidades']--;
            }
        }
    }
    
    public function is_vacia(){
        $vacia = true;
        // si al menos hay una entrada
        if( count($this->cargar_cesta()) > 0 ){
            $vacia = false;
        }
        return $vacia;
    }
}
