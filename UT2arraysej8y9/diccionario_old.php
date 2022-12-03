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

        <?= "<p><a href=\"$_SERVER[PHP_SELF]\">Actualice la página</a> para mostrar una nueva palabra.</p>"?>

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

// recoger una palabra al azar que no sea columna 0
//primero averiguar dimensiones de la matriz
        $lengthPalabras = count($palabras);
        $lengthIdioma = count($idiomas);
//ahora sacar la palabra random
        $palabrasRandom = random_int(0, $lengthPalabras - 1);
        $idiomaRandom = random_int(1, $lengthIdioma - 1);
        $palabraRandom = $palabras[$palabrasRandom][$idiomaRandom];
// traducir
        $traducida = $palabras[$palabrasRandom][0];
        $idioma = $idiomas[$idiomaRandom];
        ?>
        <?php if($palabraRandom==''){ ?>
        <p>No existe traducción para la palabra <?= $traducida ?> en <?= $idioma ?> </p>
        <?php } else { ?>
        <p>La palabra <?= $palabraRandom ?> quiere decir <?= $traducida ?> en <?= $idioma ?></p>

        <?php } ?>

        <footer>
            <p>Isabel Pastor</p>
        </footer>
    </body>
    <!-- 8) Escribe un programa, usando el fichero diccionario.php, que muestre la
    traducción de una palabra al azar (que no esté en español) a un idioma al
    azar (que no sea el español). Las posibles palabras se proporcionan en el
    array “palabras”, en el cual cada columna se corresponde a un idioma y cada
    fila a una palabra. Los distintos idiomas aparecen en el array dado
    “idiomas”. Por ejemplo, si la palabra seleccionada al azar es “chien”, el
    mensaje mostrado por pantalla debería de ser: “chien quiere decir perro en
    francés”.
    9) Modifica el programa anterior para que tenga en cuenta la posibilidad de que
    alguna palabra en español del diccionario dado no tenga traducción a otro
    idioma, lo cual ocurriría cuando aparece el valor vacío “” en el elemento
    del array correspondiente al idioma a traducir. Por ejemplo, para la
    palabra “noniná”, el mensaje mostrado sería: “No está disponible la
    traducción de noniná”. -->
</html>
