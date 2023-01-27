<?php
require_once '../servicios/funciones.php';
require_once '../servicios/Cesta_compra.php';
comprobar_sesion();

$cesta_compra = Cesta_compra::cargar_cesta();
$cesta = $cesta_compra->get_productos();
echo json_encode($cesta);
