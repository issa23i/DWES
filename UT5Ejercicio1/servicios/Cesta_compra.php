<?php

/**
 * Description of CESTA_COMPRA
 *
 * @author issa2
 */
class Cesta_compra {

    protected $cesta = [];
    /**
     * Carga la cesta de la sesión, si no existe, la crea (objeto Cesta_compra()
     * 
     * @return array
     */
    public static function cargar_cesta() {
        // carga de la sesión un objeto Cesta_compra
        if (isset($_SESSION['cesta'])) {
            $cesta_compra = $_SESSION['cesta'];
            // si no existe, la crea y la guarda
        } else {
            $cesta_compra = new Cesta_compra();
        }
        return $cesta_compra;
    }

    /**
     * guarda en la sesión el array de la cesta
     * @param type array
     */
    public function guardar_cesta($cesta) {
        $_SESSION['cesta'] = $this;
    }

    /**
     * Carga la cesta de la sesión,
     * si existe el producto en la cesta, suma las unidades, 
     * si no existe el producto, lo añade a la cesta 
     * 
     * @param type string
     * @param type string
     */
    public function carga_articulo($cod, $unidades) {
        
    // array asociativo  { cod => { 'producto':{producto}, 'unidades':{unidades} } } 

        // si ya existe el producto en la cesta, suma las unidades
        if (array_key_exists($cod, $this->cesta)) {
            $unidades_numero = intval($this->cesta[$cod]['unidades']);
            $unidades_numero += $unidades;
            $this->cesta[$cod]['unidades'] = $unidades_numero;
        } else {
            try {
                $producto = DB::obtiene_producto($cod);
                $this->cesta[$cod]['producto']=$producto;
                $this->cesta[$cod]['unidades'] = $unidades;
            } catch (Exception $exc) {
                throw $exc;
            }
        }
    }
    
    /**
     * Devuelve el total de la cesta
     * @return type
     */
    public function get_coste() {
        $total = 0;
        // recorrer la cesta para hayar el precio de los productos
        foreach ($this->cesta as $value) {
            // el objeto se obtiene con el método obtiene_producto de la clase DB
            $producto = $value['producto'];
            $unidades = $value['unidades'];
            // se consulta su precio y se suma al total
            $pvp_producto = floatval($producto->getPVP());
            $total_producto_actual =  $pvp_producto * $unidades;
            $total = $total + $total_producto_actual;
        }
        return $total;
    }

    /**
     * Devuelve el array de la cesta de la compra
     * @return type array
     */
    public function get_productos() {
    // array asociativo  { cod => { 'producto':{producto}, 'unidades':{unidades} } } 
        return $this->cesta;
    }

    /**
     * Busca el producto mediante el código y devuelve su familia
     * @param type string
     * @return type string
     */
    public function get_familia($cod_pro) {
        // si el producto está en la cesta, obtenemos la familia 
        // del producto almacenado en el array cesta
        if(array_key_exists($cod_pro, $this->cesta)){
            $producto = $this->cesta[$cod_pro]['producto'];
        // si no está en la cesta, el objeto producto se obtiene con 
        // el método obtiene_producto de la clase DB  
        } else {
            $producto = DB::obtiene_producto($cod_pro);
        }
        $cod_familia = $producto->getFamilia();
        return $cod_familia;
    }

    /**
     * Carga la cesta de la sesión,
     * Busca si existe el código pasado por parámetro en la cesta,
     * Si existe, resta una unidad, 
     * si al restar, se obtiene 0 unidades, 
     * elimina la entrada del array cesta
     * @param type string
     */
    public static function eliminar_producto($cod) {
        // comprobar que el producto existe en la cesta
        if (array_key_exists($cod, $this->cesta)) {
            $unidades = intval($this->cesta[$cod]['unidades']);
            // si hay una unidad o cero, se elimina el producto
            if ($unidades <= 1) {
                unset($this->cesta[$cod]);
            } else {
                $cesta[$cod]['unidades'] = intval($this->cesta[$cod]['unidades']) - 1;
            }
        }
    }

    /**
     * Carga la cesta de la sesión,
     * Busca si existe el código pasado por parámetro en la cesta,
     * Si existe, cambia las unidades por las unidades pasadas por parámetro
     * comprobando que si es 0 o número negativo, borre el artículo de la cesta
     * @param type $cod
     * @param type $unidades_cambiadas
     */
    public function cambiar_unidades($cod, $unidades_cambiadas) {
        // comprobar que el artículo existe en la cesta
        if (array_key_exists($cod, $this->cesta)) {
            // si se ha metido un número 0 o negativo, se borran las unidades
            if ($unidades_cambiadas < 1) {
                unset($this->cesta[$cod]);
            } else {
                $this->cesta[$cod]['unidades'] = $unidades_cambiadas;
            }
        }
    }

    /**
     * Convierte el array cesta en uno vacío y lo guarda en la sesión
     */
    public function vaciar_cesta() {
        $this->cesta = [];
    }

    /**
     * Comprueba si hay registros en la cesta
     * @return boolean
     */
    public function is_vacia() {
        $vacia = true;
        // si al menos hay una entrada
        if (count($this->cesta) > 0) {
            $vacia = false;
        }
        return $vacia;
    }

}
