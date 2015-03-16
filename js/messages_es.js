/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: ES (Spanish; Español)
 */
jQuery.extend(jQuery.validator.messages, {
	required: "Campo obligatorio.",
	email:"Introduzca una dirección de correo valida",
	equalTo: "Introduzca el mismo valor que en Contraseña.",

	date: "Introduzca una fecha válida.",
	number: "Introduzca un número entero.",
	digits: "Introduzca sólo dígitos.",
	maxlength:"Introduzca menos de {0} caracteres",
	minlength:"Introduzca más de {0} caracteres",

	letterswithspaces: jQuery.validator.format("Introduzca sólo letras y espacios en blanco."),
	letters_digits: jQuery.validator.format("Introduzca sólo letras y dígitos."),
	rangelength: jQuery.validator.format("Introduzca un valor entre {0} y {1} caracteres."),
	range: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1}."),
  
  /*
	url: "Por favor, escribe una URL válida.",
	dateISO: "Por favor, escribe una fecha (ISO) válida.",
	remote: "Por favor, rellena este campo.",
	creditcard: "Por favor, escribe un número de tarjeta válido.",

	accept: "Por favor, escribe un valor con una extensión aceptada.",

	max: jQuery.validator.format("Por favor, escribe un valor menor o igual a {0}."),
	min: jQuery.validator.format("Por favor, escribe un valor mayor o igual a {0}.")
  
  */
});