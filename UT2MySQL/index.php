
<?php
//Declaramos variables para la conexión
$host = '127.0.0.1';
$usuarioBd = 'dwes';
$password = 'abc123.';
$nombreBd = 'dwes';
$productos = [];
$mensaje = '';
$resultado;

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
$query='SELECT cod, nombre FROM producto';
$resultado=$conexion->query($query);



$stock_producto =[];
if(isset($_POST['Enviar'])){
    $cod_enviado = $_POST['producto'];
    $consultaStock = "SELECT tienda.nombre, stock.unidades "
                    . "from tienda JOIN stock "
                    . "ON tienda.cod = stock.tienda "
                    . "WHERE stock.producto=$cod_enviado;";
    $resultado_stock=$conexion->query($consultaStock);
    $stock_producto=$resultado_stock->fetch_all(MYSQLI_ASSOC);
}  




if ($resultado){
    $productos=$resultado->fetch_all(MYSQLI_ASSOC);
    //print_r($productos);
    foreach ($productos as $value) {
        
        //////////////// aquí voy //////
        //hay que sacar el nombre del producto aquí //////
        // aquí hay que sacar el nombre del producto en una variable
        if(isset($cod_enviado)){
            if($cod_enviado==$value['cod']){
                $nombre_producto = $value['nombre'];
            }
        }
        
    }
} else {
    $mensaje = "No se puedo realizar la consulta ";
}

////////////////// PARTE II ///////////
$query_consulta_tienda_unidades = "SELECT tienda.nombre, stock.unidades, tienda.cod as cod_tienda"
        . " FROM stock INNER JOIN tienda    ON stock.tienda = tienda.cod"
        . " WHERE  stock.producto='".$cod_enviado."'";

if(isset($_POST["modificar"])){
    $unidadesModificadas = $_POST["unidades"];
    $tiendasModificadas = $_POST["tienda"];
    $prepared_statment = $conexión -> stmt_init();
    $query_update_stock = "UPDATE stock SET unidades=? WHERE ";
    $prepared_statment->prepare($query_consulta_tienda_unidades);
    for($i = 0; $i < count($tiendasModificadas); $i++){
        $prepared_statment -> bind_param('ii',$unidadesModificadas[$i], $tiendasModificadas[$i]);
    }
    
}

/**
$query_parte2 = "UPDATE stock SET unidades=2 where stock.tienda=1 AND stock.producto='000222';";
$query_parte2_2= "INSERT INTO stock VALUES ('000222',2,1);";
$result_parte2 = $conexion->query($query_parte2);
$result_parte2_2 = $conexion->query($query_parte2_2);
 * */
?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;
              charset=UTF-8">
        <title>Plantilla para Ejercicios Tema 3</title>
        <link href="dwes.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="encabezado">
            <h1>Ejercicio: </h1>
            <form id="form_seleccion" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                <label>Productos</label>
                <select name="producto">
                    <?php foreach ($productos as $row): ?>
                    <?php if ($cod_enviado==$row['cod']): ?>
                    <option selected value="<?=$row['cod'] ?>"><?=$row['nombre'] ?></option>
                    <?php endif; ?>
                    <option value="<?=$row['cod'] ?>"><?=$row['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="submit" name="Enviar" value="Enviar"/>
            </form>
        </div>
        <div id="contenido">
            <h2>Stock del producto en las tiendas</h2>
            <?php if(isset($cod_enviado) && count($stock_producto) != 0): ?>
            <table>
                <tr>
                    <th colspan="2"><?=$nombre_producto ?></th>
                </tr>
                <?php foreach ($stock_producto as $value): ?>
                <tr>
                    <td><?=$value['nombre'] ?></td>  <td><?=$value['unidades'] ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
            <!--<!--   <?php //elseif ( count($stock_producto) < 1): ?>
                    <p>No hay productos en stock</p>
                  comment --> 
            <?php endif; ?>
        </div>
        <div id="parte2">
            <h2>Transacción</h2>
            <form method="post" action="<?=$_SERVER['PHP_SELF']?>">
                 
                    <p><?=$nombre_producto ?></p>
                
                <?php foreach ($stock_producto as $value): ?>
                
                
                    <p>
                        <label for="nuevas_unidades[]"><?=$value['nombre'] ?></label>  
                        <input type="hidden" name="tienda"><?=$value['nombre'] ?></label>
                        <input type="text" name="nuevas_unidades[]" value="<?=$value['unidades'] ?>"></input>
                        
                    </p>
                    
                <?php endforeach; ?>
                    <input type="hidden" name="producto_modificado" value="<?=$cod_enviado ?>">
                    <input type="submit" name="modificar" value="Enviar">
            </form>
        </div>
        <div id="pie">
        </div>
    </body>
</html>

