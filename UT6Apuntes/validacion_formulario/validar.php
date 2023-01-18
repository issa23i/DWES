<?php
function validarNombre($nombre){
	if(strlen($nombre) < 4) {
		return false;
	}
	return true;
}

function validarEmail($email){
	return preg_match("/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i", $email);
}

function validarPasswords($pass1, $pass2) {
	return $pass1 == $pass2 && strlen($pass1) > 5;
}

function validar($nombre, $email, $pass1, $pass2) {
	return validarNombre($nombre) && validarEmail($email) && validarPasswords($pass1, $pass2);
}
?>
