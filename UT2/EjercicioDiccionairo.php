<?php
$idiomas = ["español", "inglés", "francés", "italiano"];

$palabras = [
    ["perro", "dog", "chien", "cane"],
    ["gato", "cat", "chat", "gatto"],
    ["enero", "january", "janvier", "gennaio"],
    ["feliz", "happy", "heureux", "felice"],
    ["viernes", "friday", "vendredi", "venerdì"],
    ["instituto", "high school", "lycée", "istituto"],
    ["vacaciones", "holidays", "vacances", "vazanze"],
    ["noniná", "", "", ""]
];

$mensaje = "";

//Selección de coordenadas
$columna = rand(1, count($idiomas) - 1);
$fila = rand(0, count($palabras) - 1);
$palabraEspaniol = $palabras[$fila][0];
$palabraExtranjera = $palabras[$fila][$columna];
//Log
$mensaje .= "Columna: " . $columna . " Fila: " . $fila . "<br>";
$mensaje .= "Idioma a traducir: " . $idiomas[$columna] . "<br>";

if ($palabraExtranjera == "") {
    $mensaje .= "La palabra: " . $palabraEspaniol . " no tiene traducción.";
} else {
    $mensaje .= "La palabra : " . $palabraEspaniol;
    $mensaje .= " en " . $idiomas[$columna] . " es: " . $palabraExtranjera;
}
echo $mensaje;
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>
            Diccionario multilingüe.
        </title>
    </head>

    <body>
        <h1>Diccionario multilingüe</h1>

        <p>Actualice la página para mostrar una nueva palabra.</p>
        <footer>
            <p>Escriba aquí su nombre</p>
        </footer>
    </body>
</html>
