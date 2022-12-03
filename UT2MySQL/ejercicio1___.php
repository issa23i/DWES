<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01
    Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<?php
//Declaramos variables para la conexión
$host = '127.0.0.1';
$usuarioBd = 'dwes';
$password = 'abc123.';
$nombreBd = 'dwes';

//Iniciamos las variables
$nombre_producto_select = null;
$cod_enviado = null;
$stock=[];
//Creamos mensaje
$mensaje='mensaje no editado';

//Creamos la conexión con la BD usando atributos
/* Primera forma de hacerlo:
 *
  $conexion = new mysqli();
  $conexion-> mysqli_connect($host, $usuarioBd, $password, $nombreBd );

 * Mejor forma de hacerlo (Lo hacemos dentro de un try catch: */

//Vemos si ha ocurrido un error
try {
    $conexion = new mysqli($host, $usuarioBd, $password, $nombreBd);
} catch (Exception $e) {
    die('<p>Error conexión: ' . $e->getMessage() . '</p>');
}




//Comprobamos si se ha pulsado el botón enviar
if(isset($_POST["enviar"])){
   
    //Creamos variable para recoger el código del producto enviado por el formulario
  $cod_enviado = $_POST["cod_prod"];    //Tiene el mismo nombre que el select
 
  $consulta_stock = "SELECT tienda.nombre, stock.unidades FROM stock"
          . " INNER JOIN tienda ON stock.tienda=tienda.cod "
          . "WHERE stock.producto='". $cod_enviado. "'";
 
  $resultado_stock= $conexion->query($consulta_stock);
 
  if ($resultado_stock){ //Si se ha realizado la consulta correctamente
      $stock = $resultado_stock->fetch_all(MYSQLI_ASSOC);   //Contiene un array asociativo del stock (tienda.nombre, stock.unidades)
  }
 
}



//Crear la consulta
$query = 'SELECT cod, nombre FROM producto';

$resultado = $conexion->query($query);  //puede devolver false si no se conecta, o un objeto de la clase mysqli_use_result

if ($resultado) {
    $productos = $resultado->fetch_all(MYSQLI_ASSOC);   //devuelve todas las filas, array asociativo (fetch solo devuelve una fila)
   
    //Para sacar el nombre del producto a partir del codigo seleccionado
    foreach ($productos as $value) {
        if ($value["cod"]== $cod_enviado){
            $nombre_producto_selec = $value["nombre"];
        }
    }
   
}else{
    $mensaje="La consulta no se ha realizado correctamente";
}



?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;
              charset=UTF-8">
        <title>Plantilla para Ejercicios Tema 3</title>
        <link href="dwes.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <!-- <pre> <?php //print_r($productos)?></pre> Con la etiqueta <pre> te formatea la salida del array-->
        <div id="encabezado">
            <h1>Ejercicio: </h1>
            <form id="form_seleccion" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label>Productos</label>
                <select name="cod_prod">
                    <?php foreach ($productos as $value):?>
                       <?php if($cod_enviado==$value["cod"]) :?>    <!--para ver si he enviado el formulario, mostrar el producto que he enviado-->
                            <option value="<?= $value["cod"] ?>" selected> <?=$value["nombre"]?> </option>
                        <?php else:?>
                            <option value="<?= $value["cod"] ?>"> <?=$value["nombre"]?> </option>
                        <?php endif?>
                    <?php endforeach?>
                </select>
                <input type="submit" name= "enviar" value="Enviar"/>
            </form>
        </div>
        <div id="contenido">
            <h2>Stock de productos en las tiendas:</h2>
            <?php if (isset($cod_enviado) && count($stock)!=0): //Si tengo código enviado y el stock no es cero?>

                    <table border="1">
                        <tr>
                            <th>Nombre de la tienda</th>
                            <th>Nombre Producto</th>
                            <th>Unidades</th>
                        </tr>
                    <?php foreach ($stock as $value):?>
                        <tr>
                            <td><?=$value["nombre"]?></td>
                            <td><?=$nombre_producto_selec?></td>
                            <td><?=$value["unidades"]?></td>
                        </tr>
                    <?php endforeach;?>
                    </table>
                   <?php elseif (isset($cod_enviado) && count($stock) == 0) : ?>
                    <h2>No hay stock del producto </h2>
            <?php endif?>
           
        </div>
        <div id="pie">
        </div>
    </body>
</html>

