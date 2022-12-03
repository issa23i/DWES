<?php




/* Arrays asociativos */
$edades = ["Macarena" => 33, "Carlos Andrés"=> 45, "Isabel" => 21];

/* Funciones y array_map */
$valores = array(26,2,4,1,3);
function pordos($v){return $v*2;}
print_r(array_map("pordos", $valores));

/* Random */
$numeroRandom = mt_rand();
$numeroRandom1 = mt_rand(22,68);
?>
<html>
    <head>
        <title>title</title>
    </head>
    <body>
        <!-- Actualizar página -->
        <a href="<?php $_SERVER['PHP_SELF']?>">Actualizar página</a>
        <p><?= true?"Ahios":"Hola";  ?></p>
        <p>Isabel tiene <?=$edades["Isabel"]?> años</p>
        <?= "<p>Macarena tiene {$edades["Macarena"]} años</p>" ?>
        <p>Isabel tiene <?=$numeroRandom?> años</p>
        <p>Isabel tiene <?=$numeroRandom1?> años</p>
        <p>Botón de <a href="<?php $_SERVER['PHP_SELF']?>">recargar</a></p>
        <!--pre><?php print_r(get_defined_constants())?></pre -->
        <!--pre><?php print_r(get_defined_functions())?></pre -->
        <pre><?php print_r(get_defined_vars())?></pre>
        <p><?= PHP_INT_MAX ?></p>
        <p><?= PHP_INT_SIZE ?></p>
    </body>
</html>





