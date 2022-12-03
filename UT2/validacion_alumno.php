<?php
$estilo = "validado";
$text = "";
$alumnos = ["adiarub" => ["nombre"=> "Aida", "password" => "adiarub1234"],
            "ipaslop" => ["nombre"=> "Isabel", "password" => "ipaslop1234"],
            "agutrod" => ["nombre"=> "Alberto", "password" => "agutrod1234"]];

if (isset($_REQUEST['enviando'])) {
    $login = $_REQUEST['login'];
    $passw = $_REQUEST['password'];
    
    if ($login == "" || $passw == "") {
        $estilo="no_validado";
        $text = "¡Introduzca los dos parametros!";
        
    } elseif (!array_key_exists($login, $alumnos) 
            || $passw!=$alumnos[$login]["password"]) {
        $estilo="no_validado";
        $text = "¡Usuario inexistente o contraseña incorrecta!";
        
    } else {
        $estilo="validado";
        $text = '¡Bienvenido! '.$alumnos[$login]["nombre"];
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

<p class="<?= $estilo ?>"><?= $text ?></p>



<table>
    <tr> 
        <th>Usuario</th>
        <th>Nombre</th>
    </tr>
    
    <?php foreach ($alumnos as $key=>$value): ?>
    <tr>  
        <td> <?= $key ?> </td>
        <td>  <?= $value["nombre"] ?></td>
    </tr>
    <?php endforeach; ?>
    
</table>

</body>
</html>
