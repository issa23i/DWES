<?php
/**
 * Description of CESTA_COMPRA
 *
 * @author issa2
 */
class Cesta_compra {
    
    public static function cargar_cesta(){
        // carga de la sesión
        if(isset($_SESSION['cesta'])){
            $cesta = $_SESSION['cesta'];
        // si no existe, la crea y la guarda
        } else {
            $cesta = [];
            self::guardar_cesta($cesta);
        }
        //echo var_dump($cesta);
        return $cesta;
    }
    
    public static function guardar_cesta($cesta) {
        $_SESSION['cesta'] = $cesta;
    }
    
    public static function carga_articulo ($cod, $unidades){
        $cesta = self::cargar_cesta();
        
        // si ya existe el producto en la cesta, suma las unidades
        if(array_key_exists($cod, $cesta)){
            $unidades_numero = intval($cesta[$cod]['unidades']);
            $unidades_numero += $unidades;
            $cesta[$cod]['unidades'] = $unidades_numero;
        } else {
            $cesta[$cod]['unidades']= $unidades;
        }
        
        // obtener los campos nombre y pvp del producto
        $producto = DB::obtiene_producto($cod);
        $cesta[$cod]['nombre'] = $producto->mostrar_nombre();
        $cesta[$cod]['pvp'] = $producto->getPVP();
        
        //echo var_dump($cesta);
        self::guardar_cesta($cesta);
    }
    
    public static function get_coste(){
        $cesta = self::cargar_cesta();
        $total = 0;
        // recorrer la cesta para hayar el precio de los productos
        foreach ($cesta as $cod => $unidades) {
            // el objeto se obtiene con el método obtiene_producto de la clase DB
            $producto = new Product(DB::obtiene_producto($cod));
            // se consulta su precio y se suma al total
            $total += ( ($producto->getPVP()) * $unidades );
        }
        return $total;
    }
    
    public static function get_productos() {
        return self::cargar_cesta();
    }
    
    public static function get_familia($cod_pro){
        // el objeto se obtiene con el método obtiene_producto de la clase DB
        $producto = new Product(DB::obtiene_producto($cod));
        return $producto->getFamilia();
    }
    
    public static function eliminar_producto($cod){
        $cesta = self::cargar_cesta();
        // comprobar que el producto existe en la cesta
        if (array_key_exists($cod, $cesta)){
            $unidades = intval($cesta[$cod]['unidades']);
            // si hay una unidad o cero, se elimina el producto
            if ($unidades<=1){
                unset($cesta[$cod]);
            } else {
                $cesta[$cod]['unidades'] = intval($cesta[$cod]['unidades']) - 1 ;
            }
        }
    }
    public static function vaciar_cesta(){
        $cesta = [];
        self::guardar_cesta($cesta);
    }
    
    public static function is_vacia(){
        $vacia = true;
        // si al menos hay una entrada
        if( count(self::cargar_cesta()) > 0 ){
            $vacia = false;
        }
        return $vacia;
    }
}
