<script language="javascript">
	$(document).ready(function () { 
	
		jQuery.validator.setDefaults({
			debug: true,
			success: "valid",
		});
		
		$("#formContacto").validate({
			debug: true,
			success: "valid",
			rules: {
				mail: {
					required: true,
					email:true,
				},
				mensaje: {
					required: true,
				},
			},
			
			submitHandler: function() {  //cuando se envia el formulario
			//	alert("formulario enviado");
				//formContacto.submit();
				openFancyboxPequenho1();
				var email=$('[name=mail]').val();
				var msg=$('[name=mensaje]').val();
					$.post('./do.php',
						{ op: 'contactar',email: email, mensaje: msg},
						function(){
							$("#bloque_contacto").html("<div style='text-align:center;margin-top:50px;' id='message'></div>");
							$('#message').append("<a  onclick='emailEnviado();'><img id='checkmark' src='imagenes/aceptar.png' /></a>");
							$('#message').append("<h2>¡¡ Consulta Enviada !!</h2>");
						}
					);
			}
		});

	});
	

function emailEnviado(){
	$("#bloque_contacto").load("email_contactar.php");

}
	
</script>

<form name="formContacto"  id="formContacto" class="loguin_form" action="" method="post">
	<div>
		<label for="mail">E-mail: </label>
		<input type="text" name="mail" id="mail" class="input input_tamanhoNormal"/>
	</div>
	<div style="margin-top:15px">
		<label  for="mensaje">Comentario:</label>
		<textarea name="mensaje" class="" style=" width: 230px; height: 90px;"></textarea>
	</div>
	<div style="text-align:center;">
		<input type="submit" class="" value="Enviar" style="margin:5px 0 5px 0;">
	</div>
</form>