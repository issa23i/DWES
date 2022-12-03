<?php
/**
 * 6) Escribe un programa que muestre una secuencia aleatoria de 10 bits. 
 * Utiliza un array numérico para almacenar cada bit (0 ó 1) obtenido.
7) Genera otro array numérico a partir del anterior con la secuencia de bits
complementaria (negación de cada bit).
 */
define("NUMBITS",10);
$bitsAleatorios = [];
for ($i=0;$i<NUMBITS;$i++) {
   $bitsAleatorios[]=rand(0,1);
}

//cambiar 0 por 1 y al contrario
$bitsAleatorioInverso = [];
for ($i = 0; $i <NUMBITS; $i++) {
    if ($bitsAleatorios[$i]==0){
        $bitsAleatorioInverso=1;
    } else {
        $bitsAleatorioInverso=0;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <table>
            <tr>
                <?phpfor ($i = 0;$i < NUMBITS;$i++) :?>
                <td><?=$bitsAleatorios[$i]?></td>
                <?phpendfor;?>
            </tr>
            <tr>
                <?phpfor ($i = 0;$i < NUMBITS;$i++) :?>
                <td><?=$bitAleatorioInverso[$i]?></td>
                <?phpendfor;?>
            </tr>
        </table>
        
    </body>
</html>
