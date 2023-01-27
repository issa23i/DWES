<?php
require_once('../modelo/DB.php');
require_once '../servicios/funciones.php';

comprobar_sesion();
$productos = '';
 if (isset($_SESSION['cod_familia'])) {
    $cod_familia = $_SESSION['cod_familia'];
    try {
        $productos = DB::obtiene_productos($cod_familia);
    } catch (Exception $exc) {
        echo $exc->getMessage();
    }
}
echo json_encode($productos, true);
?>

