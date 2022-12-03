<!DOCTYPE html>
<!--
1) Haz una página PHP que utilice foreach para mostrar 
todos los valores del array $_SERVER en una tabla 
con dos columnas. La primera columna debe contener 
el nombre de la variable, y la segunda su valor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // crear array asociativa
        echo "<table>";
        foreach ($_SERVER as $key => $value) {
            
            echo "<tr><td> {$key}  </td> <td>  {$value} </td></tr>";
        }
          echo "</table>";      
        ?>
        <h3><a href="<?= $_SERVER['PHP_SELF'] ?>" >RECARGAR PÁGINA</a></h3>
        
        
    </body>
</html>
