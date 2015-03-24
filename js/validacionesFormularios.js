
/*$(document).ready(function () { 	
	//formulario LOGUIN
	$("[name=b_loguin]").click(function (){ 

		if( $("[name=contrasena]").val() == "" ){ 
		//	$("[name=password]").focus().after("<span class='error'>Ingrese la Password</span>"); 
			$("[name=contrasena]").removeClass("input");
			$("[name=contrasena]").addClass("errorInput");
			return false; 
		}else{
			$("[name=contrasena]").addClass("input");
		}
	});


	//formulario REGUISTRO
	$("[name=b_registro]").click(function (){ 
	
		if( $("[name=nombre]").val() == "" ){ 
		//	$("[name=password]").focus().after("<span class='error'>Ingrese la Password</span>"); 
			$("[name=nombre]").focus();
			$("[name=nombre]").addClass("errorInput");
			
			return false; 
		}else{
			$("[name=nombre]").removeClass("errorInput");
		}
	});
	
});

*/

$().ready(function() {

jQuery.validator.setDefaults({
	debug: true,
	success: "valid",
});
/*
	var validator = $("#form_registro").bind("invalid-form.validate", function() {
			$("#summary").html("Your form contains " + validator.numberOfInvalids() + " errors, see details below.");
	}).validate({
	 */
		//	debug: true,
		//	errorElement: "em",
		//	errorContainer: $(" #summary"),
			
	/*	
		    jQuery.validator.addMethod("lettersonly", function(value, element) {
      return this.optional(element) || /^[a-z]+$/i.test(value);
    }, "Solo letras");
	*/	
	$("#form_registro").validate({
		debug: true,
		success: "valid",
		rules: {
			nombre: {
				required: true,
				// lettersonly: true, escribe solo letras
				letterswithspaces: true, // escribe letras y espacios en blanco
			},
			apellidos: {
				required: true,
				letterswithspaces: true,
			},
			sexo: {
				required: true,
			},
			fechanacimiento: {
				required: true,
				date:true,
			},
			telefono: {
				required: true,
				digits:true,
				minlength: 9,
			//	maxlength: 15,	
			},
			cp: {
				required: true,
				letters_digits:true,
			//	minlength: 5,
			},
			ciudad: {
				required: true,
				letterswithspaces: true,
			},
			nacionalidad: {
				required: true,
			},
			email: {
				required: true,
				email:true,
			},
			contrasena: {
				required: true,
				rangelength: [6, 12],
			},
			contrasena2: {
				required: true,
				rangelength: [6, 12],
				equalTo: "#contrasena",
			},
		},
		
		/* SI SE INDICAS AQUI LS MENSAJES SE INDICAN ESTOS Y NO LOS DEL FICHERO 'MESSAGES_ES.JS'
		messages: {
			nombre: {
				required: "Campo obligatorios"
			},
			apellidos: {
				lettersonly: "Escribe sólo letras"
			}, 
		},
	*/	
		/*
			success: function(label) {
				//label.text("ok!").addClass("success");
				label.html("&nbsp;").removeClass("error");
				label.html("&nbsp;").addClass("success");
			},
		*/
			submitHandler: function() {  //cuando se envia el formulario
				alert("formulario enviado");
				form_registro.submit();
			}
		
		});

});