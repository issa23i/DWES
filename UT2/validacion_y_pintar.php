<?php

// Variables
$alumnos = ["adiarub" => ["nombre"=> "Aida", "password" => "adiarub1234"],
            "ipaslop" => ["nombre"=> "Isabel", "password" => "ipaslop1234"],
            "agutrod" => ["nombre"=> "Alberto", "password" => "agutrod1234"],
            "aaa" => ["nombre"=> "Alberto", "password" => "bbb"],
            "minitot" => ["nombre"=> "Maca","password"=> "maca1234"]];
$sent = isset($_POST['enviando']);
$msg = "";
$estilo = "validado";
$login_ok = false;

// funcion para pintar impares de gris en la tabla
$i=0;
function estiloImpar($i) {
    if ($i&1) {return "grey";return "white"; }
}
// Validación
if ($sent) {
    
    $login = $_POST['login'];
    $password = $_POST['password'];
    
    if ( $login == "" || $password == "" ) {
        $msg = "Debe rellenar todos los campos";
        $estilo = "no_validado";
        $login_ok = false;
    } elseif (!array_key_exists($login, $alumnos) 
            || $password!=$alumnos[$login]["password"]) {
        $msg = "Usuario o contraseña inválidos";
        $estilo = "no_validado";
        $login_ok = false;
    } else {
        $msg = "¡Bienvenid@, ".$alumnos[$login]["nombre"]."!";
        $login_ok = true;
    }
    
}


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Validación alumno</title>
<style>
	h1{
		text-align:center;
	}

	.tabla_login{
		background-color:#FFC;
		padding:5px;
		border:#666 5px solid;
        }
        .grey{
                background-color: grey;
                color: white;
        }
        .white{
                background-color: white;
                color: grey;
        }
	.no_validado{
		font-size:18px;
		color:#F00;
		font-weight:bold;
	}
	
	.validado{
		font-size:18px;
		color:#0C3;
		font-weight:bold;
	}
        
        .tabla_alumnos {border:1px solid black}

</style>
</head>

<body>
    <h1>VALIDACIÓN ALUMNO 2DAW</h1>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" name="datos_alumno" id="datos_alumno">
      <table class="tabla_login" width="15%" align="center">
        <tr>
          <td>Nombre:</td>
          <td><label for="login"></label>
          <input type="text" name="login" id="login"></td>
        </tr>
        <tr>
          <td>Contraseña:</td>
          <td><label for="password"></label>
          <input type="password" name="password" id="password"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="center"><input type="submit" name="enviando" id="enviando" value="Enviar"></td>
        </tr>
      </table>
    </form>
    <p class="<?= $estilo ?>"><?= $msg ?></p>
    
    <?php if($login_ok): ?>
    <table class="tabla_alumnos">
        <tr>
            <th>USUARIOS</th><th>CONTRASEÑAS</th>
        </tr>
        <?php foreach ($alumnos as $key => $value) :?>
        <?php $i++; ?>
        <tr class="<?= estiloImpar($i) ?>">
            <td><?=$key?></td><td><?=$value["password"]?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>
</body>
</html>
