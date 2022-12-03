<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Formulario edad</title>
<style>
	h1{
		text-align:center;
	}

	table{
		background-color:#FFC;
		padding:5px;
		border:#666 5px solid;
	}
	
	.rojo{
		font-size:18px;
		color:#F00;
		font-weight:bold;
		text-align:center;
	}
	
	.verde{
		font-size:18px;
		color:#0C3;
		font-weight:bold;
		text-align:center;
	}


</style>
</head>

<body>
<h1>INTRODUCE TU EDAD</h1>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" name="datos_usuario" id="datos_usuario">
  <table width="15%" align="center">
    <tr>
      <td>Nombre:</td>
      <td><label for="nombre_usuario"></label>
      <input type="text" name="usuario" id="usuario"></td>
    </tr>
    <tr>
      <td>Edad:</td>
      <td><label for="edad_usuario"></label>
      <input type="text" name="edad" id="edad"></td>
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

<?php

?>

</body>
</html>
