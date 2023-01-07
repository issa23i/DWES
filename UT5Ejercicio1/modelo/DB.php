<?php

include_once '../controlador/constantes.php';
include_once 'Familia.php';
include_once 'Producto.php';

/**
 * Conexión a la Base de Datos
 *
 * @author ipaslop262
 */
class DB {

    protected static function ejecuta_consulta() {
        $num_argumentos = func_num_args();
        if ($num_argumentos == 2) {
            try {
                $pdo = new PDO(DSN, USUARIO_DB, PASSWORD_DB);
                $resultado = $pdo->prepare(func_get_arg(0));
                $resultado->execute(func_get_arg(1));
                return $resultado;
            } catch (Exception $exc) {
                throw $exc;
            }
        } elseif ($num_argumentos == 1){
            try {
                $pdo = new PDO(DSN, USUARIO_DB, PASSWORD_DB);
                $resultado = $pdo->query(func_get_arg(0));
                return $resultado;
            } catch (Exception $ex) {
                echo $ex->getTraceAsString();
            }
        } else {
            return null;
        }
    }

    public static function obtener_familias() {   
        $query = 'SELECT cod, nombre FROM familia';
        $familias = [];
        try{
            $resultado = self::ejecuta_consulta($query);
            if( ($resultado->rowCount()) > 0 ){
               foreach ($resultado as $row) {
                $familias[] = new Familia($row);
            }
            return $familias; 
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public static function obtiene_productos($cod_familia){
        $productos = [];
        $query = 'SELECT cod, nombre_corto, descripcion, PVP, familia FROM producto WHERE familia = :familia';
        $array_familia = array(':familia' => $cod_familia );
        try{
            $resultado = self::ejecuta_consulta($query,$array_familia);
            if( ($resultado->rowCount()) > 0 ){
               foreach ($resultado as $row) {
                    $productos[] = new Producto($row);
            }
            return $productos; 
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public static function obtiene_producto($cod_producto){
        $producto; // variable para asignar el objeto producto
        $query = 'SELECT cod, nombre_corto, descripcion, PVP, familia FROM producto WHERE cod= :cod';
        $array_cod = array(':cod' => $cod_producto);
        try{
            $resultado = self::ejecuta_consulta($query,$array_cod);
            if( ($resultado->rowCount()) == 1 ){
                $producto = new Producto($resultado->fetch());
            }
        } catch (Exception $ex) {
            throw $ex;
        }
        return $producto;
    }
    
    public static function verifica_cliente($usuario,$password){
        $query = "SELECT * FROM `usuarios` WHERE usuario = :nombre_usuario AND password =  :clave_usuario";
        $array_usuario = array(':nombre_usuario' => $usuario, ':clave_usuario' => $password);
        try{
            $resultado = self::ejecuta_consulta($query,$array_usuario);
            if( ($resultado->rowCount())>0 ){
                return true;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public static function obtiene_tv($cod_producto) {
        $tv;
        $query = "SELECT producto.cod, producto.nombre_corto, producto.descripcion, producto.PVP, producto.familia, televisor.pulgadas, televisor.resolucion, televisor.panel FROM televisor INNER JOIN producto WHERE producto.cod = televisor.cod AND producto.cod = $cod_producto";
        try{
            $resultado = self::ejecuta_consulta($query);
            if( ($resultado->rowCount()>0)){
                $tv = new Televisor($resultado);
            }
        } catch (Exception $ex) {
            throw $ex;
        }
        return $tv;
    }
    
    public static function obtiene_sobremesa($cod_producto) {
        $sobremesa;
        $query = "SELECT producto.cod, producto.nombre_corto, producto.descripcion, producto.PVP, producto.familia, sobremesa.marca, sobremesa.modelo, sobremesa.procesador, sobremesa.ram, sobremesa.rom, sobremesa.extras FROM producto INNER JOIN sobremesa WHERE producto.cod = sobremesa.cod AND producto.cod = $cod_producto";
        try {
            $resultado = self::ejecuta_consulta($query);
            if( ($resultado->rowCount()>0)){
                $sobremesa = new Sobremesa($resultado);
            }
        } catch (Exception $exc) {
            throw $exc;
        }
        return $sobremesa;
    }

}
