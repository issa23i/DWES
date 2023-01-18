$(document).ready(function(){
function validarNombre(){
	if(nombre.val().length < 4) {
		errorNombre.removeClass("oculto");
		return false;
	}
	errorNombre.addClass("oculto");
	return true;
}

function validarEmail(){
	if(!email.val().match("^[a-zA-Z0-9]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$")) {
		errorEmail.removeClass("oculto");
		return false;
	}
	errorEmail.addClass("oculto");
	return true;
}

function validarPasswords(){
	if(password1.val().length < 6 || password1.val() != password2.val()) {
		errorPassword.removeClass("oculto");
		return false;
	}
	errorPassword.addClass("oculto");
	return true;
}

function validar(){
	return validarNombre() & validarEmail() & validarPasswords();
}
var nombre = $("#nombre");
var password1 = $("#password1");
var password2 = $("#password2");
var email = $("#email");
var errorNombre = $("#errorNombre");
var errorPassword = $("#errorPassword");
var errorEmail = $("#errorEmail");



$("#datos").submit(function(){
	if(validar()) return true;
	else return false;
});

});
