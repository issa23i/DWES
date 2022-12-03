<?php
        /**
         * Crea un menú desplegable dinámico
         * cuyas opciones sean los colores indicados
         * en los distintos elementos de un array dado.
         * Dicho menú tenrá un boon de formulario asociado
         * que enviará la opción seleccionada. Una vez pulsado,
         * se volverá a la misma página mostrando el color 
         * de fondo elegido y la opción seleccionada marcada
         * por defecto en el menú desplegable
         */
$codHexColor = '#DC143C';

        // definir varialbles del array
        $arrayColores = ['red' => '#DC143C',
                         'blue' => '#6495ED',
                         'yellow' => '#FFD700',
                         'green' => '#008000'];
    // Si se ha pulsado el botón
        if (isset($_POST['enviar'])){
            $codHexColor = $_POST['color']; // del select
        }
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body bgcolor="<?= $codHexColor  ?>">
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <select name="color">
                <?php foreach($arrayColores as $colorName => $hexColor): ?>
                <?php if($codHexColor == $hexColor): ?>
                                <option selected value="<?= $hexColor ?>"><?= $colorName ?></option>

                <?php else: ?>
                <option  value="<?= $hexColor ?>"><?= $colorName ?></option>
                
                <?php endif; ?>
                <?php endforeach; ?>
            <!--<!-- comment  
                <option value="red">ROJO</option>
                <option value="blue" selected>AZUL</option>
                <option value="yellow">AMARILLO</option>
                <option value="green">VERDE</option>
            {}
            -->
            </select>
            <input type="submit" value="enviar" name="enviar"/>
        </form>
        <?= $codHexColor ?>
    </body>
</html>
