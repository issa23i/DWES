<?php
include 'formulario_columna.php';
    $mensaje=" ";
    $pintarTabla=false;
    if(isset($_POST["Enviar"])){
        
        $filas=$_POST["filas"];
        $columnas=$_POST["columnas"];
        
            if($filas=="" || $filas==" "){
                $pintarTabla;
                $mensaje="Introduzca un numero";
            }elseif(!ctype_digit($filas)){
                    $mensaje="No es un numero entero positivo";
            }elseif($filas<0 || $filas>200) {
                $mensaje="Rango superior";
            }else{
                $pintarTabla=true;
            }
          }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
            <?php if($pintarTabla):?>
            <table border="1px">
                
              
                <?php for($i=1; $i<=$filas;$i++):?>
                <tr>
                    <?php for($c=1; $c<=$columnas;$c++):?>
                    <td><?="$i-$c"?></td>
                    <?php endfor;?>
                </tr>
                
               <?php endfor;?>     
                   
            </table>
            <?php else: ?>
                 <p><?=$mensaje;?></p>
            
            <?php endif;?>
    </body>
</html>


