<?php 
session_start();

if (isset($_SESSION["id"])){ 

header("Location: index.php");

}
require_once("clases.php");
require_once("top.php");
?>
<script>
	function validarCampos(){
		var nombre = $('#nombre').val();
		var apellidos = $('#apellidos').val();
		var nacionalidad = $('#nacionalidad').val();
		var fechanacimiento = $('#fechanacimiento').val();
		var email = $('#email').val();
		var contrasena = $('#contrasena').val();
		var error="";
	if(nombre==""){
		error += " -Nombre \n";
	}

	if(apellidos==""){
		error += " -Apellidos \n";
	}	
	
	if(nacionalidad==""){
		error += " -Nacionalidad \n";
	}
	if(fechanacimiento==""){
		error += " -Fecha de nacimiento \n";
		
	}
	if(sexo==""){
		error += " -Sexo \n";
		
	}
	if(contrasena==""){
		error += " -Password \n";
	}
	
	if(email==""){
		error += " -Email \n";
	}
	
	if(error !=""){

		alert("Compruebe que ha rellenado los siguientes campos: \n " + error);

	}else{
		formulario.submit();
	}
	}
</script>
	<div id="central">
		<article>Formulario de Registro</article>
		
		<form name="formulario" method="POST" action="do.php">
			<input type="hidden" name="op" value="registro">
			
			<div id="sidebar">
				<div >
					<label for="nombre">Nombre</label>
					<input type="text" name="nombre" id="nombre" value="" />
				</div>
				<div >
					<label for="apellidos">Apellidos</label>
					<input type="text" name="apellidos" id="apellidos" value="" />
				</div>
				<br>
				<div >
					<label for="nacionalidad">Nacionalidad</label>					
					<select name="nacionalidad" id="nacionalidad">
					<?php 
						$util=new ClsUtil();
						$ar_nacionalidades= $util->getNacionalidades();
						foreach($ar_nacionalidades as $nacionalidad){ ?>
						
						<option value="<?php echo $nacionalidad?>"><?php echo $nacionalidad?></option>
					<?php
						}
					?>
					
						
					</select>
				</div>
				<div >
					<label for="fechanacimiento">Fecha Nacimiento</label>
					<input type="text" name="fechanacimiento" id="fechanacimiento" value="" />
				</div>
				<div >
					<label for="sexo">Sexo</label>
					<input type="text" name="sexo" id="sexo" value="" />
				</div>
				<br>
				<div>
					<label for="email">Email</label>
					<input type="text" name="email" id="email" value="" />
				</div>
				<div >
					<label for="contrasena">Password</label>
					<input type="password" name="contrasena" id="contrasena" value="" />
				</div>
				
				<input type="button" value="Registro" onclick="validarCampos()" style="margin:15px;">
				
			</div>
		</form>
	</div>
	
<?php

require_once("bottom.php"); 

?>