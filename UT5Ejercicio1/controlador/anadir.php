<?php

require_once '../modelo/Cesta_compra.php';
require_once '../modelo/DB.php';
require_once '../modelo/Producto.php';
require_once 'funciones.php';

comprobar_sesion();

// Comprobamos si se ha enviado el formulario de añadir
if(isset($_POST['add'])){
    $cod = $_POST['cod'];
    $unidades = $_POST['unidades'];
    
    // añadir unidades
    Cesta_compra::carga_articulo($cod, $unidades);
    
    // obtener el código de familia
    $cod_familia = Cesta_compra::get_familia($cod);
    
    // redirigir a vista listado productos
    header("Location: ../vista/vista_listado_productos.php?familia=$cod_familia");
}